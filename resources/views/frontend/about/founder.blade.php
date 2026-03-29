@extends('layouts.app')

@section('title', 'Meet Our Founder | HA Tech')

@section('content')
@php
    $data = $page->components_json ?? [];
@endphp
@if($page->html_content)
    {!! $page->html_content !!}
@elseif($data)
<div class="min-h-screen relative pt-24 pb-16 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-5xl mx-auto">
        <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#d4a574] transition-colors mb-6 group">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
            <span class="font-bold uppercase tracking-widest text-[10px]">Back to Evolution</span>
        </a>

        <div class="reveal-up text-center mb-12">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 tracking-tighter">
                <span class="bg-gradient-to-r from-white via-white to-gray-500 bg-clip-text text-transparent">
                    Meet Our Founder
                </span>
            </h1>
            <p class="text-[#d4a574] font-black tracking-[0.3em] uppercase text-[9px]">The Visionary Force</p>
        </div>

        <div class="relative">
            <div class="absolute inset-x-0 -top-20 -bottom-20 bg-[#3B0000]/5 rounded-full blur-3xl"></div>
            <div class="relative bg-[#0a0506]/60 border border-white/5 rounded-3xl p-6 md:p-12 shadow-2xl backdrop-blur-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
                    <div class="aspect-square relative group max-w-sm mx-auto w-full">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#3B0000] to-[#d4a574] rounded-2xl blur-xl opacity-10 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative h-full w-full bg-gradient-to-br from-[#1a0f11] to-[#2B0E14] border border-white/5 rounded-2xl flex items-center justify-center overflow-hidden shadow-2xl group-hover:scale-[1.02] transition-transform duration-700">
                            @if(isset($data['image_path']))
                                <img src="{{ asset('storage/' . $data['image_path']) }}" class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="text-8xl text-[#d4a574] font-black opacity-10 tracking-widest select-none">HA</div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i data-lucide="rocket" class="w-24 h-24 text-[#d4a574] opacity-20"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] via-transparent to-transparent opacity-60"></div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-black text-white mb-2 tracking-tighter uppercase leading-tight">{{ $page->name }}</h2>
                            <div class="inline-block px-3 py-1 bg-[#d4a574]/10 border border-[#d4a574]/20 rounded-full">
                                <span class="text-[#d4a574] font-black text-[9px] tracking-widest uppercase">{{ $data['designation'] ?? 'Founder & Visionary' }}</span>
                            </div>
                        </div>

                        <p class="text-gray-400 text-base md:text-lg leading-relaxed font-medium">
                            {!! nl2br(e($data['biography'] ?? "With over a decade of experience in the tech industry, Hasan founded HA Tech with a vision to create a digital agency that truly understands and serves the Gen Z generation. His passion for innovation and commitment to excellence drives our company forward.")) !!}
                        </p>

                        <div class="grid grid-cols-2 gap-6 pt-6 border-t border-white/5">
                            <div>
                                <div class="text-2xl font-black text-white tracking-widest">{{ $data['stat1_value'] ?? '10+' }}</div>
                                <div class="text-[#d4a574] text-[9px] font-black uppercase tracking-widest mt-1">{{ $data['stat1_label'] ?? 'Years Evolution' }}</div>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-white tracking-widest">{{ $data['stat2_value'] ?? '1k+' }}</div>
                                <div class="text-[#d4a574] text-[9px] font-black uppercase tracking-widest mt-1">{{ $data['stat2_label'] ?? 'Impact Units' }}</div>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            @if(isset($data['linkedin']) && $data['linkedin'])
                            <a href="{{ $data['linkedin'] }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:bg-[#d4a574] hover:text-[#2B0E14] flex items-center justify-center transition-all shadow-lg active:scale-90" title="LinkedIn">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            @endif
                            @if(isset($data['twitter']) && $data['twitter'])
                            <a href="{{ $data['twitter'] }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:bg-[#d4a574] hover:text-[#2B0E14] flex items-center justify-center transition-all shadow-lg active:scale-90" title="Twitter / X">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.259 5.631 5.905-5.631zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            @endif
                            @if(isset($data['email']) && $data['email'])
                            <a href="mailto:{{ $data['email'] }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 hover:bg-[#d4a574] hover:text-[#2B0E14] flex items-center justify-center transition-all shadow-lg active:scale-90" title="Email">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-5xl mx-auto">
        <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#d4a574] transition-colors mb-8 group">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
            <span class="font-bold uppercase tracking-widest text-xs">Back to About Evolution</span>
        </a>

        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 tracking-tighter">
                <span class="bg-gradient-to-r from-white via-white to-gray-500 bg-clip-text text-transparent tracking-tighter">
                    Meet Our Founder
                </span>
            </h1>
            <p class="text-[#d4a574] font-black tracking-[0.3em] uppercase text-[10px]">The Visionary Force</p>
        </div>

        <div class="relative">
            <div class="absolute inset-x-0 -top-20 -bottom-20 bg-[#3B0000]/10 rounded-full blur-3xl"></div>
            <div class="relative bg-[#0a0506]/60 border border-white/5 rounded-3xl p-8 md:p-14 shadow-2xl backdrop-blur-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                    <div class="aspect-square relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#3B0000] to-[#d4a574] rounded-3xl blur-xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div class="relative h-full w-full bg-gradient-to-br from-[#1a0f11] to-[#2B0E14] border border-white/10 rounded-3xl flex items-center justify-center overflow-hidden shadow-2xl group-hover:scale-[1.02] transition-transform duration-700">
                            <div class="text-9xl text-[#d4a574] font-black opacity-10 tracking-widest group-hover:scale-110 transition-transform duration-700 select-none">HA</div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i data-lucide="rocket" class="w-32 h-32 text-[#d4a574] opacity-20 group-hover:translate-y--4 group-hover:rotate-12 transition-transform duration-700"></i>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] via-transparent to-transparent opacity-60"></div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div>
                            <h2 class="text-4xl md:text-5xl font-black text-white mb-3 tracking-tighter uppercase italic">Hasan Ali</h2>
                            <div class="inline-block px-4 py-1.5 bg-[#d4a574]/10 border border-[#d4a574]/30 rounded-full">
                                <span class="text-[#d4a574] font-black text-[10px] tracking-widest uppercase">Founder & Visionary</span>
                            </div>
                        </div>

                        <p class="text-gray-400 text-lg leading-relaxed">
                            With over a decade of experience in the tech industry, Hasan founded HA Tech
                            with a vision to create a digital agency that truly understands and serves the
                            Gen Z generation. His passion for innovation and commitment to excellence drives
                            our company forward.
                        </p>

                        <div class="grid grid-cols-2 gap-8 pt-6 border-t border-white/5">
                            <div>
                                <div class="text-3xl font-black text-white tracking-widest">10+</div>
                                <div class="text-[#d4a574] text-[10px] font-black uppercase tracking-widest mt-1">Years Evolution</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-white tracking-widest">1k+</div>
                                <div class="text-[#d4a574] text-[10px] font-black uppercase tracking-widest mt-1">Impact Units</div>
                            </div>
                        </div>

                        <div class="flex gap-5">
                            <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 hover:bg-[#d4a574] hover:text-[#2B0E14] flex items-center justify-center transition-all group shadow-lg active:scale-90">
                                <i data-lucide="linkedin" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 hover:bg-[#d4a574] hover:text-[#2B0E14] flex items-center justify-center transition-all group shadow-lg active:scale-90">
                                <i data-lucide="twitter" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 hover:bg-[#d4a574] hover:text-[#2B0E14] flex items-center justify-center transition-all group shadow-lg active:scale-90">
                                <i data-lucide="mail" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
