@extends('layouts.admin')

@section('page_title', 'Edit Profile: ' . $page->name)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="glass-card p-10 space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Full Name</label>
                <input type="text" name="name" value="{{ $page->name }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-bold" required>
            </div>
            
            <div class="space-y-2">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Designation</label>
                <input type="text" name="designation" value="{{ $page->components_json['designation'] ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white" placeholder="e.g. Founder & Visionary">
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Biography / Description</label>
            <textarea name="biography" rows="6" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white leading-relaxed">{{ $page->components_json['biography'] ?? '' }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Profile Picture</label>
                <div class="flex items-center gap-6">
                    @if(isset($page->components_json['image_path']))
                        <div class="relative group">
                            <img src="{{ asset($page->components_json['image_path']) }}" class="w-24 h-24 rounded-2xl object-cover border border-white/10 shadow-xl">
                        </div>
                    @else
                        <div class="w-24 h-24 rounded-2xl bg-white/5 border border-dashed border-white/10 flex items-center justify-center text-gray-500 text-center text-[10px] uppercase font-bold p-4">
                            No Photo
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="image" class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-[#d4a574] file:text-black hover:file:bg-[#b88a5a] transition-all">
                        <p class="text-[9px] text-gray-500 mt-2 uppercase font-bold tracking-widest">JPG, PNG allowed</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Social Links</label>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <i data-lucide="linkedin" class="w-4 h-4 text-[#d4a574]"></i>
                        <input type="text" name="linkedin" value="{{ $page->components_json['linkedin'] ?? '' }}" placeholder="LinkedIn URL" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2 outline-none focus:border-[#d4a574] text-white text-xs">
                    </div>
                    <div class="flex items-center gap-3">
                        <i data-lucide="twitter" class="w-4 h-4 text-[#d4a574]"></i>
                        <input type="text" name="twitter" value="{{ $page->components_json['twitter'] ?? '' }}" placeholder="Twitter URL" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2 outline-none focus:border-[#d4a574] text-white text-xs">
                    </div>
                   <div class="flex items-center gap-3">
                        <i data-lucide="mail" class="w-4 h-4 text-[#d4a574]"></i>
                        <input type="text" name="email" value="{{ $page->components_json['email'] ?? '' }}" placeholder="Email Address" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2 outline-none focus:border-[#d4a574] text-white text-xs">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 border-t border-white/5">
            <div class="space-y-3">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Stat 1 (Label & Value)</label>
                <div class="flex gap-4">
                    <input type="text" name="stat1_label" value="{{ $page->components_json['stat1_label'] ?? '' }}" placeholder="Years Evolution" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-sm">
                    <input type="text" name="stat1_value" value="{{ $page->components_json['stat1_value'] ?? '' }}" placeholder="10+" class="w-24 bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white font-black text-center text-sm">
                </div>
            </div>
            <div class="space-y-3">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Stat 2 (Label & Value)</label>
                <div class="flex gap-4">
                    <input type="text" name="stat2_label" value="{{ $page->components_json['stat2_label'] ?? '' }}" placeholder="Impact Units" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-sm">
                    <input type="text" name="stat2_value" value="{{ $page->components_json['stat2_value'] ?? '' }}" placeholder="1k+" class="w-24 bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white font-black text-center text-sm">
                </div>
            </div>
        </div>

        <div class="flex gap-4 pt-6">
            <button type="submit" class="px-10 py-5 bg-[#d4a574] text-black font-black rounded-2xl hover:scale-105 transition-all shadow-lg flex items-center gap-2 uppercase tracking-widest text-xs">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i> Update Profile Data
            </button>
            <a href="{{ route('admin.pages') }}" class="px-10 py-5 bg-white/5 border border-white/10 text-white font-black rounded-2xl hover:bg-white/10 transition-all uppercase tracking-widest text-xs">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
