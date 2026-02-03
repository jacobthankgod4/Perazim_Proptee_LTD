<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->call('route:clear');
$kernel->call('config:clear');
$kernel->call('cache:clear');
echo "Caches cleared!";