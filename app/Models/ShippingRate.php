<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    protected $fillable = [
        'shipping_provider_id',
        'province',
        'rate',
    ];

    protected $casts = [
        'rate' => 'decimal:2',
    ];

    public function shippingProvider()
    {
        return $this->belongsTo(ShippingProvider::class);
    }
}
