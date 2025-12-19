<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.en'=>'required|string',
            'title.ar'=>'required|string',
            'description.en'=>'nullable|string',
            'description.ar'=>'nullable|string',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Product created successfully'
        ], 201);
    }
}
