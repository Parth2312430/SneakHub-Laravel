<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

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

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products')->with('error', 'Your cart is empty.');
        }

        // 2. Validate product stock levels
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if (!$product || $product->stock < $details['quantity']) {
                return redirect()->back()->with('error', "Sorry, the product '{$details['name']}' does not have enough stock available (only {$product->stock} remaining). Please update your cart.");
            }
        }

        // 3. Calculate total
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // 4. Create the Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'total_price' => $total,
            'status' => 'Pending',
        ]);

        // 5. Create Order Items & Decrement Stock
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);

            $product = Product::find($id);
            $product->decrement('stock', $details['quantity']);
        }

        // 6. Clear the cart
        session()->forget('cart');

        // 7. Redirect to a "Thank You" page
        return redirect()->route('checkout.success')->with('success_order', 'Thank you! Your order has been placed successfully.');
    }
}