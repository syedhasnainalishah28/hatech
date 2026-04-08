@extends('layouts.admin')

@section('page_title', 'Master Identity Editor: ' . $page->name)

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow { border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); border-radius: 1rem 1rem 0 0; }
        .ql-container.ql-snow { border-color: rgba(255,255,255,0.1); background: rgba(10,5,6,0.5); border-radius: 0 0 1rem 1rem; min-height: 400px; font-size: 16px; color: #fff; }
        .repeater-item { transition: all 0.3s ease; }
        .repeater-item:hover { border-color: #d4a574; }
    </style>
@endpush

@section('content')
<div class="max-w-6xl pb-20">
    <form id="profileForm" action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
        @csrf
        
        {{-- SECTION 1: HEADER & IDENTITY --}}
        <div class="glass-card p-10 space-y-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-black uppercase tracking-widest text-[#d4a574]">Core Identity</h3>
                <span class="px-4 py-1 bg-white/5 border border-white/10 rounded-full text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                    Authorized Profile Access
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Full Name</label>
                    <input type="text" name="name" value="{{ $page->name }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-bold" required>
                </div>
                
                <div class="space-y-2">
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Professional Designation</label>
                    <input type="text" name="designation" value="{{ $page->components_json['designation'] ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white" placeholder="e.g. Founder & Visionary">
                </div>
            </div>

            <div class="space-y-4">
                <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Profile Biography (Rich Text Builder)</label>
                <div id="editor-container" class="rounded-2xl overflow-hidden border border-white/10">
                    <div id="editor">{!! $page->components_json['biography'] ?? '' !!}</div>
                </div>
                <input type="hidden" name="biography" id="biography-input">
                <p class="text-[9px] text-gray-600 uppercase font-bold italic">Note: Drag & Drop images and resize them directly in the editor.</p>
            </div>
        </div>

        {{-- SECTION 2: ATTRIBUTES & MEDIA --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-1 space-y-8">
                <div class="glass-card p-8 space-y-6">
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-500 block mb-4">Identity Portrait</label>
                    @if(isset($page->components_json['image_path']))
                        <img src="{{ asset('storage/' . $page->components_json['image_path']) }}" class="w-full aspect-[4/5] rounded-2xl object-cover border border-white/10 shadow-2xl mb-4">
                    @endif
                    <input type="file" name="image" class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-[#d4a574] file:text-black">
                </div>

                <div class="glass-card p-8 space-y-4">
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Identity Quote</label>
                    <textarea name="quote" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-[10px] italic" placeholder="The true evolution of tech isn't just code...">{{ $page->components_json['quote'] ?? '' }}</textarea>
                </div>

                <div class="glass-card p-8 space-y-4">
                    <label class="text-[10px] uppercase font-black tracking-widest text-gray-500 block">Elite Social Connectivity</label>
                    <div class="space-y-3">
                        <input type="text" name="linkedin" value="{{ $page->components_json['linkedin'] ?? '' }}" placeholder="LinkedIn" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs">
                        <input type="text" name="twitter" value="{{ $page->components_json['twitter'] ?? '' }}" placeholder="Twitter" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs">
                        <input type="text" name="email" value="{{ $page->components_json['email'] ?? '' }}" placeholder="Direct Email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                {{-- ACADEMIC HONORS REPEATER --}}
                <div class="glass-card p-8">
                    <div class="flex justify-between items-center mb-6">
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Academic Honor (Qualifications)</label>
                        <button type="button" onclick="addItem('honor')" class="p-2 bg-white/5 hover:bg-[#d4a574] rounded-lg transition-colors group">
                             <i data-lucide="plus" class="w-4 h-4 text-gray-500 group-hover:text-black"></i>
                        </button>
                    </div>
                    <div id="honor-container" class="space-y-4">
                        @php $honors = $page->components_json['qualifications'] ?? []; @endphp
                        @foreach($honors as $h)
                        <div class="repeater-item space-y-3 p-6 bg-white/5 border border-white/10 rounded-2xl group">
                             <div class="flex gap-4">
                                <input type="text" name="honor[{{ $loop->index }}][year]" value="{{ $h['year'] }}" placeholder="202X" class="w-24 bg-black/40 border border-[#d4a574]/20 rounded-xl px-4 py-2 text-center text-[#d4a574] font-black text-xs">
                                <input type="text" name="honor[{{ $loop->index }}][title]" value="{{ $h['title'] }}" placeholder="Degree Name" class="flex-1 bg-transparent border-b border-white/10 py-2 outline-none text-white font-bold text-sm">
                                <button type="button" onclick="this.closest('.repeater-item').remove()" class="text-rose-500/50 hover:text-rose-500 opacity-0 group-hover:opacity-100 transition-opacity"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                             </div>
                             <input type="text" name="honor[{{ $loop->index }}][institution]" value="{{ $h['institution'] }}" placeholder="University Name" class="w-full bg-transparent outline-none text-[10px] text-gray-500 italic">
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- MASTERY INDEX REPEATER --}}
                <div class="glass-card p-8">
                    <div class="flex justify-between items-center mb-6">
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Mastery Index (Elite Rankings)</label>
                        <button type="button" onclick="addItem('mastery')" class="p-2 bg-white/5 hover:bg-[#d4a574] rounded-lg transition-colors group">
                             <i data-lucide="plus" class="w-4 h-4 text-gray-500 group-hover:text-black"></i>
                        </button>
                    </div>
                    <div id="mastery-container" class="space-y-4">
                        @php $mastery = $page->components_json['mastery_index'] ?? []; @endphp
                        @foreach($mastery as $m)
                        <div class="repeater-item flex gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl items-center">
                            <input type="text" name="mastery[{{ $loop->index }}][label]" value="{{ $m['label'] ?? ($m['skill'] ?? '') }}" placeholder="Architectural Mastery" class="flex-1 bg-transparent outline-none text-white text-sm">
                            <input type="text" name="mastery[{{ $loop->index }}][value]" value="{{ $m['value'] ?? ($m['percentage'] ?? '') }}" placeholder="98%" class="w-20 bg-black/40 border border-white/10 rounded-lg px-2 py-1 text-center font-black text-[#d4a574] text-sm">
                            <button type="button" onclick="this.closest('.repeater-item').remove()" class="text-rose-500/50 hover:text-rose-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- TIMELINE REPEATER --}}
                <div class="glass-card p-8">
                    <div class="flex justify-between items-center mb-6">
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Evolutionary Timeline (Key Years)</label>
                        <button type="button" onclick="addItem('timeline')" class="p-2 bg-white/5 hover:bg-[#d4a574] rounded-lg transition-colors group">
                             <i data-lucide="plus" class="w-4 h-4 text-gray-500 group-hover:text-black"></i>
                        </button>
                    </div>
                    <div id="timeline-container" class="space-y-4">
                        @php $timeline = $page->components_json['experience_timeline'] ?? []; @endphp
                        @foreach($timeline as $t)
                        <div class="repeater-item space-y-3 p-6 bg-white/5 border border-white/10 rounded-2xl">
                             <div class="flex gap-4">
                                <input type="text" name="timeline[{{ $loop->index }}][year]" value="{{ $t['year'] }}" placeholder="2024" class="w-24 bg-black/40 border border-[#d4a574]/20 rounded-xl px-4 py-2 text-center text-[#d4a574] font-black text-xs">
                                <input type="text" name="timeline[{{ $loop->index }}][title]" value="{{ $t['title'] }}" placeholder="Event Title" class="flex-1 bg-transparent border-b border-white/10 py-2 outline-none text-white font-bold">
                                <button type="button" onclick="this.closest('.repeater-item').remove()" class="text-rose-500/50 hover:text-rose-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                             </div>
                             <textarea name="timeline[{{ $loop->index }}][description]" rows="2" placeholder="Describe this milestone..." class="w-full bg-transparent outline-none text-xs text-gray-500 italic">{{ $t['description'] }}</textarea>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- GALLERY REPEATER --}}
                <div class="glass-card p-8">
                    <div class="flex justify-between items-center mb-6">
                        <label class="text-[10px] uppercase font-black tracking-widest text-gray-500">Professional Lifestyle Gallery</label>
                        <button type="button" onclick="addItem('gallery')" class="p-2 bg-white/5 hover:bg-[#d4a574] rounded-lg transition-colors group">
                             <i data-lucide="plus" class="w-4 h-4 text-gray-500 group-hover:text-black"></i>
                        </button>
                    </div>
                    <div id="gallery-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php $gallery = $page->components_json['gallery'] ?? []; @endphp
                        @foreach($gallery as $img)
                        <div class="repeater-item p-4 bg-white/5 border border-white/10 rounded-2xl group relative">
                            <div class="aspect-video rounded-xl overflow-hidden mb-4 border border-white/10 bg-black/40">
                                <img src="{{ asset('storage/' . $img['url']) }}" class="w-full h-full object-cover">
                            </div>
                            <input type="hidden" name="gallery[{{ $loop->index }}][existing]" value="{{ $img['url'] }}">
                            <div class="space-y-3">
                                <input type="file" name="gallery[{{ $loop->index }}][file]" class="block w-full text-[9px] text-gray-400 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-white/10 file:text-white">
                                <input type="text" name="gallery[{{ $loop->index }}][caption]" value="{{ $img['caption'] }}" placeholder="Image Caption" class="w-full bg-transparent border-b border-white/10 py-1 outline-none text-white text-[10px] font-bold">
                            </div>
                            <button type="button" onclick="this.closest('.repeater-item').remove()" class="absolute top-6 right-6 p-2 bg-rose-500/20 text-rose-500 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 3: SEO SUITE --}}
        <div class="glass-card p-10 space-y-8">
             <h3 class="text-xs font-black uppercase tracking-[0.4em] text-[#d4a574] flex items-center gap-3">
                <i data-lucide="shield-check" class="w-4 h-4"></i> Identity SEO Suite
            </h3>
            <div class="grid grid-cols-1 gap-6 mt-4">
                <input type="text" name="meta_title" value="{{ $page->meta_title }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-6 py-4 text-white font-bold outline-none" placeholder="Meta Title">
                <div class="grid grid-cols-2 gap-4">
                    <textarea name="meta_description" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-gray-400 outline-none" placeholder="Meta Description">{{ $page->meta_description }}</textarea>
                    <textarea name="meta_keywords" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-xs text-gray-400 outline-none" placeholder="Meta Keywords">{{ $page->meta_keywords }}</textarea>
                </div>
                <div class="space-y-4">
                     <button type="button" onclick="toggleTechnical()" class="text-[9px] font-black uppercase text-blue-500 hover:text-blue-400 flex items-center gap-2">
                        <i data-lucide="terminal" class="w-3 h-3"></i> Toggle Developer Mode (Raw JSON Override)
                    </button>
                    <div id="technicalArea" class="hidden">
                        <textarea name="components_json_raw" rows="8" class="w-full bg-black border border-blue-500/10 rounded-xl p-6 text-[10px] text-blue-400 font-mono">{{ json_encode($page->components_json, JSON_PRETTY_PRINT) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- ACTION PANEL --}}
        <div class="sticky bottom-8 z-50 glass-card p-6 border-t border-white/10 flex justify-between items-center shadow-3xl">
             <div class="flex gap-4">
                <button type="submit" class="px-12 py-5 bg-gradient-to-r from-[#d4a574] to-[#f4d1a0] text-black font-black rounded-2xl hover:scale-105 transition-all shadow-xl uppercase tracking-widest text-xs">
                    Update Master Profile
                </button>
                <a href="{{ route('admin.pages') }}" class="px-12 py-5 bg-white/5 text-white font-black rounded-2xl hover:bg-white/10 transition-all uppercase tracking-widest text-xs">
                    Exit
                </a>
            </div>
            <p class="text-[9px] text-gray-500 uppercase font-black">HA Tech Authority System v2.0</p>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>window.Quill = Quill;</script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
    // 1. Initialize Quill
    try {
        if (typeof ImageResize !== 'undefined') {
            Quill.register('modules/imageResize', ImageResize.default || ImageResize);
        }
    } catch (e) { console.error("Quill Resize Error:", e); }

    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ],
            imageResize: { displaySize: true }
        }
    });

    // 2. Form Submission Handler
    document.getElementById('profileForm').onsubmit = function() {
        document.getElementById('biography-input').value = quill.root.innerHTML;
        return true;
    };

    // 3. Repeater Manager
    function addItem(type) {
        const container = document.getElementById(`${type}-container`);
        if (!container) return;
        const index = container.children.length;
        let html = '';

        if(type === 'mastery') {
            html = `
            <div class="repeater-item flex gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl items-center animate-in fade-in slide-in-from-left">
                <input type="text" name="mastery[${index}][label]" placeholder="Skill Label" class="flex-1 bg-transparent outline-none text-white text-sm">
                <input type="text" name="mastery[${index}][value]" placeholder="95%" class="w-20 bg-black/40 border border-white/10 rounded-lg px-2 py-1 text-center font-black text-[#d4a574] text-sm">
                <button type="button" onclick="this.closest('.repeater-item').remove()" class="text-rose-500/50 hover:text-rose-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>`;
        } else if(type === 'timeline') {
            html = `
            <div class="repeater-item space-y-3 p-6 bg-white/5 border border-white/10 rounded-2xl animate-in fade-in slide-in-from-bottom">
                 <div class="flex gap-4">
                    <input type="text" name="timeline[${index}][year]" placeholder="202X" class="w-24 bg-black/40 border border-[#d4a574]/20 rounded-xl px-4 py-2 text-center text-[#d4a574] font-black text-xs">
                    <input type="text" name="timeline[${index}][title]" placeholder="Milestone Title" class="flex-1 bg-transparent border-b border-white/10 py-2 outline-none text-white font-bold">
                    <button type="button" onclick="this.closest('.repeater-item').remove()" class="text-rose-500/50 hover:text-rose-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                 </div>
                 <textarea name="timeline[${index}][description]" rows="2" placeholder="Description..." class="w-full bg-transparent outline-none text-xs text-gray-500 italic"></textarea>
            </div>`;
        } else if(type === 'honor') {
            html = `
            <div class="repeater-item space-y-3 p-6 bg-white/5 border border-white/10 rounded-2xl group animate-in fade-in slide-in-from-left">
                 <div class="flex gap-4">
                    <input type="text" name="honor[${index}][year]" placeholder="202X" class="w-24 bg-black/40 border border-[#d4a574]/20 rounded-xl px-4 py-2 text-center text-[#d4a574] font-black text-xs">
                    <input type="text" name="honor[${index}][title]" placeholder="Degree Name" class="flex-1 bg-transparent border-b border-white/10 py-2 outline-none text-white font-bold text-sm">
                    <button type="button" onclick="this.closest('.repeater-item').remove()" class="text-rose-500/50 hover:text-rose-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                 </div>
                 <input type="text" name="honor[${index}][institution]" placeholder="University Name" class="w-full bg-transparent outline-none text-[10px] text-gray-500 italic">
            </div>`;
        } else if(type === 'gallery') {
            html = `
            <div class="repeater-item p-4 bg-white/5 border border-white/10 rounded-2xl group relative animate-in fade-in zoom-in">
                <div class="aspect-video rounded-xl overflow-hidden mb-4 border border-white/10 bg-black/40 flex items-center justify-center">
                    <i data-lucide="image" class="w-8 h-8 text-white/10"></i>
                </div>
                <div class="space-y-3">
                    <input type="file" name="gallery[${index}][file]" class="block w-full text-[9px] text-gray-400 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-white/10 file:text-white">
                    <input type="text" name="gallery[${index}][caption]" placeholder="Lifestyle Caption" class="w-full bg-transparent border-b border-white/10 py-1 outline-none text-white text-[10px] font-bold">
                </div>
                <button type="button" onclick="this.closest('.repeater-item').remove()" class="absolute top-6 right-6 p-2 bg-rose-500/20 text-rose-500 rounded-lg"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
            </div>`;
        }
        
        container.insertAdjacentHTML('beforeend', html);
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function toggleTechnical() {
        document.getElementById('technicalArea').classList.toggle('hidden');
    }
</script>
@endpush
