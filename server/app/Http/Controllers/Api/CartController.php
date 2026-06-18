<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return CartItem::with('product.category')
            ->where('user_id', $request->user()->id)
            ->get()
            ->map(fn ($item) => [
                'id' => $item->product_id,
                'name' => $item->product->name,
                'price' => $item->product->sale_price ?? $item->product->price,
                'image' => $item->product->image,
                'unit' => $item->product->unit,
                'qty' => $item->quantity,
            ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $item = CartItem::updateOrCreate(
            ['user_id' => $request->user()->id, 'product_id' => $validated['product_id']],
            ['quantity' => 0]
        );
        $item->increment('quantity', $validated['quantity'] ?? 1);

        return response()->json(['message' => 'Added to cart']);
    }

    public function update(Request $request, $productId)
    {
        $item = CartItem::where('user_id', $request->user()->id)->where('product_id', $productId)->first();
        if (!$item) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $validated = $request->validate(['quantity' => 'required|integer|min:1']);
        $item->update($validated);
        return response()->json(['message' => 'Cart updated']);
    }

    public function remove(Request $request, $productId)
    {
        $item = CartItem::where('user_id', $request->user()->id)->where('product_id', $productId)->first();
        if (!$item) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Removed from cart']);
    }

    public function clear(Request $request)
    {
        CartItem::where('user_id', $request->user()->id)->delete();
        return response()->json(['message' => 'Cart cleared']);
    }

    public function count(Request $request)
    {
        $count = CartItem::where('user_id', $request->user()->id)->sum('quantity');
        return response()->json(['count' => (int) $count]);
    }
}
