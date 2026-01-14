<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'stock_quantity',
        'discount',
        'image',
        'slug',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the URL for the product image
     */
    public function getImageUrlAttribute()
    {
        // Jika tidak ada nama gambar atau kosong, langsung return fallback
        if (empty($this->image) || trim($this->image) === '') {
            return asset('images/logo/logo.jpeg');
        }

        $imageName = trim($this->image);
        $imagePath = 'products/' . $imageName;
        $directPath = storage_path('app/public/' . $imagePath);
        
        // Cek apakah file ada secara langsung di filesystem
        if (file_exists($directPath) && is_file($directPath) && filesize($directPath) > 0) {
            // Gunakan asset() helper yang otomatis mendeteksi base URL dari request
            // Ini akan bekerja dengan domain apapun (localhost, kiwkiw.test, dll)
            $url = asset('storage/products/' . $imageName);
            
            // Tambahkan cache busting
            $timestamp = filemtime($directPath);
            $separator = strpos($url, '?') !== false ? '&' : '?';
            return $url . $separator . 'v=' . $timestamp;
        }
        
        // Jika file tidak ditemukan, coba gunakan file placeholder yang ada
        $productsDir = storage_path('app/public/products');
        if (is_dir($productsDir)) {
            $files = array_filter(glob($productsDir . '/*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE), function($file) {
                return is_file($file) && filesize($file) > 0;
            });
            
            if (!empty($files)) {
                // Gunakan file pertama yang ditemukan sebagai placeholder
                $placeholderFile = basename($files[0]);
                $placeholderPath = 'products/' . $placeholderFile;
                
                // Gunakan asset() helper untuk placeholder juga
                $url = asset('storage/' . $placeholderPath);
                
                $placeholderDirectPath = storage_path('app/public/' . $placeholderPath);
                if (file_exists($placeholderDirectPath)) {
                    $timestamp = filemtime($placeholderDirectPath);
                    $separator = strpos($url, '?') !== false ? '&' : '?';
                    return $url . $separator . 'v=' . $timestamp;
                }
            }
        }
        
        // Fallback: selalu return logo jika file tidak ditemukan
        return asset('images/logo/logo.jpeg');
    }
}
