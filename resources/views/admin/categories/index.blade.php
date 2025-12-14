@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-8">
            Category <span class="text-gradient grad-green">Manager</span>
        </h2>

        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 text-emerald-700 shadow-sm">
                <span class="font-bold">✅ {{ session('success') }}</span>
            </div>
        @endif

        {{-- Add Category Card --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden mb-12">
            <div class="p-8 bg-gradient-to-r from-emerald-500 to-teal-600 text-white flex justify-between items-center cursor-pointer hover:opacity-95 transition" 
                 onclick="document.getElementById('addCategoryForm').classList.toggle('hidden')">
                <div>
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <span class="bg-white/20 p-1.5 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg></span>
                        Add New Category
                    </h3>
                    <p class="text-emerald-100 text-sm mt-1 ml-10">Organize your products into logical groups.</p>
                </div>
                <svg class="w-6 h-6 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            
            <div id="addCategoryForm" class="hidden bg-slate-50/50 p-8 border-t border-slate-100">
                <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col md:flex-row gap-6 items-end">
                    @csrf
                    <div class="flex-1 w-full">
                        <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Name</label>
                        <input type="text" name="name" placeholder="e.g. Running" required class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div class="flex-[2] w-full">
                        <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Description</label>
                        <input type="text" name="description" placeholder="Description..." class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 transition transform hover:-translate-y-0.5">
                        Create
                    </button>
                </form>
            </div>
        </div>

        {{-- Categories Grid --}}
        <h3 class="text-lg font-bold text-slate-400 uppercase tracking-widest mb-6">Active Categories</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg border border-slate-100 transition-all-300 group hover:-translate-y-1">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-emerald-50 p-3 rounded-xl text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-slate-300 hover:text-emerald-500 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete?');">
                                @csrf @method('DELETE')
                                <button class="text-slate-300 hover:text-red-500 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </form>
                        </div>
                    </div>

                    <h4 class="text-xl font-bold text-slate-800 mb-2">{{ $category->name }}</h4>
                    <p class="text-slate-500 text-sm h-10 line-clamp-2 leading-relaxed">
                        {{ $category->description ?? 'No description.' }}
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-50 text-xs font-bold text-slate-300 uppercase">
                        Created {{ $category->created_at->format('M d, Y') }}
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection