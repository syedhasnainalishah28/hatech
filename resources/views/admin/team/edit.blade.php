@extends('layouts.admin')

@section('page_title', 'Edit Team Member')

@section('content')
<div class="glass-card p-8 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h4 class="text-2xl font-black uppercase tracking-tight mb-1">Edit Member</h4>
            <p class="text-xs text-gray-500 uppercase tracking-widest">{{ $member->name }}</p>
        </div>
        <a href="{{ route('admin.team') }}" class="text-gray-400 hover:text-[#d4a574] transition-colors flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back
        </a>
    </div>

    @if($errors->any())
    <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 rounded-xl">
        <div class="flex items-center gap-3 text-rose-400 font-bold mb-2 text-sm">
            <i data-lucide="alert-triangle" class="w-4 h-4"></i> Please fix the errors below
        </div>
        <ul class="list-disc list-inside text-rose-400/80 text-xs">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.team.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('POST')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Role / Job Title *</label>
                <input type="text" name="role" value="{{ old('role', $member->role) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>
            
            <!-- Email -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Email <span class="text-gray-500 lowercase">(optional, or # to just show icon)</span></label>
                <input type="text" name="email" value="{{ old('email', $member->email) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Order Index *</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order) }}" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- LinkedIn -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">LinkedIn URL <span class="text-gray-500 lowercase">(optional, or # to just show icon)</span></label>
                <input type="text" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>

            <!-- Twitter -->
            <div>
                <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Twitter/X URL <span class="text-gray-500 lowercase">(optional, or # to just show icon)</span></label>
                <input type="text" name="twitter_url" value="{{ old('twitter_url', $member->twitter_url) }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#d4a574] transition-colors">
            </div>
        </div>

        <div class="border-t border-white/5 pt-6 mt-6">
            <h4 class="text-lg font-bold text-white mb-4">Design Settings</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image -->
                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Profile Image <span class="text-gray-500 lowercase">(optional)</span></label>
                    @if($member->image_path)
                    <div class="mb-4 flex items-center gap-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden border border-white/10 shrink-0 bg-gradient-to-br {{ $member->gradient }}">
                            <img src="{{ asset('storage/' . $member->image_path) }}" class="w-full h-full object-cover">
                        </div>
                        <span class="text-xs text-emerald-400 font-bold tracking-widest uppercase">Has custom image</span>
                    </div>
                    @endif
                    <input type="file" name="image_path" accept="image/*" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#d4a574] file:text-black hover:file:bg-[#e8b44a] focus:outline-none focus:border-[#d4a574] transition-colors cursor-pointer">
                    <p class="text-[10px] text-gray-500 mt-2 ml-1">Leave blank to keep existing image or initial logic.</p>
                </div>

                <!-- Gradient Style -->
                <div>
                    <label class="block text-xs font-bold text-[#d4a574] uppercase tracking-widest mb-2 ml-1">Gradient Theme *</label>
                    <div class="relative">
                        <select name="gradient" required class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 appearance-none text-white focus:outline-none focus:border-[#d4a574] transition-colors cursor-pointer" style="background-color: #1a0f11;">
                            <option value="from-[#3B0000] to-[#4a1520]" {{ $member->gradient == 'from-[#3B0000] to-[#4a1520]' ? 'selected' : '' }}>Red to Dark Red (Founder Style)</option>
                            <option value="from-[#4a1520] to-[#d4a574]" {{ $member->gradient == 'from-[#4a1520] to-[#d4a574]' ? 'selected' : '' }}>Dark Red to Gold (CTO Style)</option>
                            <option value="from-[#d4a574] to-[#e8b44a]" {{ $member->gradient == 'from-[#d4a574] to-[#e8b44a]' ? 'selected' : '' }}>Gold to Light Gold (Designer Style)</option>
                            <option value="from-[#e8b44a] to-[#c49a6b]" {{ $member->gradient == 'from-[#e8b44a] to-[#c49a6b]' ? 'selected' : '' }}>Light Gold to Sand (Marketing Style)</option>
                            <option value="from-[#c49a6b] to-[#8b6f47]" {{ $member->gradient == 'from-[#c49a6b] to-[#8b6f47]' ? 'selected' : '' }}>Sand to Bronze (Dev Style)</option>
                            <option value="from-[#8b6f47] to-[#3B0000]" {{ $member->gradient == 'from-[#8b6f47] to-[#3B0000]' ? 'selected' : '' }}>Bronze to Red (PM Style)</option>
                            <option value="from-[#3B0000] to-[#d4a574]" {{ $member->gradient == 'from-[#3B0000] to-[#d4a574]' ? 'selected' : '' }}>Red to Gold (UX/Researcher Style)</option>
                        </select>
                        <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/5 pt-6 mt-6 flex items-center justify-between">
            <label class="flex items-center gap-3 cursor-pointer group">
                <div class="relative flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }} class="peer sr-only">
                    <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-300 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#d4a574]"></div>
                </div>
                <span class="text-sm font-bold text-gray-300 group-hover:text-white transition-colors uppercase tracking-widest">Active Profile</span>
            </label>

            <button type="submit" class="bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform flex items-center gap-2 shadow-xl shadow-[#d4a574]/20">
                <i data-lucide="save" class="w-4 h-4"></i> Update Member
            </button>
        </div>
    </form>
</div>
@endsection
