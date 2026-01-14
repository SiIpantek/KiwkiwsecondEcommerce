<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$product = App\Models\Product::first();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Render Test</title>
    <style>
        body { padding: 20px; font-family: Arial; }
        .test { margin: 20px; padding: 20px; border: 3px solid blue; background: white; }
        img { border: 5px solid green; max-width: 500px; }
    </style>
</head>
<body>
    <h1>Simple Image Render Test</h1>
    
    <?php if($product): ?>
        <div class="test">
            <h2>Product: <?= htmlspecialchars($product->name) ?></h2>
            <p><strong>URL:</strong> <?= htmlspecialchars($product->image_url) ?></p>
            
            <h3>Test 1: Direct img tag (no container)</h3>
            <img src="<?= htmlspecialchars($product->image_url) ?>" 
                 alt="Test 1"
                 onload="console.log('LOADED:', this.src); alert('Image loaded!');"
                 onerror="console.error('ERROR:', this.src); alert('Image failed!');">
            
            <h3>Test 2: With simple div container</h3>
            <div style="width: 300px; height: 300px; border: 2px solid red; overflow: hidden;">
                <img src="<?= htmlspecialchars($product->image_url) ?>" 
                     alt="Test 2"
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onload="console.log('LOADED 2:', this.src);"
                     onerror="console.error('ERROR 2:', this.src);">
            </div>
        </div>
    <?php endif; ?>
</body>
</html>
