@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-black text-3xl text-slate-800 leading-tight uppercase tracking-wider">
                Edit Category
            </h2>
            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-700 font-bold flex items-center gap-1 transition">
                &larr; Back to Dashboard
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
                <h3 class="text-xl font-black mb-2 text-slate-800 uppercase tracking-wider">✏️ Update Category: {{ $category->name }}</h3>
                <p class="text-slate-600 text-sm font-semibold">Modify the category details below.</p>
            </div>
            
            <div class="p-8">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Category Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" required
                                class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm" />
                        </div>

                        <div>
                            <label class="block text-sm uppercase font-black text-slate-600 tracking-widest mb-3">Description</label>
                            <textarea name="description" rows="4"
                                class="w-full px-5 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm">{{ $category->description }}</textarea>
                        </div>

                        <div class="flex items-center justify-end pt-8 border-t border-slate-200">
                            <button type="submit" 
                                class="px-12 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black rounded-xl shadow-lg shadow-blue-500/30 transition duration-300 uppercase tracking-wider text-lg">
                                Update Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection