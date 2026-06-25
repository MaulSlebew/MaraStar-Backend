<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images', 'sizes'])
            ->where('status', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images', 'sizes']);

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }
}