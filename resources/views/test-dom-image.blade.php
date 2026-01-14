<!DOCTYPE html>
<html>
<head>
    <title>DOM Image Test</title>
    <style>
        body { padding: 20px; font-family: Arial; }
        .test { margin: 20px; padding: 20px; border: 3px solid blue; background: white; }
        img { border: 5px solid green; }
    </style>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img');
            images.forEach((img, index) => {
                console.log(`Image ${index + 1}:`, {
                    src: img.src,
                    complete: img.complete,
                    naturalWidth: img.naturalWidth,
                    naturalHeight: img.naturalHeight,
                    width: img.width,
                    height: img.height,
                    offsetWidth: img.offsetWidth,
                    offsetHeight: img.offsetHeight,
                    style: window.getComputedStyle(img).display,
                    visibility: window.getComputedStyle(img).visibility,
                    opacity: window.getComputedStyle(img).opacity
                });
            });
        });
    </script>
</head>
<body>
    <h1>DOM Image Test</h1>
    
    @php
        $product = App\Models\Product::first();
    @endphp
    
    @if($product)
        <div class="test">
            <h2>Product: {{ $product->name }}</h2>
            <p><strong>URL:</strong> {{ $product->image_url }}</p>
            
            <h3>Test: Simple img tag</h3>
            <img src="{{ $product->image_url }}" 
                 alt="Test"
                 style="width: 300px; height: 300px; border: 5px solid red; background: yellow;"
                 onload="console.log('LOADED - Width:', this.naturalWidth, 'Height:', this.naturalHeight);"
                 onerror="console.error('ERROR');">
        </div>
    @endif
</body>
</html>
