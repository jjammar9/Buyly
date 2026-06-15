<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category')
            ->where('in_stock', true)
            ->latest()
            ->paginate(20);
    }

    public function featured()
    {
        return Product::with('category')
            ->where('is_featured', true)
            ->where('in_stock', true)
            ->latest()
            ->get();
    }

    public function show(string $slug)
    {
        return Product::where('slug', $slug)->with('category')->firstOrFail();
    }
}
