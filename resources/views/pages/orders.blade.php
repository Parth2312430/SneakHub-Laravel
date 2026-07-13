@extends('layouts.header')
@section('title','SneakHub | My Orders')

@section('content')
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Order History</h2>
        <a href="{{ route('products') }}" class="btn btn-outline-dark rounded-pill px-4">Continue Shopping</a>
    </div>

    @if ($orders->isEmpty())
        <div class="card text-center p-5 border-0 shadow-sm">
            <div class="card-body">
                <div class="fs-1 text-muted mb-3">📦</div>
                <h4 class="fw-bold">No Orders Placed Yet</h4>
                <p class="text-muted mb-4">You haven't made any purchases yet. Start exploring our collections today!</p>
                <a href="{{ route('products') }}" class="btn btn-dark rounded-pill px-4">Browse Sneakers</a>
            </div>
        </div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="py-3 px-4">Order ID</th>
                        <th scope="col" class="py-3">Date</th>
                        <th scope="col" class="py-3">Shipping Info</th>
                        <th scope="col" class="py-3">Items</th>
                        <th scope="col" class="py-3">Total Paid</th>
                        <th scope="col" class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-4 fw-bold">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="fw-bold">{{ $order->name }}</div>
                                <small class="text-muted d-block">{{ $order->phone }}</small>
                                <small class="text-muted d-block">{{ $order->address }}, {{ $order->city }}</small>
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($order->items as $item)
                                        <li>
                                            <i class="bi bi-chevron-right text-muted small"></i>
                                            @if ($item->product)
                                                <a href="{{ route('product.details', $item->product->id) }}" class="text-decoration-none text-dark fw-semibold">
                                                    {{ $item->product->name }}
                                                </a>
                                            @else
                                                <span class="text-muted">{{ $item->product_id }} (Deleted)</span>
                                            @endif
                                            <span class="text-muted">x {{ $item->quantity }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="fw-bold text-danger">PKR {{ number_format($order->total_price) }}</td>
                            <td class="px-4">
                                @if ($order->status === 'Pending')
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-hourglass-split"></i> Pending</span>
                                @elseif ($order->status === 'Shipped')
                                    <span class="badge bg-info text-white px-3 py-2 rounded-pill"><i class="bi bi-truck"></i> Shipped</span>
                                @elseif ($order->status === 'Delivered')
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill"><i class="bi bi-check-circle-fill"></i> Delivered</span>
                                @else
                                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill"><i class="bi bi-x-circle-fill"></i> {{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
