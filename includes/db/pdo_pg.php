<?php
// Production-ready PDO Postgres connection helper
// Usage: $pdo = require __DIR__ . '/pdo_pg.php';

if (isset($GLOBALS['__pdo_pg_instance'])) {
    return $GLOBALS['__pdo_pg_instance'];
}

// Check for Supabase environment variables first
$dsn = getenv('DATABASE_URL') ?: null;

if (!$dsn) {
    // Try to construct from individual Supabase variables
    $supabase_url = getenv('SUPABASE_URL');
    if ($supabase_url) {
        // Extract project ID from Supabase URL
        preg_match('/https:\/\/([a-z0-9]+)\.supabase\.co/', $supabase_url, $matches);
        $project_id = $matches[1] ?? null;
        
        if ($project_id) {
            // Construct DATABASE_URL for Supabase
            $dsn = "postgresql://postgres:[password]@db.{$project_id}.supabase.co:5432/postgres";
            error_log('Constructed DSN from SUPABASE_URL: ' . $dsn);
        }
    }
}

if ($dsn) {
    // DATABASE_URL format: postgres://user:pass@host:port/dbname
    $url = parse_url($dsn);
    $host = $url['host'] ?? null;
    $port = $url['port'] ?? 5432;
    $user = $url['user'] ?? null;
    $pass = $url['pass'] ?? null;
    $db = ltrim($url['path'] ?? '', '/');
    
    if (!$host || !$user) {
        throw new PDOException('Invalid DATABASE_URL format');
    }
    
    $pdo_dsn = "pgsql:host={$host};port={$port};dbname={$db}";
} else {
    // Fallback to individual environment variables
    $host = getenv('DB_HOST') ?: 'db.vqlybihufqliujmgwcgz.supabase.co';
    $port = getenv('DB_PORT') ?: 5432;
    $db = getenv('DB_NAME') ?: 'postgres';
    $user = getenv('DB_USER') ?: 'postgres';
    $pass = getenv('DB_PASSWORD') ?: '';
    $pdo_dsn = "pgsql:host={$host};port={$port};dbname={$db}";
    
    error_log('Using fallback database connection: ' . $pdo_dsn);
}

$opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_STRINGIFY_FETCHES => false,
];

try {
    $pdo = new PDO($pdo_dsn, $user, $pass, $opts);
    error_log('Database connection successful');
} catch (PDOException $e) {
    error_log('PDO connection failed: ' . $e->getMessage());
    error_log('Connection details - Host: ' . $host . ', Port: ' . $port . ', DB: ' . $db . ', User: ' . $user);
    throw new PDOException('Database connection failed. Please check environment variables.');
}

$GLOBALS['__pdo_pg_instance'] = $pdo;
return $pdo;
