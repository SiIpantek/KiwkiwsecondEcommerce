<!DOCTYPE html>
<html>
<head>
    <title>Test Product URLs</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .product { margin: 20px 0; padding: 20px; border: 1px solid #ccc; }
        .url { background: #f0f0f0; padding: 10px; margin: 10px 0; word-break: break-all; }
        img { max-width: 300px; border: 2px solid blue; margin: 10px 0; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Test Product Image URLs</h1>
    
    @php
        $products = App\Models\Product::take(5)->get();
    @endphp
    
    @foreach($products as $product)
        <div class="product">
            <h2>{{ $product->name }}</h2>
            <p><strong>Image field:</strong> {{ $product->image ?: 'empty' }}</p>
            
            <div class="url">
                <strong>Generated URL:</strong><br>
                {{ $product->image_url }}
            </div>
            
            <p><strong>File exists in storage:</strong> 
                @php
                    $filePath = storage_path('app/public/products/' . $product->image);
                    $exists = file_exists($filePath);
                    echo $exists ? '<span class="success">YES</span>' : '<span class="error">NO</span>';
                @endphp
            </p>
            
            <p><strong>Symlink path exists:</strong>
                @php
                    $symlinkPath = public_path('storage/products/' . $product->image);
                    $symExists = file_exists($symlinkPath);
                    echo $symExists ? '<span class="success">YES</span>' : '<span class="error">NO</span>';
                @endphp
            </p>
            
            <h3>Test Image (should show if URL is correct):</h3>
            <img src="{{ $product->image_url }}" 
                 alt="{{ $product->name }}"
                 onload="console.log('Image loaded:', this.src)"
                 onerror="console.error('Image failed:', this.src); this.style.border='5px solid red';">
            
            <h3>Test Direct Symlink Access:</h3>
            <img src="{{ asset('storage/products/' . $product->image) }}" 
                 alt="Direct symlink"
                 onload="console.log('Direct symlink loaded')"
                 onerror="console.error('Direct symlink failed'); this.style.border='5px solid red';">
        </div>
        <hr>
    @endforeach
    
    <h2>APP_URL Config:</h2>
    <p>{{ config('app.url') }}</p>
    
    <h2>Test Direct File Access:</h2>
    <p><a href="{{ url('test-direct-image.php') }}" target="_blank">Test Direct Image PHP</a></p>
</body>
</html>
