@extends('frontend.user.layout')

@section('title', 'Order History')
@section('subtitle', 'Track and review your past purchases')

@section('content')
<!-- Service Project Tracking -->
<div class="mb-12">
    <div class="flex items-center justify-between mb-6 pl-2">
        <div>
            <h2 class="text-xl font-black text-white uppercase tracking-tighter italic">Service Project Tracker</h2>
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Real-time progress for your custom solutions</p>
        </div>
    </div>

    @if($serviceOrders->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($serviceOrders as $sOrder)
            <div class="glass-card p-6 border border-white/10 rounded-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-[#3B0000] to-transparent opacity-0 group-hover:opacity-10 transition-opacity"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-black text-[#d4a574] tracking-widest uppercase">#{{ $sOrder->order_number }}</span>
                        @php
                            $sColors = [
                                'pending' => 'text-amber-500 bg-amber-500/10',
                                'reviewing' => 'text-blue-400 bg-blue-400/10',
                                'working' => 'text-emerald-400 bg-emerald-400/10',
                                'completed' => 'text-purple-400 bg-purple-400/10',
                                'canceled' => 'text-rose-400 bg-rose-400/10',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest {{ $sColors[$sOrder->status] }}">
                            {{ $sOrder->status }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-white mb-1 uppercase italic tracking-tight">{{ $sOrder->service_name }}</h3>
                    <p class="text-xs text-gray-500 mb-6 truncate">{{ $sOrder->requirements }}</p>

                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <div class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">
                            {{ $sOrder->created_at->format('M d, Y') }}
                        </div>
                        <a href="{{ route('service.order.track', $sOrder->id) }}" class="px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-[10px] font-black text-white hover:bg-[#d4a574] hover:text-[#0a0506] transition-all uppercase tracking-widest">
                            Track Evolution
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8 text-center">
            <p class="text-xs text-gray-500 uppercase font-black tracking-widest italic">No active service projects found.</p>
        </div>
    @endif
</div>

<!-- Marketplace Buy History -->
<div class="flex items-center justify-between mb-6 pl-2">
    <div>
        <h2 class="text-xl font-black text-white uppercase tracking-tighter italic">Marketplace History</h2>
        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Status of your digital assets & products</p>
    </div>
</div>

<div class="glass-card rounded-2xl overflow-hidden border border-white/10">
    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-300">
                <thead class="bg-white/5 text-gray-400 uppercase tracking-wider text-xs border-b border-white/10">
                    <tr>
                        <th scope="col" class="px-6 py-5 font-medium">Order ID</th>
                        <th scope="col" class="px-6 py-5 font-medium">Date</th>
                        <th scope="col" class="px-6 py-5 font-medium">Items</th>
                        <th scope="col" class="px-6 py-5 font-medium">Total</th>
                        <th scope="col" class="px-6 py-5 font-medium">Payment</th>
                        <th scope="col" class="px-6 py-5 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($orders as $order)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-5 font-medium text-white">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-5">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col gap-1">
                                @foreach($order->items as $item)
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded shrink-0 bg-white/5 overflow-hidden">
                                            @if($item->product && $item->product->thumbnail)
                                                <img src="{{ Storage::url($item->product->thumbnail) }}" class="w-full h-full object-cover">
                                            @else
                                                <i data-lucide="package" class="w-4 h-4 m-1 text-gray-500"></i>
                                            @endif
                                        </div>
                                        <span class="truncate max-w-[200px] text-gray-300" title="{{ $item->product->title ?? 'Removed' }}">
                                            {{ $item->product->title ?? 'Product Removed' }} (x{{ $item->quantity }})
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-5 font-medium text-[#d4a574]">${{ number_format($order->total, 2) }}</td>
                        <td class="px-6 py-5">
                            <span class="capitalize">{{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}</span>
                        </td>
                        <td class="px-6 py-5">
                            @if($order->status === 'completed')
                                <span class="px-3 py-1 bg-green-500/10 text-green-400 text-xs rounded-full border border-green-500/20 whitespace-nowrap">Completed</span>
                            @elseif($order->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 text-xs rounded-full border border-yellow-500/20 whitespace-nowrap">Pending</span>
                            @elseif($order->status === 'failed' || $order->status === 'cancelled')
                                <span class="px-3 py-1 bg-red-500/10 text-red-400 text-xs rounded-full border border-red-500/20 whitespace-nowrap">{{ ucfirst($order->status) }}</span>
                            @else
                                <span class="px-3 py-1 bg-gray-500/10 text-gray-400 text-xs rounded-full border border-gray-500/20 whitespace-nowrap">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="p-4 border-t border-white/10 bg-black/20">
            {{ $orders->links('pagination::tailwind') }}
        </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="p-16 text-center text-gray-400">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 ring-1 ring-white/10">
                <i data-lucide="receipt" class="w-10 h-10 opacity-50"></i>
            </div>
            <h3 class="text-xl font-display font-bold text-white mb-2">No Order History</h3>
            <p class="mb-8 max-w-md mx-auto text-sm">You haven't placed any orders yet. Once you make a purchase from our marketplace, it will appear here.</p>
            <a href="{{ url('/marketplace') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-[0_0_15px_rgba(212,165,116,0.2)]">
                Explore Marketplace <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    @endif
</div>
@endsection
