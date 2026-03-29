@extends('layouts.admin')

@section('page_title', 'Edit Email Template')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.email_templates') }}" class="text-[#d4a574] text-xs font-black uppercase tracking-widest hover:underline flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Templates
        </a>
    </div>

    <form action="{{ route('admin.email_templates.update', $template->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <div class="glass-card p-10">
            <h2 class="text-xl font-black text-white uppercase tracking-tight mb-8 border-b border-white/5 pb-4">Template Identity</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Internal Template Name</label>
                    <input type="text" name="template_name" value="{{ old('template_name', $template->template_name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-medium">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Email Subject Line</label>
                    <input type="text" name="subject" value="{{ old('subject', $template->subject) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-medium">
                </div>
            </div>
        </div>

        <div class="glass-card p-10">
            <h2 class="text-xl font-black text-white uppercase tracking-tight mb-8 border-b border-white/5 pb-4">Branding & Layout</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Brand Name</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name', $template->brand_name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-medium">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Brand Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $template->tagline) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-medium">
                </div>
            </div>

            <div class="space-y-6">
                @if($template->logo_path)
                <div class="w-24 h-24 rounded-2xl bg-white/5 border border-white/10 p-4">
                    <img src="{{ asset('storage/' . $template->logo_path) }}" class="w-full h-full object-contain">
                </div>
                @endif
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Update Logo (Leave empty to keep current)</label>
                    <input type="file" name="logo" 
                        class="block w-full text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#d4a574] file:text-[#0a0506] hover:file:bg-[#e8b44a] transition-all cursor-pointer">
                </div>
            </div>
        </div>

        <div class="glass-card p-10">
            <h2 class="text-xl font-black text-white uppercase tracking-tight mb-8 border-b border-white/5 pb-4">Base Content Structure</h2>
            <p class="text-[10px] text-amber-500 font-bold uppercase tracking-widest mb-4">You can use {name} and {email} as placeholders in the content.</p>
            
            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Main Body Text</label>
                <textarea name="content" rows="10" required
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white leading-relaxed font-medium"
                    placeholder="Write your email body here...">{{ old('content', $template->content) }}</textarea>
            </div>
        </div>

        <div class="glass-card p-10">
            <h2 class="text-xl font-black text-white uppercase tracking-tight mb-8 border-b border-white/5 pb-4">Footer Contact Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Phone</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $template->contact_phone) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-white text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $template->contact_email) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-white text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Website</label>
                    <input type="text" name="website_url" value="{{ old('website_url', $template->website_url) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 outline-none focus:border-[#d4a574] transition-all text-white text-sm">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit" class="px-12 py-5 bg-[#d4a574] text-[#0a0506] font-black rounded-2xl hover:scale-[1.02] transition-all shadow-xl shadow-[#d4a574]/20 uppercase tracking-widest text-sm">
                Update Template
            </button>
        </div>
    </form>
</div>
@endsection
