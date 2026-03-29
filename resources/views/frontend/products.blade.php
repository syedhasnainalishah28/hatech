@extends('layouts.app')

@section('title', 'Products - Premium Digital Assets')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-[#1a0f11] to-[#0a0506] -z-20"></div>
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="reveal-up">
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    Premium Digital <br>
                    <span class="bg-gradient-to-r from-[#d4a574] via-[#e8b44a] to-[#c49a6b] bg-clip-text text-transparent ">Assets</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-10">High-end software, UI kits, and enterprise tools crafted for the elite digital experience.</p>
            </div>
        </div>
    </section>

    <!-- PRODUCTS GRID -->
    <section class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product 1: Nexus UI Kit -->
                <div class="reveal-up group relative">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2.5rem] overflow-hidden hover:bg-white/[0.05] transition-all duration-500 h-full flex flex-col">
                        <div class="relative aspect-video overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-br from-[#d4a574]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="w-full h-full flex items-center justify-center bg-[#1a0f11] text-[#d4a574]">
                                <i data-lucide="layout" class="w-20 h-20 opacity-20 group-hover:scale-110 transition-transform duration-700"></i>
                            </div>
                            <div class="absolute top-4 right-4 z-20">
                                <span class="px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest border border-white/20">
                                    UI KIT
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-[#d4a574] transition-colors leading-tight">
                                Nexus UI Kit
                            </h3>
                            <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                                A luxury Figma design system with 500+ premium components, dark mode layouts, and custom glassmorphism effects.
                            </p>
                            <div class="flex items-center gap-2 mb-8">
                                <span class="text-3xl font-black text-white">$49</span>
                                <span class="text-gray-500 text-sm line-through">$129</span>
                            </div>
                            <div class="mt-auto pt-6 border-t border-white/5 flex flex-col gap-3">
                                <button class="w-full py-4 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold shadow-lg shadow-[#d4a574]/10 hover:shadow-[#d4a574]/20 transition-all">
                                    Purchase Now
                                </button>
                                <button class="w-full py-4 rounded-xl bg-white/5 text-white font-bold hover:bg-white/10 transition-all border border-white/10">
                                    Live Preview
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2: Elite SaaS Boilerplate -->
                <div class="reveal-up group relative" style="transition-delay: 100ms;">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2.5rem] overflow-hidden hover:bg-white/[0.05] transition-all duration-500 h-full flex flex-col">
                        <div class="relative aspect-video overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-br from-[#c49a6b]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="w-full h-full flex items-center justify-center bg-[#1a0f11] text-[#c49a6b]">
                                <i data-lucide="zap-off" class="w-20 h-20 opacity-20 group-hover:scale-110 transition-transform duration-700"></i>
                            </div>
                            <div class="absolute top-4 right-4 z-20">
                                <span class="px-4 py-1.5 rounded-full bg-[#d4a574] text-[#2b0e14] text-[10px] font-bold uppercase tracking-widest">
                                    BOILERPLATE
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-[#d4a574] transition-colors leading-tight">
                                Elite SaaS Boilerplate
                            </h3>
                            <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                                Launch in days with a fully featured Next.js 14 + Laravel starter kit. Includes Stripe, Auth, and Admin Dashboard.
                            </p>
                            <div class="flex items-center gap-2 mb-8">
                                <span class="text-3xl font-black text-white">$149</span>
                                <span class="text-gray-500 text-sm line-through">$299</span>
                            </div>
                            <div class="mt-auto pt-6 border-t border-white/5 flex flex-col gap-3">
                                <button class="w-full py-4 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold shadow-lg shadow-[#d4a574]/10 hover:shadow-[#d4a574]/20 transition-all">
                                    Purchase Now
                                </button>
                                <button class="w-full py-4 rounded-xl bg-white/5 text-white font-bold hover:bg-white/10 transition-all border border-white/10">
                                    Live Preview
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 3: AI Logo Engine -->
                <div class="reveal-up group relative" style="transition-delay: 200ms;">
                    <div class="relative bg-white/[0.03] border border-white/10 rounded-[2.5rem] overflow-hidden hover:bg-white/[0.05] transition-all duration-500 h-full flex flex-col">
                        <div class="relative aspect-video overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-br from-[#e8b44a]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="w-full h-full flex items-center justify-center bg-[#1a0f11] text-[#e8b44a]">
                                <i data-lucide="bot" class="w-20 h-20 opacity-20 group-hover:scale-110 transition-transform duration-700"></i>
                            </div>
                            <div class="absolute top-4 right-4 z-20">
                                <span class="px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest border border-white/20">
                                    SAAS
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-[#d4a574] transition-colors leading-tight">
                                AI Logo Engine
                            </h3>
                            <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                                A custom-trained machine learning model that generates pixel-perfect vector logos for enterprise brands.
                            </p>
                            <div class="flex items-center gap-2 mb-8">
                                <span class="text-3xl font-black text-white">$19/mo</span>
                            </div>
                            <div class="mt-auto pt-6 border-t border-white/5 flex flex-col gap-3">
                                <button class="w-full py-4 rounded-xl bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold shadow-lg shadow-[#d4a574]/10 hover:shadow-[#d4a574]/20 transition-all">
                                    Get Started
                                </button>
                                <button class="w-full py-4 rounded-xl bg-white/5 text-white font-bold hover:bg-white/10 transition-all border border-white/10">
                                    Live Preview
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CUSTOM INQUIRY -->
    <section class="py-20 px-4 border-t border-white/5">
        <div class="max-w-7xl mx-auto rounded-[3.5rem] bg-luxury-mesh p-12 md:p-20 relative overflow-hidden text-center border border-white/5">
            <div class="absolute inset-0 bg-gradient-to-r from-[#d4a574]/5 to-transparent"></div>
            <div class="reveal-up max-w-2xl mx-auto">
                <h2 class="text-4xl font-bold text-white mb-4">Need Something Custom?</h2>
                <p class="text-gray-400 mb-10 text-lg">We build bespoke digital products tailored to your specific business needs. From AI workflows to custom SaaS platforms.</p>
                <a href="{{ url('/contact') }}" class="inline-flex px-10 py-5 rounded-full bg-[#2b0e14] text-[#d4a574] font-bold border border-[#d4a574]/30 hover:bg-[#d4a574] hover:text-[#2b0e14] transition-all shadow-xl">
                    Request Custom Project
                </a>
            </div>
        </div>
    </section>
@endsection
