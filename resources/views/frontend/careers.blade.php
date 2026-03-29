@extends('layouts.app')

@section('title', 'Join Our Team | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    Join Our Team
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Be part of something extraordinary. Build the future with us.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
            @php
                $jobs = [
                    ['title' => 'Senior Full Stack Developer', 'dept' => 'Engineering', 'loc' => 'Remote', 'type' => 'Full-time', 'salary' => '$120k - $180k', 'gradient' => 'from-[#3B0000] to-[#4a1520]'],
                    ['title' => 'UI/UX Designer', 'dept' => 'Design', 'loc' => 'New York', 'type' => 'Full-time', 'salary' => '$90k - $130k', 'gradient' => 'from-[#4a1520] to-[#d4a574]'],
                    ['title' => 'Digital Marketing Manager', 'dept' => 'Marketing', 'loc' => 'Remote', 'type' => 'Full-time', 'salary' => '$80k - $120k', 'gradient' => 'from-[#d4a574] to-[#e8b44a]'],
                    ['title' => 'DevOps Engineer', 'dept' => 'Engineering', 'loc' => 'San Francisco', 'type' => 'Full-time', 'salary' => '$110k - $160k', 'gradient' => 'from-[#e8b44a] to-[#c49a6b]'],
                    ['title' => 'Content Writer', 'dept' => 'Content', 'loc' => 'Remote', 'type' => 'Part-time', 'salary' => '$50k - $70k', 'gradient' => 'from-[#c49a6b] to-[#8b6f47]'],
                    ['title' => 'Product Manager', 'dept' => 'Product', 'loc' => 'Austin', 'type' => 'Full-time', 'salary' => '$100k - $150k', 'gradient' => 'from-[#8b6f47] to-[#3B0000]']
                ];
            @endphp

            @foreach($jobs as $job)
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r {{ $job['gradient'] }} rounded-3xl blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-[#d4a574] transition-colors">{{ $job['title'] }}</h3>
                            <p class="text-[#d4a574] font-semibold">{{ $job['dept'] }}</p>
                        </div>
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-r {{ $job['gradient'] }} flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <i data-lucide="briefcase" class="w-7 h-7"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-4 mb-8">
                        <div class="flex items-center gap-3 text-gray-400">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                <i data-lucide="map-pin" class="w-4 h-4 text-[#d4a574]"></i>
                            </div>
                            <span class="text-sm font-medium">{{ $job['loc'] }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-400">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                <i data-lucide="clock" class="w-4 h-4 text-[#d4a574]"></i>
                            </div>
                            <span class="text-sm font-medium">{{ $job['type'] }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-400">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                <i data-lucide="dollar-sign" class="w-4 h-4 text-[#d4a574]"></i>
                            </div>
                            <span class="text-sm font-medium">{{ $job['salary'] }}</span>
                        </div>
                    </div>

                    <button class="w-full py-4 bg-gradient-to-r {{ $job['gradient'] }} rounded-xl text-white font-bold hover:brightness-110 transition-all shadow-lg active:scale-[0.98]">
                        Apply Now
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="reveal-up text-center">
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000] to-[#d4a574] rounded-3xl blur-2xl opacity-50"></div>
                <div class="relative bg-gradient-to-r from-[#2b0e14] to-[#3d1a0f] border border-white/10 rounded-3xl p-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Don't See Your Role?</h2>
                    <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">We're always looking for talented individuals. Send us your resume!</p>
                    <a href="{{ url('/contact') }}" class="inline-block px-10 py-4 bg-white text-[#2b0e14] font-bold rounded-full hover:bg-gray-100 transition-all duration-300 shadow-xl">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
