@extends('layouts.admin')

@section('page_title', 'Portfolio Management')

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
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Live Projects</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Database records: {{ count($portfolios) }}</p>
        </div>
        <a href="{{ route('admin.portfolios.create') }}" class="bg-[#d4a574] text-black px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Project
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @foreach($portfolios as $portfolio)
        <div class="flex items-center gap-8 p-6 rounded-3xl bg-white/[0.01] border border-white/5 hover:border-[#d4a574]/40 transition-all group">
            <div class="w-12 h-12 flex items-center justify-center font-black text-gray-600 text-xl">{{ $loop->iteration }}</div>
            
            <div class="w-32 h-20 rounded-2xl overflow-hidden border border-white/10 shrink-0">
                @php
                    $imagePath = 'storage/' . $portfolio->image_path;
                    $displayImage = (file_exists(public_path($imagePath)) && !empty($portfolio->image_path)) 
                                    ? asset($imagePath) 
                                    : asset('images/ha_tech_system_mockup.png');
                @endphp
                <img src="{{ $displayImage }}" class="w-full h-full object-cover">
            </div>

            <div class="flex-1">
                <h5 class="text-lg font-black uppercase tracking-tight group-hover:text-[#d4a574] transition-colors">{{ $portfolio->title }}</h5>
                <div class="flex gap-4 mt-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500 border-r border-white/10 pr-4">{{ $portfolio->category }}</span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500 border-r border-white/10 pr-4">{{ $portfolio->year }}</span>
                    @if($portfolio->is_featured)
                    <span class="text-[8px] font-black uppercase tracking-widest text-emerald-400 bg-emerald-400/10 px-2 py-0.5 rounded-full border border-emerald-400/20">Featured on Home</span>
                    @endif
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="w-12 h-12 rounded-2xl glass-card flex items-center justify-center hover:bg-white/10 transition-colors">
                    <i data-lucide="edit-3" class="w-5 h-5 text-indigo-400"></i>
                </a>
                <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Bhai, pakka delete karna hai?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-12 h-12 rounded-2xl glass-card flex items-center justify-center hover:bg-rose-500/10 transition-colors group/del">
                        <i data-lucide="trash-2" class="w-5 h-5 text-gray-500 group-hover/del:text-rose-500"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
