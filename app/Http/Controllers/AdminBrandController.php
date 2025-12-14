<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.index'); // We use the toggle form on index
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('brands', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')
                         ->with('success', 'Brand created successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            // Optional: Delete old logo here if you want strict cleanup
            $path = $request->file('logo')->store('brands', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')
                         ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')
                         ->with('success', 'Brand deleted successfully.');
    }

    /**
     * AJAX Search for brands - Filters by Name AND Description.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search across multiple fields
        $brands = Brand::where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%");
                    })
                    ->limit(10) // Show up to 10 results
                    ->get();

        return response()->json($brands);
    }
}