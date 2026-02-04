<?php
// Catch-all for other PHP files
$path = $_GET['path'] ?? '';
$file = '../' . $path;

if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require_once $file;
} else {
    http_response_code(404);
    echo "File not found";
}