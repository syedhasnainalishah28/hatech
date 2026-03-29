@extends('layouts.app')

@section('title', 'Get In Touch | HA Tech')

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    Get In Touch
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Let's discuss your project and bring your vision to life
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="reveal-up relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000]/10 to-[#d4a574]/10 rounded-3xl blur-2xl"></div>
                    <div class="relative bg-white/5 border border-white/10 rounded-3xl p-8">
                        <form action="{{ url('/contact') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm text-gray-300 mb-2 font-medium">Your Name</label>
                                    <input type="text" name="name" placeholder="John Doe" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-gray-500 focus:outline-none focus:border-[#d4a574] transition-colors" required>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-300 mb-2 font-medium">Your Email</label>
                                    <input type="email" name="email" placeholder="you@example.com" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-gray-500 focus:outline-none focus:border-[#d4a574] transition-colors" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-300 mb-2 font-medium">Subject</label>
                                <input type="text" name="subject" placeholder="How can we help you?" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-gray-500 focus:outline-none focus:border-[#d4a574] transition-colors" required>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-300 mb-2 font-medium">Message</label>
                                <textarea name="message" placeholder="Tell us about your project..." rows="6" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder:text-gray-500 focus:outline-none focus:border-[#d4a574] transition-colors resize-none" required></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] rounded-xl text-[#2b0e14] font-bold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all duration-300 flex items-center justify-center gap-2">
                                <i data-lucide="send" class="w-5 h-5"></i>
                                <span>Send Message</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @php
                    $contacts = [
                        ['icon' => 'mail', 'title' => 'Email Us', 'info' => 'hello@hatech.com', 'gradient' => 'from-[#3B0000] to-[#4a1520]'],
                        ['icon' => 'phone', 'title' => 'Call Us', 'info' => '+1 (555) 123-4567', 'gradient' => 'from-[#4a1520] to-[#d4a574]'],
                        ['icon' => 'map-pin', 'title' => 'Visit Us', 'info' => '123 Digital Ave, Tech City', 'gradient' => 'from-[#d4a574] to-[#e8b44a]']
                    ];
                @endphp

                @foreach($contacts as $contact)
                <div class="reveal-up relative">
                    <div class="absolute inset-0 bg-gradient-to-r {{ $contact['gradient'] }} rounded-2xl blur-xl opacity-20"></div>
                    <div class="relative bg-white/5 border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r {{ $contact['gradient'] }} flex items-center justify-center mb-4 text-white">
                            <i data-lucide="{{ $contact['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $contact['title'] }}</h3>
                        <p class="text-gray-400 font-medium">{{ $contact['info'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
