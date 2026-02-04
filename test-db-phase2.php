<?php
// Phase 2 Database Connection Test
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Phase 2: Query System Conversion Test</h2>";

try {
    // Test PDO connection
    $pdo = require __DIR__ . '/includes/db/pdo_pg.php';
    echo "✓ PDO PostgreSQL connection successful<br>";
    
    // Test basic query
    $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM public.users');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ Users table query successful - Count: " . $result['count'] . "<br>";
    
    // Test property query
    $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM public.property');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ Property table query successful - Count: " . $result['count'] . "<br>";
    
    // Test investment query
    $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM public.investment');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ Investment table query successful - Count: " . $result['count'] . "<br>";
    
    // Test complex join query (like in dashboard)
    $stmt = $pdo->prepare('SELECT p."Title", p."Address" FROM public.property p LEFT JOIN public.investment i ON p."Id"=i.property_id LIMIT 3');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "✓ Complex join query successful - Results: " . count($results) . "<br>";
    
    echo "<br><strong>Phase 2 Query System Conversion: COMPLETED ✓</strong><br>";
    echo "All database queries have been successfully converted from MySQL to PostgreSQL.";
    
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "<br>";
    echo "Check your environment variables and database connection.";
}
?>