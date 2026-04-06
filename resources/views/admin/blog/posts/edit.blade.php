@extends('layouts.admin')

@section('page_title', 'Edit SEO Article')

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border-color: rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            border-radius: 1rem 1rem 0 0;
        }
        .ql-container.ql-snow {
            border-color: rgba(255,255,255,0.1);
            background: rgba(10,5,6,0.5);
            border-radius: 0 0 1rem 1rem;
            min-height: 600px;
            font-size: 16px;
            color: #fff;
        }
        .ql-editor.ql-blank::before { color: rgba(255,255,255,0.2) !important; }
    </style>
@endpush

@section('content')
<div class="glass-card p-8 min-h-full">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1 cursor-pointer text-[#d4a574]">Edit Post</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">{{ $post->title }}</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.blog.posts') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 font-bold text-xs transition-colors flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back
            </a>
            <button type="submit" form="savePost" class="bg-gradient-to-r from-emerald-500 to-teal-400 text-white px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-105 transition-transform flex items-center gap-2 shadow-xl shadow-emerald-500/20">
                <i data-lucide="check" class="w-4 h-4"></i> Update Post
            </button>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs font-bold">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="savePost" action="{{ route('admin.blog.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="flex gap-8">
        @csrf
        
        <!-- Left Column: Content Editor -->
        <div class="w-2/3 flex flex-col gap-6">
            
            <div class="glass-card p-6 border border-white/10 rounded-3xl">
                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-white mb-2">Headline (H1) *</label>
                    <input type="text" name="title" id="title" required value="{{ old('title', $post->title) }}" class="w-full bg-[#0a0506] border border-white/10 rounded-xl px-4 py-4 text-white text-xl font-bold focus:outline-none focus:border-[#d4a574] transition-colors">
                </div>
                
                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">URL Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" class="w-full bg-[#0a0506]/50 border border-white/10 rounded-xl px-4 py-3 text-gray-400 text-sm focus:outline-none focus:border-[#d4a574] transition-colors">
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">Short Excerpt</label>
                    <textarea name="excerpt" rows="3" class="w-full bg-[#0a0506]/50 border border-white/10 rounded-xl px-4 py-3 text-gray-300 text-sm focus:outline-none focus:border-[#d4a574] transition-colors">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2 flex justify-between items-center">
                        HTML Body *
                        <span class="text-[8px] text-gray-500 font-normal normal-case tracking-normal">Quill Premium Editor Powered</span>
                    </label>
                    <div id="editor-container" class="bg-[#0a0506] border border-white/10 rounded-xl overflow-hidden">
                        <div id="editor" style="height: 600px;">{!! old('body', $post->body) !!}</div>
                    </div>
                    <input type="hidden" name="body" id="body-input">
                </div>
            </div>

            <div class="glass-card p-6 border border-indigo-500/20 rounded-3xl bg-indigo-500/5 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl point-events-none"></div>
                <h4 class="text-lg font-black uppercase tracking-tight text-white mb-6 flex items-center gap-2">
                    <i data-lucide="search" class="w-5 h-5 text-indigo-400"></i> Technical SEO Data
                </h4>
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors" placeholder="Leave blank to use main Title">
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors placeholder:text-gray-600">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Focus Keyword</label>
                            <input type="text" name="focus_keyword" value="{{ old('focus_keyword', $post->focus_keyword) }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Canonical URL</label>
                            <input type="url" name="canonical_url" value="{{ old('canonical_url', $post->canonical_url) }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Settings Tab -->
        <div class="w-1/3 flex flex-col gap-6">
            
            <div class="glass-card p-6 border border-white/10 rounded-3xl">
                <h4 class="text-sm font-black uppercase tracking-widest text-white mb-6 border-b border-white/10 pb-4">Publishing Attributes</h4>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Status *</label>
                        <div class="relative">
                            <select name="status" class="w-full bg-[#0a0506] border border-white/10 rounded-xl px-4 py-3 appearance-none text-white focus:outline-none focus:border-[#d4a574] transition-colors cursor-pointer font-bold">
                                <option value="draft" @selected(old('status', $post->status) == 'draft')>📌 Draft Mode</option>
                                <option value="published" @selected(old('status', $post->status) == 'published')>🌍 Published</option>
                            </select>
                            <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Category</label>
                        <div class="relative">
                            <select name="category_id" class="w-full bg-[#0a0506] border border-white/10 rounded-xl px-4 py-3 appearance-none text-white focus:outline-none focus:border-[#d4a574] transition-colors cursor-pointer">
                                <option value="">No Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Read Time Estimate (Mins)</label>
                        <input type="number" min="1" name="read_time" value="{{ old('read_time', $post->read_time ?? 5) }}" class="w-full bg-[#0a0506] border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-[#d4a574] transition-colors text-center font-bold">
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 border border-white/10 rounded-3xl">
                <h4 class="text-sm font-black uppercase tracking-widest text-white mb-6 border-b border-white/10 pb-4">Cover Image</h4>
                
                @if($post->thumbnail && file_exists(public_path('storage/' . $post->thumbnail)))
                <div class="w-full h-48 rounded-xl overflow-hidden mb-4 relative group border border-white/10 shadow-xl">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white bg-white/10 px-4 py-2 rounded-full border border-white/20">Current Cover</span>
                    </div>
                </div>
                @endif
                
                <div class="w-full h-32 rounded-xl border-2 border-dashed border-white/20 bg-white/5 flex flex-col items-center justify-center hover:bg-white/10 hover:border-[#d4a574]/50 transition-all cursor-pointer relative overflow-hidden group">
                    <input type="file" name="thumbnail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="fileUpload">
                    
                    <div class="text-center z-0 pointer-events-none flex flex-col items-center gap-2 group-hover:-translate-y-2 transition-transform" id="uploadState">
                        <i data-lucide="upload-cloud" class="w-6 h-6 text-[#d4a574]"></i>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Replace/Upload Image</span>
                    </div>
                </div>
            </div>

            <!-- OJS Sidebar Controls -->
            <div class="glass-card p-6 border border-amber-500/20 rounded-3xl bg-amber-500/5">
                <h4 class="text-sm font-black uppercase tracking-widest text-amber-400 mb-6 border-b border-amber-500/10 pb-4 flex items-center gap-2">
                    <i data-lucide="layout-columns" class="w-4 h-4"></i> OJS Layout Engine
                </h4>
                
                <div class="space-y-8">
                    <!-- Left Sidebar -->
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-white">Left Sidebar</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="sidebar_left_show" value="1" @checked($post->sidebar_left_show) class="sr-only peer">
                                <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-300 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                            </label>
                        </div>
                        <div class="space-y-4">
                            <select name="sidebar_left_type" onchange="toggleSidebarContent('left', this.value)" class="w-full bg-black/60 border border-white/10 rounded-xl px-4 py-2 text-xs text-gray-300 focus:outline-none">
                                <option value="standard" @selected($post->sidebar_left_type == 'standard')>Standard (Author & Info)</option>
                                <option value="custom" @selected($post->sidebar_left_type == 'custom')>Custom (Image/HTML)</option>
                            </select>
                            <textarea id="left-content-area" name="sidebar_left_content" rows="3" class="{{ $post->sidebar_left_type == 'custom' ? '' : 'hidden' }} w-full bg-black/80 border border-white/10 rounded-xl px-4 py-3 text-xs text-gray-400 focus:outline-none" placeholder="Paste Small Image URL or Custom Links HTML...">{{ $post->sidebar_left_content }}</textarea>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black uppercase tracking-widest text-white">Right Sidebar</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="sidebar_right_show" value="1" @checked($post->sidebar_right_show) class="sr-only peer">
                                <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-300 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                            </label>
                        </div>
                        <div class="space-y-4">
                            <select name="sidebar_right_type" onchange="toggleSidebarContent('right', this.value)" class="w-full bg-black/60 border border-white/10 rounded-xl px-4 py-2 text-xs text-gray-300 focus:outline-none">
                                <option value="standard" @selected($post->sidebar_right_type == 'standard')>Standard (Share & Related)</option>
                                <option value="custom" @selected($post->sidebar_right_type == 'custom')>Custom (Buttons/Ad)</option>
                            </select>
                            <textarea id="right-content-area" name="sidebar_right_content" rows="3" class="{{ $post->sidebar_right_type == 'custom' ? '' : 'hidden' }} w-full bg-black/80 border border-white/10 rounded-xl px-4 py-3 text-xs text-gray-400 focus:outline-none" placeholder="Paste custom buttons or widget code...">{{ $post->sidebar_right_content }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Essential for Image Resize Module to find Quill
    window.Quill = Quill;
</script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
    // Register Image Resize Module safely
    try {
        if (typeof ImageResize !== 'undefined') {
            Quill.register('modules/imageResize', ImageResize.default || ImageResize);
        }
    } catch (e) {
        console.error("Quill Image Resize failed to load:", e);
    }

    // Initialize Quill
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ],
            imageResize: {
                displaySize: true
            }
        }
    });

    // Handle Form Submit
    var form = document.getElementById('savePost');
    form.onsubmit = function() {
        // Populate hidden input on submit
        var body = document.querySelector('input[id=body-input]');
        body.value = quill.root.innerHTML;
        return true;
    };

    // Title to slug generation
    document.getElementById('title').addEventListener('input', function() {
        if(!document.getElementById('slug').dataset.edited) {
            const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            document.getElementById('slug').value = slug;
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.edited = true;
    });

    // File name update dummy
    document.getElementById('fileUpload').addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            document.getElementById('uploadState').innerHTML = `
                <i data-lucide="image" class="w-6 h-6 text-emerald-400"></i>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400">Selected: ${e.target.files[0].name}</span>
            `;
            lucide.createIcons();
        }
    });
    function toggleSidebarContent(side, value) {
        const area = document.getElementById(`${side}-content-area`);
        if(value === 'custom') {
            area.classList.remove('hidden');
        } else {
            area.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection
