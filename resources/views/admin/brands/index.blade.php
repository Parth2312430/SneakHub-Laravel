@extends('layouts.app')

@section('content')
<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h2 class="text-4xl font-black text-slate-800 tracking-tight">
                    Brand <span class="text-gradient grad-orange">Partners</span>
                </h2>
                <p class="text-slate-500 mt-2 font-medium">Manage your suppliers and logos.</p>
            </div>
            
            {{-- AJAX Search --}}
            <div class="relative w-full md:w-80 z-30">
                <input type="text" id="ajaxSearch" placeholder="Find a brand..." 
                    class="w-full pl-4 pr-10 py-3 rounded-xl border-slate-200 focus:border-amber-500 focus:ring-amber-500 shadow-sm">
                <div class="absolute right-3 top-3 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <ul id="searchResults" class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl border border-slate-100 hidden overflow-hidden divide-y divide-slate-50"></ul>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-amber-50 border border-amber-100 rounded-2xl flex items-center gap-3 text-amber-700 shadow-sm">
                <span class="font-bold">✅ {{ session('success') }}</span>
            </div>
        @endif

        {{-- Add Brand Card --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden mb-12">
            <div class="p-8 bg-gradient-to-r from-amber-500 to-orange-600 text-white flex justify-between items-center cursor-pointer hover:opacity-95 transition" 
                 onclick="document.getElementById('addBrandForm').classList.toggle('hidden')">
                <h3 class="text-2xl font-bold flex items-center gap-2">
                    <span class="bg-white/20 p-1.5 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></span>
                    Add New Brand
                </h3>
                <svg class="w-6 h-6 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            
            <div id="addBrandForm" class="hidden bg-slate-50/50 p-8 border-t border-slate-100">
                <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div>
                        <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Brand Name</label>
                        <input type="text" name="name" required class="w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Logo</label>
                        <input type="file" name="logo" id="brandLogoInput" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:bg-amber-100 file:text-amber-700 file:border-0 hover:file:bg-amber-200">
                        <div id="brandLogoPreviewContainer" class="hidden mt-3">
                            <img id="brandLogoPreview" src="#" class="h-16 w-16 rounded-xl border border-slate-200 object-contain shadow-sm">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Description</label>
                        <input type="text" name="description" class="w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div class="md:col-span-2 pt-2">
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-500/30 transition transform hover:-translate-y-0.5">
                            Save Brand
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Brands Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($brands as $brand)
                <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg border border-slate-100 transition-all-300 group hover:-translate-y-1 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-center p-2">
                            @if($brand->logo)
                                <img src="{{ asset($brand->logo) }}" class="w-full h-full object-contain">
                            @else
                                <span class="text-2xl font-black text-slate-300">{{ substr($brand->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-slate-300 hover:text-amber-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Delete?');">
                                @csrf @method('DELETE')
                                <button class="text-slate-300 hover:text-red-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </form>
                        </div>
                    </div>
                    
                    <h4 class="text-xl font-bold text-slate-800 mb-1">{{ $brand->name }}</h4>
                    <p class="text-slate-500 text-sm flex-1">{{ $brand->description ?? 'No description.' }}</p>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $brands->links() }}
        </div>
    </div>
</div>

<script>
    // AJAX Search Logic - Filters by Name and Description
    const searchInput = document.getElementById('ajaxSearch');
    const resultsList = document.getElementById('searchResults');
    const brandLogoInput = document.getElementById('brandLogoInput');
    const brandLogoPreview = document.getElementById('brandLogoPreview');
    const brandLogoPreviewContainer = document.getElementById('brandLogoPreviewContainer');

    searchInput.addEventListener('keyup', function() {
        let query = this.value.trim();
        
        // Start searching after 2 characters
        if (query.length >= 2) {
            resultsList.classList.remove('hidden');
            
            // Fetch results from server
            fetch(`{{ route('admin.brands.search') }}?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsList.innerHTML = '';
                    
                    if (data.length > 0) {
                        data.forEach(brand => {
                            const logo = brand.logo ? `<img src="/${brand.logo}" class="w-10 h-10 rounded-lg object-contain border border-slate-200">` 
                                                    : `<div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 font-bold">${brand.name.charAt(0)}</div>`;
                            
                            resultsList.innerHTML += `
                                <li class="hover:bg-amber-50 transition cursor-pointer">
                                    <a href="/admin/brands/${brand.id}/edit" class="flex items-center px-4 py-3 gap-3">
                                        ${logo}
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-slate-800">${brand.name}</p>
                                            <p class="text-xs text-slate-500">${brand.description || 'No description'}</p>
                                        </div>
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
                                <p class="text-sm text-slate-500 font-medium">No brands found</p>
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

    // Logo preview on file select
    brandLogoInput?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) {
            brandLogoPreviewContainer.classList.add('hidden');
            return;
        }
        const reader = new FileReader();
        reader.onload = function(ev) {
            brandLogoPreview.src = ev.target.result;
            brandLogoPreviewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection