<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Get all products (List).
     */
    public function index()
    {
        // We load 'reviews' so the API consumer sees ratings too
        return response()->json(Product::with('reviews')->get());
    }

    /**
     * Get a single product (Detail).
     */
    public function show($id)
    {
        $product = Product::with('reviews')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }
}