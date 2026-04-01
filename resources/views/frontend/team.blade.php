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
            @foreach($team as $member)
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r {{ $member->gradient }} rounded-3xl blur-xl opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-3xl p-6 hover:bg-white/10 transition-all duration-300">
                    <div class="aspect-square bg-gradient-to-br {{ $member->gradient }} rounded-2xl mb-6 flex items-center justify-center group-hover:scale-105 transition-transform duration-500 shadow-xl overflow-hidden">
                        @if($member->image_path && file_exists(public_path('storage/' . $member->image_path)))
                            <img src="{{ asset('storage/' . $member->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="text-5xl text-white font-bold tracking-tighter group-hover:scale-110 transition-transform duration-500">
                                @foreach(explode(' ', $member->name) as $n) {{ substr($n, 0, 1) }} @endforeach
                            </div>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1 group-hover:text-[#d4a574] transition-colors">{{ $member->name }}</h3>
                    <p class="text-[#d4a574] font-medium text-sm mb-6">{{ $member->role }}</p>
                    <div class="flex gap-3 pt-4 border-t border-white/5">
                        @if(!empty($member->linkedin_url))
                        <a href="{{ $member->linkedin_url }}" target="{{ $member->linkedin_url == '#' ? '_self' : '_blank' }}" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hover:-translate-y-1 text-gray-400 hover:text-[#0077b5]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        @endif
                        @if(!empty($member->twitter_url))
                        <a href="{{ $member->twitter_url }}" target="{{ $member->twitter_url == '#' ? '_self' : '_blank' }}" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hover:-translate-y-1 text-gray-400 hover:text-white">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        @endif
                        @if(!empty($member->email))
                        <a href="{{ $member->email == '#' ? '#' : 'mailto:'.$member->email }}" class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hover:-translate-y-1 text-gray-400 hover:text-[#ea4335]">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </a>
                        @endif
                        @if(empty($member->linkedin_url) && empty($member->twitter_url) && empty($member->email))
                            <span class="text-xs text-gray-600 font-bold uppercase tracking-widest mt-2">No Links Provided</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
