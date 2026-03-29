@extends('layouts.admin')

@section('page_title', 'Send Custom Email')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.users') }}" class="text-[#d4a574] text-xs font-black uppercase tracking-widest hover:underline flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to User Management
        </a>
    </div>

    <form action="{{ route('admin.emails.dispatch') }}" method="POST" class="space-y-8">
        @csrf
        
        <div class="glass-card p-10">
            <h2 class="text-xl font-black text-white uppercase tracking-tight mb-8 border-b border-white/5 pb-4">Recipient Selection</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Recipient Type</label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="recipient_type" value="all" class="hidden peer" {{ !$targetUser ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border border-white/10 bg-white/5 text-center peer-checked:border-[#d4a574] peer-checked:bg-[#d4a574]/10 transition-all">
                                <span class="text-xs font-black uppercase tracking-widest text-gray-400 peer-checked:text-[#d4a574]">All Buyers</span>
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="recipient_type" value="single" class="hidden peer" {{ $targetUser ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border border-white/10 bg-white/5 text-center peer-checked:border-[#d4a574] peer-checked:bg-[#d4a574]/10 transition-all">
                                <span class="text-xs font-black uppercase tracking-widest text-gray-400 peer-checked:text-[#d4a574]">Specific User</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Target User</label>
                    <input type="hidden" name="user_id" value="{{ $targetUser->id ?? '' }}">
                    <div class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white font-medium opacity-60">
                        {{ $targetUser ? $targetUser->name . ' (' . $targetUser->email . ')' : 'No specific user selected (Bulk Mode)' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card p-10">
            <h2 class="text-xl font-black text-white uppercase tracking-tight mb-8 border-b border-white/5 pb-4">Email Configuration</h2>
            
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Select Branding Template</label>
                    <select name="template_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white font-medium appearance-none">
                        <option value="" class="bg-black">-- Choose a Template --</option>
                        @foreach($templates as $tpl)
                            <option value="{{ $tpl->id }}" class="bg-black">{{ $tpl->template_name }} ({{ $tpl->brand_name }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Custom Message / Announcement</label>
                    <p class="text-[10px] text-amber-500 font-bold uppercase tracking-widest mb-2 italic">Tip: Template structure will wrap this message. You can use {name} placeholder.</p>
                    <textarea name="message_content" rows="12" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white leading-relaxed font-medium"
                        placeholder="Type your message here..."></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit" class="px-12 py-5 bg-[#d4a574] text-[#0a0506] font-black rounded-2xl hover:scale-[1.02] transition-all shadow-xl shadow-[#d4a574]/20 uppercase tracking-widest text-sm flex items-center gap-3">
                <i data-lucide="send" class="w-5 h-5"></i> Dispatch Campaign
            </button>
        </div>
    </form>
</div>
@endsection
