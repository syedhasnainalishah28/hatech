@extends('layouts.app')

@section('title', 'HA Tech | Next Gen Digital Agency')

@section('content')
<main>
    <!-- HERO SECTION -->
    <section class="relative min-h-[90vh] flex items-center justify-center pt-32 pb-20 px-4 overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-gradient-to-br from-[#3B0000]/30 to-transparent rounded-full blur-[120px]"></div>
            <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-gradient-to-tl from-[#d4a574]/10 to-transparent rounded-full blur-[120px]"></div>

            <!-- Box Grid Background (Only in Hero) -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.15] hero-grid" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="boxGridHero" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#boxGridHero)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto relative z-10 w-full text-center">
            <!-- Floating Glass Cards -->
            <div class="absolute inset-0 pointer-events-none hidden lg:block">
                <div class="absolute top-[10%] left-[-5%] p-4 rounded-2xl bg-[#1a0f11]/80 border border-white/10 shadow-2xl flex items-center gap-3 transform -rotate-6 transition-transform hover:scale-105 duration-500">
                    <div class="w-10 h-10 rounded-full bg-[#d4a574]/20 flex items-center justify-center text-[#d4a574]">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                    </div>
                    <div class="text-left">
                        <div class="text-white font-bold text-sm">Ultra Fast</div>
                        <div class="text-gray-400 text-xs">60fps Animation</div>
                    </div>
                </div>

                <div class="absolute bottom-[20%] right-[-5%] p-4 rounded-2xl bg-[#1a0f11]/80 border border-white/10 shadow-2xl flex items-center gap-3 transform rotate-3 transition-transform hover:scale-105 duration-500">
                    <div class="w-10 h-10 rounded-full bg-[#3B0000]/40 flex items-center justify-center text-[#d4a574]">
                        <i data-lucide="shield" class="w-5 h-5"></i>
                    </div>
                    <div class="text-left">
                        <div class="text-white font-bold text-sm">Secure Build</div>
                        <div class="text-gray-400 text-xs">Enterprise Ready</div>
                    </div>
                </div>
            </div>

            <!-- Floating Badge -->
            <div class="reveal-up inline-flex items-center gap-2 px-6 py-2 bg-white/5 border border-[#d4a574]/20 rounded-full mb-8 group hover:bg-[#d4a574]/10 transition-colors duration-500">
                <i data-lucide="sparkles" class="w-4 h-4 text-[#d4a574] animate-pulse"></i>
                <span class="text-xs font-bold uppercase tracking-[0.3em] text-[#d4a574]">Next Gen Digital Agency</span>
            </div>

            <!-- Main Title -->
            <h1 class="reveal-up text-5xl md:text-7xl lg:text-8xl font-black mb-8 leading-[0.95] tracking-tighter overflow-visible">
                <span class="inline-block bg-gradient-to-b from-white to-gray-400 bg-clip-text text-transparent">BUILD YOUR</span>
                <br>
                <span class="relative inline-block mt-2 bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent  overflow-visible">
                    DIGITAL EMPIRE
                    <div class="absolute -bottom-2 left-0 h-1 bg-gradient-to-r from-[#d4a574] to-transparent opacity-50 w-full"></div>
                </span>
            </h1>

            <p class="reveal-up text-lg md:text-xl text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                We don't follow trends, we set them. HA Tech bridges the gap between raw innovation and enterprise-grade execution.
            </p>

            <!-- Buttons -->
            <div class="reveal-up flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ url('/signup') }}" class="group relative px-10 py-5 overflow-hidden rounded-2xl transform hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#d4a574] to-[#e8b44a]"></div>
                    <div class="relative z-10 flex items-center gap-2 text-[#2b0e14] font-black uppercase tracking-widest text-sm">
                        <span>Start Your Journey</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <a href="{{ url('/portfolio') }}" class="group relative px-10 py-5 overflow-hidden rounded-2xl border border-white/10 hover:border-[#d4a574]/40 transition-all">
                    <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10 flex items-center gap-2 text-white font-bold uppercase tracking-widest text-sm">
                        <span>View Our Work</span>
                        <i data-lucide="globe" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50">
            <span class="text-[10px] uppercase tracking-[0.4em] text-gray-500 font-bold">Scroll</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-[#d4a574] to-transparent"></div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="relative py-20 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="reveal-up bg-white/5 border border-[#d4a574]/20 rounded-2xl p-6 hover:bg-white/10 transition-all group">
                <i data-lucide="users" class="w-8 h-8 text-[#d4a574] mb-3"></i>
                <div class="text-3xl font-bold bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent">500+</div>
                <div class="text-gray-400 text-sm">Happy Clients</div>
            </div>
            <div class="reveal-up bg-white/5 border border-[#d4a574]/20 rounded-2xl p-6 hover:bg-white/10 transition-all group">
                <i data-lucide="award" class="w-8 h-8 text-[#d4a574] mb-3"></i>
                <div class="text-3xl font-bold bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent">1000+</div>
                <div class="text-gray-400 text-sm">Projects Done</div>
            </div>
            <div class="reveal-up bg-white/5 border border-[#d4a574]/20 rounded-2xl p-6 hover:bg-white/10 transition-all group">
                <i data-lucide="star" class="w-8 h-8 text-[#d4a574] mb-3"></i>
                <div class="text-3xl font-bold bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent">98%</div>
                <div class="text-gray-400 text-sm">Satisfaction</div>
            </div>
            <div class="reveal-up bg-white/5 border border-[#d4a574]/20 rounded-2xl p-6 hover:bg-white/10 transition-all group">
                <i data-lucide="trending-up" class="w-8 h-8 text-[#d4a574] mb-3"></i>
                <div class="text-3xl font-bold bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent">5X</div>
                <div class="text-gray-400 text-sm">ROI Average</div>
            </div>
        </div>
    </section>

    <!-- PREMIUM ABOUT SECTION -->
    <section class="relative py-24 px-4 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Content Left -->
                <div class="reveal-up order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/5 border border-[#d4a574]/20 rounded-full mb-6">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#d4a574]">About Us</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black mb-8 leading-tight">
                        Elevating Your <br>
                        <span class="bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent ">Digital Presence</span> <br>
                        with HA Tech 2.0
                    </h2>
                    <div class="space-y-6 text-lg text-gray-400 leading-relaxed">
                        <p>
                            For over a decade, <span class="text-white font-semibold">HA Tech</span> has been at the forefront of digital transformation, bridging the gap between raw innovation and enterprise-grade execution worldwide.
                        </p>
                        <p>
                            Now with <span class="text-[#d4a574] font-bold">HA Tech 2.0</span>, we are taking that mission further — combining AI-driven methodologies with human creativity to deliver personalized, faster, and measurable growth results for our partners.
                        </p>
                        <p class="text-sm border-l-2 border-[#d4a574]/30 pl-6 py-2 italic">
                            "The era of generic digital strategies is over. We build architectures that adapt, evolve, and dominate."
                        </p>
                    </div>
                    <div class="mt-10 flex items-center gap-8">
                        <a href="{{ url('/about') }}" class="inline-flex items-center gap-2 text-[#d4a574] font-bold hover:text-[#e8b44a] transition-all group">
                            <span>LEARN OUR STORY</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <!-- Image Right -->
                <div class="reveal-up order-1 lg:order-2 relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#d4a574]/20 to-transparent rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                        <img src="{{ asset('images/about-hero.png') }}" alt="HA Tech Premium Office" class="w-full h-auto transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] via-transparent to-transparent opacity-60"></div>
                        <!-- Decorative Stats Overlay -->
                        <div class="absolute bottom-6 left-6 right-6 p-6 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-2xl font-bold text-white">#BanoDigitalExpert</div>
                                    <div class="text-xs text-[#d4a574] uppercase tracking-widest font-bold">HA Tech Movement</div>
                                </div>
                                <div class="w-12 h-12 rounded-xl bg-[#d4a574]/20 flex items-center justify-center text-[#d4a574]">
                                    <i data-lucide="zap" class="w-6 h-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="relative py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 reveal-up">
                <h2 class="text-4xl md:text-6xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent">Our Services</span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Cutting-edge solutions designed for the future</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1: Custom Software -->
                <div class="reveal-up group relative">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition-all duration-500 h-full text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#d4a574] to-[#e8b44a] flex items-center justify-center mb-8 text-[#2b0e14] transform group-hover:rotate-6 transition-transform duration-500 shadow-lg shadow-[#d4a574]/20">
                            <i data-lucide="code-2" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Custom Software</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">Tailored enterprise solutions built with scalable architecture and clean, efficient code.</p>
                        <div class="mt-auto w-full">
                            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-xl hover:scale-[1.02] transition-all shadow-lg shadow-[#d4a574]/20 active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 2: AI & Machine Learning -->
                <div class="reveal-up group relative" style="transition-delay: 100ms;">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition-all duration-500 h-full text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#e8b44a] to-[#c49a6b] flex items-center justify-center mb-8 text-[#2b0e14] transform group-hover:-rotate-6 transition-transform duration-500 shadow-lg shadow-[#e8b44a]/20">
                            <i data-lucide="brain-circuit" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">AI & Machine Learning</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">Predictive analytics and intelligent automation to revolutionize your business decision-making.</p>
                        <div class="mt-auto w-full">
                            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-xl hover:scale-[1.02] transition-all shadow-lg shadow-[#d4a574]/20 active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 3: Cloud & DevOps -->
                <div class="reveal-up group relative" style="transition-delay: 200ms;">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition-all duration-500 h-full text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#c49a6b] to-[#c14a2b] flex items-center justify-center mb-8 text-[#2b0e14] transform group-hover:rotate-6 transition-transform duration-500 shadow-lg shadow-[#c49a6b]/20">
                            <i data-lucide="cloud-lightning" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Cloud & DevOps</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">Zero-downtime deployments and enterprise-grade infrastructure scaling for global demands.</p>
                        <div class="mt-auto w-full">
                            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-xl hover:scale-[1.02] transition-all shadow-lg shadow-[#d4a574]/20 active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 4: Cyber Security -->
                <div class="reveal-up group relative">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition-all duration-500 h-full text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#c14a2b] to-[#d4a574] flex items-center justify-center mb-8 text-white transform group-hover:-rotate-6 transition-transform duration-500 shadow-lg shadow-[#c14a2b]/20">
                            <i data-lucide="shield-check" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Cyber Security</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">Protecting your digital assets with advanced threat detection and rigorous security auditing.</p>
                        <div class="mt-auto w-full">
                            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-xl hover:scale-[1.02] transition-all shadow-lg shadow-[#d4a574]/20 active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 5: Digital Branding -->
                <div class="reveal-up group relative" style="transition-delay: 100ms;">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition-all duration-500 h-full text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#d4a574] to-[#f4d393] flex items-center justify-center mb-8 text-[#2b0e14] transform group-hover:rotate-6 transition-transform duration-500 shadow-lg shadow-[#d4a574]/20">
                            <i data-lucide="fingerprint" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Digital Branding</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">Creating unique, high-impact brand identities that resonate with the Gen Z digital landscape.</p>
                        <div class="mt-auto w-full">
                            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-xl hover:scale-[1.02] transition-all shadow-lg shadow-[#d4a574]/20 active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Service 6: ERP Solutions -->
                <div class="reveal-up group relative" style="transition-delay: 200ms;">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2rem] p-8 hover:bg-white/[0.07] transition-all duration-500 h-full text-center flex flex-col items-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#f4d393] to-[#d4a574] flex items-center justify-center mb-8 text-[#2b0e14] transform group-hover:-rotate-6 transition-transform duration-500 shadow-lg shadow-[#f4d393]/20">
                            <i data-lucide="layout-grid" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">ERP Solutions</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">Synchronize your entire operation with a unified enterprise platform for seamless management.</p>
                        <div class="mt-auto w-full">
                            <a href="{{ url('/services') }}" class="inline-flex items-center justify-center w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold rounded-xl hover:scale-[1.02] transition-all shadow-lg shadow-[#d4a574]/20 active:scale-95">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INNOVATION DASHBOARD SECTION -->
    <section class="relative py-24 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-[#0a0506] -z-20"></div>
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Content -->
                <div class="reveal-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#d4a574]/10 border border-[#d4a574]/20 mb-6">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#d4a574] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#d4a574]"></span>
                        </span>
                        <span class="text-[#d4a574] text-xs font-bold uppercase tracking-widest">HA Tech Execution Engine</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black mb-8 leading-tight">
                        The Science of <br>
                        <span class="bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent  text-5xl md:text-7xl">Precision Execution</span>
                    </h2>
                    <p class="text-xl text-gray-400 mb-10 leading-relaxed max-w-xl">
                        Our proprietary system ensures every project is engineered for elite performance. From strategic mapping to automated quality assurance, we deliver with 100% precision.
                    </p>
                    <div class="space-y-6 mb-10">
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-[#d4a574]/20 transition-all">
                                <i data-lucide="target" class="w-6 h-6 text-[#d4a574]"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Strategic Goal Alignment</h4>
                                <p class="text-sm text-gray-500">Aligning tech assets with your high-level business objectives.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-[#d4a574]/20 transition-all">
                                <i data-lucide="settings-2" class="w-6 h-6 text-[#d4a574]"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Precision Engineering Pipeline</h4>
                                <p class="text-sm text-gray-500">Automated workflows that eliminate human error and lag.</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/services') }}" class="group inline-flex items-center gap-3 px-8 py-4 rounded-full bg-white/5 border border-white/10 text-white font-bold hover:bg-[#d4a574] hover:text-[#2b0e14] transition-all">
                        View Our Production Logic
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- System Mockup Visual -->
                <div class="reveal-up relative">
                    <!-- Background Glow -->
                    <div class="absolute -inset-10 bg-[#d4a574]/5 blur-[80px] -z-10 animate-pulse"></div>
                    
                    <!-- Premium System Image -->
                    <div class="relative bg-[#1a0f11] border border-white/10 rounded-[3rem] p-3 shadow-2xl overflow-hidden aspect-[4/3] group/img">
                        <img src="{{ asset('images/ha_tech_system_mockup.png') }}" alt="HA Tech System Console" class="w-full h-full object-cover rounded-[2.5rem] brightness-75 group-hover/img:scale-105 transition-transform duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0506] via-transparent to-transparent opacity-60"></div>
                        
                        <!-- HUD Overlay Elements -->
                        <div class="absolute top-8 left-8 flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest bg-black/40 backdrop-blur-md px-3 py-1 rounded-full border border-white/10">System Status: Optimal</span>
                        </div>
                    </div>

                    <!-- FLOATING ELEMENTS -->
                    
                    <!-- Performance Circle (Top Left) -->
                    <div class="absolute -top-10 -left-10 w-44 h-44 rounded-full bg-white/10 backdrop-blur-2xl border border-white/20 shadow-2xl flex flex-col items-center justify-center animate-bounce-slow z-20 group">
                        <div class="relative w-24 h-24 mb-2">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle cx="48" cy="48" r="40" stroke="currentColor" stroke-width="8" fill="transparent" class="text-white/5"></circle>
                                <circle cx="48" cy="48" r="40" stroke="currentColor" stroke-width="8" fill="transparent" stroke-dasharray="251.2" stroke-dashoffset="0" class="text-[#d4a574] group-hover:stroke-[10px] transition-all duration-500"></circle>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl font-black text-white">100%</span>
                            </div>
                        </div>
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Logic Accuracy</span>
                    </div>

                    <!-- Tech Stack Popup (Bottom Right) -->
                    <div class="absolute -bottom-10 -right-10 w-64 bg-gradient-to-br from-[#1a0f11] to-black border border-[#d4a574]/30 rounded-3xl p-6 shadow-2xl z-20 animate-float-slow">
                        <h5 class="text-xs text-[#d4a574] font-bold uppercase tracking-widest mb-4">HA Tech Ecosystem</h5>
                        <div class="flex flex-wrap gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-[#d4a574]/20 transition-colors" title="Engine">
                                <i data-lucide="gem" class="w-5 h-5 text-gray-300"></i>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-[#d4a574]/20 transition-colors" title="Logic">
                                <i data-lucide="binary" class="w-5 h-5 text-gray-300"></i>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-[#d4a574]/20 transition-colors" title="Execution">
                                <i data-lucide="workflow" class="w-5 h-5 text-gray-300"></i>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-[#d4a574]/20 transition-colors" title="Stability">
                                <i data-lucide="activity" class="w-5 h-5 text-gray-300"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-white/5">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-gray-500 font-bold uppercase">Uptime Score</span>
                                <span class="text-[10px] text-green-500 font-black">STABLE</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Decorative Dots -->
                    <div class="absolute top-1/2 -right-4 w-8 h-8 rounded-full bg-[#d4a574] blur-xl opacity-30 animate-pulse"></div>
                    <div class="absolute -bottom-2 lg:left-1/4 w-12 h-12 rounded-full bg-[#e8b44a] blur-2xl opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section class="relative py-20 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent">Why Choose Us?</span>
                </h2>
                <p class="text-xl text-gray-400 mb-8">We don't just build products, we build relationships and deliver excellence at every step.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3"><i data-lucide="check-circle" class="w-5 h-5 text-[#d4a574]"></i><span class="text-gray-300">24/7 Premium Support</span></div>
                    <div class="flex items-center gap-3"><i data-lucide="check-circle" class="w-5 h-5 text-[#d4a574]"></i><span class="text-gray-300">Scalable Solutions</span></div>
                    <div class="flex items-center gap-3"><i data-lucide="check-circle" class="w-5 h-5 text-[#d4a574]"></i><span class="text-gray-300">Fast Turnaround Time</span></div>
                    <div class="flex items-center gap-3"><i data-lucide="check-circle" class="w-5 h-5 text-[#d4a574]"></i><span class="text-gray-300">Tailored Strategy</span></div>
                </div>
            </div>
            <div class="reveal-up relative">
                <div class="absolute inset-0 bg-[#d4a574]/10 rounded-3xl blur-2xl opacity-10"></div>
                <div class="relative bg-white/5 border border-[#d4a574]/20 rounded-3xl p-8 space-y-8 shadow-2xl">
                    <!-- Card 1 -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] flex items-center justify-center text-[#2b0e14] group-hover:scale-110 transition-transform duration-300 flex-shrink-0 aspect-square">
                            <i data-lucide="zap" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-2">Lightning Fast Delivery</h4>
                            <p class="text-gray-400 text-sm">We understand the importance of speed. Get your projects delivered at record pace without compromising on architecture or code quality.</p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#e8b44a] to-[#c49a6b] flex items-center justify-center text-[#2b0e14] group-hover:scale-110 transition-transform duration-300 flex-shrink-0 aspect-square">
                            <i data-lucide="star" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-2">Premium Quality Assurance</h4>
                            <p class="text-gray-400 text-sm">Every pixel and line of code is cross-verified against elite industry standards to ensure a flawless, future-proof digital product.</p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#c49a6b] to-[#8b6f47] flex items-center justify-center text-[#2b0e14] group-hover:scale-110 transition-transform duration-300 flex-shrink-0 aspect-square">
                            <i data-lucide="users" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-2">Elite Dedicated Team</h4>
                            <p class="text-gray-400 text-sm">Work directly with a team of senior technologists and creators who treat your business objectives as their own mission.</p>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="flex items-start gap-4 group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-[#8b6f47] to-[#d4a574] flex items-center justify-center text-[#2b0e14] group-hover:scale-110 transition-transform duration-300 flex-shrink-0 aspect-square">
                            <i data-lucide="cpu" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-white mb-2">Strategic AI Integration</h4>
                            <p class="text-gray-400 text-sm">We leverage next-gen AI methodologies to automate workflows and optimize user experiences for maximum measurable ROI.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ELITE PORTFOLIO SECTION -->
    <section id="portfolio" class="relative py-32 px-4 overflow-hidden bg-luxury-mesh">
        <!-- Accent Glows -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#d4a574]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#3B0000]/20 rounded-full blur-[100px] pointer-events-none"></div>

        <style>
            @media (max-width: 768px) {
                .mobile-carousel {
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                }
                .mobile-carousel::-webkit-scrollbar {
                    display: none;
                }
            }
        </style>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-8 reveal-up">
                <div class="max-w-2xl">
                    <span class="text-[#d4a574] text-xs font-black uppercase tracking-[0.6em] mb-4 block">Execution Quality</span>
                    <h2 class="text-5xl md:text-7xl font-black mb-6 leading-none">
                        <span class="bg-gradient-to-r from-white via-gray-300 to-gray-600 bg-clip-text text-transparent">THE ELITE EXHIBIT</span>
                    </h2>
                    <p class="text-xl text-gray-400">Architecting digital infrastructure for the world's most ambitious brands.</p>
                </div>
                <div class="hidden md:block pb-2">
                    <div class="w-32 h-[2px] bg-gradient-to-r from-[#d4a574] to-transparent"></div>
                </div>
            </div>

            <div class="flex overflow-x-auto md:grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-10 mobile-carousel snap-x snap-mandatory scroll-smooth pb-8 -mx-4 px-4 md:mx-0 md:px-0">
                @foreach($portfolios as $index => $portfolio)
                <!-- Project {{ $index + 1 }} -->
                <div class="reveal-up group relative aspect-[4/5] rounded-[32px] overflow-hidden border border-white/5 bg-[#1a0f11] shadow-2xl min-w-[85vw] md:min-w-0 snap-center {{ $index % 3 == 1 ? 'md:translate-y-12' : '' }}">
                    @php
                        $imagePath = 'storage/' . $portfolio->image_path;
                        $displayImage = (file_exists(public_path($imagePath)) && !empty($portfolio->image_path)) 
                                        ? asset($imagePath) 
                                        : asset('images/ha_tech_system_mockup.png');
                    @endphp
                    <img src="{{ $displayImage }}" alt="{{ $portfolio->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                    
                    <div class="absolute inset-0 p-8 flex flex-col justify-end translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full bg-[#d4a574]/20 border border-[#d4a574]/30 text-[#d4a574] text-[10px] font-black uppercase tracking-widest">{{ $portfolio->category }}</span>
                            <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-white/50 text-[10px] font-bold uppercase tracking-widest">{{ $portfolio->year }}</span>
                        </div>
                        <h4 class="text-3xl font-black text-white mb-2 uppercase tracking-tight">{{ $portfolio->title }}</h4>
                        <p class="text-gray-400 text-sm mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ $portfolio->description }}</p>
                        
                        <a href="{{ route('portfolio.show', $portfolio->slug ?? $portfolio->id) }}" class="w-fit flex items-center gap-2 text-[#d4a574] font-black text-xs uppercase tracking-[0.2em] group/btn">
                            <span>VIEW CASE STUDY</span>
                            <div class="w-8 h-8 rounded-full border border-[#d4a574]/30 flex items-center justify-center group-hover/btn:bg-[#d4a574] group-hover/btn:text-[#2B0E14] transition-all">
                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                            </div>
                        </a>
                    </div>
                    
                    <div class="absolute inset-0 border-2 border-[#d4a574]/0 group-hover:border-[#d4a574]/40 rounded-[32px] transition-all duration-500 pointer-events-none"></div>
                </div>
                @endforeach
            </div>

            <!-- Footer CTA for Portfolio -->
            <div class="mt-24 text-center reveal-up">
                <a href="{{ url('/marketplace') }}" class="inline-flex items-center gap-4 group">
                    <span class="text-gray-500 font-bold uppercase tracking-[0.4em] transition-all group-hover:text-white">EXPLORE FULL ARCHIVE</span>
                    <div class="w-12 h-[1px] bg-[#d4a574] group-hover:w-20 transition-all duration-500"></div>
                </a>
            </div>
        </div>
    </section>

    <!-- REVIEWS SECTION -->
    <section class="relative py-24 px-4 bg-luxury-mesh overflow-hidden">
        <div class="absolute inset-0 pointer-events-none opacity-20">
            <div class="absolute top-1/2 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#d4a574] to-transparent"></div>
        </div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16 reveal-up">
                <span class="text-[#d4a574] text-xs font-black uppercase tracking-[0.4em] mb-4 block">Social Proof</span>
                <h2 class="text-4xl md:text-6xl font-black mb-6">
                    <span class="bg-gradient-to-r from-white via-gray-300 to-gray-500 bg-clip-text text-transparent">TESTIMONIALS</span>
                </h2>
                <div class="w-24 h-1 bg-[#d4a574] mx-auto opacity-50"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <!-- Review -->
                <div class="reveal-up border border-white/5 rounded-3xl p-8 bg-white/5 hover:bg-white/[0.07] transition-all duration-500 group">
                    <div class="flex gap-1 mb-6">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                        <i data-lucide="star" class="w-4 h-4 text-[#d4a574] fill-[#d4a574]"></i>
                        @endfor
                    </div>
                    <p class="text-gray-300 italic mb-8 leading-relaxed">"{{ $testimonial->content }}"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden border border-[#d4a574]/30">
                            @if($testimonial->avatar_path)
                            <img src="{{ asset('storage/' . $testimonial->avatar_path) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-[#d4a574]/10 flex items-center justify-center text-[#d4a574] font-bold">
                                {{ substr($testimonial->name, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-white font-bold">{{ $testimonial->name }}</h4>
                            <p class="text-gray-500 text-xs uppercase tracking-widest">{{ $testimonial->role }} @ {{ $testimonial->company }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Submit Review Prompt -->
            <div class="mt-16 text-center reveal-up">
                <div class="inline-block p-1 rounded-full bg-gradient-to-r from-transparent via-[#d4a574]/20 to-transparent">
                    <button onclick="toggleReviewModal(true)" class="px-8 py-4 rounded-full bg-[#d4a574] text-black font-black text-xs uppercase tracking-[0.2em] hover:scale-105 transition-transform">
                        Add Your Review
                    </button>
                </div>
                
                @if(session('success'))
                    <p class="text-emerald-400 font-bold text-sm mt-4">{{ session('success') }}</p>
                @endif
            </div>

@push('modals')
            <!-- Review Form Modal (Glassmorphism) -->
            <div id="review-form-modal" class="hidden fixed inset-0 z-[110] flex items-center justify-center p-6 bg-black/60 will-change-[opacity,visibility] transition-all duration-300">
                <div class="glass-card max-w-2xl w-full p-12 relative overflow-y-auto max-h-[90vh] shadow-[0_0_50px_rgba(0,0,0,0.5)]">
                    <button onclick="toggleReviewModal(false)" class="absolute top-8 right-8 text-gray-500 hover:text-white transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    
                    <h3 class="text-3xl font-black uppercase tracking-tighter mb-8 text-white">Share Your Experience</h3>
                    
                    <form action="{{ route('testimonials.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Your Name</label>
                                <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-[#d4a574] outline-none transition-all font-bold text-white">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Role / Company</label>
                                <input type="text" name="role" placeholder="e.g. CEO @ TechFlow" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-[#d4a574] outline-none transition-all font-bold text-white">
                            </div>
                        </div>
                        
                        <div class="space-y-2 text-left">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Rating</label>
                            <select name="rating" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-[#d4a574] outline-none transition-all font-bold text-white">
                                <option value="5" class="bg-black text-white">5 Stars - Exceptional</option>
                                <option value="4" class="bg-black text-white">4 Stars - Great</option>
                                <option value="3" class="bg-black text-white">3 Stars - Good</option>
                            </select>
                        </div>

                        <div class="space-y-2 text-left">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#d4a574]">Review Content</label>
                            <textarea name="content" required rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 focus:border-[#d4a574] outline-none transition-all font-bold text-white"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#d4a574] text-black py-4 rounded-xl font-black text-xs uppercase tracking-[0.2em] hover:scale-[1.02] transition-transform">
                            Submit Review
                        </button>
                    </form>
                </div>
            </div>
@endpush
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="relative py-24 px-4 overflow-hidden border-t border-white/5">
        <div class="absolute inset-0 pointer-events-none overflow-hidden blur-[80px] opacity-[0.07]">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-[#d4a574] rounded-full text-transparent">.</div>
            <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-[#3B0000] rounded-full text-transparent">.</div>
        </div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-16 reveal-up">
                <span class="text-[#d4a574] text-xs font-black uppercase tracking-[0.4em] mb-4 block">Knowledge Base</span>
                <h2 class="text-4xl md:text-6xl font-black mb-6">
                    <span class="bg-gradient-to-r from-white via-gray-300 to-gray-500 bg-clip-text text-transparent">F.A.Q</span>
                </h2>
                <p class="text-gray-400">Everything you need to know about our elite execution engine.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="reveal-up faq-item group border border-white/5 rounded-2xl bg-white/5 overflow-hidden transition-[border-color,background-color] duration-300 hover:border-[#d4a574]/30 hover:bg-white/[0.07]">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between faq-trigger">
                        <span class="text-lg font-bold text-white group-hover:text-[#d4a574] transition-colors">What makes HA Tech different from other agencies?</span>
                        <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-[#d4a574] transition-transform duration-300 faq-icon">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </div>
                    </button>
                    <div class="max-h-0 overflow-hidden transition-[max-height,opacity] duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] faq-content px-8 opacity-0" style="will-change: max-height;">
                        <p class="pb-6 text-gray-400 leading-relaxed">We prioritize "Precision Execution" and a luxury aesthetic over generic solutions. Every project is a bespoke masterpiece built with a focus on high-end performance, scalability, and premium branding.</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="reveal-up faq-item group border border-white/5 rounded-2xl bg-white/5 overflow-hidden transition-[border-color,background-color] duration-300 hover:border-[#d4a574]/30 hover:bg-white/[0.07]">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between faq-trigger">
                        <span class="text-lg font-bold text-white group-hover:text-[#d4a574] transition-colors">How long does a typical project take?</span>
                        <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-[#d4a574] transition-transform duration-300 faq-icon">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </div>
                    </button>
                    <div class="max-h-0 overflow-hidden transition-[max-height,opacity] duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] faq-content px-8 opacity-0" style="will-change: max-height;">
                        <p class="pb-6 text-gray-400 leading-relaxed">Depending on complexity, most high-end digital solutions take anywhere from 4 to 8 weeks. We emphasize quality over speed, but our elite workflow ensures we meet deadlines without compromising on architecture.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="reveal-up faq-item group border border-white/5 rounded-2xl bg-white/5 overflow-hidden transition-[border-color,background-color] duration-300 hover:border-[#d4a574]/30 hover:bg-white/[0.07]">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between faq-trigger">
                        <span class="text-lg font-bold text-white group-hover:text-[#d4a574] transition-colors">Do you provide ongoing support after deployment?</span>
                        <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-[#d4a574] transition-transform duration-300 faq-icon">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </div>
                    </button>
                    <div class="max-h-0 overflow-hidden transition-[max-height,opacity] duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] faq-content px-8 opacity-0" style="will-change: max-height;">
                        <p class="pb-6 text-gray-400 leading-relaxed">Yes, we offer elite maintenance packages to ensure your digital empire remains future-proof, secure, and hyper-optimized for evolving market demands.</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="reveal-up faq-item group border border-white/5 rounded-2xl bg-white/5 overflow-hidden transition-all duration-300 hover:border-[#d4a574]/30 hover:bg-white/[0.07]">
                    <button class="w-full px-8 py-6 text-left flex items-center justify-between faq-trigger">
                        <span class="text-lg font-bold text-white group-hover:text-[#d4a574] transition-colors">What industries do you specialize in?</span>
                        <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center text-[#d4a574] transition-transform duration-300 faq-icon">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </div>
                    </button>
                    <div class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out faq-content px-8">
                        <p class="pb-6 text-gray-400 leading-relaxed">We excel in high-tech startups, luxury brands, complex ERP ecosystems, and AI-driven enterprise solutions that require a sophisticated digital presence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION (Minimalist Premium) -->
    <section class="relative py-16 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="reveal-up relative overflow-hidden bg-[#111111] border border-white/5 rounded-3xl p-12 md:p-16 text-center shadow-2xl">
                <h2 class="text-4xl md:text-4xl font-black mb-6 text-white tracking-tight uppercase">
                    Ready to transform your business?
                </h2>
                
                <p class="text-lg text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Join the forward-thinking companies that trust HA Tech to build their digital future through precision execution.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="{{ url('/contact') }}" class="px-10 py-4 bg-[#d4a574] text-black font-black rounded-full hover:scale-105 transition-all shadow-xl flex items-center gap-2 group/btn">
                        <span>START A PROJECT</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ url('/marketplace') }}" class="px-10 py-4 border border-white/10 text-white rounded-full hover:bg-white/5 transition-all font-bold">SCHEDULE A CALL</a>
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    function toggleReviewModal(show) {
        const modal = document.getElementById('review-form-modal');
        const content = document.getElementById('main-content');
        const overlay = document.getElementById('modal-overlay');
        if (show) {
            modal.classList.remove('hidden');
            content.classList.add('modal-active');
            overlay.classList.add('active');
        } else {
            modal.classList.add('hidden');
            content.classList.remove('modal-active');
            overlay.classList.remove('active');
        }
    }
</script>
@endpush
@endsection
