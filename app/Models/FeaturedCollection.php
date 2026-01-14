<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FeaturedCollection extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image && strpos($this->image, 'storage/') !== false) {
            return asset($this->image);
        }
        
        if ($this->image) {
            return asset('storage/collections/' . $this->image);
        }
        
        return asset('images/logo/logo.jpeg');
    }
}
