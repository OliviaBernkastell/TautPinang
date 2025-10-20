<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'DB_HOST: ' . env('DB_HOST', '127.0.0.1') . PHP_EOL;
echo 'DB_PORT: ' . env('DB_PORT', '3306') . PHP_EOL;
echo 'DB_DATABASE: ' . env('DB_DATABASE', 'unknown') . PHP_EOL;