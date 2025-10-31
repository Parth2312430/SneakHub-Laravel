<?php

namespace App\Http\Controllers;

use App\Models\Review; // Import the Review model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id (This is the $product->id from the route)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        // 1. Validate the form data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);

        // 2. Create the new review
        Review::create([
            'product_id' => $id,             // The ID of the product
            'user_id' => Auth::id(),       // The ID of the currently logged-in user
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // 3. Redirect the user back to the product page
        return redirect()->back()->with('success', 'Thank you! Your review has been submitted.');
    }
}

