@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title . ' | HA Tech Insights')
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->body), 150))

@if($post->canonical_url)
@section('canonical_url')
    <link rel="canonical" href="{{ $post->canonical_url }}" />
@endsection
@endif

@section('og_tags')
    <meta property="og:title" content="{{ $post->meta_title ?: $post->title }}" />
    <meta property="og:description" content="{{ $post->meta_description ?: Str::limit(strip_tags($post->excerpt ?: $post->body), 150) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($post->thumbnail)
    <meta property="og:image" content="{{ asset('storage/' . $post->thumbnail) }}" />
    @endif
    <meta property="article:published_time" content="{{ $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String() }}" />
    <meta property="article:author" content="{{ $post->author->name }}" />
    @if($post->category)
    <meta property="article:section" content="{{ $post->category->name }}" />
    @endif
@endsection

@push('styles')
<style>
    /* Premium Prose Styling for HA Tech Detailed Reading */
    .premium-prose {
        color: #d1d5db; /* gray-300 */
        font-family: 'Inter', sans-serif;
        font-size: 1.125rem; /* 18px */
        line-height: 1.8;
       letter-spacing: 0.015em;
    }
    .premium-prose h2 {
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 900;
        font-size: 2.25rem;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }
    .premium-prose h3 {
        color: #e8b44a;
        font-weight: 700;
        font-size: 1.5rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .premium-prose p {
        margin-bottom: 1.75rem;
    }
    .premium-prose a {
        color: #d4a574;
        text-decoration: underline;
        text-underline-offset: 4px;
        transition: color 0.3s ease;
    }
    .premium-prose a:hover {
        color: #e8b44a;
    }
    .premium-prose ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.75rem;
    }
    .premium-prose ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1.75rem;
    }
    .premium-prose li {
        margin-bottom: 0.5rem;
    }
    .premium-prose blockquote {
        border-left: 4px solid #d4a574;
        padding-left: 1.5rem;
        margin-left: 0;
        margin-right: 0;
        font-style: italic;
        color: #9ca3af; /* gray-400 */
        background: rgba(255,255,255,0.02);
        padding: 1.5rem;
        border-radius: 0 1rem 1rem 0;
    }
    .premium-prose img {
        border-radius: 1.5rem;
        margin: 2.5rem 0;
        width: 100%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }
    .premium-prose pre {
        background: #0a0506;
        border: 1px solid rgba(255,255,255,0.1);
        padding: 1.5rem;
        border-radius: 1rem;
        overflow-x: auto;
        margin-bottom: 1.75rem;
    }
</style>
@endpush

@section('content')
<main class="min-h-screen relative pt-32 pb-20 antialiased overflow-x-hidden">

    <!-- Hero Section -->
    <header class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 pt-10">
        <div class="reveal-up text-center">
            
            <div class="flex items-center justify-center gap-4 mb-6">
                @if($post->category)
                <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-[10px] font-black uppercase tracking-widest" style="color: {{ $post->category->color ?? '#d4a574' }}">
                    {{ $post->category->name }}
                </span>
                @endif
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest flex items-center gap-1">
                    <i data-lucide="clock" class="w-3 h-3"></i> {{ $post->read_time ?? 5 }} Min Read
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-8 leading-tight tracking-tighter">
                {{ $post->title }}
            </h1>

            <div class="flex items-center justify-center gap-6 mt-8 border-t border-white/10 pt-8 max-w-xl mx-auto">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#d4a574] to-[#4a1520] flex items-center justify-center text-white font-black text-xl shadow-lg border border-white/10">
                        {{ substr($post->author->name, 0, 1) }}
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-bold text-white uppercase tracking-wider">{{ $post->author->name }}</p>
                        <p class="text-[10px] text-[#d4a574] font-black uppercase tracking-widest">{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

    <!-- Featured Image -->
    @if($post->thumbnail)
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 reveal-up">
        <div class="aspect-[21/9] rounded-[2rem] overflow-hidden shadow-2xl relative group border border-white/10">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] via-transparent to-transparent z-10 opacity-50"></div>
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 ease-out">
        </div>
    </div>
    @endif

    <!-- Article Content -->
    <article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 reveal-up">
        
        @if($post->excerpt)
        <div class="text-xl md:text-2xl text-gray-400 font-medium leading-relaxed mb-12 pb-12 border-b border-white/10">
            {{ $post->excerpt }}
        </div>
        @endif

        <div class="premium-prose">
            {!! $post->body !!}
        </div>

        <!-- SEO Keyword / Tags Footer -->
        <div class="mt-20 pt-8 border-t border-white/10 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Share this insight</span>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#1DA1F2] border border-white/10 flex items-center justify-center text-white transition-colors">
                    <i data-lucide="twitter" class="w-4 h-4"></i>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-[#0077b5] border border-white/10 flex items-center justify-center text-white transition-colors">
                    <i data-lucide="linkedin" class="w-4 h-4"></i>
                </a>
            </div>
            @if($post->focus_keyword)
            <div>
                <span class="px-4 py-2 rounded-full bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-widest text-[#d4a574]">
                    #{{ str_replace(' ', '', $post->focus_keyword) }}
                </span>
            </div>
            @endif
        </div>

    </article>

    <!-- Keep Reading / Related (Static visual) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32 border-t border-white/5 pt-20">
        <h3 class="text-3xl font-black uppercase tracking-tight text-white mb-12 text-center">Keep Reading</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $related = \App\Models\BlogPost::where('id', '!=', $post->id)
                            ->where('status', 'published')
                            ->orderByDesc('published_at')
                            ->take(3)->get();
            @endphp
            @foreach($related as $rel)
            <a href="{{ route('blog.single', $rel->slug) }}" class="group/card bg-white/5 border border-white/10 rounded-3xl overflow-hidden hover:bg-white/10 transition-colors">
                @if($rel->thumbnail)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('storage/'.$rel->thumbnail) }}" class="w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-700">
                    </div>
                @endif
                <div class="p-8 pb-10">
                    <div class="flex gap-4 mb-4">
                        @if($rel->category)
                        <span class="text-[9px] font-black uppercase tracking-widest" style="color: {{ $rel->category->color ?? '#d4a574' }}">{{ $rel->category->name }}</span>
                        @endif
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3 group-hover/card:text-[#d4a574] transition-colors leading-tight">{{ $rel->title }}</h4>
                    <p class="text-sm text-gray-400 line-clamp-2">{{ $rel->excerpt }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</main>
@endsection
