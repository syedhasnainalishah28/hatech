@extends('layouts.app')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen text-white pt-40 pb-32 overflow-x-hidden">
    <!-- Hero Header -->
    <section class="max-w-5xl mx-auto px-6 md:px-12 mb-32 text-center relative">
        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-[#d4a574]/5 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="reveal-up relative z-10">
            <div class="flex items-center justify-center gap-4 mb-10">
                <span class="px-5 py-2 rounded-full bg-[#d4a574]/10 border border-[#d4a574]/20 text-[#d4a574] text-[10px] font-black uppercase tracking-[0.4em]">{{ $portfolio->category }}</span>
                <div class="w-1.5 h-1.5 rounded-full bg-gray-800"></div>
                <span class="text-gray-500 text-[10px] font-black uppercase tracking-[0.4em]">{{ $portfolio->year }}</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl lg:text-9xl font-display font-black uppercase tracking-tighter leading-[0.85] mb-8 bg-gradient-to-b from-white to-white/40 bg-clip-text text-transparent">
                {{ $portfolio->title }}
            </h1>
            
            <p class="max-w-2xl mx-auto text-xl md:text-2xl text-gray-400 font-medium leading-relaxed mb-16 italic">
                "{{ $portfolio->description }}"
            </p>
        </div>

        <!-- Main Hero Media -->
        <div class="reveal-up relative group mt-20">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent z-10"></div>
            <div class="absolute -inset-4 bg-[#d4a574]/10 blur-3xl rounded-[64px] opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
            
            <div class="aspect-[16/9] w-full rounded-[48px] md:rounded-[64px] overflow-hidden border border-white/5 bg-white/[0.02] shadow-2xl relative">
                @php
                    $imagePath = 'storage/' . $portfolio->image_path;
                    $displayImage = (file_exists(public_path($imagePath)) && !empty($portfolio->image_path)) 
                                    ? asset($imagePath) 
                                    : asset('images/ha_tech_system_mockup.png');
                @endphp
                <img src="{{ $displayImage }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
            </div>
        </div>
    </section>

    <!-- Project Snapshot (3-Card Grid) -->
    <section class="max-w-6xl mx-auto px-6 md:px-12 mb-40">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="reveal-up glass-card p-10 border border-white/5 hover:border-[#d4a574]/30 transition-all group">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#d4a574]"></span> Identity
                </h4>
                <p class="text-xl font-display font-black uppercase tracking-tight">{{ $portfolio->title }}</p>
                <div class="mt-4 text-[10px] font-black uppercase text-gray-600 tracking-widest">{{ $portfolio->category }}</div>
            </div>

            <div class="reveal-up glass-card p-10 border border-white/5 hover:border-[#d4a574]/30 transition-all group delay-100">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#d4a574]"></span> Focus
                </h4>
                <p class="text-xl font-display font-black uppercase tracking-tight">Full Execution</p>
                <div class="mt-4 text-[10px] font-black uppercase text-gray-600 tracking-widest">Digital Transformation</div>
            </div>

            <div class="reveal-up glass-card p-10 border border-white/5 hover:border-[#d4a574]/30 transition-all group delay-200">
                <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-500 mb-6 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-[#d4a574]"></span> Lifecycle
                </h4>
                <p class="text-xl font-display font-black uppercase tracking-tight">{{ $portfolio->year }} Release</p>
                <div class="mt-4 text-[10px] font-black uppercase text-gray-600 tracking-widest">Post-Deployment Support</div>
            </div>
        </div>
    </section>

    <!-- Narrative Content -->
    <section class="max-w-[1400px] mx-auto px-6 md:px-12">
        <div class="space-y-48">
            @php 
                $sections = $portfolio->layout_sections ?? [];
                if(empty($sections) && !empty($portfolio->content)) {
                    $sections = [['content' => $portfolio->content, 'layout' => 'media-left', 'media_type' => 'image']];
                }
            @endphp

            @foreach($sections as $index => $section)
                @php
                    $mediaType = $section['media_type'] ?? 'image';
                    $hasMedia = false;
                    $mediaSrc = '';

                    if ($mediaType === 'image' && !empty($section['media_url'])) {
                        $hasMedia = true;
                        $mediaSrc = asset('storage/' . $section['media_url']);
                    } elseif ($mediaType === 'video' && !empty($section['video_url'])) {
                        $hasMedia = true;
                        $mediaSrc = $section['video_url'];
                    } elseif ($mediaType === 'lottie' && (!empty($section['lottie_path']) || !empty($section['lottie_url']))) {
                        $hasMedia = true;
                    }
                @endphp

                <div class="reveal-up flex flex-col {{ ($section['layout'] ?? 'media-left') === 'media-right' ? 'lg:flex-row-reverse' : 'lg:flex-row' }} gap-16 lg:gap-32 items-center">
                    <!-- Text Content -->
                    <div class="w-full {{ $hasMedia ? 'lg:w-1/2' : 'lg:w-full max-w-4xl mx-auto text-center' }}">
                        <div class="relative">
                            @if($hasMedia)
                            <span class="absolute -left-12 -top-8 text-8xl font-black text-white/[0.03] select-none pointer-events-none">
                                {{ sprintf("%02d", $index + 1) }}
                            </span>
                            @endif
                            
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-8 {{ $hasMedia ? '' : 'justify-center' }}">
                                    <div class="h-[1px] w-12 bg-[#d4a574]/40"></div>
                                    <span class="text-[10px] font-black uppercase tracking-[0.5em] text-[#d4a574]">Phase {{ $index + 1 }}</span>
                                    <div class="h-[1px] w-12 bg-[#d4a574]/40 {{ $hasMedia ? 'hidden' : '' }}"></div>
                                </div>
                                
                                <div class="prose prose-invert prose-p:text-gray-400 prose-p:text-lg prose-p:leading-relaxed prose-headings:font-display prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tighter max-w-none prose-img:hidden">
                                    {!! $section['content'] ?? '' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($hasMedia)
                    <!-- Media Container -->
                    <div class="w-full lg:w-1/2 relative group">
                        <div class="absolute -inset-10 bg-[#d4a574]/5 blur-[80px] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-1000 -z-10"></div>
                        
                        <div class="rounded-[40px] overflow-hidden border border-white/5 bg-white/[0.02] relative shadow-[0_32px_64px_-16px_rgba(0,0,0,0.5)] cursor-zoom-trigger" 
                             @if($mediaType !== 'lottie') onclick="openLightbox('{{ $mediaType }}', '{{ $mediaSrc }}')" @endif>
                            
                            @if($mediaType === 'image')
                                <img src="{{ $mediaSrc }}" class="w-full h-auto object-cover transition-transform duration-1000 group-hover:scale-105">
                            @elseif($mediaType === 'video')
                                <div class="aspect-video w-full pointer-events-none">
                                    <iframe src="{{ $mediaSrc }}" class="w-full h-full border-0" allowfullscreen></iframe>
                                </div>
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
                            @elseif($mediaType === 'lottie')
                                <div class="aspect-square w-full p-12">
                                    @php
                                        $lottiePath = !empty($section['lottie_path']) ? asset('storage/' . $section['lottie_path']) : ($section['lottie_url'] ?? '');
                                    @endphp
                                    <lottie-player src="{{ $lottiePath }}" background="transparent" speed="1" loop autoplay class="w-full h-full"></lottie-player>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            @endforeach

            @if(empty($sections))
                <div class="reveal-up p-24 rounded-[64px] border border-dashed border-white/10 text-center max-w-4xl mx-auto">
                    <p class="text-gray-500 italic text-xl">Developing the full technical narrative for this project. Stay tuned as we document every strategic detail of this transformation.</p>
                </div>
            @endif
        </div>

        <!-- Footer Call to Action -->
        <div class="mt-48 pt-32 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-12 reveal-up">
            <div class="text-center md:text-left">
                <h4 class="text-4xl font-display font-black uppercase tracking-tighter mb-4 italic">Next Story</h4>
                <p class="text-gray-500 uppercase tracking-widest text-[10px] font-black">Continue the journey through our portfolio</p>
            </div>
            
            <div class="flex items-center gap-8">
                <a href="{{ url('/') }}#work" class="flex items-center gap-4 text-gray-500 hover:text-white transition-colors group">
                    <i data-lucide="arrow-left" class="w-5 h-5 group-hover:-translate-x-2 transition-transform"></i>
                    <span class="font-black text-xs uppercase tracking-widest">All Work</span>
                </a>
                <a href="{{ url('/contact') }}" class="px-10 py-5 bg-[#d4a574] text-black rounded-full font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform shadow-2xl">
                    Start Your Project
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[10000] bg-black/98 backdrop-blur-3xl opacity-0 pointer-events-none transition-all duration-500 grid place-items-center p-4 md:p-12" onclick="closeLightbox()">
    <!-- Close Icon -->
    <button class="absolute top-10 right-10 text-white/40 hover:text-white transition-colors z-[10001]">
        <i data-lucide="x" class="w-10 h-10"></i>
    </button>
    
    <!-- Content Wrapper -->
    <div id="lightbox-content" class="relative max-w-full max-h-full transition-all duration-500 scale-90 opacity-0" onclick="event.stopPropagation()">
        <!-- Image/Video injected here -->
    </div>
</div>

<style>
    .prose h2 { font-size: 3rem; line-height: 0.95; margin-top: 2rem; margin-bottom: 2rem; color: #d4a574; font-family: 'Montserrat', sans-serif; font-weight: 900; letter-spacing: -0.04em; }
    .prose h3 { font-size: 1.5rem; color: white; margin-bottom: 1.5rem; }
    .prose p { margin-bottom: 2.5rem; font-size: 1.15rem; }
    .prose li { color: #d1d5db; margin-bottom: 0.75rem; font-size: 1.1rem; }
    .prose strong { color: #d4a574; }
    .prose a { 
        color: #d4a574; 
        text-decoration: none; 
        border-bottom: 1px solid rgba(212, 165, 116, 0.3); 
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .prose a:hover {
        border-bottom-color: #d4a574;
        background: rgba(212, 165, 116, 0.05);
    }
    
    #lightbox.active {
        opacity: 1;
        pointer-events: auto;
    }
    #lightbox.active #lightbox-content {
        opacity: 1;
        transform: scale(1);
    }
    
    #lightbox-content img, #lightbox-content iframe {
        box-shadow: 0 80px 160px -40px rgba(0,0,0,0.9);
        border-radius: 32px;
        max-width: 90vw;
        max-height: 80vh; /* Strict height to ensure vertical centering room */
        object-fit: contain;
        display: block;
        margin: auto;
    }
    
    @media (max-width: 768px) {
        .prose h2 { font-size: 2rem; }
    }
</style>

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    function openLightbox(type, src) {
        if (!src || src === '' || src.includes('undefined')) return;

        const lightbox = document.getElementById('lightbox');
        const content = document.getElementById('lightbox-content');
        
        content.innerHTML = '';
        
        if (type === 'image') {
            content.innerHTML = `<img src="${src}" class="shadow-4xl">`;
        } else if (type === 'video') {
            content.innerHTML = `<iframe src="${src}" class="w-full aspect-video border-0 shadow-4xl" allowfullscreen></iframe>`;
        }

        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        setTimeout(() => {
            document.getElementById('lightbox-content').innerHTML = '';
        }, 500);
    }

    // Escape Key Support
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endpush
@endsection

