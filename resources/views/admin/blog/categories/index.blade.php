@extends('layouts.admin')

@section('page_title', 'Blog Categories')

@section('content')
<div class="flex gap-8 p-8 h-full">
    <!-- Categories List -->
    <div class="w-2/3 flex flex-col h-full overflow-hidden glass-card">
        <div class="p-6 border-b border-white/5 flex justify-between items-center">
            <div>
                <h4 class="text-xl font-black uppercase tracking-tight mb-1">Active Categories</h4>
                <p class="text-xs text-gray-500 uppercase tracking-widest">Manage blog sections</p>
            </div>
            <div class="px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-xs font-bold text-gray-400">
                Total: {{ count($categories) }}
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto p-6">
            <div class="grid grid-cols-1 gap-4">
                @foreach($categories as $category)
                <div class="flex items-center gap-4 p-5 rounded-2xl bg-white/[0.01] border border-white/5 hover:border-[#d4a574]/30 transition-all group">
                    <div class="w-4 h-4 rounded-full border border-white/10" style="background-color: {{ $category->color ?? '#d4a574' }}"></div>
                    
                    <div class="flex-1">
                        <h5 class="text-base font-black text-white tracking-wide group-hover:text-[#d4a574] transition-colors">{{ $category->name }}</h5>
                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mt-1">/{{ $category->slug }}</p>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->slug) }}', '{{ $category->color }}')" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center text-indigo-400 transition-colors tooltip" title="Edit">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.blog.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Silencing this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-rose-500/10 flex items-center justify-center text-gray-500 hover:text-rose-500 transition-colors tooltip" title="Delete">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="p-4 border-t border-white/5">
            {{ $categories->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Create/Edit Form -->
    <div class="w-1/3 flex flex-col h-full bg-[#1a0f11]/80 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 bg-gradient-to-br from-[#d4a574]/10 to-transparent">
            <h4 id="form-title" class="text-xl font-black uppercase tracking-tight text-[#d4a574]">New Category</h4>
            <p id="form-subtitle" class="text-xs text-gray-500 uppercase tracking-widest mt-1">Add a new topic</p>
        </div>

        <div class="p-6 flex-1 overflow-y-auto">
            @if($errors->any())
            <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs font-bold">
                @foreach($errors->all() as $error)
                    <div>- {{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form id="categoryForm" action="{{ route('admin.blog.categories.store') }}" method="POST" class="space-y-5">
                @csrf
                <div id="method-container"></div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">Category Name *</label>
                    <input type="text" id="name" name="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-[#d4a574] transition-colors" placeholder="e.g. Artificial Intelligence" oninput="generateSlug(this.value)">
                </div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">URL Slug</label>
                    <input type="text" id="slug" name="slug" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 text-sm focus:outline-none focus:border-[#d4a574] transition-colors" placeholder="artificial-intelligence">
                    <p class="text-[9px] text-gray-600 uppercase tracking-widest mt-2">Auto-generated if left blank</p>
                </div>
                
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-[#d4a574] mb-2">Accent Color</label>
                    <div class="flex items-center gap-4 bg-white/5 border border-white/10 rounded-xl px-4 py-2 hover:border-[#d4a574]/30 transition-colors">
                        <input type="color" id="color" name="color" value="#d4a574" class="w-8 h-8 rounded cursor-pointer bg-transparent border-none p-0">
                        <span class="text-sm font-medium text-gray-400" id="color-hex">#d4a574</span>
                    </div>
                </div>

                <div class="pt-6 border-t border-white/5 flex gap-3">
                    <button type="submit" id="submit-btn" class="flex-1 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-[1.02] transition-transform shadow-xl shadow-[#d4a574]/20">
                        Save Category
                    </button>
                    <button type="button" id="cancel-btn" onclick="resetForm()" class="hidden px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-300 font-bold text-xs transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function generateSlug(text) {
        if(!document.getElementById('slug').dataset.edited) {
            const slug = text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            document.getElementById('slug').value = slug;
        }
    }
    
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.edited = true;
    });

    document.getElementById('color').addEventListener('input', function() {
        document.getElementById('color-hex').innerText = this.value;
    });

    function editCategory(id, name, slug, color) {
        document.getElementById('form-title').innerText = 'Edit Category';
        document.getElementById('form-subtitle').innerText = 'Updating: ' + name;
        
        document.getElementById('name').value = name;
        document.getElementById('slug').value = slug;
        document.getElementById('slug').dataset.edited = true;
        
        if(color) {
            document.getElementById('color').value = color;
            document.getElementById('color-hex').innerText = color;
        }

        const form = document.getElementById('categoryForm');
        form.action = `/admin/blog/categories/${id}`;
        
        document.getElementById('method-container').innerHTML = '@method("POST")';
        document.getElementById('submit-btn').innerText = 'UPDATE CATEGORY';
        document.getElementById('cancel-btn').classList.remove('hidden');
    }

    function resetForm() {
        document.getElementById('form-title').innerText = 'New Category';
        document.getElementById('form-subtitle').innerText = 'Add a new topic';
        
        const form = document.getElementById('categoryForm');
        form.reset();
        form.action = "{{ route('admin.blog.categories.store') }}";
        
        document.getElementById('method-container').innerHTML = '';
        document.getElementById('submit-btn').innerText = 'SAVE CATEGORY';
        document.getElementById('cancel-btn').classList.add('hidden');
        document.getElementById('slug').dataset.edited = '';
        document.getElementById('color-hex').innerText = '#d4a574';
    }
</script>
@endsection
