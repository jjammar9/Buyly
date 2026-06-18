<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::match(['put', 'patch'], 'user', [AuthController::class, 'update']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
    Route::patch('orders/{order}/progress', [OrderController::class, 'progress']);
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/add', [CartController::class, 'add']);
    Route::put('cart/product/{productId}', [CartController::class, 'update']);
    Route::delete('cart/product/{productId}', [CartController::class, 'remove']);
    Route::delete('cart', [CartController::class, 'clear']);
    Route::get('cart/count', [CartController::class, 'count']);
});

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{slug}', [CategoryController::class, 'show']);

Route::get('products', [ProductController::class, 'index']);
Route::get('products/featured', [ProductController::class, 'featured']);
Route::get('products/{slug}', [ProductController::class, 'show']);
