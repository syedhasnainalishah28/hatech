@extends('layouts.app')

@section('title', 'Our Portfolio | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-black mb-4 uppercase tracking-tighter">
                <span class="bg-gradient-to-r from-white via-white to-gray-500 bg-clip-text text-transparent ">
                    Our Work
                </span>
            </h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                Discover our latest digital evolutions and strategic executions.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($portfolios as $index => $portfolio)
            <div class="reveal-up group relative aspect-[4/5] rounded-[32px] overflow-hidden border border-white/5 bg-[#1a0f11] shadow-2xl">
                @php
                    $imagePath = 'storage/' . $portfolio->image_path;
                    $displayImage = (file_exists(public_path($imagePath)) && !empty($portfolio->image_path)) 
                                    ? asset($imagePath) 
                                    : asset('images/ha_tech_system_mockup.png');
                @endphp
                <img src="{{ $displayImage }}" alt="{{ $portfolio->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-60">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                
                <div class="absolute inset-0 p-8 flex flex-col justify-end translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 rounded-full bg-[#d4a574]/20 border border-[#d4a574]/30 text-[#d4a574] text-[10px] font-black uppercase tracking-widest">{{ $portfolio->category }}</span>
                        <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-white/50 text-[10px] font-bold uppercase tracking-widest">{{ $portfolio->year }}</span>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-2 uppercase tracking-tight">{{ $portfolio->title }}</h4>
                    <p class="text-gray-400 text-sm mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ $portfolio->description }}</p>
                    
                    <a href="{{ route('portfolio.show', $portfolio->slug ?? $portfolio->id) }}" class="w-fit flex items-center gap-2 text-[#d4a574] font-black text-xs uppercase tracking-[0.2em] group/btn">
                        <span>VIEW CASE STUDY</span>
                        <div class="w-8 h-8 rounded-full border border-[#d4a574]/30 flex items-center justify-center group-hover/btn:bg-[#d4a574] group-hover/btn:text-[#2B0E14] transition-all">
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </div>
                    </a>
                </div>
                
                <div class="absolute inset-0 border-2 border-[#d4a574]/0 group-hover:border-[#d4a574]/40 rounded-[32px] transition-all duration-500 pointer-events-none"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
