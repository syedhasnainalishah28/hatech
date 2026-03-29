@extends('layouts.app')

@section('title', $post->title . ' | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-4xl mx-auto">
        <a href="{{ url('/blog') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#d4a574] transition-colors mb-8 group">
            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
            <span class="font-bold uppercase tracking-widest text-xs">Back to Blog Evolution</span>
        </a>

        <div class="reveal-up mb-12">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-4 py-1.5 bg-[#d4a574]/10 border border-[#d4a574]/30 rounded-full text-[#d4a574] font-bold text-xs uppercase tracking-widest">
                    {{ $post->category?->name ?? 'Update' }}
                </span>
                <span class="text-gray-500 text-xs font-bold uppercase tracking-widest">
                    {{ $post->read_time ?? '5 min' }} read
                </span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight tracking-tighter">
                {{ $post->title }}
            </h1>
            <div class="flex items-center gap-6 pb-8 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#d4a574] to-[#e8b44a] flex items-center justify-center text-[#2b0e14] font-bold">
                        {{ substr($post->author?->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm">{{ $post->author?->name ?? 'Admin' }}</div>
                        <div class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">Author</div>
                    </div>
                </div>
                <div>
                    <div class="text-white font-bold text-sm">{{ $post->published_at?->format('M d, Y') ?? 'Recently' }}</div>
                    <div class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">Published</div>
                </div>
            </div>
        </div>

        <div class="reveal-up relative mb-16 rounded-3xl overflow-hidden aspect-video border border-white/10 group">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] to-transparent z-10 opacity-60"></div>
            @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[2s]">
            @else
                <div class="w-full h-full bg-gradient-to-br from-[#2b0e14] to-[#3d1a0f] flex items-center justify-center">
                    <i data-lucide="image" class="w-20 h-20 text-white/10"></i>
                </div>
            @endif
        </div>

        <div class="reveal-up prose prose-invert prose-p:text-gray-300 prose-headings:text-white max-w-none text-lg leading-relaxed">
            {!! $post->body !!}
        </div>

        <div class="reveal-up mt-20 p-12 bg-white/5 border border-white/10 rounded-3xl text-center">
            <h3 class="text-2xl font-bold text-white mb-4">Enjoying our content?</h3>
            <p class="text-gray-400 mb-8 max-w-xl mx-auto text-lg leading-relaxed">
                Stay updated with the latest digital evolution insights and strategies by following our journey.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/contact') }}" class="px-8 py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-full hover:scale-105 transition-all shadow-lg shadow-[#d4a574]/20">
                    SAY HELLO
                </a>
                <a href="#" class="px-8 py-4 bg-white/5 border border-white/20 text-white font-bold rounded-full hover:bg-white/10 transition-all">
                    FOLLOW @HATECH
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
