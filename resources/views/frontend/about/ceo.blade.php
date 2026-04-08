@extends('layouts.app')

@section('title', $page->meta_title ?? 'Syed Ahmar Ali Shah | CEO & Growth Architect | HA Tech')
@section('meta_description', $page->meta_description ?? 'Chief Executive Officer of HA Tech. Expert in operational excellence and strategic growth architectures.')
@section('meta_keywords', $page->meta_keywords ?? 'Syed Ahmar Ali Shah, Ahmar Shah, CEO HA Tech, Growth Architect Pakistan')

@section('content')
@php
    $data = $page->components_json ?? [];
    $gallery = $data['gallery'] ?? [];
    $timeline = $data['experience_timeline'] ?? [];
    $qualifications = $data['qualifications'] ?? [];
    $mastery = $data['mastery_index'] ?? [];
@endphp

{{-- Schema Injection --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => 'Syed Ahmar Ali Shah',
    'jobTitle' => 'Chief Executive Officer',
    'worksFor' => [
        '@type' => 'Organization',
        'name' => 'HA Tech',
        'url' => url('/')
    ],
    'url' => url()->current(),
    'description' => $page->meta_description ?? 'CEO of HA Tech.'
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

<div class="min-h-screen bg-[#050203] text-white overflow-hidden selection:bg-[#d4a574] selection:text-black">
    
    {{-- Ultra-Premium Hero Section --}}
    <section class="relative min-h-screen flex items-center pt-20 px-4 sm:px-6 lg:px-8">
        {{-- Three.js Canvas Backdrop --}}
        <canvas id="identity-canvas" class="absolute inset-0 z-0 pointer-events-none opacity-40"></canvas>

        <div class="relative z-10 max-w-7xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                {{-- Left Side: Identity & Name --}}
                <div class="lg:col-span-7 space-y-8 lg:order-2 lg:text-right">
                    <div class="reveal-up inline-flex items-center gap-3">
                        <span class="text-[10px] sm:text-xs font-black uppercase tracking-[0.5em] text-[#d4a574]/80 px-6 py-2 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
                            Leadership Archive
                        </span>
                    </div>

                    <h1 class="text-5xl sm:text-6xl md:text-7xl font-black text-white leading-none tracking-tighter uppercase reveal-up drop-shadow-2xl">
                        Syed <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-[#d4a574] to-white/40">Ahmar Ali</span> Shah
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-500 font-medium tracking-tight border-r-4 border-[#d4a574]/30 pr-6 py-2">
                        Chief Executive Officer & Growth Architect of HA Tech.
                    </p>

                    {{-- Visual Mastery Index in Hero --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-10 reveal-up max-w-2xl lg:ml-auto">
                        @foreach($mastery ?: [] as $skill)
                        <div class="space-y-2 group/skill">
                            <div class="flex justify-between items-center text-[11px] font-black uppercase tracking-widest transition-all group-hover/skill:tracking-[0.15em]">
                                <span class="text-[#d4a574]">{{ $skill['value'] ?? ($skill['percentage'] ?? 0) }}%</span>
                                <span class="text-white drop-shadow-md text-right">{{ $skill['label'] ?? ($skill['skill'] ?? 'Skill') }}</span>
                            </div>
                            <div class="h-[2px] w-full bg-white/5 rounded-full overflow-hidden">
                                @php $val = intval($skill['value'] ?? ($skill['percentage'] ?? 0)); @endphp
                                <div class="h-full bg-gradient-to-l from-[#3B0000] to-[#d4a574] shadow-[0_0_15px_#d4a574]/40" style="width: {{ $val }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Side: The Main Identity Card 3D Scroll-Reveal --}}
                <div class="lg:col-span-5 reveal-up lg:order-1 identity-card-container" style="perspective: 2000px;">
                    <style>
                        .identity-img { filter: grayscale(100%) brightness(0.9); transition: all 0.8s ease-in-out; }
                        .identity-3d-card:hover .identity-img { filter: grayscale(0%) brightness(1.1); transform: scale(1.05); }
                        
                        /* Scroll Opening Effect */
                        .scroll-reveal-card {
                            transform: rotateX(25deg) rotateY(10deg) scale(0.85);
                            opacity: 0.3;
                            transition: transform 1.2s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 1.2s ease;
                            transform-origin: bottom center;
                        }
                        .scroll-reveal-card.is-open {
                            transform: rotateX(0deg) rotateY(0deg) scale(1);
                            opacity: 1;
                        }
                    </style>
                    <div class="relative group identity-3d-card scroll-reveal-card" id="ceo-card">
                        <div class="absolute -inset-2 bg-gradient-to-r from-[#d4a574] via-[#d4a574]/20 to-black rounded-2xl blur-xl opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                        <div class="relative bg-black rounded-2xl overflow-hidden border border-white/10 aspect-[4/5] shadow-2xl">
                             @php $displayImage = $data['image_path'] ?? ($data['primary_image'] ?? null); @endphp
                             @if($displayImage)
                                <img src="{{ asset('storage/' . $displayImage) }}" class="w-full h-full object-cover identity-img">
                             @else
                                <div class="w-full h-full flex flex-col items-center justify-center p-12 bg-gradient-to-br from-[#1a0f11] to-[#050203]">
                                    <i data-lucide="award" class="w-32 h-32 text-[#d4a574] opacity-20 mb-4"></i>
                                    <span class="text-[12rem] font-black text-white opacity-5 tracking-tighter leading-none select-none">CEO</span>
                                </div>
                             @endif
                             
                             <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
                             <div class="absolute bottom-10 left-10 right-10">
                                <div class="flex justify-between items-center">
                                    <div class="text-left">
                                        <p class="text-xs font-black uppercase tracking-widest text-[#d4a574] mb-1">Executive Status</p>
                                        <p class="text-2xl font-black text-white italic tracking-tighter uppercase">Verified CEO</p>
                                    </div>
                                    <div class="w-16 h-16 rounded-2xl bg-white/5 backdrop-blur-2xl border border-white/10 flex items-center justify-center text-[#d4a574] animate-pulse">
                                        <i data-lucide="verified" class="w-8 h-8"></i>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 reveal-up">
            <div class="w-[1px] h-20 bg-gradient-to-b from-[#d4a574] to-transparent"></div>
        </div>
    </section>

    {{-- Detailed Narrative Section --}}
    <section class="py-32 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
                
                {{-- Left: Expertise & Skills (Mastery Index) --}}
                <div class="lg:col-span-4 space-y-16">
                    <div class="reveal-up space-y-6">
                        <h3 class="text-xs font-black uppercase tracking-[0.5em] text-[#d4a574]">01. Strategic Index</h3>
                        <div class="space-y-8">
                            <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur-2xl relative overflow-hidden group">
                                <div class="absolute -top-4 -right-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                    <i data-lucide="quote" class="w-20 h-20 text-[#d4a574]"></i>
                                </div>
                                <p class="text-xl md:text-2xl text-white font-medium italic leading-relaxed relative z-10 text-right">
                                    "{{ $data['quote'] ?? 'Strategy is the art of creating value where others see only complexity.' }}"
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Qualifications --}}
                    @if($qualifications)
                    <div class="reveal-up space-y-6 pt-12">
                        <h3 class="text-xs font-black uppercase tracking-[0.5em] text-[#d4a574]">02. Academic Honor</h3>
                        <div class="space-y-6 border-l border-white/10 pl-6">
                            @foreach($qualifications as $edu)
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-[#d4a574] uppercase tracking-widest">{{ $edu['year'] }}</p>
                                <p class="text-lg font-black text-white uppercase tracking-tighter">{{ $edu['title'] }}</p>
                                <p class="text-xs text-gray-400 font-medium italic">{{ $edu['institution'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Right: Long-form Story --}}
                <div class="lg:col-span-8">
                    <div class="reveal-up space-y-12">
                        <div class="inline-block px-3 py-1 bg-[#d4a574]/10 border border-[#d4a574]/20 rounded text-[9px] font-black tracking-widest text-[#d4a574] uppercase">
                            Operational Narrative
                        </div>
                        <div class="prose prose-invert max-w-none">
                            <p class="text-3xl md:text-5xl font-black text-white leading-[1.1] tracking-tighter uppercase italic reveal-up">
                                "Growth is not a goal; <span class="text-[#d4a574]">it's a continuous architecture.</span>"
                            </p>
                            <div class="mt-12 text-gray-400 text-xl leading-relaxed space-y-8 font-medium border-r-2 border-[#d4a574]/20 pr-8 text-right lg:text-left identity-biography-rich">
                                {!! $data['biography'] ?? "As the CEO of HA Tech, Syed Ahmar Ali Shah leads with a focus on systematic expansion and technological integration." !!}
                            </div>
                        </div>

                        {{-- Gallery Grid --}}
                        @if($gallery)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-12">
                            @foreach($gallery as $img)
                            <div class="reveal-up aspect-video rounded-3xl overflow-hidden border border-white/5 relative group">
                                <img src="{{ asset('storage/' . $img['url']) }}" class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-transform duration-1000">
                                <div class="absolute bottom-5 left-5 right-5 p-4 bg-black/40 backdrop-blur-xl border border-white/10 rounded-xl translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-white">{{ $img['caption'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Vertical Timeline: Road to Evolution --}}
    @if($timeline)
    <section class="py-32 px-4 sm:px-6 lg:px-8 border-t border-white/5 bg-[#080506]">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-24 reveal-up">
                <h2 class="text-4xl md:text-6xl font-black uppercase italic tracking-tighter">Growth <span class="text-[#d4a574]">Milestones</span></h2>
                <div class="w-20 h-1 bg-[#d4a574] mx-auto mt-6"></div>
            </div>

            <div class="space-y-24 relative before:absolute before:left-[11px] before:top-0 before:bottom-0 before:w-[1px] before:bg-white/10">
                @foreach($timeline as $event)
                <div class="relative pl-12 reveal-up group">
                    <div class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-black border-4 border-[#d4a574]/30 z-10 group-hover:border-[#d4a574] transition-colors"></div>
                    <div class="space-y-3">
                        <span class="text-xs font-black text-[#d4a574] tracking-[0.3em] uppercase">{{ $event['year'] }}</span>
                        <h4 class="text-2xl font-black text-white uppercase italic tracking-tight">{{ $event['title'] }}</h4>
                        <p class="text-gray-500 font-medium leading-relaxed max-w-2xl">{{ $event['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
             // 1. Initialize Scroll Reveal (Opening/Closing Effect)
            const scrollCards = document.querySelectorAll(".scroll-reveal-card");
            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-open');
                    } else {
                        // Optional: Re-close if out of view (feels more like 'scroll' animation)
                        entry.target.classList.remove('is-open');
                    }
                });
            }, { 
                threshold: 0.2,
                rootMargin: '0px 0px -50px 0px'
            });

            scrollCards.forEach(card => scrollObserver.observe(card));

            // 2. Simple Three.js Particle Background (Zero Lag)
            const canvas = document.getElementById('identity-canvas');
            if (canvas) {
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
                renderer.setPixelRatio(window.devicePixelRatio);
                renderer.setSize(window.innerWidth, window.innerHeight);

                const particlesGeometry = new THREE.BufferGeometry();
                const particlesCount = 4000;
                const posArray = new Float32Array(particlesCount * 3);
                for(let i=0; i < particlesCount * 3; i++) {
                    posArray[i] = (Math.random() - 0.5) * 12;
                }
                particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
                const particlesMaterial = new THREE.PointsMaterial({ 
                    size: 0.015, 
                    color: '#f4d1a0',
                    transparent: true,
                    opacity: 1.0,
                    blending: THREE.AdditiveBlending
                });
                const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
                scene.add(particlesMesh);
                camera.position.z = 2;

                function animate() {
                    requestAnimationFrame(animate);
                    particlesMesh.rotation.y += 0.001;
                    particlesMesh.rotation.x += 0.0005;
                    renderer.render(scene, camera);
                }
                animate();

                window.addEventListener('resize', () => {
                    camera.aspect = window.innerWidth / window.innerHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(window.innerWidth, window.innerHeight);
                });
            }

            // 3. Smooth Reveal Observer
            const observerOptions = { threshold: 0.1 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            document.querySelectorAll('.reveal-up').forEach(el => observer.observe(el));
        });
    </script>
@endpush
@endsection
