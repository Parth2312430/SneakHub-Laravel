@extends('layouts.header')

@section('title', 'SneakHub | Home')

@section('content')
<div class="hero text-center py-5 bg-dark text-white">
  <h1 class="display-4 fw-bold">Welcome to SneakHub</h1>
  <p class="lead mb-4">Your ultimate destination for authentic sneakers and footwear</p>
  <a href="{{ route('products') }}" class="btn btn-light btn-lg rounded-pill px-4">Shop Now</a>
</div>

<div class="container py-5">
  <h2 class="text-center mb-4 fw-bold">Trending Sneakers</h2>
  
  {{-- 1. ADD THE 'card-grid' CLASS HERE --}}
  <div class="row card-grid" id="trending-sneakers">
    
    @forelse ($trendingProducts as $product)
      <div class="col-md-3 col-6 mb-4">
        {{-- 2. ADD 'd-flex' and 'flex-column' --}}
        <div class="card border-0 shadow-sm h-100 d-flex flex-column">
          
          {{-- 3. ADD THE 'card-img-container' --}}
          <div class="card-img-container">
            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          </div>

          {{-- 4. ADD 'd-flex' and 'flex-grow-1' --}}
          <div class="card-body text-center d-flex flex-column flex-grow-1">
            <span class="badge bg-dark mb-2">{{ $product->brand }}</span>
            <h6 class="card-title fw-bold">{{ $product->name }}</h6>
            <p class="price text-danger fw-bold">PKR {{ number_format($product->price) }}</p>
            
            {{-- 5. ADD 'mt-auto' TO THE BUTTON --}}
            <a href="{{ route('product.details', $product->id) }}" class="btn btn-outline-dark btn-sm rounded-pill px-3 mt-auto">
              View Details
            </a>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-muted">No trending products found.</p>
    @endforelse

  </div>
</div>
@endsection