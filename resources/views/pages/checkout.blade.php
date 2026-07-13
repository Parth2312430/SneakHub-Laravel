@extends('layouts.header')
@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">Checkout</h1>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-5">

        <!-- Shipping Form -->
        <div class="col-lg-7">
            <h4 class="fw-bold mb-3">Shipping Information</h4>
            <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" id="phone" required>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" id="city" required>
                    </div>
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" value="Pakistan" disabled>
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-dark btn-lg" type="submit">Place Order</button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <h4 class="fw-bold mb-3">Your Order</h4>
            <ul class="list-group mb-3">
                
                @foreach($cart as $id => $item)
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">{{ $item['name'] }}</h6>
                        <small class="text-muted">Quantity: {{ $item['quantity'] }}</small>
                    </div>
                    <span class="text-muted">PKR {{ number_format($item['price'] * $item['quantity']) }}</span>
                </li>
                @endforeach
                
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <span class="text-muted">Shipping</span>
                    <strong>FREE</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between fs-5">
                    <strong>Total (PKR)</strong>
                    <strong class="text-danger">PKR {{ number_format($total) }}</strong>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection