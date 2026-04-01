@extends('layouts.app')

@section('title', 'Sign Up | HA Tech Evolution')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-32 relative overflow-hidden antialiased">
    <div class="absolute inset-x-0 -top-20 -bottom-20 bg-gradient-to-b from-[#3B0000]/20 to-transparent rounded-full blur-3xl"></div>

    <div class="reveal-up relative w-full max-w-md">
        <div class="relative bg-[#0a0506]/80 border border-[#d4a574]/20 rounded-3xl p-8 shadow-2xl overflow-hidden backdrop-blur-xl">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#d4a574]/30 to-transparent"></div>

            <div class="flex justify-center mb-10">
                <a href="{{ url('/') }}" class="flex flex-col items-center gap-2 group">
                    <div class="relative w-16 h-16 group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#d4a574]/20 rounded-2xl blur-lg group-hover:blur-xl transition-all"></div>
                        <div class="relative w-full h-full bg-[#3B0000] border border-[#d4a574]/30 rounded-2xl flex items-center justify-center overflow-hidden">
                            <span class="text-[#d4a574] font-black text-2xl">HA</span>
                        </div>
                    </div>
                </a>
            </div>

            <h2 class="text-3xl font-bold text-white text-center mb-2 tracking-tight">Create Account</h2>
            <p class="text-gray-400 text-center mb-8 text-sm font-medium">Start your digital evolution journey today</p>

            <!-- Account Type Switcher -->
            <div class="flex items-center p-1 bg-[#1a0f11] border border-[#d4a574]/20 rounded-2xl mb-10 shadow-inner">
                <div class="flex-1 text-center py-3 bg-gradient-to-r from-[#3B0000] to-[#2b0e14] border border-[#d4a574]/40 rounded-xl text-white font-black text-xs uppercase tracking-widest shadow-lg">
                    Client Account
                </div>
                <div class="flex-1 text-center py-3 text-gray-500 font-bold text-[10px] uppercase tracking-widest cursor-not-allowed flex flex-col items-center justify-center relative" title="Vendor accounts are not yet available">
                    <span>Seller Account</span>
                    <span class="text-[#d4a574]/70 mt-1" style="font-size: 8px;">(Coming Soon)</span>
                </div>
            </div>

            <form action="{{ url('/signup') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Full Name</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 group-focus-within:text-[#d4a574] transition-colors"></i>
                        <input type="text" name="name" placeholder="Your Name" class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-all" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <div class="relative group">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 group-focus-within:text-[#d4a574] transition-colors"></i>
                        <input type="email" name="email" placeholder="you@example.com" class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-all" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Password</label>
                    <div class="relative group">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 group-focus-within:text-[#d4a574] transition-colors"></i>
                        <input type="password" name="password" placeholder="••••••••" class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-all" required>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#3B0000] to-[#4a1520] border border-[#d4a574]/30 rounded-2xl text-white font-bold hover:border-[#d4a574] transition-all duration-300 shadow-xl active:scale-[0.98]">
                    SIGN UP FAST
                </button>
            </form>

            <div class="mt-8">
                <div class="relative flex items-center justify-center">
                    <div class="w-full border-t border-white/5"></div>
                    <span class="absolute px-3 bg-[#0a0506] text-[10px] font-bold text-gray-500 uppercase tracking-widest">Or Evolution via</span>
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4">
                    <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center gap-3 px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white font-bold hover:bg-white/10 transition-all text-xs group">
                        <img src="{{ asset('images/google-icon.svg') }}" onerror="this.src='https://www.google.com/favicon.ico'" class="w-4 h-4" alt="Google"> Google
                    </a>
                    <a href="{{ route('social.redirect', 'github') }}" class="flex items-center justify-center gap-3 px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white font-bold hover:bg-white/10 transition-all text-xs group">
                        <i data-lucide="github" class="w-4 h-4 text-[#d4a574]"></i> GitHub
                    </a>
                </div>
            </div>

            <p class="mt-10 text-center text-gray-500 text-sm font-medium">
                Join the elite? <a href="{{ url('/login') }}" class="text-[#d4a574] hover:text-white transition-colors font-bold underline underline-offset-4">Login Now</a>
            </p>
        </div>
    </div>
</div>
@endsection
