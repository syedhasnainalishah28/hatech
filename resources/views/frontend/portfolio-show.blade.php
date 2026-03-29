@extends('layouts.app')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen text-white pt-32 pb-24">
    <!-- Hero Section -->
    <section class="max-w-[1400px] mx-auto px-6 md:px-12 mb-24">
        <div class="reveal-up">
            <div class="flex items-center gap-4 mb-8">
                <span class="px-4 py-1 rounded-full bg-[#d4a574]/10 border border-[#d4a574]/20 text-[#d4a574] text-[10px] font-black uppercase tracking-[0.3em]">{{ $portfolio->category }}</span>
                <span class="text-gray-600 text-[10px] font-black uppercase tracking-[0.3em]">{{ $portfolio->year }}</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black uppercase tracking-tighter leading-[0.95] mb-12">
                {{ $portfolio->title }}
            </h1>
        </div>

        <div class="reveal-up aspect-[21/9] w-full rounded-[48px] overflow-hidden border border-white/5 bg-white/[0.02] relative group">
            @php
                $imagePath = 'storage/' . $portfolio->image_path;
                $displayImage = (file_exists(public_path($imagePath)) && !empty($portfolio->image_path)) 
                                ? asset($imagePath) 
                                : asset('images/ha_tech_system_mockup.png');
            @endphp
            <img src="{{ $displayImage }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent opacity-60"></div>
        </div>
    </section>

    <!-- Case Study Body -->
    <section class="max-w-[1400px] mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
            <!-- Sidebar / Stats -->
            <div class="lg:col-span-4 space-y-12">
                <div class="reveal-up">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6">Brief</h3>
                    <p class="text-xl text-gray-300 leading-relaxed font-medium">
                        {{ $portfolio->description }}
                    </p>
                </div>

                <div class="reveal-up pt-12 border-t border-white/5 space-y-8">
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-2">Platform</h4>
                        <p class="text-white font-bold">{{ $portfolio->category }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-2">Released</h4>
                        <p class="text-white font-bold">{{ $portfolio->year }}</p>
                    </div>
                    @if($portfolio->case_study_url)
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-4">Live Preview</h4>
                        <a href="{{ $portfolio->case_study_url }}" target="_blank" class="inline-flex items-center gap-3 text-[#d4a574] group">
                            <span class="font-black text-xs uppercase tracking-widest">Visit Project</span>
                            <i data-lucide="external-link" class="w-4 h-4 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-8">
                <div class="reveal-up prose prose-invert prose-p:text-gray-400 prose-p:text-lg prose-p:leading-relaxed prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tighter max-w-none">
                    @if($portfolio->content)
                        {!! $portfolio->content !!}
                    @else
                        <div class="p-12 rounded-[40px] border border-dashed border-white/10 text-center">
                            <p class="text-gray-500 italic">Full case study content coming soon... This project showcases our commitment to elite technical execution and premium design aesthetics.</p>
                        </div>
                    @endif
                </div>

                <!-- Footer Navigation -->
                <div class="mt-32 pt-24 border-t border-white/5 flex justify-between items-center reveal-up">
                    <a href="{{ url('/') }}#work" class="flex items-center gap-4 text-gray-500 hover:text-white transition-colors group">
                        <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-2 transition-transform"></i>
                        <span class="font-black text-xs uppercase tracking-widest">Back to Portfolio</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .prose h2 { font-size: 2.5rem; margin-top: 4rem; margin-bottom: 2rem; color: #d4a574; }
    .prose p { margin-bottom: 2rem; }
    .prose img { border-radius: 32px; border: 1px solid rgba(255,255,255,0.05); margin-top: 4rem; margin-bottom: 4rem; }
</style>
@endsection
