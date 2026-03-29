@extends('frontend.user.layout')

@section('title', 'Overview')
@section('subtitle', 'Welcome back, ' . Auth::user()->name)

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <!-- Stat Card 1 -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-gradient-to-br from-[#d4a574]/20 to-transparent rounded-full blur-2xl group-hover:bg-[#d4a574]/30 transition-all"></div>
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium tracking-wide uppercase mb-1">Total Orders</p>
                <h3 class="text-4xl font-display font-bold bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">{{ $totalOrders }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-[#d4a574]">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-gradient-to-br from-[#d4a574]/20 to-transparent rounded-full blur-2xl group-hover:bg-[#d4a574]/30 transition-all"></div>
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium tracking-wide uppercase mb-1">Total Spent</p>
                <h3 class="text-4xl font-display font-bold bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">${{ number_format($totalSpent, 2) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-[#d4a574]">
                <i data-lucide="dollar-sign" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-gradient-to-br from-[#d4a574]/20 to-transparent rounded-full blur-2xl group-hover:bg-[#d4a574]/30 transition-all"></div>
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium tracking-wide uppercase mb-1">Digital Assets</p>
                <h3 class="text-4xl font-display font-bold bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">{{ $digitalProductsCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-[#d4a574]">
                <i data-lucide="folder" class="w-6 h-6"></i>
            </div>
        </div>
    </div>
</div>

<div class="mb-10">
    <div class="flex items-center justify-between mb-6 border-b border-[#d4a574]/20 pb-4">
        <h2 class="text-xl font-display font-bold text-white tracking-wide">Recent Orders</h2>
        <a href="{{ route('user.orders') }}" class="text-sm text-[#d4a574] hover:text-[#e8b44a] transition-colors flex items-center gap-1 group">
            View All <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    @if($recentOrders->count() > 0)
        <div class="glass-card rounded-2xl overflow-hidden border border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-300">
                    <thead class="bg-white/5 text-gray-400 uppercase tracking-wider text-xs border-b border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Order ID</th>
                            <th scope="col" class="px-6 py-4 font-medium">Date</th>
                            <th scope="col" class="px-6 py-4 font-medium">Items</th>
                            <th scope="col" class="px-6 py-4 font-medium">Total</th>
                            <th scope="col" class="px-6 py-4 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach($recentOrders as $order)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 font-medium text-white">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="truncate max-w-[200px]">{{ $order->items->first()->product->title ?? 'Product Removed' }}</span>
                                    @if($order->items->count() > 1)
                                        <span class="text-xs text-gray-500">+ {{ $order->items->count() - 1 }} more</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-[#d4a574]">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($order->status === 'completed')
                                    <span class="px-3 py-1 bg-green-500/10 text-green-400 text-xs rounded-full border border-green-500/20">Completed</span>
                                @elseif($order->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-500/10 text-yellow-400 text-xs rounded-full border border-yellow-500/20">Pending</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-500/10 text-gray-400 text-xs rounded-full border border-gray-500/20">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="glass-card rounded-2xl p-12 text-center border text-gray-400 border-white/10">
            <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="shopping-bag" class="w-8 h-8 opacity-50"></i>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">No Orders Yet</h3>
            <p class="mb-6 max-w-sm mx-auto">Looks like you haven't made any purchases yet. Explore our marketplace to find what you need.</p>
            <a href="{{ url('/marketplace') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-[0_0_15px_rgba(212,165,116,0.2)]">
                Browse Marketplace <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    @endif
</div>
@endsection
