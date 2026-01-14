<!DOCTYPE html>
<html>
<head>
    <title>Debug Images</title>
</head>
<body>
    <h1>Debug Product Images</h1>
    @php
        $products = App\Models\Product::take(5)->get();
    @endphp
    
    @foreach($products as $product)
        <div style="margin: 20px; padding: 20px; border: 1px solid #ccc;">
            <h3>{{ $product->name }}</h3>
            <p><strong>Image field:</strong> {{ $product->image ?: 'empty' }}</p>
            <p><strong>Image URL:</strong> {{ $product->image_url }}</p>
            <p><strong>Raw URL (no encoding):</strong> {{ $product->image_url }}</p>
            <p><strong>File exists:</strong> 
                @php
                    $filePath = storage_path('app/public/products/' . $product->image);
                    echo file_exists($filePath) ? 'YES' : 'NO';
                @endphp
            </p>
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 200px;" 
                 onerror="console.error('Image failed to load:', this.src); this.style.border='3px solid red';">
            <hr>
        </div>
    @endforeach
    
    <h2>Test Direct Access</h2>
    <p><a href="{{ asset('storage/products/logo_1768038929_696222111bf72.jpeg') }}" target="_blank">
        Test Image: {{ asset('storage/products/logo_1768038929_696222111bf72.jpeg') }}
    </a></p>
</body>
</html>
