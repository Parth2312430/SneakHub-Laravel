@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-black text-3xl text-slate-800 leading-tight uppercase tracking-wider">
                Edit Product
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-700 font-bold flex items-center gap-1 transition">
                &larr; Back to Inventory
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200">
            {{-- Header --}}
            <div class="p-8 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-slate-200">
                <h3 class="text-xl font-black mb-2 text-slate-800 uppercase tracking-wider">✏️ Update Product: {{ $product->name }}</h3>
                <p class="text-slate-600 text-sm font-semibold">Modify the product details below.</p>
            </div>
            
            <div class="p-8">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Left Column --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Product Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" required
                                    class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Brand</label>
                                    <select name="brand" class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm">
                                        <option value="{{ $product->brand }}" selected>{{ $product->brand }}</option>
                                        <option>Nike</option><option>Adidas</option><option>Puma</option><option>New Balance</option><option>Vans</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Category</label>
                                    <select name="category" class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm">
                                        <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                                        @foreach($categories as $category)
                                            @if($category->name !== $product->category)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Price (PKR)</label>
                                    <input type="number" name="price" value="{{ $product->price }}" required
                                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm" />
                                </div>
                                <div>
                                    <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Stock</label>
                                    <input type="number" name="stock" value="{{ $product->stock }}" required
                                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm" />
                                </div>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="space-y-6">
                            <div class="bg-slate-50 p-4 rounded-xl border-2 border-slate-200">
                                <label class="block text-xs font-black text-slate-600 uppercase tracking-wide mb-2">Current Image</label>
                                <img src="{{ asset($product->image) }}" class="w-full h-40 object-cover rounded-lg shadow-sm mb-4 border border-slate-200">
                                
                                <label class="block text-sm font-black text-slate-700 mb-2">Change Image</label>
                                <input type="file" name="image" class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl text-slate-600 cursor-pointer focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white file:font-bold hover:file:bg-blue-700">
                            </div>

                            <div>
                                <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Description</label>
                                <textarea name="description" rows="4"
                                    class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-8 mt-8 border-t border-slate-200">
                        <button type="submit" 
                            class="px-12 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black rounded-xl shadow-lg shadow-blue-500/30 transition duration-300 uppercase tracking-wider text-lg">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection