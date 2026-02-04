<?php
// PostgreSQL connection using PDO
try {
    $dbc = require __DIR__ . '/../includes/db/pdo_pg.php';
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    die('Database connection error');
}

function escape_data($data, $dbc){
    return trim($data); // PDO handles escaping via prepared statements
}