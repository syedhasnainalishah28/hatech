@extends('layouts.admin')

@section('page_title', 'Add New Project')

@section('content')
<div class="max-w-4xl">
    <div class="glass-card p-12">
        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Project Title</label>
                    <input type="text" name="title" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Slug (Unique URL)</label>
                    <input type="text" name="slug" placeholder="auto-generated-if-empty" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Category</label>
                    <input type="text" name="category" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Year</label>
                    <input type="text" name="year" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Case Study URL (Optional)</label>
                    <input type="url" name="case_study_url" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold" placeholder="https://...">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Short Description</label>
                <textarea name="description" required rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold"></textarea>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Case Study Content (HTML/Rich Text)</label>
                <textarea name="content" rows="10" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold" placeholder="Describe the challenge, solution, and results..."></textarea>
            </div>

            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_featured" id="is_featured" class="w-5 h-5 rounded border-white/10 bg-white/5 text-[#d4a574] focus:ring-[#d4a574]">
                    <label for="is_featured" class="text-xs font-bold uppercase tracking-widest text-gray-400 cursor-pointer">Feature on Homepage</label>
                </div>
                
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Project Image</label>
                <div class="relative group">
                    <input type="file" name="image" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full bg-white/5 border-2 border-dashed border-white/10 rounded-2xl p-12 text-center group-hover:border-[#d4a574]/40 transition-all">
                        <i data-lucide="upload-cloud" class="w-10 h-10 mx-auto mb-4 text-gray-500 group-hover:text-[#d4a574] transition-colors"></i>
                        <p class="text-sm font-bold text-gray-400 group-hover:text-white transition-colors">Click to upload or drag and drop</p>
                        <p class="text-[10px] uppercase tracking-widest text-gray-600 mt-2">PNG, JPG, WEBP (MAX 5MB)</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-[#d4a574] text-black px-10 py-4 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-transform">
                    Deploy Project
                </button>
                <a href="{{ route('admin.portfolios') }}" class="px-10 py-4 border border-white/10 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white/5 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
