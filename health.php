<?php
header('Content-Type: application/json');

$health = [
    'status' => 'ok',
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => []
];

// Database connection check
try {
    $pdo = require __DIR__ . '/includes/db/pdo_pg.php';
    $stmt = $pdo->query('SELECT 1');
    $health['checks']['database'] = 'ok';
} catch (Exception $e) {
    $health['status'] = 'error';
    $health['checks']['database'] = 'failed: ' . $e->getMessage();
}

// File system check
$health['checks']['filesystem'] = file_exists('index.php') ? 'ok' : 'failed';

// Environment variables check
$health['checks']['env_vars'] = getenv('DATABASE_URL') ? 'ok' : 'failed';

// PHP version check
$health['checks']['php_version'] = PHP_VERSION;

echo json_encode($health, JSON_PRETTY_PRINT);
?>