<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * This function is called by the /api/products route.
     * It provides all products as JSON for the shop page.
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();
        
        // Return them as a JSON response
        return response()->json($products);
    }
}