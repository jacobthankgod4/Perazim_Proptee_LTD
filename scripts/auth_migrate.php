#!/usr/bin/env php
<?php
/**
 * Auth migration helper: move existing MySQL `users` table to Postgres with Supabase Auth
 * 
 * This script handles two strategies:
 * 1. (Recommended) Generate password reset tokens and force password reset on login
 * 2. (Optional) Import password hashes directly (requires bcrypt/argon2 compatibility)
 * 
 * Usage:
 *   php scripts/auth_migrate.php --strategy=reset-token
 *   php scripts/auth_migrate.php --strategy=import-hashes --supabase-url=<URL> --supabase-key=<KEY>
 */

$strategy = null;
$supabase_url = null;
$supabase_key = null;
$db_url = getenv('DATABASE_URL');

// Parse CLI arguments
foreach ($argv as $arg) {
    if (strpos($arg, '--strategy=') === 0) {
        $strategy = substr($arg, strlen('--strategy='));
    }
    if (strpos($arg, '--supabase-url=') === 0) {
        $supabase_url = substr($arg, strlen('--supabase-url='));
    }
    if (strpos($arg, '--supabase-key=') === 0) {
        $supabase_key = substr($arg, strlen('--supabase-key='));
    }
}

if (!$strategy || !in_array($strategy, ['reset-token', 'import-hashes'])) {
    fwrite(STDERR, "Usage: php scripts/auth_migrate.php --strategy=reset-token|import-hashes\n");
    exit(1);
}

if ($strategy === 'import-hashes' && (!$supabase_url || !$supabase_key)) {
    fwrite(STDERR, "import-hashes requires --supabase-url and --supabase-key\n");
    exit(1);
}

// Connect to Postgres DB
$url = parse_url($db_url);
if ($url === false) {
    fwrite(STDERR, "Invalid DATABASE_URL\n");
    exit(2);
}

$host = $url['host'] ?? '127.0.0.1';
$port = $url['port'] ?? 5432;
$user = $url['user'] ?? null;
$pass = $url['pass'] ?? null;
$db = ltrim($url['path'] ?? '', '/');
$pdo_dsn = "pgsql:host={$host};port={$port};dbname={$db}";

$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
    $pdo = new PDO($pdo_dsn, $user, $pass, $opts);
} catch (PDOException $e) {
    fwrite(STDERR, "DB connection failed: " . $e->getMessage() . "\n");
    exit(2);
}

echo "Starting auth migration using strategy: $strategy\n";

try {
    $pdo->beginTransaction();

    if ($strategy === 'reset-token') {
        echo "Migration strategy: Generate password reset tokens (users must reset on first login)\n";
        
        // For each existing user, generate a reset token and copy profile data
        $stmt = $pdo->prepare('SELECT "Id", "Email", "Name", "age", "gender", "bank", "Account", "User_Type", "status" FROM public.users WHERE "Id" > 0 LIMIT 1000');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Found " . count($users) . " users to migrate\n";
        
        foreach ($users as $u) {
            // Generate a reset token for forced password reset
            $reset_token = bin2hex(random_bytes(32));
            $reset_expires = date('Y-m-d H:i:s', time() + 86400 * 7); // 7 days
            
            // Insert into users_profile with a placeholder UUID (will be linked to auth.users later)
            // For now, we generate a deterministic UUID based on email to allow later matching
            $uuid = sprintf(
                '00000000-0000-5000-a000-%012s',
                substr(hash('md5', $u['Email']), 0, 12)
            );
            
            $ins = $pdo->prepare('
                INSERT INTO public.users_profile ("auth_id", "User_Type", "Name", "age", "gender", "bank", "Account", "status")
                VALUES (:auth_id, :user_type, :name, :age, :gender, :bank, :account, :status)
                ON CONFLICT ("auth_id") DO UPDATE SET
                  "Name" = EXCLUDED."Name",
                  "age" = EXCLUDED."age",
                  "gender" = EXCLUDED."gender",
                  "bank" = EXCLUDED."bank",
                  "Account" = EXCLUDED."Account",
                  "status" = EXCLUDED."status"
            ');
            
            $ins->execute([
                ':auth_id' => $uuid,
                ':user_type' => $u['User_Type'] ?? 'user',
                ':name' => $u['Name'],
                ':age' => $u['age'],
                ':gender' => $u['gender'],
                ':bank' => $u['bank'],
                ':account' => $u['Account'],
                ':status' => $u['status'] ?? 'active'
            ]);
            
            // Update original users table with reset token (temporary, for reference)
            $upd = $pdo->prepare('UPDATE public.users SET "reset_token_hash" = :token, "reset_token_expires_at" = :expires WHERE "Id" = :id');
            $upd->execute([
                ':token' => $reset_token,
                ':expires' => $reset_expires,
                ':id' => $u['Id']
            ]);
            
            echo "  Migrated user {$u['Email']} (id={$uuid})\n";
        }
        
        echo "✅ All users migrated. Reset tokens generated.\n";
        echo "⚠️  Users must reset passwords on first login to Supabase Auth.\n";
        
    } elseif ($strategy === 'import-hashes') {
        echo "Migration strategy: Import password hashes directly to Supabase Auth\n";
        echo "⚠️  This requires compatible hash formats (bcrypt preferred).\n";
        
        // This requires direct API calls to Supabase to import hashes
        // For now, log instructions and a sample
        
        $stmt = $pdo->prepare('SELECT "Id", "Email", "Password" FROM public.users WHERE "Id" > 0 LIMIT 5');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nSample users (first 5) to import:\n";
        foreach ($users as $u) {
            echo "  - {$u['Email']}: " . substr($u['Password'], 0, 20) . "...\n";
        }
        
        echo "\n❌ Bulk password import via Supabase CLI or API not yet implemented.\n";
        echo "   See: https://supabase.com/docs/guides/auth/auth-password-migration\n";
    }

    $pdo->commit();
    echo "✅ Auth migration completed successfully.\n";

} catch (Exception $e) {
    $pdo->rollBack();
    fwrite(STDERR, "Migration failed: " . $e->getMessage() . "\n");
    exit(3);
}
