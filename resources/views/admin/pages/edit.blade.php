@extends('layouts.admin')

@section('page_title', 'Edit Page: ' . $page->name)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" class="glass-card p-10 space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Page Name</label>
                <input type="text" name="name" value="{{ $page->name }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-bold" required>
            </div>
            
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">URL Slug</label>
                <input type="text" name="slug" value="{{ $page->slug }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-mono" required>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <label class="text-[10px] uppercase font-black tracking-widest text-[#d4a574] flex items-center gap-2">
                    <i data-lucide="code-2" class="w-4 h-4"></i> PRO MODE: HTML CONTENT EDITOR
                </label>
                <span class="text-[9px] px-2 py-0.5 bg-red-500/10 border border-red-500/20 text-red-500 font-bold uppercase tracking-tighter rounded">Technical Area</span>
            </div>
            <textarea name="html_content" rows="20" class="w-full bg-[#0a0506] border border-white/5 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-gray-300 font-mono text-sm leading-relaxed" placeholder="Modify your HTML content here...">{{ $page->html_content }}</textarea>
            <p class="text-[10px] text-gray-500 flex items-center gap-2">
                <i data-lucide="info" class="w-3 h-3"></i> This area is for raw code editing. Ensure HTML tags are balanced to avoid breaking the frontend design.
            </p>
        </div>

        <div class="flex gap-4 pt-6">
            <button type="submit" class="px-10 py-4 bg-[#d4a574] text-black font-black rounded-2xl hover:scale-105 transition-all shadow-lg flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i> UPDATE PAGE
            </button>
            <a href="{{ route('admin.pages') }}" class="px-10 py-4 bg-white/5 border border-white/10 text-white font-black rounded-2xl hover:bg-white/10 transition-all">
                CANCEL
            </a>
        </div>
    </form>
</div>
@endsection
