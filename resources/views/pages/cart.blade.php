@extends('layouts.header')
@section('title', 'Your Shopping Cart')

@section('content')
<div class="container py-5">

    <h1 class="fw-bold mb-4">Your Shopping Cart</h1>

    {{-- Check if cart is empty --}}
    @if(empty($cart))
        <div class="alert alert-info text-center">
            <h4 class="alert-heading">Your cart is empty!</h4>
            <p>Looks like you haven't added any sneakers yet.</p>
            <a href="{{ route('products') }}" class="btn btn-dark">Start Shopping</a>
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