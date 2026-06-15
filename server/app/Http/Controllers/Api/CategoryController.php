<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::ordered()->withCount('products')->get();
    }

    public function show(string $slug)
    {
        return Category::where('slug', $slug)->with('products')->firstOrFail();
    }
}
