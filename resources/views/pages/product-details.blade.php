@extends('layouts.header')
@section('title', $product->name)

@section('content')
<div class="container py-5">
    
    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row g-5">

        <!-- Product Image Column -->
        <div class="col-lg-6">
            <img src="{{ asset($product->image) }}" class="img-fluid rounded shadow-sm w-100" alt="{{ $product->name }}">
        </div>

        <!-- Product Details Column -->
        <div class="col-lg-6">
            <span class="badge bg-dark mb-2">{{ $product->brand }}</span>
            <span class="badge bg-secondary mb-2">{{ $product->category }}</span>
            
            <h1 class="fw-bold display-5">{{ $product->name }}</h1>
            
            <p class="fs-4 price text-danger fw-bold">PKR {{ number_format($product->price) }}</p>
            
            <p class="text-muted">{{ $product->description }}</p>
            
            <hr>

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-3 col-4">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    <div class="col-md-9 col-8 align-self-end">
                        <button type="submit" class="btn btn-dark btn-lg w-100">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </form>
            
            <div class="mt-2">
                <small class="text-muted">{{ $product->stock }} items left in stock</small>
            </div>
            
        </div>
    </div>

    <hr class="my-5">

    <!-- Reviews Section -->
    <div class="row">
        <div class="col-lg-7">
            <h2 class="fw-bold mb-4">Customer Reviews ({{ $product->reviews->count() }})</h2>

            @forelse ($product->reviews->sortByDesc('created_at') as $review)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold">{{ $review->user->name }}</h5>
                            <span class="text-muted">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++)
                                    <i class="bi bi-star text-warning"></i>
                                @endfor
                            </span>
                        </div>
                        <p class="card-text mt-2">{{ $review->comment }}</p>
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Be the first to leave a review for this product!
                </div>
            @endforelse
        </div>

        <!-- Add Review Form Column -->
        <div class="col-lg-5">
            <h2 class="fw-bold mb-4">Leave a Review</h2>
            
            @auth
                <!-- User is logged in, show the form -->
                <form action="{{ route('reviews.store', $product) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Your Rating (1-5)</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Select a rating</option>
                            <option value="5">5 Stars (Excellent)</option>
                            <option value="4">4 Stars (Good)</option>
                            <option value="3">3 Stars (Average)</option>
                            <option value="2">2 Stars (Not Good)</option>
                            <option value="1">1 Star (Poor)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Review</label>
                        <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Tell us what you thought..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-dark w-100">Submit Review</button>
                </form>

            @else
                <!-- User is logged out, show this message -->
                <div class="alert alert-warning">
                    You must be <a href="{{ route('login') }}">logged in</a> to leave a review.
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection