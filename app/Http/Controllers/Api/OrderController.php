<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Create order from cart (Checkout)
    public function checkout(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'status' => 'pending'
        ]);

        foreach ($cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity
            ]);
        }

        $cart->items()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'data' => $order->load('items.product')
        ]);
    }

    // List all user orders
    public function history(Request $request)
    {
        $orders = $request->user()->orders()->with('items.product')->get();

        return response()->json([
            'status' => true,
            'data' => $orders
        ]);
    }

    // Show details of a single order
    public function show(Request $request, $id)
    {
        $order = $request->user()->orders()->with('items.product')->find($id);

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $order
        ]);
    }
}
