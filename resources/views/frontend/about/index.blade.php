@extends('layouts.app')

@section('title', 'About Our Evolution | HA Tech')
@section('content')
@php
    $data = $page->components_json ?? [];
@endphp
@if($page->html_content)
    {!! $page->html_content !!}
@elseif($data)
<div class="min-h-screen relative pt-24 pb-16 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tighter">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    {{ $data['hero_title'] ?? 'Shaping the Digital Future' }}
                </span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                {{ $data['hero_subtitle'] ?? 'We are a team of visionaries, designers, and engineers dedicated to building extraordinary digital experiences.' }}
            </p>
        </div>

        <div class="reveal-up mb-20">
            <div class="relative max-w-5xl mx-auto">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000]/10 to-[#d4a574]/10 rounded-3xl blur-2xl"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-3xl p-10 md:p-14">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-6 uppercase tracking-tight">{{ $data['story_title'] ?? 'Our Story' }}</h2>
                    <div class="text-gray-300 text-base md:text-lg leading-relaxed space-y-4">
                        {!! nl2br(e($data['story_content'] ?? "HA Tech was born from a vision to revolutionize the digital landscape for the new generation. We're not just another IT agency - we're a movement, a platform, and a community dedicated to pushing the boundaries of what's possible in the digital world.")) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
            <!-- Mission -->
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000]/10 to-[#d4a574]/10 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#3B0000] to-[#d4a574] flex items-center justify-center mb-4 text-white">
                        <i data-lucide="target" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-tight">Our Mission</h3>
                    <p class="text-gray-400 text-xs md:text-sm leading-relaxed">{{ $data['mission_desc'] ?? 'To empower brands with cutting-edge technology and creative excellence.' }}</p>
                </div>
            </div>
            <!-- Vision -->
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000]/10 to-[#d4a574]/10 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#3B0000] to-[#d4a574] flex items-center justify-center mb-4 text-white">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-tight">Our Vision</h3>
                    <p class="text-gray-400 text-xs md:text-sm leading-relaxed">{{ $data['vision_desc'] ?? 'To be the global leader in digital transformation and innovation.' }}</p>
                </div>
            </div>
            <!-- Excellence -->
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000]/10 to-[#d4a574]/10 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-[#3B0000] to-[#d4a574] flex items-center justify-center mb-4 text-white">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-tight">Excellence</h3>
                    <p class="text-gray-400 text-xs md:text-sm leading-relaxed">{{ $data['excellence_desc'] ?? 'Committed to delivering premium quality every time' }}</p>
                </div>
            </div>
        </div>

        <!-- Links to CEO/Founder -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
            <a href="{{ url('/about/founder') }}" class="reveal-up group relative overflow-hidden rounded-3xl border border-white/10 p-12 hover:border-[#d4a574]/40 transition-all">
                <div class="absolute inset-0 bg-gradient-to-br from-[#3B0000]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <h3 class="text-3xl font-bold text-white mb-4 uppercase tracking-tighter">Meet the Founder</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">Learn about the vision and passion behind HA Tech.</p>
                <span class="inline-flex items-center gap-2 text-[#d4a574] font-black text-xs uppercase tracking-[0.2em]">Read More <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i></span>
            </a>
            <a href="{{ url('/about/ceo') }}" class="reveal-up group relative overflow-hidden rounded-3xl border border-white/10 p-12 hover:border-[#d4a574]/40 transition-all">
                <div class="absolute inset-0 bg-gradient-to-br from-[#d4a574]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <h3 class="text-3xl font-bold text-white mb-4 uppercase tracking-tighter">Meet our CEO</h3>
                <p class="text-gray-400 mb-6 leading-relaxed">Discover how we drive operational excellence and growth.</p>
                <span class="inline-flex items-center gap-2 text-[#d4a574] font-black text-xs uppercase tracking-[0.2em]">Read More <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i></span>
            </a>
        </div>
    </div>
</div>
@else
<div class="min-h-screen relative pt-24 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto text-center py-20">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tighter">About HA Tech</h1>
        <p class="text-gray-400 text-lg">Our story, mission, and vision will appear here once content is configured.</p>
    </div>
</div>
@endif
@endsection
