<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Deployment Test Suite</h1>\n";

// Test 1: Database Connection
echo "<h2>1. Database Connection Test</h2>\n";
try {
    $pdo = require __DIR__ . '/includes/db/pdo_pg.php';
    echo "✓ Database connection successful<br>\n";
    
    $stmt = $pdo->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "✓ PostgreSQL version: " . htmlspecialchars($version) . "<br>\n";
} catch (Exception $e) {
    echo "✗ Database connection failed: " . htmlspecialchars($e->getMessage()) . "<br>\n";
    exit;
}

// Test 2: Table Existence
echo "<h2>2. Table Structure Test</h2>\n";
$tables = ['users', 'properties', 'investments', 'transactions', 'packages'];
foreach ($tables as $table) {
    try {
        $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
        $count = $stmt->fetchColumn();
        echo "✓ Table '$table' exists with $count records<br>\n";
    } catch (Exception $e) {
        echo "✗ Table '$table' error: " . htmlspecialchars($e->getMessage()) . "<br>\n";
    }
}

// Test 3: Authentication System
echo "<h2>3. Authentication System Test</h2>\n";
try {
    include_once 'includes/auth/auth_helper.php';
    echo "✓ Auth helper loaded successfully<br>\n";
} catch (Exception $e) {
    echo "✗ Auth helper error: " . htmlspecialchars($e->getMessage()) . "<br>\n";
}

// Test 4: Core Includes
echo "<h2>4. Core Files Test</h2>\n";
$core_files = [
    'Administration/config.inc.php',
    'Administration/mysql.inc.php',
    'includes/view/header.php',
    'includes/view/footer.php'
];

foreach ($core_files as $file) {
    if (file_exists($file)) {
        echo "✓ File '$file' exists<br>\n";
    } else {
        echo "✗ File '$file' missing<br>\n";
    }
}

// Test 5: Environment Variables
echo "<h2>5. Environment Variables Test</h2>\n";
$env_vars = ['DATABASE_URL', 'SUPABASE_URL', 'SUPABASE_ANON_KEY'];
foreach ($env_vars as $var) {
    $value = getenv($var);
    if ($value) {
        echo "✓ $var is set<br>\n";
    } else {
        echo "✗ $var is not set<br>\n";
    }
}

// Test 6: Sample Query Test
echo "<h2>6. Sample Query Test</h2>\n";
try {
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM users WHERE status = ?");
    $stmt->execute(['active']);
    $result = $stmt->fetch();
    echo "✓ Sample query executed successfully - Active users: " . $result['total'] . "<br>\n";
} catch (Exception $e) {
    echo "✗ Sample query failed: " . htmlspecialchars($e->getMessage()) . "<br>\n";
}

echo "<h2>Test Complete</h2>\n";
echo "<p>If all tests show ✓, the application is ready for deployment.</p>\n";
?>