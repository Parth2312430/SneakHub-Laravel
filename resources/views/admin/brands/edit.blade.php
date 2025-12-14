@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                Edit Brand
            </h2>
            <a href="{{ route('admin.brands.index') }}" class="text-cyan-600 hover:text-cyan-800 font-semibold flex items-center gap-1">
                &larr; Back to Dashboard
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
            {{-- Cyan Gradient Header --}}
            <div class="p-8 bg-gradient-to-r from-cyan-500 to-blue-600 text-white">
                <h3 class="text-xl font-bold mb-2">✏️ Update Brand: {{ $brand->name }}</h3>
                <p class="text-cyan-100 text-sm">Modify the details below.</p>
            </div>
            
            <div class="p-8 bg-white">
                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm uppercase font-bold text-gray-500 tracking-wider mb-2">Brand Name</label>
                            <input type="text" name="name" value="{{ $brand->name }}" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:bg-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition" />
                        </div>

                        <div>
                            <label class="block text-sm uppercase font-bold text-gray-500 tracking-wider mb-2">Current Logo</label>
                            @if($brand->logo)
                                <img src="{{ asset($brand->logo) }}" class="w-20 h-20 object-contain border rounded p-2 mb-2">
                            @else
                                <p class="text-sm text-gray-400 italic mb-2">No logo uploaded.</p>
                            @endif
                            <input type="file" name="logo" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100"/>
                        </div>

                        <div>
                            <label class="block text-sm uppercase font-bold text-gray-500 tracking-wider mb-2">Description</label>
                            <textarea name="description" rows="4"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:bg-white focus:ring-2 focus:ring-cyan-400 focus:border-transparent transition">{{ $brand->description }}</textarea>
                        </div>

                        <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                            <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold rounded-lg shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                                Update Brand
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection