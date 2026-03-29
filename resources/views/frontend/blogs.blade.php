@extends('layouts.app')

@section('title', 'Blogs - Insights & Innovation')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-[#1a0f11] to-[#0a0506] -z-20"></div>
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="reveal-up">
                <h1 class="text-5xl md:text-5xl font-black mb-6 leading-tight">
                    Insights & <br>
                    <span class="bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent ">Innovation</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-10">Explore the latest trends in AI, luxury digital design, and next-gen enterprise solutions.</p>
            </div>
        </div>
    </section>

    <!-- BLOG GRID -->
    <section class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="reveal-up group">
                            <div class="relative bg-white/[0.03] border border-white/10 rounded-[2.5rem] overflow-hidden hover:bg-white/[0.05] transition-all duration-500 h-full flex flex-col">
                                <!-- Image Placeholder / Thumbnail -->
                                <div class="relative aspect-[16/10] overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                                    <img src="{{ $post->thumbnail ?? asset('images/blog-placeholder.jpg') }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute top-4 left-4 z-20">
                                        <span class="px-4 py-1.5 rounded-full bg-[#d4a574] text-[#2b0e14] text-xs font-bold uppercase tracking-widest">
                                            {{ $post->category ?? 'Tech' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-8 flex flex-col flex-grow">
                                    <div class="flex items-center gap-4 text-gray-500 text-xs mb-4 uppercase tracking-widest font-bold">
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="w-1 h-1 rounded-full bg-[#d4a574]"></span>
                                        <span>5 min read</span>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-[#d4a574] transition-colors leading-tight">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-gray-400 text-sm line-clamp-3 mb-8">
                                        {{ Str::limit(strip_tags($post->content), 120) }}
                                    </p>
                                    <div class="mt-auto pt-6 border-t border-white/5 flex items-center justify-between">
                                        <a href="{{ url('/blogs/'.$post->slug) }}" class="text-[#d4a574] font-bold text-sm tracking-widest uppercase flex items-center gap-2 group/btn">
                                            Read Article
                                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 reveal-up">
                    <div class="w-24 h-24 rounded-3xl bg-white/5 flex items-center justify-center mx-auto mb-8 border border-[#d4a574]/30">
                        <i data-lucide="pen-tool" class="w-10 h-10 text-[#d4a574]"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">Our Writers are Preparing Something Epic</h2>
                    <p class="text-gray-400 mb-8 max-w-md mx-auto">We're currently crafting high-value content for our Gen Z tech audience. Stay tuned for the first drop.</p>
                    <a href="{{ url('/') }}" class="inline-flex px-8 py-4 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold shadow-lg shadow-[#d4a574]/20 hover:scale-105 transition-all">
                        Back to Home
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="py-20 px-4 border-t border-white/5 bg-white/[0.01]">
        <div class="max-w-4xl mx-auto rounded-[3rem] p-12 bg-gradient-to-br from-[#1a0f11] to-[#0a0506] border border-[#d4a574]/20 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#d4a574]/5 blur-[100px] -z-10"></div>
            <h2 class="text-3xl font-bold text-white mb-4">Join the Inner Circle</h2>
            <p class="text-gray-400 mb-8">Get exclusive insights delivered directly to your inbox. No spam, just pure value.</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Your premium email" class="flex-grow bg-white/5 border border-white/10 rounded-full px-6 py-4 text-white placeholder-gray-500 focus:outline-none focus:border-[#d4a574] transition-colors">
                <button class="px-8 py-4 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold shadow-lg shadow-[#d4a574]/20 hover:scale-105 transition-all">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
@endsection
