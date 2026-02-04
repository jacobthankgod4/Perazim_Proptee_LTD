<?php
try {
    $pdo = require __DIR__ . '/includes/db/pdo_pg.php';
    echo "✓ Database connection successful\n";
    
    $stmt = $pdo->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "✓ PostgreSQL version: " . $version . "\n";
    
} catch (Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
}