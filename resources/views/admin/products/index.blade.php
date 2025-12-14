@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header & Stats --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h2 class="text-4xl font-black text-slate-800 tracking-tight">
                    Inventory <span class="text-gradient grad-blue">HQ</span>
                </h2>
                <p class="text-slate-500 mt-2 font-medium">Manage your sneaker catalog with precision.</p>
            </div>
            
            {{-- Search Bar --}}
            <div class="relative group w-full md:w-96 z-30">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative flex items-center bg-white rounded-full p-1 shadow-sm">
                    <div class="pl-4 text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" id="ajaxSearch" placeholder="Search products..." autocomplete="off"
                        class="w-full bg-transparent border-none focus:ring-0 text-sm font-medium text-slate-700 placeholder-slate-400 h-10">
                </div>
                <ul id="searchResults" class="absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-slate-100 hidden overflow-hidden divide-y divide-slate-50 max-h-80 overflow-y-auto custom-scrollbar"></ul>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 text-emerald-700 shadow-sm animate-fade-in-down">
                <div class="bg-emerald-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Add Product Toggle --}}
        <div class="mb-12">
            <button onclick="document.getElementById('addProductForm').classList.toggle('hidden')" 
                class="group w-full bg-white hover:bg-slate-50 border-2 border-dashed border-slate-300 hover:border-blue-400 rounded-2xl p-6 flex flex-col items-center justify-center text-slate-400 hover:text-blue-600 transition-all duration-300">
                <div class="bg-slate-100 group-hover:bg-blue-100 p-3 rounded-full mb-3 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <span class="font-bold text-lg">Click to Add New Product</span>
            </button>

            {{-- Hidden Form --}}
            <div id="addProductForm" class="hidden mt-6 bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xl font-bold text-slate-800">New Product Details</h3>
                </div>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Name</label>
                            <input type="text" name="name" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 bg-slate-50" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Brand</label>
                                <select name="brand" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 bg-slate-50">
                                    <option>Nike</option><option>Adidas</option><option>Puma</option><option>New Balance</option><option>Vans</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Category</label>
                                <select name="category" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 bg-slate-50">
                                    <option>Lifestyle</option><option>Running</option><option>Basketball</option><option>Skateboarding</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Price</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-slate-400">₨</span>
                                    <input type="number" name="price" class="w-full pl-8 rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 bg-slate-50" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Stock</label>
                                <input type="number" name="stock" value="10" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 bg-slate-50" required>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Image</label>
                            <input type="file" name="image" id="productImageInput" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                            <div id="imagePreviewContainer" class="hidden mt-4">
                                <img id="imagePreview" src="#" class="h-32 w-auto rounded-lg shadow-md border border-slate-200">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500 bg-slate-50"></textarea>
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/30 transform transition hover:-translate-y-0.5">
                                Save Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="group bg-white rounded-3xl p-4 shadow-sm hover:shadow-xl border border-slate-100 transition-all-300 hover-lift flex flex-col h-full">
                <div class="relative h-52 rounded-2xl overflow-hidden mb-4 bg-slate-50">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-slate-800 shadow-sm">
                        {{ $product->stock }} left
                    </div>
                </div>
                
                <div class="flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md uppercase tracking-wider">{{ $product->brand }}</span>
                        <span class="text-sm font-black text-slate-900">PKR {{ number_format($product->price) }}</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-800 leading-tight mb-1 line-clamp-1 group-hover:text-blue-600 transition-colors">{{ $product->name }}</h3>
                    <p class="text-xs text-slate-400 mb-4">{{ $product->category }}</p>
                    
                    <div class="mt-auto flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 bg-slate-50 hover:bg-slate-100 text-slate-600 hover:text-slate-900 text-center py-2.5 rounded-xl text-sm font-bold transition-colors">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 p-2.5 rounded-xl transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="inline-block p-4 rounded-full bg-slate-100 text-slate-400 mb-3"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg></div>
                <p class="text-slate-500 font-medium">No products found.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-10">
            {{ $products->links() }}
        </div>
    </div>
</div>

<script>
    // AJAX Search Logic - Filters by Name, Brand, and Category
    const searchInput = document.getElementById('ajaxSearch');
    const resultsList = document.getElementById('searchResults');

    searchInput.addEventListener('keyup', function() {
        let query = this.value.trim();
        
        // Start searching after 2 characters
        if (query.length >= 2) {
            resultsList.classList.remove('hidden');
            
            // Fetch results from server
            fetch(`{{ route('admin.products.search') }}?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsList.innerHTML = '';
                    
                    if (data.length > 0) {
                        data.forEach(product => {
                            resultsList.innerHTML += `
                                <li class="hover:bg-blue-50 transition cursor-pointer">
                                    <a href="/admin/products/${product.id}/edit" class="flex items-center px-4 py-3 gap-3">
                                        <img src="/${product.image}" class="w-12 h-12 rounded-lg object-cover border border-slate-200" onerror="this.src='https://via.placeholder.com/50'">
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-slate-800">${product.name}</p>
                                            <p class="text-xs text-slate-500">${product.brand} • ${product.category}</p>
                                        </div>
                                        <span class="text-xs font-bold text-blue-600">PKR ${product.price.toLocaleString()}</span>
                                    </a>
                                </li>`;
                        });
                    } else {
                        resultsList.innerHTML = `
                            <li class="px-4 py-6 text-center">
                                <div class="text-slate-400 mb-2">
                                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-500 font-medium">No products found</p>
                            </li>`;
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    resultsList.innerHTML = `<li class="px-4 py-3 text-sm text-red-500 text-center">Error loading results</li>`;
                });
        } else {
            resultsList.classList.add('hidden');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', e => {
        if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
            resultsList.classList.add('hidden');
        }
    });

    // Show dropdown when input is focused and has content
    searchInput.addEventListener('focus', function() {
        if (this.value.trim().length >= 2) {
            resultsList.classList.remove('hidden');
        }
    });

    // Image Preview
    document.getElementById('productImageInput').addEventListener('change', function(e) {
        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection