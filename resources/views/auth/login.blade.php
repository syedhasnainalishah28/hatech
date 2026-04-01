@extends('layouts.app')

@section('title', 'Login | HA Tech Portal')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 pt-32 relative overflow-hidden antialiased">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[20%] left-[20%] w-96 h-96 bg-[#3B0000]/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[20%] right-[20%] w-96 h-96 bg-[#d4a574]/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="reveal-up w-full max-w-md bg-[#1a0f11]/80 backdrop-blur-xl border border-white/10 rounded-3xl p-8 relative z-10 shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black bg-gradient-to-r from-[#d4a574] to-[#e8b44a] bg-clip-text text-transparent mb-2">
                HA Tech Portal
            </h1>
            <p class="text-gray-400 text-sm">Sign in to your account</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3 text-red-400 text-sm">
            <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-widest text-[10px]">Email Address</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-[#d4a574] transition-colors">
                        <i data-lucide="mail" class="h-5 w-5"></i>
                    </div>
                    <input type="email" name="email" required class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all text-white placeholder-gray-500" placeholder="admin@hatech.com" value="{{ old('email') }}">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-widest text-[10px]">Password</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-[#d4a574] transition-colors">
                        <i data-lucide="lock" class="h-5 w-5"></i>
                    </div>
                    <input type="password" name="password" required class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-11 pr-4 focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all text-white placeholder-gray-500" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/10 text-[#d4a574] focus:ring-[#d4a574] cursor-pointer">
                    <span class="text-gray-500 group-hover:text-gray-300 transition-colors">Remember me</span>
                </label>
                <a href="{{ url('/forgot-password') }}" class="text-[#d4a574] hover:text-[#e8b44a] transition-colors">
                    Forgot?
                </a>
            </div>

            <button type="submit" class="w-full relative group py-4 rounded-xl overflow-hidden font-bold mt-6 shadow-xl shadow-[#d4a574]/10 active:scale-[0.98] transition-transform">
                <div class="absolute inset-0 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] transition-transform duration-500 group-hover:scale-105"></div>
                <span class="relative z-10 text-[#2b0e14] flex items-center justify-center gap-2">
                    SIGN IN PORTAL
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </button>

            <div class="mt-8">
                <div class="relative flex items-center justify-center">
                    <div class="w-full border-t border-white/5"></div>
                    <span class="absolute px-3 bg-[#1a0f11] text-[10px] font-bold text-gray-500 uppercase tracking-widest">Or Login With</span>
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

            <p class="text-center text-xs text-gray-500 mt-6 uppercase tracking-widest font-bold">
                Don't have an account? <a href="{{ url('/signup') }}" class="text-white hover:text-[#d4a574] transition-colors border-b border-[#d4a574]/30">Create one</a>
            </p>
        </form>
    </div>
</div>
@endsection
