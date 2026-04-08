@extends('layouts.app')

@section('title', $member->meta_title ?: $member->name . ' | HA Tech Founder & Identity')
@section('meta_description', $member->meta_description ?: 'Discover the profile of ' . $member->name . ', a key leader at HA Tech - Gen Z Evolution.')

@section('og_tags')
    <meta property="og:title" content="{{ $member->meta_title ?: $member->name }}">
    <meta property="og:description" content="{{ $member->meta_description }}">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($member->image_path)
    <meta property="og:image" content="{{ asset('storage/' . $member->image_path) }}">
    @endif
@endsection

@section('content')
<!-- Person Schema -->
@if($member->schema_markup)
    {!! $member->schema_markup !!}
@else
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $member->name,
        'jobTitle' => $member->role,
        'url' => url()->current(),
        'image' => asset('storage/' . $member->image_path),
        'sameAs' => array_filter([
            $member->linkedin_url,
            $member->twitter_url,
            $member->github_url,
            $member->instagram_url
        ]),
        'worksFor' => [
            '@type' => 'Organization',
            'name' => 'HA Tech',
            'url' => url('/')
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endif

<main class="pt-32 pb-24 px-6 min-h-screen bg-luxury-mesh overflow-hidden">
    <!-- Sophisticated Backdrop Text -->
    <div class="absolute top-20 left-0 w-full text-center pointer-events-none opacity-[0.03] select-none">
        <h2 class="text-[20vw] font-black uppercase leading-none">{{ $member->name }}</h2>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <!-- Sidebar: Identity Card -->
            <div class="lg:col-span-4 sticky top-32">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r {{ $member->gradient }} rounded-3xl blur opacity-25 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative bg-[#0a0506]/80 border border-white/10 rounded-3xl overflow-hidden backdrop-blur-xl">
                        <div class="aspect-[4/5] overflow-hidden">
                            @if($member->image_path)
                                <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br {{ $member->gradient }} flex items-center justify-center">
                                    <span class="text-9xl font-black text-white/20">{{ substr($member->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-8 text-center">
                            <h1 class="text-3xl font-black uppercase tracking-tight text-white mb-2">{{ $member->name }}</h1>
                            <p class="text-[#d4a574] font-bold uppercase tracking-widest text-xs mb-6">{{ $member->role }}</p>
                            
                            <div class="flex justify-center gap-4">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="p-3 bg-white/5 rounded-full text-gray-400 hover:text-[#d4a574] hover:bg-white/10 transition-all">
                                        <i data-lucide="linkedin" class="w-5 h-5"></i>
                                    </a>
                                @endif
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="p-3 bg-white/5 rounded-full text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                                        <i data-lucide="twitter" class="w-5 h-5"></i>
                                    </a>
                                @endif
                                @if($member->instagram_url)
                                    <a href="{{ $member->instagram_url }}" target="_blank" class="p-3 bg-white/5 rounded-full text-gray-400 hover:text-rose-400 hover:bg-white/10 transition-all">
                                        <i data-lucide="instagram" class="w-5 h-5"></i>
                                    </a>
                                @endif
                                @if($member->github_url)
                                    <a href="{{ $member->github_url }}" target="_blank" class="p-3 bg-white/5 rounded-full text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                                        <i data-lucide="github" class="w-5 h-5"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Call-to-Action -->
                <div class="mt-8 p-6 bg-gradient-to-br from-white/5 to-transparent border border-white/10 rounded-2xl">
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-3">Direct Contact</p>
                    <a href="mailto:{{ $member->email ?: 'office@hatechservices.com.pk' }}" class="text-white hover:text-[#d4a574] font-bold flex items-center gap-2 transition-colors">
                        <i data-lucide="mail" class="w-4 h-4"></i> {{ $member->email ?: 'Send a message' }}
                    </a>
                </div>
            </div>

            <!-- Content: Detailed Narrative -->
            <div class="lg:col-span-8 flex flex-col gap-12">
                
                <!-- Biography / Experience Sector -->
                <section class="prose prose-invert prose-lg max-w-none">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-px flex-1 bg-gradient-to-r from-[#d4a574] to-transparent"></div>
                        <h2 class="text-xs font-bold uppercase tracking-[0.5em] text-[#d4a574] whitespace-nowrap">Professional Narrative</h2>
                    </div>
                    
                    <div class="bio-content text-gray-300 leading-relaxed font-sans text-xl">
                        {!! $member->bio ?: 'Highly specialized professional at the intersection of technology and creativity.' !!}
                    </div>
                </section>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-4">
                    <!-- Expertise Section -->
                    @if($member->expertise)
                    <section>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-8 h-px bg-[#d4a574]"></div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-[#d4a574]">Core Expertise</h3>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $member->expertise) as $skill)
                                <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-xs font-medium text-gray-300 uppercase tracking-tight hover:border-[#d4a574] transition-colors">
                                    {{ trim($skill) }}
                                </span>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    <!-- Achievements Section -->
                    @if($member->achievements)
                    <section>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-8 h-px bg-[#d4a574]"></div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-[#d4a574]">Notable Milestones</h3>
                        </div>
                        <ul class="space-y-4">
                            @foreach(explode("\n", str_replace("\r", "", $member->achievements)) as $achievement)
                                @if(trim($achievement))
                                    <li class="flex items-start gap-3">
                                        <div class="mt-1.5 w-1.5 h-1.5 bg-[#d4a574] rounded-full shrink-0"></div>
                                        <p class="text-sm text-gray-400 font-medium leading-tight">{{ $achievement }}</p>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                    @endif
                </div>

                <!-- Personal Visibility Signatures (Hidden SEO Data) -->
                <div class="mt-16 border-t border-white/5 pt-12 opacity-50">
                    <p class="text-[9px] uppercase tracking-widest text-gray-600 font-bold mb-4">Official Verification</p>
                    <div class="flex flex-wrap gap-x-8 gap-y-2 text-[10px] text-gray-500 font-medium italic">
                        <span>Hasnain Ali</span>
                        <span>Syed Hasnain</span>
                        <span>Hasnain Shah</span>
                        <span>Ahmar Shah</span>
                        <span>CEO HA Tech</span>
                        <span>Founder HA Tech</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
