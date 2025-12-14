@extends('layouts.header')
@section('title', 'Your Shopping Cart')

@section('content')
<div class="container py-5">

    <h1 class="fw-bold mb-4">Your Shopping Cart</h1>

    {{-- Check if cart is empty --}}
    @if(empty($cart))
        <div class="text-center py-5">
            <div class="mb-4">
                <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Your Cart is Empty</h3>
            <p class="text-gray-500 mb-6">Looks like you haven't added any sneakers yet.</p>
            <a href="{{ route('products') }}" class="btn btn-dark btn-lg px-5 rounded-pill shadow-sm">
                Start Shopping
            </a>
        </div>
    @else
        <div class="row">
            {{-- Cart Items Column --}}
            <div class="col-lg-8">
                
                {{-- Loop through each item in the cart --}}
                @foreach($cart as $id => $item)
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="row g-3 align-items-center">
                            
                            {{-- Product Image --}}
                            <div class="col-md-2 col-4">
                                <img src="{{ asset($item['image']) }}" class="img-fluid rounded" alt="{{ $item['name'] }}">
                            </div>

                            {{-- Product Name --}}
                            <div class="col-md-3 col-8">
                                <h5 class="mb-0 fs-6 fw-bold">{{ $item['name'] }}</h5>
                                <small class="text-muted">PKR {{ number_format($item['price']) }}</small>
                            </div>

                            {{-- Quantity Form --}}
                            <div class="col-md-3 col-6">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 70px;">
                                    <button type="submit" class="btn btn-outline-dark btn-sm ms-2">Update</button>
                                </form>
                            </div>

                            {{-- Price Subtotal --}}
                            <div class="col-md-2 col-4">
                                <p class="mb-0 fw-bold">PKR {{ number_format($item['price'] * $item['quantity']) }}</p>
                            </div>

                            {{-- Remove Button --}}
                            <div class="col-md-2 col-2 text-end">
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-danger" title="Remove item">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Summary Column --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold">Cart Summary</h4>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-bold">PKR {{ number_format($total) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span class="fw-bold">FREE</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-danger">PKR {{ number_format($total) }}</span>
                        </div>
                        <a href="{{ route('checkout.show') }}" class="btn btn-dark w-100 mt-4">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>

    @endif {{-- End of @if cart is not empty --}}

</div>
@endsection