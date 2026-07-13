@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight uppercase">
                Order details: <span class="text-gradient grad-blue">#{{ $order->id }}</span>
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-700 font-bold flex items-center gap-1 transition">
                &larr; Back to Orders
            </a>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 text-emerald-700 shadow-sm">
                <div class="bg-emerald-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left column (items and shipping details) --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Customer / Shipping Details Card --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider mb-6">📦 Shipping Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Customer Name</span>
                            <span class="text-slate-800 font-bold text-base">{{ $order->name }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Phone Number</span>
                            <span class="text-slate-800 font-bold text-base">{{ $order->phone }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Email Address</span>
                            <span class="text-slate-800 font-bold text-base">{{ $order->email }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">City</span>
                            <span class="text-slate-800 font-bold text-base">{{ $order->city }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Shipping Address</span>
                            <span class="text-slate-800 font-bold text-base">{{ $order->address }}</span>
                        </div>
                    </div>
                </div>

                {{-- Order Items Card --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider mb-6">👟 Purchased Items</h3>
                    <div class="divide-y divide-slate-100">
                        @foreach ($order->items as $item)
                            <div class="py-4 first:pt-0 last:pb-0 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    @if ($item->product)
                                        <img src="{{ asset($item->product->image) }}" class="w-16 h-16 rounded-xl object-cover border border-slate-200" onerror="this.src='https://via.placeholder.com/100'">
                                        <div>
                                            <h4 class="font-bold text-slate-800 text-sm md:text-base">{{ $item->product->name }}</h4>
                                            <p class="text-xs text-slate-500">{{ $item->product->brand }} • {{ $item->product->category }}</p>
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 text-xs">Deleted</div>
                                        <div>
                                            <h4 class="font-bold text-slate-400 text-sm">Product ID: {{ $item->product_id }}</h4>
                                            <p class="text-xs text-slate-400">This product is no longer in inventory</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <div class="text-slate-900 font-bold text-sm">PKR {{ number_format($item->price) }}</div>
                                    <div class="text-slate-500 text-xs font-semibold">Qty: {{ $item->quantity }}</div>
                                    <div class="text-slate-900 font-black text-sm mt-1">Subtotal: PKR {{ number_format($item->price * $item->quantity) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- Total Order Subtotal --}}
                    <div class="border-t border-slate-100 mt-6 pt-6 flex justify-between items-center bg-slate-50/50 -mx-8 -mb-8 p-8 rounded-b-3xl">
                        <span class="text-slate-500 font-bold uppercase tracking-wider text-sm">Total Paid Amount</span>
                        <span class="text-2xl font-black text-rose-600">PKR {{ number_format($order->total_price) }}</span>
                    </div>
                </div>

            </div>

            {{-- Right column (actions / status updates) --}}
            <div class="space-y-8">
                
                {{-- Status Management Card --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
                    <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider mb-6">Status & Fulfillment</h3>
                    
                    <div class="mb-6">
                        <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-2">Current Status</span>
                        @if ($order->status === 'Pending')
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pending Approval
                            </span>
                        @elseif ($order->status === 'Shipped')
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Shipped / Out for Delivery
                            </span>
                        @elseif ($order->status === 'Delivered')
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Order Delivered
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span> {{ $order->status }}
                            </span>
                        @endif
                    </div>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-xs uppercase font-black text-slate-500 tracking-wider mb-2">Update Order Status</label>
                            <select name="status" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-slate-200 text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition shadow-sm font-bold">
                                <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-500/20 transition transform hover:-translate-y-0.5">
                            Update Order Status
                        </button>
                    </form>
                </div>

                {{-- Helper Card --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100">
                    <h4 class="font-bold text-slate-800 text-base mb-2">💡 Quick Tip</h4>
                    <p class="text-slate-600 text-xs leading-relaxed font-semibold">Updating status to "Shipped" or "Delivered" changes the badge shown to customers in their My Orders page. Make sure delivery items are verified before completing order fulfillment.</p>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
