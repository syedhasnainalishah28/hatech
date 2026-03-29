@extends('layouts.admin')

@section('page_title', 'Edit Project')

@section('content')
<div class="max-w-4xl">
    <div class="glass-card p-12">
        <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Project Title</label>
                    <input type="text" name="title" value="{{ $portfolio->title }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Slug (Unique URL)</label>
                    <input type="text" name="slug" value="{{ $portfolio->slug }}" placeholder="auto-generated-if-empty" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Category</label>
                    <input type="text" name="category" value="{{ $portfolio->category }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Year</label>
                    <input type="text" name="year" value="{{ $portfolio->year }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Short Description</label>
                <textarea name="description" required rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">{{ $portfolio->description }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Case Study Content (HTML/Rich Text)</label>
                <textarea name="content" rows="10" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold" placeholder="Describe the challenge, solution, and results...">{{ $portfolio->content }}</textarea>
            </div>

            <div class="space-y-4 pt-4 border-t border-white/5">
                <div class="flex items-center gap-3 mb-6">
                    <input type="checkbox" name="is_featured" id="is_featured" {{ $portfolio->is_featured ? 'checked' : '' }} class="w-5 h-5 rounded border-white/10 bg-white/5 text-[#d4a574] focus:ring-[#d4a574]">
                    <label for="is_featured" class="text-xs font-bold uppercase tracking-widest text-gray-400 cursor-pointer">Feature on Homepage</label>
                </div>

                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Current Image</label>
                <div class="w-48 h-32 rounded-2xl overflow-hidden border border-white/10 shadow-2xl">
                    @php
                        $imagePath = 'storage/' . $portfolio->image_path;
                        $displayImage = (file_exists(public_path($imagePath)) && !empty($portfolio->image_path)) 
                                        ? asset($imagePath) 
                                        : asset('images/ha_tech_system_mockup.png');
                    @endphp
                    <img src="{{ $displayImage }}" class="w-full h-full object-cover">
                </div>
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Change Image (Optional)</label>
                    <div class="relative group">
                        <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full bg-white/5 border-2 border-dashed border-white/10 rounded-2xl p-8 text-center group-hover:border-[#d4a574]/40 transition-all">
                            <p class="text-sm font-bold text-gray-500 group-hover:text-white transition-colors">Select new image...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-[#d4a574] text-black px-10 py-4 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-transform">
                    Update Project
                </button>
                <a href="{{ route('admin.portfolios') }}" class="px-10 py-4 border border-white/10 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white/5 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
