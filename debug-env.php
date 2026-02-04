<?php
echo "<h2>Environment Debug</h2>";
echo "<p>DATABASE_URL: " . (getenv('DATABASE_URL') ? 'SET' : 'NOT SET') . "</p>";
echo "<p>SUPABASE_URL: " . (getenv('SUPABASE_URL') ? 'SET' : 'NOT SET') . "</p>";
echo "<p>SUPABASE_ANON_KEY: " . (getenv('SUPABASE_ANON_KEY') ? 'SET' : 'NOT SET') . "</p>";

if (getenv('DATABASE_URL')) {
    $url = parse_url(getenv('DATABASE_URL'));
    echo "<p>DB Host: " . ($url['host'] ?? 'NOT FOUND') . "</p>";
    echo "<p>DB Port: " . ($url['port'] ?? 'NOT FOUND') . "</p>";
    echo "<p>DB Name: " . (ltrim($url['path'] ?? '', '/') ?: 'NOT FOUND') . "</p>";
    echo "<p>DB User: " . ($url['user'] ?? 'NOT FOUND') . "</p>";
}

try {
    $pdo = require __DIR__ . '/includes/db/pdo_pg.php';
    echo "<p style='color:green'>✓ Database connection successful</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
}