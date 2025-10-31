<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // This function shows the checkout page
    public function show()
    {
        $cart = session()->get('cart', []);

        // If cart is empty, redirect them away
        if(empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        // Calculate the total
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('pages.checkout', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    // This function processes the checkout form
    public function process(Request $request)
    {
        // 1. Validate the user's shipping info
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
        ]);

        // 2. (Future Step): This is where you would process the payment
        // with a gateway like Stripe or EasyPaisa.

        // 3. (Future Step): This is where you would save the order
        // to an 'orders' table in your database.

        // 4. For this project, we just clear the cart
        session()->forget('cart');

        // 5. Redirect to a "Thank You" page
        return redirect()->route('checkout.success');
    }
}