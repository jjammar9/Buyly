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

        $perPage = max(1, min((int) $request->input('per_page', 20), 50));

        $sort = $request->input('sort', 'newest');
        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'name_asc' => $query->orderBy('name'),
            'name_desc' => $query->orderByDesc('name'),
            default => $query->latest(),
        };

        return $query->paginate($perPage);
    }

    public function featured()
    {
        return Product::with('category')
            ->where('is_featured', true)
            ->where('in_stock', true)
            ->inRandomOrder()
            ->limit(8)
            ->get();
    }

    public function show(string $slug)
    {
        $product = Product::with('category')->whereSlug($slug)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return $product;
    }
}
