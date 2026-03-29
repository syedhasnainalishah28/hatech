@extends('frontend.user.layout')

@section('title', 'Profile Settings')
@section('subtitle', 'Manage your account details and password')

@section('content')
<div class="max-w-3xl glass-card rounded-2xl p-6 md:p-8 border border-white/10">
    <form action="{{ route('user.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Basic Info Section -->
        <div>
            <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="user" class="w-5 h-5 text-[#d4a574]"></i> Personal Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-400">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-400">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all">
                </div>
            </div>
        </div>

        <hr class="border-white/10 my-8">

        <!-- Password Section -->
        <div>
            <h3 class="text-lg font-display font-bold text-white mb-4 flex items-center gap-2">
                <i data-lucide="lock" class="w-5 h-5 text-[#d4a574]"></i> Change Password
            </h3>
            <p class="text-sm text-gray-500 mb-6">Leave these fields blank if you don't want to change your password.</p>
            
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-400">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-400">New Password</label>
                        <input type="password" name="password"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-400">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#d4a574] focus:ring-1 focus:ring-[#d4a574] transition-all">
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-white/10 flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-8 py-3 rounded-full bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-bold hover:from-[#e8b44a] hover:to-[#d4a574] transition-all shadow-[0_0_15px_rgba(212,165,116,0.2)]">
                <i data-lucide="save" class="w-4 h-4"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
