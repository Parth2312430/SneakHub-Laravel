@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-black text-3xl text-white leading-tight uppercase tracking-wider">
                Add Category
            </h2>
            <a href="{{ route('admin.categories.index') }}" class="text-yellow-400 hover:text-orange-500 font-bold flex items-center gap-1 transition">
                &larr; Back to Dashboard
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-900/30 border-l-4 border-red-500 text-red-300 shadow-xl rounded-r">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gradient-to-br from-gray-900 to-black overflow-hidden shadow-2xl sm:rounded-2xl border-2 border-yellow-500/30">
            {{-- Legendary Header --}}
            <div class="p-8 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 border-b-2 border-yellow-500/30">
                <h3 class="text-xl font-black mb-2 text-white uppercase tracking-wider">✨ Create New Category</h3>
                <p class="text-yellow-400 text-sm font-semibold">Organize your legendary inventory with style.</p>
            </div>
            
            <div class="p-8">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Category Name</label>
                            <input type="text" name="name" placeholder="e.g. Sneakers" required
                                class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white placeholder-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl" />
                        </div>

                        <div>
                            <label class="block text-sm uppercase font-black text-yellow-400 tracking-widest mb-3">Description (Optional)</label>
                            <textarea name="description" rows="4" placeholder="Enter a legendary description..."
                                class="w-full px-5 py-4 rounded-xl bg-black/50 border-2 border-gray-800 text-white placeholder-gray-600 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/50 transition shadow-xl"></textarea>
                        </div>

                        <div class="flex items-center justify-end pt-8 border-t border-gray-800">
                            <button type="submit" 
                                class="px-12 py-4 bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-300 hover:to-orange-400 text-black font-black rounded-xl shadow-2xl transform hover:scale-105 transition duration-300 uppercase tracking-wider text-lg">
                                + Create Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection