@extends('layouts.header')
@section('title', 'Order Confirmed')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
            <h1 class="display-4 fw-bold mt-3">Thank You!</h1>
            <p class="lead text-muted">Your order has been placed successfully.</p>
            <p>We've sent a confirmation to your email. You can continue shopping for more sneakers.</p>
            <a href="{{ route('products') }}" class="btn btn-dark btn-lg mt-3">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection