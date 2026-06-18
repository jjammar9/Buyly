<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return Order::with('items')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        $total = 0;
        $orderItems = [];

        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            $price = $product->sale_price ?? $product->price;
            $total += $price * $item['quantity'];
            $orderItems[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'price' => $price,
                'quantity' => $item['quantity'],
            ];
        }

        $order = $request->user()->orders()->create([
            'status' => 'confirmed',
            'total' => $total,
            'address_line1' => $validated['address_line1'],
            'address_line2' => $validated['address_line2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zip'],
            'notes' => $validated['notes'] ?? null,
            'delivery_eta' => now()->addHours(rand(1, 4)),
        ]);

        $order->items()->createMany($orderItems);

        return $order->load('items');
    }

    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }
        return $order->load('items');
    }

    public function progress(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) abort(403);

        $next = ['confirmed' => 'preparing', 'preparing' => 'shipped', 'shipped' => 'delivered'];

        if (!isset($next[$order->status])) {
            return response()->json(['message' => 'Order already delivered'], 400);
        }

        $order->update(['status' => $next[$order->status]]);

        return $order->load('items');
    }
}
