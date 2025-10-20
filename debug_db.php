<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Enable query log
DB::enableQueryLog();

// Get first tautan
$tautan = App\Models\Tautan::first();

// Show queries
echo "Queries: " . json_encode(DB::getQueryLog()) . PHP_EOL;

// Show data
echo "Database: " . DB::connection()->getDatabaseName() . PHP_EOL;
echo "Host: " . DB::connection()->getConfig('host') . PHP_EOL;
echo "ID: " . $tautan->id . PHP_EOL;
echo "QR borderColor: " . json_encode($tautan->styles['qrcode']['borderColor'] ?? 'NOT FOUND') . PHP_EOL;