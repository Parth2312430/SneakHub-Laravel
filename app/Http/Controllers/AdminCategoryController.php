<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the categories (Admin Dashboard).
     */
    public function index()
    {
        // Get all categories, newest first, 10 per page
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // 2. Create the category
        Category::create($request->all());

        // 3. Redirect back with success message
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in the database.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validate (ignore current category ID for unique check)
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // 2. Update the category
        $category->update($request->all());

        // 3. Redirect back
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified category from the database.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully');
    }
}