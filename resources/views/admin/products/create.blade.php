@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-10">
            <h2 class="font-black text-4xl text-white leading-tight">
                Add Legendary Product
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-yellow-400 hover:text-yellow-300 font-bold flex items-center gap-2 transition group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back to Marketplace</span>
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-8 p-5 bg-gradient-to-r from-red-500/20 to-pink-500/20 border border-red-500/50 text-red-400 shadow-xl rounded-2xl backdrop-blur-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="font-semibold">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gradient-to-br from-gray-900 to-black overflow-hidden shadow-2xl sm:rounded-3xl border border-yellow-500/30">
            {{-- Dark Header --}}
            <div class="p-10 bg-gradient-to-r from-yellow-500/10 via-orange-500/10 to-yellow-500/10 border-b border-yellow-500/20">
                <h3 class="text-3xl font-black text-white mb-3">Add New Inventory Item</h3>
                <p class="text-gray-400 text-base">Fill in the details below to add a legendary product to the marketplace.</p>
            </div>
            
            <div class="p-10 bg-black/50">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Left Column --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Product Name</label>
                                <input type="text" name="name" placeholder="e.g. Nike Air Jordan 1" required
                                    class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white placeholder-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Brand</label>
                                    <select name="brand" class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl">
                                        <option class="bg-gray-900">Nike</option><option class="bg-gray-900">Adidas</option><option class="bg-gray-900">Puma</option><option class="bg-gray-900">New Balance</option><option class="bg-gray-900">Vans</option><option class="bg-gray-900">Converse</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Category</label>
                                    <select name="category" class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl">
                                        <option value="" class="bg-gray-900">-- Select a Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->name }}" class="bg-gray-900">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Price (PKR)</label>
                                    <input type="number" name="price" required
                                        class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white placeholder-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl" />
                                </div>
                                <div>
                                    <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Stock</label>
                                    <input type="number" name="stock" value="10" required
                                        class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl" />
                                </div>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Product Image</label>
                                <input type="file" name="image" required
                                    class="w-full px-4 py-3 bg-black/50 border-2 border-gray-800 rounded-xl text-gray-400 cursor-pointer focus:border-yellow-500 transition file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-gradient-to-r file:from-yellow-400 file:to-orange-500 file:text-black file:font-bold hover:file:from-yellow-300 hover:file:to-orange-400" />
                            </div>

                            <div>
                                <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Description</label>
                                <textarea name="description" rows="5" placeholder="Enter legendary product details..."
                                    class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white placeholder-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-8 mt-8 border-t border-gray-800">
                        <button type="submit" 
                            class="px-12 py-4 bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-300 hover:to-orange-400 text-black font-black rounded-xl shadow-2xl transform hover:scale-105 transition duration-300 uppercase tracking-wider text-lg">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection