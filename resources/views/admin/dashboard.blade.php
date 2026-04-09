@extends('layouts.admin')

@section('page_title', 'Master Dashboard')

@section('content')
<!-- System Status Row -->
<div class="mb-12">
    <div class="glass-card p-8 border {{ App::isDownForMaintenance() ? 'border-rose-500/30 bg-rose-500/5' : 'border-emerald-500/30 bg-emerald-500/5' }} flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="flex items-center gap-6 text-center md:text-left">
            <div class="w-16 h-16 rounded-3xl {{ App::isDownForMaintenance() ? 'bg-rose-500/20 text-rose-400' : 'bg-emerald-500/20 text-emerald-400' }} flex items-center justify-center shadow-2xl">
                <i data-lucide="{{ App::isDownForMaintenance() ? 'shield-off' : 'shield-check' }}" class="w-8 h-8"></i>
            </div>
            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.3em] text-gray-400 mb-1">System Environment</h3>
                <div class="flex items-center gap-3 justify-center md:justify-start">
                    <span class="text-2xl font-black uppercase tracking-tighter">
                        @if(App::isDownForMaintenance())
                            Maintenance Mode
                        @else
                            Production Live
                        @endif
                    </span>
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ App::isDownForMaintenance() ? 'bg-rose-400' : 'bg-emerald-400' }} opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 {{ App::isDownForMaintenance() ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center gap-6">
            @php 
                $devMode = \App\Models\SiteSetting::get('developer_mode', false);
            @endphp
            
            <a href="{{ route('admin.logs') }}" class="flex items-center gap-3 px-6 py-3 bg-white/5 hover:bg-white/10 rounded-xl transition-all border border-white/5">
                <i data-lucide="activity" class="w-4 h-4 text-[#d4a574]"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-300">Activity Logs</span>
            </a>

            <form action="{{ route('admin.maintenance.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="w-full md:w-auto px-6 py-3 {{ App::isDownForMaintenance() ? 'bg-emerald-500 text-black' : 'bg-rose-500 text-white' }} rounded-xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl hover:scale-105 transition-all">
                    {{ App::isDownForMaintenance() ? 'Go Live' : 'Under Maintenance' }}
                </button>
            </form>

            <form action="{{ route('admin.dev_mode.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="w-full md:w-auto px-6 py-3 {{ $devMode ? 'bg-amber-500 text-black' : 'bg-white/10 text-white' }} rounded-xl font-black text-[10px] uppercase tracking-[0.2em] transition-all border border-white/10">
                    {{ $devMode ? 'Dev Mode: ON' : 'Dev Mode: OFF' }}
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <!-- Revenue -->
    <div class="glass-card p-8 bg-gradient-to-br from-[#3B0000]/20 to-transparent">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                <i data-lucide="dollar-sign" class="w-6 h-6"></i>
            </div>
            <span class="text-emerald-400 text-xs font-black bg-emerald-400/10 px-3 py-1 rounded-full">+12.5%</span>
        </div>
        <h3 class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Total Revenue</h3>
        <p class="text-3xl font-black">${{ number_format($stats['revenue'], 2) }}</p>
    </div>

    <!-- Users -->
    <div class="glass-card p-8 bg-gradient-to-br from-purple-500/10 to-transparent">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-purple-500/20 flex items-center justify-center text-purple-400">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <span class="text-emerald-400 text-xs font-black bg-emerald-400/10 px-3 py-1 rounded-full">+8.2%</span>
        </div>
        <h3 class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Total Users</h3>
        <p class="text-3xl font-black">{{ number_format($stats['users']) }}</p>
    </div>

    <!-- Products -->
    <div class="glass-card p-8 bg-gradient-to-br from-pink-500/10 to-transparent">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-pink-500/20 flex items-center justify-center text-pink-400">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <span class="text-rose-400 text-xs font-black bg-rose-400/10 px-3 py-1 rounded-full">-2.4%</span>
        </div>
        <h3 class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Products</h3>
        <p class="text-3xl font-black">{{ number_format($stats['products']) }}</p>
    </div>

    <!-- Orders -->
    <div class="glass-card p-8 bg-gradient-to-br from-[#d4a574]/10 to-transparent">
        <div class="flex justify-between items-start mb-6">
            <div class="w-12 h-12 rounded-2xl bg-[#d4a574]/20 flex items-center justify-center text-[#d4a574]">
                <i data-lucide="shopping-cart" class="w-6 h-6"></i>
            </div>
            <span class="text-emerald-400 text-xs font-black bg-emerald-400/10 px-3 py-1 rounded-full">+15.3%</span>
        </div>
        <h3 class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Total Orders</h3>
        <p class="text-3xl font-black">{{ number_format($stats['orders']) }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
    <!-- Recent Orders -->
    <div class="glass-card p-8">
        <div class="flex justify-between items-center mb-8">
            <h4 class="text-xl font-black uppercase tracking-tight">Recent Activity</h4>
            <a href="#" class="text-[#d4a574] text-xs font-black uppercase tracking-widest border-b border-[#d4a574]/20 pb-1 hover:border-[#d4a574] transition-all">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] border-b border-white/5">
                        <th class="pb-4">Order</th>
                        <th class="pb-4">Buyer</th>
                        <th class="pb-4">Amount</th>
                        <th class="pb-4 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($recentOrders as $order)
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="py-4 font-bold text-sm text-gray-400">#{{ $order->id }}</td>
                        <td class="py-4 font-black uppercase text-xs">{{ $order->buyer->name ?? 'Guest' }}</td>
                        <td class="py-4 font-black text-[#d4a574] text-sm">${{ number_format($order->total, 2) }}</td>
                        <td class="py-4 text-right">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $order->status === 'completed' ? 'bg-emerald-400/10 text-emerald-400' : 'bg-gray-400/10 text-gray-400' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Portfolio Quick View -->
    <div class="glass-card p-8">
        <div class="flex justify-between items-center mb-8">
            <h4 class="text-xl font-black uppercase tracking-tight">Portfolio Pulse</h4>
            <a href="/admin/portfolios" class="text-[#d4a574] text-xs font-black uppercase tracking-widest border-b border-[#d4a574]/20 pb-1 hover:border-[#d4a574] transition-all">Manage Projects</a>
        </div>
        <div class="grid grid-cols-1 gap-6">
            @foreach($recentPortfolios as $portfolio)
            <div class="flex items-center gap-6 p-4 rounded-2xl bg-white/[0.02] border border-white/5 group hover:border-[#d4a574]/30 transition-all">
                <div class="w-20 h-20 rounded-xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-black text-[#d4a574] uppercase tracking-widest mb-1">{{ $portfolio->category }}</p>
                    <h5 class="font-black uppercase text-sm mb-1">{{ $portfolio->title }}</h5>
                    <p class="text-xs text-gray-500 line-clamp-1">{{ $portfolio->description }}</p>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="px-2 py-0.5 rounded-md bg-white/5 text-[10px] font-bold text-gray-400">{{ $portfolio->year }}</span>
                    <i data-lucide="eye" class="w-4 h-4 text-gray-600 group-hover:text-[#d4a574] transition-colors"></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
