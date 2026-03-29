@extends('layouts.app')

@section('title', 'Our Blog | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    Our Blog
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Insights, tutorials, and stories from the digital frontier
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000] to-[#d4a574] rounded-3xl blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                <a href="{{ url('/blog/' . ($post->slug ?? $post->id)) }}" class="block relative bg-white/5 border border-white/10 rounded-3xl overflow-hidden hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="h-52 bg-gradient-to-br from-[#2b0e14] to-[#3d1a0f] flex items-center justify-center">
                        @if($post->thumbnail)
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-60 group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="text-7xl text-white/20 font-bold group-hover:scale-110 transition-transform duration-500">
                                {{ $post->category?->name[0] ?? 'B' }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-3 py-1 bg-[#3B0000]/40 border border-[#d4a574]/30 rounded-full text-xs text-[#d4a574] font-bold uppercase">
                                {{ $post->category?->name ?? 'General' }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#d4a574] transition-colors leading-tight line-clamp-2">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-400 mb-6 line-clamp-2 leading-relaxed text-sm">
                            {{ $post->excerpt }}
                        </p>
                        <div class="flex items-center justify-between text-[10px] text-gray-500 pt-4 border-t border-white/5 uppercase tracking-widest font-bold">
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-1.5">
                                    <i data-lucide="user" class="w-3.6 h-3.6 text-[#d4a574]"></i>
                                    {{ $post->author?->name ?? 'Admin' }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i data-lucide="calendar" class="w-3.6 h-3.6 text-[#d4a574]"></i>
                                    {{ $post->published_at?->format('M d, Y') ?? 'Recently' }}
                                </span>
                            </div>
                            <i data-lucide="arrow-right" class="w-4 h-4 text-[#d4a574] group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-gray-400">No blog posts found yet. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
