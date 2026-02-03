<?php
// Production-ready PDO Postgres connection helper
// Usage: $pdo = require __DIR__ . '/pdo_pg.php';

if (isset($GLOBALS['__pdo_pg_instance'])) {
    return $GLOBALS['__pdo_pg_instance'];
}

$dsn = getenv('DATABASE_URL') ?: null;
if ($dsn) {
    // DATABASE_URL format: postgres://user:pass@host:port/dbname
    $url = parse_url($dsn);
    $host = $url['host'] ?? null;
    $port = $url['port'] ?? 5432;
    $user = $url['user'] ?? null;
    $pass = $url['pass'] ?? null;
    $db = ltrim($url['path'] ?? '', '/');
    $pdo_dsn = "pgsql:host={$host};port={$port};dbname={$db}";
} else {
    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $port = getenv('DB_PORT') ?: 5432;
    $db = getenv('DB_NAME') ?: 'app';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASSWORD') ?: '';
    $pdo_dsn = "pgsql:host={$host};port={$port};dbname={$db}";
}

$opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_STRINGIFY_FETCHES => false,
];

try {
    $pdo = new PDO($pdo_dsn, $user, $pass, $opts);
} catch (PDOException $e) {
    // In production, avoid echoing details — log and rethrow a generic exception
    error_log('PDO connection failed: ' . $e->getMessage());
    throw $e;
}

$GLOBALS['__pdo_pg_instance'] = $pdo;
return $pdo;
