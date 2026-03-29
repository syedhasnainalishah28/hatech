@extends('layouts.admin')

@section('page_title', 'Edit Testimonial')

@section('content')
<div class="max-w-4xl">
    <div class="glass-card p-12">
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Client Name</label>
                    <input type="text" name="name" value="{{ $testimonial->name }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Rating</label>
                    <select name="rating" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold appearance-none">
                        <option value="5" {{ $testimonial->rating == 5 ? 'selected' : '' }}>5 Stars (Elite)</option>
                        <option value="4" {{ $testimonial->rating == 4 ? 'selected' : '' }}>4 Stars (Premium)</option>
                        <option value="3" {{ $testimonial->rating == 3 ? 'selected' : '' }}>3 Stars (Standard)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Role</label>
                    <input type="text" name="role" value="{{ $testimonial->role }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Company</label>
                    <input type="text" name="company" value="{{ $testimonial->company }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Feedback Content</label>
                <textarea name="content" required rows="6" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">{{ $testimonial->content }}</textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-[#d4a574] text-black px-10 py-4 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-transform">
                    Update Testimonial
                </button>
                <a href="{{ route('admin.testimonials') }}" class="px-10 py-4 border border-white/10 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white/5 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
