@extends('layouts.admin')

@section('page_title', 'Create SEO Article')

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
            min-height: 400px;
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
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1 cursor-pointer text-[#d4a574]">New Blog Post</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Publish content designed for growth</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.blog.posts') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 font-bold text-xs transition-colors flex items-center gap-2">
                <i data-lucide="x" class="w-4 h-4"></i> Cancel
            </a>
            <button type="button" onclick="document.getElementById('savePost').submit()" class="bg-gradient-to-r from-emerald-500 to-teal-400 text-white px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-105 transition-transform flex items-center gap-2 shadow-xl shadow-emerald-500/20">
                <i data-lucide="check" class="w-4 h-4"></i> Save & Next
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

    <form id="savePost" action="{{ route('admin.blog.posts.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-8">
        @csrf
        
        <!-- Left Column: Content Editor -->
        <div class="w-2/3 flex flex-col gap-6">
            
            <div class="glass-card p-6 border border-white/10 rounded-3xl">
                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-white mb-2">Headline (H1) *</label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}" class="w-full bg-[#0a0506] border border-white/10 rounded-xl px-4 py-4 text-white text-xl font-bold focus:outline-none focus:border-[#d4a574] transition-colors" placeholder="e.g. 10 Reasons to Embrace Generative AI">
                </div>
                
                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">URL Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full bg-[#0a0506]/50 border border-white/10 rounded-xl px-4 py-3 text-gray-400 text-sm focus:outline-none focus:border-[#d4a574] transition-colors" placeholder="10-reasons-to-embrace-generative-ai">
                </div>

                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">Short Excerpt</label>
                    <textarea name="excerpt" rows="3" class="w-full bg-[#0a0506]/50 border border-white/10 rounded-xl px-4 py-3 text-gray-300 text-sm focus:outline-none focus:border-[#d4a574] transition-colors placeholder:text-gray-600" placeholder="A brief summary for category grids and index screens.">{{ old('excerpt') }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2 flex justify-between items-center">
                        HTML Body *
                        <span class="text-[8px] text-gray-500 font-normal normal-case tracking-normal">Quill Premium Editor Powered</span>
                    </label>
                    <div id="editor-container" class="bg-[#0a0506] border border-white/10 rounded-xl overflow-hidden">
                        <div id="editor" style="height: 400px;">{!! old('body') !!}</div>
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
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors placeholder:text-gray-600" placeholder="Leave blank to use main Title">
                        <p class="text-[9px] text-gray-500 mt-1">Optimal length: 50-60 chars.</p>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors placeholder:text-gray-600" placeholder="Action-driven snippet for Google search results...">{{ old('meta_description') }}</textarea>
                        <p class="text-[9px] text-gray-500 mt-1">Optimal length: 150-160 chars.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Focus Keyword</label>
                            <input type="text" name="focus_keyword" value="{{ old('focus_keyword') }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors" placeholder="e.g. AI Agency">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 mb-2">Canonical URL</label>
                            <input type="url" name="canonical_url" value="{{ old('canonical_url') }}" class="w-full bg-black/40 border border-indigo-500/30 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-indigo-400 transition-colors" placeholder="https://external-source.com/original-article">
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
                                <option value="draft" @selected(old('status') == 'draft')>📌 Save as Draft</option>
                                <option value="published" @selected(old('status') == 'published')>🌍 Publish Immediately</option>
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
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Read Time Estimate (Mins)</label>
                        <input type="number" min="1" name="read_time" value="{{ old('read_time', 5) }}" class="w-full bg-[#0a0506] border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-[#d4a574] transition-colors text-center font-bold">
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 border border-white/10 rounded-3xl">
                <h4 class="text-sm font-black uppercase tracking-widest text-white mb-6 border-b border-white/10 pb-4">Cover Image</h4>
                
                <div class="w-full h-48 rounded-xl border-2 border-dashed border-white/20 bg-white/5 flex flex-col items-center justify-center hover:bg-white/10 hover:border-[#d4a574]/50 transition-all cursor-pointer relative overflow-hidden group">
                    <input type="file" name="thumbnail" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="fileUpload">
                    
                    <div class="text-center z-0 pointer-events-none flex flex-col items-center gap-2 group-hover:-translate-y-2 transition-transform" id="uploadState">
                        <i data-lucide="upload-cloud" class="w-8 h-8 text-[#d4a574]"></i>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Upload Featured Image</span>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
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
            ]
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
                <i data-lucide="image" class="w-8 h-8 text-emerald-400"></i>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-400">Selected: ${e.target.files[0].name}</span>
            `;
            lucide.createIcons();
        }
    });
</script>
@endpush
@endsection
