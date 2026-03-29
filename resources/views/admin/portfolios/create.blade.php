@extends('layouts.admin')

@section('page_title', 'Add New Project')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow { border: 1px solid rgba(255,255,255,0.1) !important; background: rgba(255,255,255,0.02); border-radius: 12px 12px 0 0; }
    .ql-container.ql-snow { border: 1px solid rgba(255,255,255,0.1) !important; background: rgba(255,255,255,0.02); border-radius: 0 0 12px 12px; height: 300px; color: white; }
    .ql-editor { font-family: 'Inter', sans-serif; font-size: 14px; line-height: 1.6; }
    .ql-snow .ql-stroke { stroke: #d4a574 !important; }
    .ql-snow .ql-fill { fill: #d4a574 !important; }
    .ql-snow .ql-picker { color: #d4a574 !important; }
</style>
@endpush

@section('content')
<div class="max-w-5xl">
    <div class="glass-card p-12">
        <form id="portfolio-form" action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            
            <!-- Basic Info Section -->
            <div class="space-y-8">
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

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Short Summary</label>
                    <textarea name="description" required rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 focus:border-[#d4a574] outline-none transition-all font-bold"></textarea>
                </div>
            </div>

            <!-- Modular Layout System -->
            <div class="space-y-6 pt-10 border-t border-white/5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex flex-col">
                        <h3 class="text-sm font-black uppercase tracking-widest text-white">Case Study Builder</h3>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mt-1">Add repeatable split-layout blocks</p>
                    </div>
                    <button type="button" onclick="addSection()" class="bg-[#d4a574]/10 text-[#d4a574] hover:bg-[#d4a574] hover:text-black px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-[#d4a574]/30">
                        + New Block
                    </button>
                </div>
                
                <div id="sections-container" class="space-y-12">
                    <!-- Initially empty or add one default -->
                </div>
            </div>

            <!-- Hidden Template -->
            <template id="section-template">
                @include('admin.portfolios._section_form', ['index' => 'IDX_PLACEHOLDER', 'section' => []])
            </template>


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

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    let sectionCount = 0;

    function initQuill(container) {
        const quill = new Quill(container, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'clean']
                ]
            }
        });

        const hiddenInput = container.parentElement.querySelector('.quill-content');
        quill.on('text-change', function() {
            hiddenInput.value = quill.root.innerHTML;
        });
    }

    function addSection() {
        const template = document.getElementById('section-template').innerHTML;
        const newSectionHtml = template.replace(/IDX_PLACEHOLDER/g, sectionCount);
        
        const container = document.getElementById('sections-container');
        const div = document.createElement('div');
        div.innerHTML = newSectionHtml;
        const newElement = div.firstElementChild;
        
        container.appendChild(newElement);
        initQuill(newElement.querySelector('.quill-editor'));
        
        if(window.lucide) {
            lucide.createIcons();
        }
        
        sectionCount++;
    }

    function removeSection(btn) {
        if(confirm('Remove this section?')) {
            btn.closest('.section-block').remove();
        }
    }

    function toggleLayout(btn, pos) {
        const block = btn.closest('.section-block');
        const input = block.querySelector('.layout-input');
        const toggles = block.querySelectorAll('.layout-toggle');
        
        toggles.forEach(t => t.classList.remove('bg-[#d4a574]', 'text-black'));
        toggles.forEach(t => t.classList.add('text-gray-500'));
        
        btn.classList.remove('text-gray-500');
        btn.classList.add('bg-[#d4a574]', 'text-black');
        
        input.value = 'media-' + pos;
    }

    function updateMediaFields(select) {
        const block = select.closest('.section-block');
        const type = select.value;
        const fields = block.querySelectorAll('.media-field');
        
        fields.forEach(f => {
            if(f.dataset.type === type) {
                f.style.display = 'block';
            } else {
                f.style.display = 'none';
            }
        });
    }

    // Add one default section on load
    window.onload = function() {
        addSection();
    };

    // Ensure Quill data is synced before submission
    document.getElementById('portfolio-form').onsubmit = function() {
        document.querySelectorAll('.quill-editor').forEach(editor => {
            const quill = Quill.find(editor);
            if(quill) {
                const hiddenInput = editor.parentElement.querySelector('.quill-content');
                hiddenInput.value = quill.root.innerHTML;
            }
        });
        return true;
    };
</script>
@endpush
