<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('in_stock', true);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $category));
        }

        $perPage = min((int) $request->input('per_page', 20), 50);

        return $query->latest()->paginate($perPage);
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
