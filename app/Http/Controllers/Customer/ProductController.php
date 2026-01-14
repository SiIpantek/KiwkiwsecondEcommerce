<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(8);
        $featuredCollections = \App\Models\FeaturedCollection::where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.customers.product.index', compact('products', 'featuredCollections'));
    }
}
