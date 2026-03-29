@extends('layouts.admin')

@section('page_title', 'Products & Marketplace')

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
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Marketplace Products</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Total Products: {{ $products->total() }}</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-[#d4a574] text-black px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Product
        </a>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-300">
            <thead class="bg-white/5 text-gray-400 uppercase tracking-wider text-xs border-b border-white/10">
                <tr>
                    <th scope="col" class="px-6 py-5 font-bold">Product</th>
                    <th scope="col" class="px-6 py-5 font-bold">Category</th>
                    <th scope="col" class="px-6 py-5 font-bold">Type</th>
                    <th scope="col" class="px-6 py-5 font-bold">Price</th>
                    <th scope="col" class="px-6 py-5 font-bold">Status</th>
                    <th scope="col" class="px-6 py-5 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse($products as $product)
                <tr class="hover:bg-white/5 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 overflow-hidden shrink-0 flex items-center justify-center">
                                @if($product->thumbnail)
                                    <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="box" class="w-5 h-5 text-gray-500"></i>
                                @endif
                            </div>
                            <div>
                                <h5 class="text-white font-bold leading-tight line-clamp-1">{{ $product->title }}</h5>
                                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">ID: {{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-gray-400">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </td>
                    <td class="px-6 py-5">
                        @if($product->type === 'digital')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">
                                <i data-lucide="download-cloud" class="w-3.5 h-3.5"></i> Digital
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-500/10 text-purple-400 border border-purple-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">
                                <i data-lucide="package" class="w-3.5 h-3.5"></i> Physical
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="text-[#d4a574] font-bold text-base">${{ number_format($product->sale_price, 2) }}</span>
                                <span class="text-gray-500 line-through text-xs">${{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="text-white font-bold text-base">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @if($product->status === 'active')
                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">Active</span>
                        @elseif($product->status === 'draft')
                            <span class="px-3 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">Draft</span>
                        @else
                            <span class="px-3 py-1 bg-gray-500/10 text-gray-400 border border-gray-500/20 rounded-lg text-xs font-bold uppercase tracking-wider">{{ $product->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-end gap-2 opacity-50 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="w-10 h-10 rounded-xl glass-card border border-white/10 flex items-center justify-center hover:bg-[#d4a574] hover:text-black hover:border-transparent transition-all">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl glass-card border border-white/10 flex items-center justify-center hover:bg-rose-500 hover:text-white hover:border-transparent transition-all text-gray-500">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i data-lucide="package-open" class="w-12 h-12 mb-4 opacity-50"></i>
                            <p class="text-lg font-bold text-white mb-2">No Products Found</p>
                            <p class="text-sm">You haven't added any products to the marketplace yet.</p>
                            <a href="{{ route('admin.products.create') }}" class="mt-6 text-[#d4a574] hover:underline flex items-center gap-2 text-sm font-bold uppercase tracking-wide">
                                Add First Product <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-8 pt-6 border-t border-white/10">
        {{ $products->links('pagination::tailwind') }}
    </div>
    @endif
</div>
@endsection
