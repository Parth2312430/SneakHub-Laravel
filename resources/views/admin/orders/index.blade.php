@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <h2 class="text-4xl font-black text-slate-800 tracking-tight">
                Order <span class="text-gradient grad-blue">HQ</span>
            </h2>
            <p class="text-slate-500 mt-2 font-medium">Monitor and manage customer purchases and order fulfillment.</p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-3 text-emerald-700 shadow-sm">
                <div class="bg-emerald-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Orders Table --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs font-black uppercase tracking-wider border-b border-slate-100">
                            <th class="py-5 px-8">Order ID</th>
                            <th class="py-5 px-4">Date</th>
                            <th class="py-5 px-4">Customer</th>
                            <th class="py-5 px-4">City</th>
                            <th class="py-5 px-4">Total</th>
                            <th class="py-5 px-4">Status</th>
                            <th class="py-5 px-8 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 text-sm font-semibold">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-5 px-8 font-black text-slate-900">#{{ $order->id }}</td>
                                <td class="py-5 px-4 text-slate-500">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                                <td class="py-5 px-4">
                                    <div class="text-slate-900 font-bold">{{ $order->name }}</div>
                                    <div class="text-slate-400 text-xs font-medium">{{ $order->email }}</div>
                                </td>
                                <td class="py-5 px-4 text-slate-600">{{ $order->city }}</td>
                                <td class="py-5 px-4 text-slate-900 font-black">PKR {{ number_format($order->total_price) }}</td>
                                <td class="py-5 px-4">
                                    @if ($order->status === 'Pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                        </span>
                                    @elseif ($order->status === 'Shipped')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Shipped
                                        </span>
                                    @elseif ($order->status === 'Delivered')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Delivered
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> {{ $order->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-5 px-8 text-right">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-700 font-bold rounded-xl text-xs transition duration-200">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 font-medium">
                                    No orders have been placed yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($orders->hasPages())
                <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
