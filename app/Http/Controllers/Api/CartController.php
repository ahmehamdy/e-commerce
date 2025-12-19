<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function view(Request $request)
    {
        $cart = $request->user()->cart()->with('items.product')->first();

        return response()->json([
            'status' => true,
            'data' => $cart
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $request->user()->cart()->firstOrCreate([]);

        $item = $cart->items()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->quantity]
        );

        return response()->json([
            'status' => true,
            'message' => 'Item added to cart',
            'data' => $cart->load('items.product')
        ]);
    }

    public function remove(Request $request, $id)
    {
        $cart = $request->user()->cart;
        $item = $cart->items()->where('id', $id)->first();

        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found in cart'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Item removed from cart'
        ]);
    }
}
