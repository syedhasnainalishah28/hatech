@extends('layouts.admin')

@section('page_title', 'Edit About Page: ' . $page->name)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="glass-card p-10 space-y-8">
        @csrf
        
        <div class="space-y-2">
            <label class="text-[10px] uppercase font-black tracking-widest text-[#d4a574]">Page Name / Admin Title</label>
            <input type="text" name="name" value="{{ $page->name }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-bold" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t border-white/5">
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Hero Title (Main)</label>
                <input type="text" name="hero_title" value="{{ $page->components_json['hero_title'] ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white" placeholder="Shaping the Digital Future">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Hero Subtitle</label>
                <input type="text" name="hero_subtitle" value="{{ $page->components_json['hero_subtitle'] ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white" placeholder="...">
            </div>
        </div>

        <div class="space-y-2 pt-6 border-t border-white/5">
            <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Our Story Title</label>
            <input type="text" name="story_title" value="{{ $page->components_json['story_title'] ?? 'Our Story' }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white uppercase font-bold tracking-tight">
        </div>

        <div class="space-y-2">
            <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Our Story Content</label>
            <textarea name="story_content" rows="8" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white leading-relaxed">{{ $page->components_json['story_content'] ?? '' }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-white/5">
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Mission Description</label>
                <textarea name="mission_desc" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs leading-relaxed text-gray-300">{{ $page->components_json['mission_desc'] ?? '' }}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Vision Description</label>
                <textarea name="vision_desc" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs leading-relaxed text-gray-300">{{ $page->components_json['vision_desc'] ?? '' }}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Excellence Description</label>
                <textarea name="excellence_desc" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs leading-relaxed text-gray-300">{{ $page->components_json['excellence_desc'] ?? '' }}</textarea>
            </div>
        </div>

        <div class="flex gap-4 pt-6">
            <button type="submit" class="px-10 py-5 bg-[#d4a574] text-black font-black rounded-2xl hover:scale-105 transition-all shadow-lg flex items-center gap-2 uppercase tracking-widest text-xs">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i> Update Content
            </button>
            <a href="{{ route('admin.pages') }}" class="px-10 py-5 bg-white/5 border border-white/10 text-white font-black rounded-2xl hover:bg-white/10 transition-all uppercase tracking-widest text-xs">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
