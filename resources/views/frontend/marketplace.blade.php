@extends('layouts.app')

@section('title', 'Marketplace | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    Marketplace
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto mb-10">
                Discover premium digital products from talented creators
            </p>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <div class="relative group">
                    <div class="absolute inset-0 bg-[#d4a574]/20 rounded-2xl blur-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative flex items-center">
                        <i data-lucide="search" class="absolute left-5 w-5 h-5 text-gray-400 group-focus-within:text-[#d4a574] transition-colors"></i>
                        <input type="text" placeholder="Search for products..." class="w-full pl-14 pr-32 py-5 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-gray-500 focus:outline-none focus:border-[#d4a574] transition-all">
                        <button class="absolute right-2 px-6 py-3 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] rounded-xl text-[#2b0e14] font-bold hover:brightness-110 transition-all flex items-center gap-2">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                            <span>Filter</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Beta / Coming Soon Banner -->
        <div class="max-w-4xl mx-auto mb-16 reveal-up">
            <div class="p-6 bg-[#d4a574]/10 border border-[#d4a574]/30 rounded-2xl flex flex-col md:flex-row items-center gap-6 justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#d4a574]/20 flex items-center justify-center shrink-0">
                        <i data-lucide="info" class="w-6 h-6 text-[#d4a574]"></i>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-lg mb-1">Marketplace Beta Mode</h4>
                        <p class="text-gray-400 text-sm">Currently, only verified <strong>HA Tech Clients</strong> can log in and purchase products. Vendor registration is coming soon!</p>
                    </div>
                </div>
                <button disabled title="Vendor registration is currently disabled" class="px-6 py-3 bg-white/5 border border-white/10 text-gray-500 font-bold rounded-xl cursor-not-allowed whitespace-nowrap">
                    Register as Seller (Coming Soon)
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $products = [
                    ['id' => 1, 'name' => 'Website Template - Modern SaaS', 'seller' => 'Design Studio Pro', 'price' => '$99', 'rating' => 4.9, 'sales' => 1250, 'gradient' => 'from-[#3B0000] to-[#4a1520]'],
                    ['id' => 2, 'name' => 'Mobile App UI Kit', 'seller' => 'Creative Minds', 'price' => '$79', 'rating' => 4.8, 'sales' => 890, 'gradient' => 'from-[#4a1520] to-[#d4a574]'],
                    ['id' => 3, 'name' => 'Logo Design Bundle', 'seller' => 'Brand Experts', 'price' => '$149', 'rating' => 5.0, 'sales' => 2100, 'gradient' => 'from-[#d4a574] to-[#f4d0a0]'],
                    ['id' => 4, 'name' => 'WordPress Theme - E-commerce', 'seller' => 'Theme Masters', 'price' => '$129', 'rating' => 4.7, 'sales' => 750, 'gradient' => 'from-[#e8b44a] to-[#c49a6b]'],
                    ['id' => 5, 'name' => 'React Components Library', 'seller' => 'Code Factory', 'price' => '$199', 'rating' => 4.9, 'sales' => 1580, 'gradient' => 'from-[#c49a6b] to-[#8b6f47]'],
                    ['id' => 6, 'name' => 'Social Media Graphics Pack', 'seller' => 'Visual Vibes', 'price' => '$49', 'rating' => 4.6, 'sales' => 3200, 'gradient' => 'from-[#8b6f47] to-[#3B0000]']
                ];
            @endphp

            @foreach($products as $product)
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r {{ $product['gradient'] }} rounded-3xl blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                <div class="block relative bg-white/5 border border-white/10 rounded-3xl overflow-hidden hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="h-52 bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center relative">
                        <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-md border border-white/10 px-3 py-1.5 rounded-full text-xs font-bold text-[#d4a574] tracking-widest uppercase z-10 flex items-center gap-2">
                            <i data-lucide="clock" class="w-3 h-3"></i> Coming Soon
                        </div>
                        <div class="text-8xl text-white/10 font-bold group-hover:scale-110 transition-transform duration-500">{{ $product['name'][0] }}</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-[#d4a574] transition-colors line-clamp-1">
                            {{ $product['name'] }}
                        </h3>
                        <p class="text-sm text-[#d4a574] font-medium mb-6 block">by {{ $product['seller'] }}</p>
                        <div class="flex items-center justify-between mb-8 pb-6 border-b border-white/5">
                            <div class="flex items-center gap-2 bg-white/5 px-3 py-1.5 rounded-full">
                                <i data-lucide="star" class="w-4 h-4 text-yellow-500 fill-yellow-500"></i>
                                <span class="text-white font-bold text-sm">{{ $product['rating'] }}</span>
                                <span class="text-gray-500 text-xs font-medium">({{ $product['sales'] }})</span>
                            </div>
                            <div class="text-2xl font-bold text-white tracking-tighter">{{ $product['price'] }}</div>
                        </div>
                        <button disabled class="w-full py-4 bg-white/5 border border-white/10 rounded-xl text-gray-500 font-bold transition-all flex items-center justify-center gap-3 cursor-not-allowed">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                            <span>Available Soon</span>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
