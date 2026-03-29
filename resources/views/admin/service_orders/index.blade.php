@extends('layouts.admin')

@section('page_title', 'Service Requests')

@section('content')
<div class="glass-card p-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-bold text-white uppercase tracking-tight">Incoming Service Orders</h2>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Manage custom client projects</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Order #</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Client</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Service</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Price</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($orders as $order)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-6">
                        <span class="text-sm font-black text-[#d4a574]">#{{ $order->order_number }}</span>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-white">{{ $order->user->name }}</span>
                            <span class="text-[10px] text-gray-500">{{ $order->user->email }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <span class="text-xs font-bold text-gray-300 uppercase italic">{{ $order->service_name }}</span>
                    </td>
                    <td class="px-6 py-6">
                        @php
                            $statusColors = [
                                'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                'reviewing' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                'working' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                'completed' => 'bg-purple-500/10 text-purple-500 border-purple-500/20',
                                'canceled' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusColors[$order->status] }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-6">
                        <span class="text-sm font-bold text-white">
                            {{ $order->price ? '$' . number_format($order->price, 2) : 'TBD' }}
                        </span>
                    </td>
                    <td class="px-6 py-6">
                        <a href="{{ route('admin.service_orders.show', $order->id) }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-[#d4a574] hover:bg-white/10 transition-all">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
@endsection
