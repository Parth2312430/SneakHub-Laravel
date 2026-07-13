<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-3xl text-slate-800 leading-tight uppercase tracking-wider">
            {{ __('Sales Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            {{-- Welcome --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 text-white shadow-lg shadow-blue-500/20">
                <h3 class="text-2xl font-black mb-2">Welcome Back, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-blue-100 font-medium">Here's what's happening with SneakHub today.</p>
            </div>

            {{-- Stats Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Total Sales Revenue --}}
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Total Revenue</span>
                        <span class="text-3xl font-black text-slate-800">PKR {{ number_format($totalRevenue) }}</span>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-2xl text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                {{-- Total Orders --}}
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Orders Placed</span>
                        <span class="text-3xl font-black text-slate-800">{{ $totalOrders }}</span>
                    </div>
                    <div class="bg-indigo-50 p-4 rounded-2xl text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>

                {{-- Out of Stock items --}}
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="block text-xs uppercase font-black text-slate-400 tracking-widest mb-1">Out of Stock Items</span>
                        <span class="text-3xl font-black text-rose-600">{{ $outOfStock }}</span>
                    </div>
                    <div class="bg-rose-50 p-4 rounded-2xl text-rose-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>

            </div>

            {{-- Recent Orders Table Card --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-wider">📋 Recent Orders</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-700 font-bold text-sm transition">
                        View All Orders &rarr;
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-xs font-black uppercase tracking-wider border-b border-slate-100">
                                <th class="py-5 px-8">Order ID</th>
                                <th class="py-5 px-4">Customer</th>
                                <th class="py-5 px-4">Date</th>
                                <th class="py-5 px-4">Total</th>
                                <th class="py-5 px-4">Status</th>
                                <th class="py-5 px-8 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 text-sm font-semibold">
                            @forelse ($recentOrders as $order)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-5 px-8 font-black text-slate-900">#{{ $order->id }}</td>
                                    <td class="py-5 px-4">
                                        <div class="text-slate-900 font-bold">{{ $order->name }}</div>
                                        <div class="text-slate-400 text-xs font-medium">{{ $order->email }}</div>
                                    </td>
                                    <td class="py-5 px-4 text-slate-500">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="py-5 px-4 text-slate-900 font-black">PKR {{ number_format($order->total_price) }}</td>
                                    <td class="py-5 px-4">
                                        @if ($order->status === 'Pending')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                                Pending
                                            </span>
                                        @elseif ($order->status === 'Shipped')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                                Shipped
                                            </span>
                                        @elseif ($order->status === 'Delivered')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                Delivered
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100">
                                                {{ $order->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-8 text-right">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-700 font-bold rounded-xl text-xs transition duration-200">
                                            Manage
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-slate-400 font-medium">
                                        No orders placed yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
