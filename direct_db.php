<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=tautpinang', 'root', '');
$result = $pdo->query('SELECT id, JSON_EXTRACT(styles, "$.qrcode.borderColor") as borderColor FROM tautans WHERE id = 29')->fetchAll(PDO::FETCH_ASSOC);
echo "Direct MySQL result: " . json_encode($result) . PHP_EOL;