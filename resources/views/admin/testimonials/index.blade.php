@extends('layouts.admin')

@section('page_title', 'Client Testimonials')

@section('content')
<div class="glass-card p-8">
    @if(session('success'))
    <div class="mb-8 p-4 bg-emerald-400/10 border border-emerald-400/20 text-emerald-400 rounded-xl font-bold text-sm flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-center mb-10">
        <div>
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Reviews & Feedback</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Active testimonials: {{ count($testimonials) }}</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="bg-[#d4a574] text-black px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> New Testimonial
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($testimonials as $testimonial)
        <div class="p-8 rounded-[40px] border border-white/5 bg-gradient-to-br from-white/[0.02] to-transparent hover:border-[#d4a574]/30 transition-all flex flex-col justify-between">
            <div>
                <div class="flex gap-1 mb-6">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <i data-lucide="star" class="w-4 h-4 text-[#d4a574] fill-[#d4a574]"></i>
                    @endfor
                </div>
                <p class="text-gray-300 italic mb-8 leading-relaxed">"{{ $testimonial->content }}"</p>
            </div>
            
            <div class="flex items-center justify-between border-t border-white/5 pt-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden border border-[#d4a574]/30 bg-[#d4a574]/10 flex items-center justify-center text-[#d4a574] font-black relative">
                        {{ substr($testimonial->name, 0, 1) }}
                        @if(!$testimonial->is_active)
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-amber-500 rounded-full border-2 border-black animate-pulse"></div>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="text-white font-bold">{{ $testimonial->name }}</h4>
                            @if(!$testimonial->is_active)
                            <span class="text-[8px] font-black uppercase tracking-widest bg-amber-500/10 text-amber-500 px-2 py-0.5 rounded-full border border-amber-500/20">Pending</span>
                            @endif
                        </div>
                        <p class="text-gray-500 text-[10px] uppercase tracking-widest">{{ $testimonial->role }} @ {{ $testimonial->company }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    @if(!$testimonial->is_active)
                    <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-10 h-10 rounded-xl bg-amber-500 text-black flex items-center justify-center hover:scale-110 transition-transform" title="Approve Review">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="w-10 h-10 rounded-xl glass-card flex items-center justify-center hover:bg-white/10 transition-colors">
                        <i data-lucide="edit-2" class="w-4 h-4 text-gray-400"></i>
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Bhai, reviews delete nahi karne chahiye, magar kardu?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 rounded-xl glass-card flex items-center justify-center hover:bg-rose-500/10 transition-colors text-gray-600 hover:text-rose-500">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
