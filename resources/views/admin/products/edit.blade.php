@extends('layouts.admin')

@section('page_title', 'Edit Product')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products') }}" class="w-10 h-10 rounded-xl glass-card flex items-center justify-center hover:bg-white/10 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Edit Product</h4>
                <p class="text-xs text-gray-500 uppercase tracking-widest">{{ $product->title }}</p>
            </div>
        </div>
        
        <a href="{{ route('home') }}/products" target="_blank" class="px-6 py-3 border border-white/10 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-white/5 transition-all flex items-center gap-2">
            <i data-lucide="external-link" class="w-4 h-4"></i> View Public
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-sm">
        <div class="flex items-center gap-2 mb-2 font-bold">
            <i data-lucide="alert-circle" class="w-4 h-4"></i> Please fix the errors below
        </div>
        <ul class="list-disc list-inside ml-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="glass-card p-12 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-gradient-to-br from-[#d4a574]/10 to-transparent rounded-full blur-3xl pointer-events-none"></div>
        
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Basic Info -->
                <div class="space-y-6">
                    <h5 class="text-white font-bold uppercase tracking-widest text-xs border-b border-white/10 pb-4 mb-6 flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4 text-[#d4a574]"></i> Basic Details
                    </h5>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Product Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">URL Slug <span class="text-rose-500">*</span></label>
                        <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold text-gray-400">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Product Type <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="type" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold appearance-none text-white">
                                    <option value="digital" class="bg-[#0a0506]" {{ old('type', $product->type) == 'digital' ? 'selected' : '' }}>Digital Download</option>
                                    <option value="physical" class="bg-[#0a0506]" {{ old('type', $product->type) == 'physical' ? 'selected' : '' }}>Physical Item</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Status <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <select name="status" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold appearance-none text-white">
                                    <option value="active" class="bg-[#0a0506]" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active (Public)</option>
                                    <option value="draft" class="bg-[#0a0506]" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                    <option value="archived" class="bg-[#0a0506]" {{ old('status', $product->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Category</label>
                        <div class="relative">
                            <select name="category_id" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold appearance-none text-white">
                                <option value="" class="bg-[#0a0506]">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" class="bg-[#0a0506]" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>
                </div>

                <!-- Media & Pricing -->
                <div class="space-y-6">
                    <h5 class="text-white font-bold uppercase tracking-widest text-xs border-b border-white/10 pb-4 mb-6 flex items-center gap-2">
                        <i data-lucide="tag" class="w-4 h-4 text-[#d4a574]"></i> Pricing & Media
                    </h5>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Regular Price ($) <span class="text-rose-500">*</span></label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold placeholder-gray-600" placeholder="0.00">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Sale Price ($)</label>
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold placeholder-gray-600" placeholder="Optional">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Thumbnail Image</label>
                        @if($product->thumbnail)
                            <div class="mb-3 w-32 h-32 rounded-xl border border-white/10 overflow-hidden bg-white/5">
                                <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-4 file:px-6 file:rounded-xl file:border-0 file:bg-white/5 file:text-white file:font-bold hover:file:bg-[#d4a574] hover:file:text-black transition-all cursor-pointer">
                        </div>
                        <p class="text-[10px] text-gray-500 mt-1">Leave blank to keep current thumbnail. Max 2MB.</p>
                    </div>

                    <div class="space-y-2 p-6 rounded-2xl border border-cyan-500/20 bg-cyan-500/5">
                        <div class="flex items-center gap-2 mb-2">
                            <i data-lucide="download-cloud" class="w-4 h-4 text-cyan-400"></i>
                            <label class="text-[10px] font-black uppercase tracking-widest text-cyan-400">Digital Product File</label>
                        </div>
                        @if($product->file_url && $product->type === 'digital')
                            <div class="mb-4 flex items-center gap-3 bg-black/40 p-3 rounded-lg border border-white/5">
                                <i data-lucide="file-check" class="w-5 h-5 text-emerald-400"></i>
                                <div>
                                    <p class="text-xs font-bold text-white">File Uploaded</p>
                                    <p class="text-[10px] text-gray-400 truncate max-w-[200px]">{{ basename($product->file_url) }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-[10px] text-gray-400 mb-4">If this is a digital product, upload the asset (.zip, .pdf, .fig).</p>
                        @endif
                        <div class="relative">
                            <input type="file" name="file" class="w-full text-sm text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:bg-cyan-500/10 file:text-cyan-400 file:font-bold hover:file:bg-cyan-500 hover:file:text-black transition-all cursor-pointer">
                        </div>
                        <p class="text-[10px] text-gray-500 mt-2">Leave blank to keep existing file. Max 50MB.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-2 pt-6 border-t border-white/10">
                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Product Description <span class="text-rose-500">*</span></label>
                <textarea name="description" required rows="6" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold placeholder-gray-600">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-white/10">
                <button type="submit" class="bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-black px-10 py-4 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-all shadow-[0_0_20px_rgba(212,165,116,0.2)] flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Save Changes
                </button>
                <a href="{{ route('admin.products') }}" class="px-10 py-4 border border-white/10 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:bg-white/5 transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
