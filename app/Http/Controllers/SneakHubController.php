<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- 1. We must import the Product model to use it
use Illuminate\Http\Request;

class SneakHubController extends Controller
{
    /**
     * Display the home page.
     * We'll fetch 4 random products to show as "Trending".
     */
    public function home()
    {
        // Fetch 4 products in a random order
        $trendingProducts = Product::inRandomOrder()->take(4)->get();

        // Pass those 4 products to the 'pages.home' view
        return view('pages.home', ['trendingProducts' => $trendingProducts]);
    }

    /**
     * Display the products listing page.
     * This view now loads its own data via the /api/products route,
     * so this controller just needs to return the empty view file.
     */
    public function products()
    {
        return view('pages.products');
    }

    /**
     * Display the single product details page.
     * We will eager-load the reviews and the user who wrote the review.
     */
    public function productDetails($id)
    {
       
        $product = Product::with('reviews.user')->findOrFail($id);
        
        // Pass the product (and its reviews) to the view
        return view('pages.product-details', ['product' => $product]);
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('pages.contact');
    }
}

