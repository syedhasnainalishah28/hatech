@extends('frontend.user.layout')

@section('title', 'Digital Downloads')
@section('subtitle', 'Access your purchased digital products and assets')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @if($downloads->count() > 0)
        @foreach($downloads as $item)
            @php $product = $item->product; @endphp
            @if($product)
            <div class="glass-card rounded-2xl overflow-hidden border border-white/10 group flex flex-col h-full">
                <!-- Thumbnail -->
                <div class="relative w-full pb-[60%] bg-[#0a0506] overflow-hidden">
                    @if($product->thumbnail)
                        <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-white/5">
                            <i data-lucide="image" class="w-12 h-12 text-gray-600"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] to-transparent opacity-80"></div>
                    
                    <!-- Category Badge -->
                    @if($product->category)
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-black/60 backdrop-blur-md rounded-full text-xs font-semibold text-[#d4a574] border border-[#d4a574]/20">
                                {{ $product->category->name }}
                            </span>
                        </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold text-white mb-2 line-clamp-1" title="{{ $product->title }}">{{ $product->title }}</h3>
                    <p class="text-gray-400 text-sm line-clamp-2 mb-6 flex-1">
                        {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}
                    </p>
                    
                    <!-- Action Details -->
                    <div class="pt-4 border-t border-white/10 flex items-center justify-between mt-auto">
                        <div class="text-xs text-gray-500">
                            Purchased: {{ $item->created_at->format('M d, Y') }}
                        </div>
                        <a href="{{ $product->file_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#d4a574]/20 to-[#e8b44a]/20 border border-[#d4a574]/30 flex items-center justify-center text-[#d4a574] hover:bg-[#d4a574] hover:text-[#2b0e14] transition-all group/btn" title="Download Asset">
                            <i data-lucide="download" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @else
        <div class="col-span-1 md:col-span-2 xl:col-span-3 glass-card rounded-2xl p-16 text-center border border-white/10 text-gray-400">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 ring-1 ring-white/10">
                <i data-lucide="folder-open" class="w-10 h-10 opacity-50"></i>
            </div>
            <h3 class="text-xl font-display font-bold text-white mb-2">No Digital Assets Yet</h3>
            <p class="mb-8 max-w-md mx-auto text-sm">You don't have any digital downloads available. Digital products you purchase from our marketplace will appear here.</p>
            <a href="{{ url('/marketplace') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-[0_0_15px_rgba(212,165,116,0.2)]">
                Browse Digital Products <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    @endif
</div>
@endsection
