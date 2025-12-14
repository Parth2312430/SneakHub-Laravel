<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products (Admin Dashboard).
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'description' => 'required',
            'stock' => 'required|integer'
        ]);

        $input = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // This stores the image in 'storage/app/public/images'
            $imagePath = $request->file('image')->store('images', 'public');
            // We save the path as 'storage/images/filename.jpg' so asset() can find it
            $input['image'] = 'storage/' . $imagePath;
        }

        Product::create($input);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $input = $request->all();

        // Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            // (Optional logic, kept simple for now)
            
            $imagePath = $request->file('image')->store('images', 'public');
            $input['image'] = 'storage/' . $imagePath;
        } else {
            // Keep the old image if no new one is uploaded
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully');
    }

    /**
     * AJAX Search for products - Filters by Name AND Category simultaneously.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search across multiple fields with priority scoring
        $products = Product::where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('brand', 'LIKE', "%{$query}%")
                          ->orWhere('category', 'LIKE', "%{$query}%");
                    })
                    ->limit(10) // Show up to 10 results
                    ->get();

        return response()->json($products);
    }
}