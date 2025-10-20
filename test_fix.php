<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TESTING QR CODE FIX ===\n\n";

// Test 1: Cek data asli dari database
echo "1. RAW DATA from database:\n";
$tautan = App\Models\Tautan::first();
echo "ID: " . $tautan->id . "\n";
echo "Raw JSON: " . json_encode($tautan->getRawOriginal('styles'), JSON_PRETTY_PRINT) . "\n\n";

// Test 2: Cek data setelah lewat accessor
echo "2. ACCESSOR DATA (after Model processing):\n";
echo "Accessor JSON: " . json_encode($tautan->styles, JSON_PRETTY_PRINT) . "\n\n";

// Test 3: Cek specific QR borderColor
echo "3. QR borderColor comparison:\n";
echo "Raw: " . json_encode($tautan->getRawOriginal('styles')['qrcode']['borderColor'] ?? 'NOT FOUND') . "\n";
echo "Accessor: " . json_encode($tautan->styles['qrcode']['borderColor'] ?? 'NOT FOUND') . "\n\n";

// Test 4: Cek apakah ada perbedaan
$rawData = $tautan->getRawOriginal('styles');
$accessorData = $tautan->styles;

if ($rawData !== $accessorData) {
    echo "❌ DATA BERBEDA!\n";
    echo "Raw: " . json_encode($rawData['qrcode']['borderColor'] ?? 'NOT FOUND') . "\n";
    echo "Accessor: " . json_encode($accessorData['qrcode']['borderColor'] ?? 'NOT FOUND') . "\n";
} else {
    echo "✅ DATA SAMA - Fix berhasil!\n";
    echo "QR borderColor: " . json_encode($accessorData['qrcode']['borderColor'] ?? 'NOT FOUND') . "\n";
}

echo "\n=== END TEST ===\n";