@extends('layouts.app')

@section('title', 'Meet Our Team | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    Meet Our Team
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Talented individuals united by passion and innovation
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $team = [
                    ['name' => 'Hasan Ali', 'role' => 'Founder & CEO', 'gradient' => 'from-[#3B0000] to-[#4a1520]'],
                    ['name' => 'Sarah Johnson', 'role' => 'CTO', 'gradient' => 'from-[#4a1520] to-[#d4a574]'],
                    ['name' => 'Mike Chen', 'role' => 'Lead Designer', 'gradient' => 'from-[#d4a574] to-[#e8b44a]'],
                    ['name' => 'Emily Davis', 'role' => 'Head of Marketing', 'gradient' => 'from-[#e8b44a] to-[#c49a6b]'],
                    ['name' => 'Alex Martinez', 'role' => 'Senior Developer', 'gradient' => 'from-[#c49a6b] to-[#8b6f47]'],
                    ['name' => 'Lisa Wang', 'role' => 'Product Manager', 'gradient' => 'from-[#8b6f47] to-[#3B0000]'],
                    ['name' => 'David Kim', 'role' => 'UX Researcher', 'gradient' => 'from-[#3B0000] to-[#d4a574]'],
                    ['name' => 'Rachel Green', 'role' => 'Content Strategist', 'gradient' => 'from-[#d4a574] to-[#e8b44a]']
                ];
            @endphp

            @foreach($team as $member)
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r {{ $member['gradient'] }} rounded-3xl blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-3xl p-6 hover:bg-white/10 transition-all duration-300">
                    <div class="aspect-square bg-gradient-to-br {{ $member['gradient'] }} rounded-2xl mb-6 flex items-center justify-center group-hover:scale-105 transition-transform duration-500 shadow-xl">
                        <div class="text-5xl text-white font-bold tracking-tighter group-hover:scale-110 transition-transform duration-500">
                            @foreach(explode(' ', $member['name']) as $n) {{ substr($n, 0, 1) }} @endforeach
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-[#d4a574] transition-colors">{{ $member['name'] }}</h3>
                    <p class="text-[#d4a574] font-medium text-sm mb-6">{{ $member['role'] }}</p>
                    <div class="flex gap-3 pt-4 border-t border-white/5">
                        <a href="#" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hover:-translate-y-1 text-gray-400 hover:text-white">
                            <i data-lucide="linkedin" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hover:-translate-y-1 text-gray-400 hover:text-white">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hover:-translate-y-1 text-gray-400 hover:text-white">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
