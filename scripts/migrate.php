<?php
// Simple idempotent migration runner
// Usage: CLI with env DATABASE_URL set, run from repo root:
// php scripts/migrate.php

$dir = __DIR__ . '/../audit/migrations_pg';
if (!is_dir($dir)) {
    fwrite(STDERR, "Migrations directory not found: $dir\n");
    exit(2);
}

$dsn = getenv('DATABASE_URL') ?: null;
if (!$dsn) {
    fwrite(STDERR, "Set DATABASE_URL (postgres://user:pass@host:port/db)\n");
    exit(2);
}

// parse DSN for PDO
$url = parse_url($dsn);
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

$opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
try {
    $pdo = new PDO($pdo_dsn, $user, $pass, $opts);
} catch (PDOException $e) {
    fwrite(STDERR, "DB connection failed: " . $e->getMessage() . "\n");
    exit(2);
}

// Ensure schema_migrations table
$pdo->exec("CREATE TABLE IF NOT EXISTS schema_migrations (filename TEXT PRIMARY KEY, applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);");

$files = glob($dir . '/*.sql');
usort($files, function($a, $b){ return strcmp(basename($a), basename($b)); });

foreach ($files as $file) {
    $name = basename($file);
    $stmt = $pdo->prepare('SELECT 1 FROM schema_migrations WHERE filename = :f');
    $stmt->execute([':f' => $name]);
    if ($stmt->fetch()) {
        echo "skipping already applied: $name\n";
        continue;
    }

    echo "applying: $name\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        fwrite(STDERR, "failed to read $file\n");
        exit(3);
    }

    try {
        $pdo->beginTransaction();
        $pdo->exec($sql);
        $ins = $pdo->prepare('INSERT INTO schema_migrations (filename) VALUES (:f)');
        $ins->execute([':f' => $name]);
        $pdo->commit();
        echo "applied: $name\n";
    } catch (PDOException $e) {
        $pdo->rollBack();
        fwrite(STDERR, "migration failed ($name): " . $e->getMessage() . "\n");
        exit(4);
    }
}

echo "All migrations applied.\n";
