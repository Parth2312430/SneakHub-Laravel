<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add a product to the cart.
     */
    public function add(Request $request, Product $product)
    {
        // Validate the incoming request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id = $product->id;

        $requestedQuantity = $request->quantity;
        $currentInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $totalRequested = $currentInCart + $requestedQuantity;

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'This item is out of stock.');
        }

        if ($totalRequested > $product->stock) {
            return redirect()->back()->with('error', "Cannot add more. Only {$product->stock} items are available in stock.");
        }

        // Check if product is already in cart
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            // Add new product to cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Show the cart page.
     */
    public function show()
    {
        $cart = session()->get('cart', []);
        
        // Calculate total
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('pages.cart', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        if ($request->quantity > $product->stock) {
            return redirect()->back()->with('error', "Only {$product->stock} items are available in stock.");
        }

        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed successfully!');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }
}