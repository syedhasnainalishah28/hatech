@extends('layouts.admin')

@section('page_title', 'Edit Team Member')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow { border-color: rgba(255,255,255,0.1); background: rgba(10,5,6,0.3); border-radius: 1rem 1rem 0 0; }
    .ql-container.ql-snow { border-color: rgba(255,255,255,0.1); background: rgba(10,5,6,0.5); border-radius: 0 0 1rem 1rem; min-height: 300px; font-size: 16px; color: #fff; }
</style>
@endpush

@section('content')
<div class="glass-card p-8 max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Edit Authority Profile</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">{{ $member->name }}</p>
        </div>
        <a href="{{ route('admin.team') }}" class="text-gray-400 hover:text-[#d4a574] transition-colors flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back
        </a>
    </div>

    @if($errors->any())
    <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 rounded-xl">
        <div class="flex items-center gap-3 text-rose-400 font-bold mb-2 text-sm">
            <i data-lucide="alert-triangle" class="w-4 h-4"></i> Please fix the errors below
        </div>
        <ul class="list-disc list-inside text-rose-400/80 text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Full Name *</label>
                <input type="text" name="name" id="name_input" value="{{ old('name', $member->name) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">SEO Slug <span class="text-gray-500 lowercase">(auto-generated if blank)</span></label>
                <input type="text" name="slug" id="slug_input" value="{{ old('slug', $member->slug) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Role / Job Title *</label>
                <input type="text" name="role" value="{{ old('role', $member->role) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>
            
            <!-- Sort Order -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Order Index *</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>
        </div>

        <!-- Detailed Biography (Quill) -->
        <div class="mt-6">
            <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Detailed Biography (Quill Editor) *</label>
            <div id="editor-container" class="bg-[#0a0506] border border-white/10 rounded-xl overflow-hidden">
                <div id="editor" style="height: 300px;">{!! old('bio', $member->bio) !!}</div>
            </div>
            <input type="hidden" name="bio" id="bio-input">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Expertise -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Expertise <span class="text-gray-500 lowercase">(comma separated)</span></label>
                <textarea name="expertise" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">{{ old('expertise', $member->expertise) }}</textarea>
            </div>

            <!-- Achievements -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Key Achievements</label>
                <textarea name="achievements" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">{{ old('achievements', $member->achievements) }}</textarea>
            </div>
        </div>

        <div class="border-t border-white/5 pt-8 mt-8">
            <div class="flex items-center gap-3 mb-6">
                <i data-lucide="share-2" class="w-5 h-5 text-[#d4a574]"></i>
                <h4 class="text-xl font-black uppercase tracking-tight">Social Presence</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">LinkedIn</label>
                    <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" placeholder="URL" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Twitter/X</label>
                    <input type="text" name="twitter_url" value="{{ old('twitter_url', $member->twitter_url) }}" placeholder="URL" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Instagram</label>
                    <input type="text" name="instagram_url" value="{{ old('instagram_url', $member->instagram_url) }}" placeholder="URL" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">GitHub</label>
                    <input type="text" name="github_url" value="{{ old('github_url', $member->github_url) }}" placeholder="URL" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] text-sm">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">Email <span class="text-gray-600 lowercase">(or # to hide)</span></label>
                <input type="text" name="email" value="{{ old('email', $member->email) }}" placeholder="Email" class="w-full md:w-1/2 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] text-sm">
            </div>
        </div>

        <div class="border-t border-white/5 pt-8 mt-8 bg-white/5 p-6 rounded-2xl">
            <div class="flex items-center gap-3 mb-6">
                <i data-lucide="search" class="w-5 h-5 text-[#d4a574]"></i>
                <h4 class="text-xl font-black uppercase tracking-tight">Identity SEO Suite</h4>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Meta Title <span class="text-gray-600">(e.g. Syed Hasnain Ali Shah | Founder)</span></label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $member->meta_title) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Focus Keywords <span class="text-gray-600">(Hasnain Ali, Syed Hasnain)</span></label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $member->meta_keywords) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574]">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Meta Description <span class="text-gray-600">(Google snippet)</span></label>
                <textarea name="meta_description" rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574]">{{ old('meta_description', $member->meta_description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Custom JSON-LD Schema <span class="text-gray-600">(Paste Person Schema here)</span></label>
                <textarea name="schema_markup" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-300 font-mono text-xs focus:outline-none focus:border-[#d4a574]">{{ old('schema_markup', $member->schema_markup) }}</textarea>
                <p class="text-[10px] text-gray-500 mt-2 italic">I will automatically generate basic schema if left blank.</p>
            </div>
        </div>

        <div class="border-t border-white/5 pt-8 mt-8">
            <h4 class="text-lg font-bold text-white mb-4">Branding Settings</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image -->
                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Profile Photo</label>
                    @if($member->image_path)
                    <div class="mb-4 flex items-center gap-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden border border-white/10 shrink-0 bg-gradient-to-br {{ $member->gradient }}">
                            <img src="{{ asset('storage/' . $member->image_path) }}" class="w-full h-full object-cover">
                        </div>
                        <span class="text-xs text-emerald-400 font-bold tracking-widest uppercase">Existing Image</span>
                    </div>
                    @endif
                    <input type="file" name="image_path" accept="image/*" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#d4a574] file:text-black hover:file:bg-[#e8b44a] focus:outline-none focus:border-[#d4a574] transition-colors cursor-pointer">
                </div>

                <!-- Gradient Style -->
                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Identity Gradient</label>
                    <div class="relative">
                        <select name="gradient" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 appearance-none text-white focus:outline-none focus:border-[#d4a574] transition-colors cursor-pointer" style="background-color: #1a0f11;">
                            <option value="from-[#3B0000] to-[#4a1520]" {{ $member->gradient == 'from-[#3B0000] to-[#4a1520]' ? 'selected' : '' }}>Red Velvet (Founder Style)</option>
                            <option value="from-[#4a1520] to-[#d4a574]" {{ $member->gradient == 'from-[#4a1520] to-[#d4a574]' ? 'selected' : '' }}>Eclipse Gold (CEO Style)</option>
                            <option value="from-[#d4a574] to-[#e8b44a]" {{ $member->gradient == 'from-[#d4a574] to-[#e8b44a]' ? 'selected' : '' }}>Midas Touch (Exec Style)</option>
                            <option value="from-[#0a0506] to-[#d4a574]" {{ $member->gradient == 'from-[#0a0506] to-[#d4a574]' ? 'selected' : '' }}>Brutalist Black (Tech Style)</option>
                        </select>
                        <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/5 pt-8 mt-8 flex items-center justify-between">
            <label class="flex items-center gap-3 cursor-pointer group">
                <div class="relative flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }} class="peer sr-only">
                    <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-300 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#d4a574]"></div>
                </div>
                <span class="text-sm font-bold text-gray-300 group-hover:text-white transition-colors uppercase tracking-widest">Publish Profile</span>
            </label>

            <button type="submit" class="bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] px-12 py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform flex items-center gap-3 shadow-2xl shadow-[#d4a574]/30">
                <i data-lucide="shield-check" class="w-5 h-5"></i> Update Identity
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
    // Essential for Image Resize Module
    window.Quill = Quill;

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
            imageResize: { displaySize: true }
        }
    });

    // Handle Form Submission
    var form = document.querySelector('form');
    form.onsubmit = function() {
        var bio = document.querySelector('input[name=bio]');
        bio.value = quill.root.innerHTML;
    };

    // Auto-slug Generation
    const nameInput = document.getElementById('name_input');
    const slugInput = document.getElementById('slug_input');

    nameInput.addEventListener('blur', function() {
        if (!slugInput.value) {
            slugInput.value = nameInput.value
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    });
</script>
@endpush
@endsection
