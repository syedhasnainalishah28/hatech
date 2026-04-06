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
@endsection

@push('styles')
<style>
    /* OJS Inspired Layout & Prose */
    .premium-prose {
        color: #d1d5db;
        font-family: 'Inter', sans-serif;
        font-size: 1.15rem;
        line-height: 1.8;
    }
    .premium-prose h2 {
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-weight: 900;
        font-size: 2.25rem;
        margin-top: 3.5rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }
    .premium-prose h3 {
        color: #e8b44a;
        font-weight: 700;
        font-size: 1.5rem;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }
    .premium-prose p { margin-bottom: 2rem; }
    
    /* Quill Specific List Fixes */
    .premium-prose ul {
        list-style-type: disc !important;
        margin-bottom: 2rem;
        padding-left: 2rem;
    }
    .premium-prose ol {
        list-style-type: decimal !important;
        margin-bottom: 2rem;
        padding-left: 2rem;
    }
    .premium-prose li {
        margin-bottom: 0.75rem;
        display: list-item !important;
    }
    
    .premium-prose blockquote {
        border-left: 4px solid #d4a574;
        padding: 2rem;
        margin: 3rem 0;
        background: rgba(212,165,116,0.03);
        font-style: italic;
        font-size: 1.25rem;
        color: #9ca3af;
    }
    .premium-prose img {
        border-radius: 1rem;
        margin: 2.5rem 0;
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }

    .sticky-sidebar {
        position: sticky;
        top: 8rem;
        height: max-content;
    }

    .ql-align-center { text-align: center; }
    .ql-align-right { text-align: right; }
    .ql-align-justify { text-align: justify; }
</style>
@endpush

@section('content')
<main class="min-h-screen pt-32 pb-20 antialiased bg-[#0a0506]">
    
    <!-- Hero Section: Title & Top Image -->
    <header class="max-w-7xl mx-auto px-4 mb-20">
        <div class="reveal-up text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                @if($post->category)
                <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-lg" style="color: {{ $post->category->color ?? '#d4a574' }}">
                    {{ $post->category->name }}
                </span>
                @endif
                <span class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] flex items-center gap-2 bg-white/5 px-4 py-1.5 rounded-full border border-white/10">
                    <i data-lucide="clock" class="w-3.5 h-3.5"></i> {{ $post->read_time ?? 5 }} Min Reading
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl font-black mb-8 leading-[1.2] tracking-tighter uppercase max-w-4xl mx-auto text-white">
                {{ $post->title }}
            </h1>
        </div>

        @if($post->thumbnail)
        <div class="reveal-up max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-[0_30px_60px_-10px_rgba(0,0,0,0.5)] border border-white/10 aspect-[16/7]">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif
    </header>

    <!-- OJS-Style 3 Column Content -->
    <div class="max-w-[1600px] mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- LEFT SIDEBAR: Author & Meta -->
            @if($post->sidebar_left_show)
            <aside class="lg:col-span-3 order-2 lg:order-1 sticky-sidebar">
                <div class="reveal-up">
                    @if($post->sidebar_left_type == 'standard')
                        <!-- Author Card -->
                        <div class="glass-card p-8 border border-white/10 rounded-2xl mb-8 group">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-[#d4a574] to-[#4a1520] flex items-center justify-center text-white font-black text-3xl shadow-2xl border-4 border-white/5 mb-6 group-hover:scale-110 transition-transform duration-500">
                                    {{ substr($post->author->name, 0, 1) }}
                                </div>
                                <h4 class="text-sm font-black uppercase tracking-[0.2em] text-white">{{ $post->author->name }}</h4>
                                <p class="text-[10px] text-[#d4a574] font-black uppercase mt-1">Lead Strategist</p>
                                <div class="w-full h-px bg-white/5 my-6"></div>
                                <div class="flex flex-col gap-4 text-left w-full">
                                    <div class="flex flex-col">
                                        <span class="text-[9px] uppercase font-black text-gray-500 tracking-widest">Published On</span>
                                        <span class="text-xs font-bold text-gray-300">{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] uppercase font-black text-gray-500 tracking-widest">Repository</span>
                                        <span class="text-xs font-bold text-gray-300 italic">{{ $post->category->name }} / Archive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Custom Content -->
                        <div class="glass-card p-6 rounded-2xl border border-white/10 overflow-hidden">
                            {!! $post->sidebar_left_content !!}
                        </div>
                    @endif
                </div>
            </aside>
            @endif

            <!-- MAIN CONTENT: The Article -->
            <div class="{{ $post->sidebar_left_show && $post->sidebar_right_show ? 'lg:col-span-6' : ($post->sidebar_left_show || $post->sidebar_right_show ? 'lg:col-span-9' : 'lg:col-span-12 max-w-4xl mx-auto') }} order-1 lg:order-2">
                <article class="reveal-up">
                    @if($post->excerpt)
                    <div class="text-2xl md:text-3xl text-gray-400 font-medium leading-relaxed mb-12 italic border-b border-white/10 pb-12">
                        "{{ $post->excerpt }}"
                    </div>
                    @endif

                    <div class="premium-prose ql-editor">
                        {!! $post->body !!}
                    </div>
                </article>
            </div>

            <!-- RIGHT SIDEBAR: Share & Related -->
            @if($post->sidebar_right_show)
            <aside class="lg:col-span-3 order-3 sticky-sidebar">
                <div class="reveal-up space-y-10">
                    
                    @if($post->sidebar_right_type == 'standard')
                        <!-- Share Box -->
                        <div class="glass-card p-8 border border-white/10 rounded-2xl bg-white/[0.02]">
                            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-white mb-6 flex items-center gap-2">
                                <i data-lucide="share-2" class="w-4 h-4 text-[#d4a574]"></i> Disseminate
                            </h4>
                            <div class="flex flex-col gap-3">
                                <a href="https://x.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="w-full py-4 rounded-xl border border-white/5 hover:border-[#d4a574]/50 bg-white/5 hover:bg-white/10 flex items-center justify-between px-6 transition-all group">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-white">Share on X</span>
                                    <i data-lucide="x" class="w-4 h-4 text-gray-500 group-hover:text-white"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="w-full py-4 rounded-xl border border-white/5 hover:border-[#d4a574]/50 bg-white/5 hover:bg-white/10 flex items-center justify-between px-6 transition-all group">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-white">LinkedIn</span>
                                    <i data-lucide="linkedin" class="w-4 h-4 text-gray-500 group-hover:text-white"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Related Articles -->
                        <div class="space-y-6">
                            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-gray-500 px-2 flex items-center justify-between">
                                Synchronized Reading
                                <i data-lucide="compass" class="w-3.5 h-3.5 opacity-50"></i>
                            </h4>
                            @php
                                $related = \App\Models\BlogPost::where('id', '!=', $post->id)->where('status', 'published')->latest('published_at')->take(2)->get();
                            @endphp
                            @foreach($related as $rel)
                            <a href="{{ route('blog.single', $rel->slug) }}" class="group block glass-card p-6 border border-white/10 rounded-2xl hover:bg-white/5 transition-all">
                                <div class="flex flex-col gap-3">
                                    <span class="text-[8px] font-black uppercase tracking-widest text-[#d4a574]">{{ $rel->category->name }}</span>
                                    <h5 class="text-sm font-bold text-white group-hover:text-[#d4a574] transition-colors leading-snug line-clamp-2 uppercase tracking-tight">{{ $rel->title }}</h5>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <!-- Custom Content -->
                        <div class="glass-card p-6 rounded-2xl border border-white/10 overflow-hidden">
                            {!! $post->sidebar_right_content !!}
                        </div>
                    @endif

                    @if($post->focus_keyword)
                    <div class="pt-10">
                         <div class="w-20 h-0.5 bg-white/10 mb-6"></div>
                         <span class="text-[9px] font-black text-[#d4a574] uppercase tracking-[0.2em] opacity-80 decoration-inherit">#{{ str_replace(' ', '', $post->focus_keyword) }}</span>
                    </div>
                    @endif

                </div>
            </aside>
            @endif

        </div>
    </div>

    <!-- Bottom Action: Newsletter -->
    <section class="mt-40 max-w-5xl mx-auto px-4 reveal-up">
        <div class="relative p-12 lg:p-20 rounded-[2.5rem] bg-gradient-to-br from-[#1a0f11] to-[#0a0506] border border-[#d4a574]/20 text-center overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#d4a574]/5 blur-[120px]"></div>
            <h2 class="text-3xl lg:text-5xl font-black uppercase tracking-tighter text-white mb-6">Evolution is an Inbox Away</h2>
            <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">Get exclusive strategy drops and digital insights for the next-gen web space.</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Premium Email Address" class="flex-grow bg-white/5 border border-white/10 rounded-full px-8 py-5 text-white placeholder-gray-600 focus:outline-none focus:border-[#d4a574] transition-all font-bold">
                <button class="px-10 py-5 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#0a0506] font-black uppercase text-xs tracking-widest hover:scale-105 transition-all shadow-xl shadow-[#d4a574]/20">Join</button>
            </form>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
