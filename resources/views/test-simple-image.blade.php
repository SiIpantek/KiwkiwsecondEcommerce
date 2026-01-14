<!DOCTYPE html>
<html>
<head>
    <title>Simple Image Test</title>
    <style>
        body { padding: 20px; font-family: Arial; }
        .test { margin: 20px 0; padding: 20px; border: 2px solid blue; }
        img { max-width: 400px; border: 3px solid green; display: block; }
    </style>
</head>
<body>
    <h1>Simple Image Test</h1>
    
    @php
        $product = App\Models\Product::first();
    @endphp
    
    @if($product)
        <div class="test">
            <h2>Product: {{ $product->name }}</h2>
            <p><strong>Image URL:</strong> {{ $product->image_url }}</p>
            <p><strong>Direct Asset:</strong> {{ asset('storage/products/' . $product->image) }}</p>
            
            <h3>Test 1: Using image_url attribute</h3>
            <img src="{{ $product->image_url }}" alt="Test 1" 
                 onload="console.log('Test 1 loaded:', this.src)"
                 onerror="console.error('Test 1 failed:', this.src); this.style.border='5px solid red';">
            
            <h3>Test 2: Using asset() directly</h3>
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="Test 2"
                 onload="console.log('Test 2 loaded:', this.src)"
                 onerror="console.error('Test 2 failed:', this.src); this.style.border='5px solid red';">
        </div>
    @endif
</body>
</html>
