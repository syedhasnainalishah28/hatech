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

        <!-- SEO SUITE -->
        <div class="bg-white/5 p-8 rounded-3xl border border-white/5 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <i data-lucide="search" class="w-5 h-5 text-[#d4a574]"></i>
                <h4 class="text-xs font-black uppercase tracking-widest text-white">Identity SEO Suite</h4>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[9px] uppercase font-bold text-gray-500 tracking-widest">Meta Title (Authority Branding)</label>
                    <input type="text" name="meta_title" value="{{ $page->meta_title }}" placeholder="e.g. Syed Hasnain Ali Shah | Founder & Visionary" class="w-full bg-black/40 border border-white/5 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-sm text-white">
                </div>
                <div class="space-y-2">
                    <label class="text-[9px] uppercase font-bold text-gray-500 tracking-widest">Focus Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ $page->meta_keywords }}" placeholder="Hasan Ali, Hasnain Shah, Syed Hasnain..." class="w-full bg-black/40 border border-white/5 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-sm text-white">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[9px] uppercase font-bold text-gray-500 tracking-widest">Meta Description (Search Snippet)</label>
                <textarea name="meta_description" rows="2" class="w-full bg-black/40 border border-white/5 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-sm text-gray-300">{{ $page->meta_description }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-[9px] uppercase font-bold text-gray-500 tracking-widest">JSON-LD Person Schema</label>
                <textarea name="schema_markup" rows="4" class="w-full bg-black/40 border border-white/5 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-xs text-gray-400 font-mono" placeholder='{ "@@context": "https://schema.org", "@@type": "Person"... }'>{{ $page->schema_markup }}</textarea>
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
