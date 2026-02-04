<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$page_title = 'Home Page ';

// Test database connection first
try {
    $test_pdo = require __DIR__ . '/includes/db/pdo_pg.php';
    // Quick connection test
    $test_pdo->query('SELECT 1');
} catch (Exception $e) {
    error_log('Database connection failed on index.php: ' . $e->getMessage());
    echo '<!DOCTYPE html><html><head><title>Database Error</title></head><body>';
    echo '<h1>Database Connection Error</h1>';
    echo '<p>Unable to connect to database. Please try again later.</p>';
    echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '</body></html>';
    exit;
}

try {
    include 'Administration/config.inc.php';
    include "Administration/mysql.inc.php";
    include "includes/view/header.php";
    include "includes/view/processor/home.data.config.php";
    include "includes/view/home.php";
    include "includes/view/footer.php";
} catch (Exception $e) {
    echo "<!DOCTYPE html><html><head><title>Application Error</title></head><body>";
    echo "<h1>Application Error</h1>";
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</body></html>";
    error_log('Index.php error: ' . $e->getMessage());
}