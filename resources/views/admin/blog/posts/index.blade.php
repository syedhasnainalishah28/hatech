@extends('layouts.admin')

@section('page_title', 'Blog Posts (SEO)')

@section('content')
<div class="glass-card p-8 h-full flex flex-col">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Articles & Posts</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Manage blog content and SEO metadata</p>
        </div>
        <a href="{{ route('admin.blog.posts.create') }}" class="bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-105 transition-transform flex items-center gap-2 shadow-xl shadow-[#d4a574]/20">
            <i data-lucide="pen-tool" class="w-4 h-4"></i> Write New Article
        </a>
    </div>

    @if(session('success'))
    <div class="mb-8 p-4 bg-emerald-400/10 border border-emerald-400/20 text-emerald-400 rounded-xl font-bold text-sm flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="flex-1 overflow-y-auto">
        <div class="grid grid-cols-1 gap-4">
            @foreach($posts as $post)
            <div class="flex items-center gap-6 p-6 rounded-3xl bg-white/[0.01] border border-white/5 hover:border-[#d4a574]/30 transition-all group">
                <!-- Thumbnail -->
                <div class="w-24 h-24 rounded-2xl overflow-hidden border border-white/10 shrink-0 bg-[#0a0506] flex items-center justify-center realtive">
                    @if($post->thumbnail && file_exists(public_path('storage/' . $post->thumbnail)))
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover">
                    @else
                        <i data-lucide="image" class="w-8 h-8 text-gray-700"></i>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        @if($post->status === 'published')
                            <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[9px] font-black uppercase tracking-widest">Published</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-[9px] font-black uppercase tracking-widest">Draft</span>
                        @endif
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-3 border-l border-white/10">
                            {{ $post->category ? $post->category->name : 'Uncategorized' }}
                        </span>
                    </div>
                    <h5 class="text-xl font-black text-white tracking-wide group-hover:text-[#d4a574] transition-colors line-clamp-1 pr-6">{{ $post->title }}</h5>
                    <div class="flex items-center gap-4 mt-2">
                        <span class="text-[10px] font-medium text-gray-400 flex items-center gap-1">
                            <i data-lucide="user" class="w-3 h-3 text-[#d4a574]"></i> {{ $post->author->name }}
                        </span>
                        <span class="text-[10px] font-medium text-gray-400 flex items-center gap-1 border-l border-white/10 pl-4">
                            <i data-lucide="calendar" class="w-3 h-3 text-[#d4a574]"></i> {{ $post->created_at->format('M d, Y') }}
                        </span>
                        <span class="text-[10px] font-medium text-gray-400 flex items-center gap-1 border-l border-white/10 pl-4">
                            <i data-lucide="clock" class="w-3 h-3 text-[#d4a574]"></i> {{ $post->read_time ?? 5 }} min read
                        </span>
                    </div>

                    <!-- SEO Hint -->
                    @if($post->meta_title || $post->meta_description || $post->focus_keyword)
                    <div class="mt-3 flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded-md bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[8px] font-black uppercase tracking-[0.2em] flex items-center gap-1">
                            <i data-lucide="search" class="w-3 h-3"></i> SEO Optimized
                        </span>
                        @if($post->focus_keyword)
                            <span class="text-[9px] text-gray-500 uppercase tracking-widest">KW: {{ $post->focus_keyword }}</span>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-2 shrink-0 border-l border-white/5 pl-6">
                    <a href="{{ route('admin.blog.posts.edit', $post->id) }}" class="h-10 px-4 rounded-xl glass-card flex items-center justify-center gap-2 hover:bg-[#d4a574]/10 hover:text-[#d4a574] hover:border-[#d4a574]/30 text-gray-400 text-[10px] font-bold uppercase tracking-widest transition-all">
                        <i data-lucide="edit-3" class="w-4 h-4"></i> Edit
                    </a>
                    <form action="{{ route('admin.blog.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Silencing this post forever?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full h-10 px-4 rounded-xl glass-card flex items-center justify-center gap-2 hover:bg-rose-500/10 hover:text-rose-400 hover:border-rose-500/30 text-gray-500 text-[10px] font-bold uppercase tracking-widest transition-all">
                            <i data-lucide="trash-2" class="w-4 h-4"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="pt-6 border-t border-white/5 mt-auto">
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
@endsection
