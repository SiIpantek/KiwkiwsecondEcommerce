<?php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$product = App\Models\Product::first();

if ($product) {
    echo "<h1>Asset URL Test</h1>";
    echo "<p><strong>Product:</strong> " . $product->name . "</p>";
    echo "<p><strong>Image field:</strong> " . $product->image . "</p>";
    echo "<hr>";
    
    echo "<h2>URL Comparison</h2>";
    echo "<p><strong>From model (image_url):</strong><br>";
    echo $product->image_url . "</p>";
    
    echo "<p><strong>From asset() helper:</strong><br>";
    echo asset('storage/products/' . $product->image) . "</p>";
    
    echo "<p><strong>APP_URL config:</strong><br>";
    echo config('app.url') . "</p>";
    
    echo "<hr>";
    echo "<h2>Test Images</h2>";
    
    echo "<h3>Test 1: Using image_url</h3>";
    echo "<img src='" . $product->image_url . "' alt='Test 1' style='max-width: 300px; border: 3px solid blue;' 
          onload='console.log(\"Test 1 loaded\")' 
          onerror='console.error(\"Test 1 failed\"); this.style.border=\"5px solid red\";'>";
    
    echo "<h3>Test 2: Using asset()</h3>";
    echo "<img src='" . asset('storage/products/' . $product->image) . "' alt='Test 2' style='max-width: 300px; border: 3px solid green;'
          onload='console.log(\"Test 2 loaded\")' 
          onerror='console.error(\"Test 2 failed\"); this.style.border=\"5px solid red\";'>";
}
