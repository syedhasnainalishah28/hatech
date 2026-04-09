@extends('layouts.admin')

@section('page_title', 'Administrative Activity Logs')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h3 class="text-sm font-black uppercase tracking-[0.3em] text-[#d4a574] mb-2">Security Monitor</h3>
        <h2 class="text-3xl font-black uppercase tracking-tighter">Portal Audit Trail</h2>
    </div>
    
    <div class="flex items-center gap-4">
        <div class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mr-2">Total Events:</span>
            <span class="font-black text-[#d4a574]">{{ $logs->total() }}</span>
        </div>
    </div>
</div>

<div class="glass-card overflow-hidden border border-white/5 shadow-2xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/[0.02] text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] border-b border-white/5">
                    <th class="px-8 py-5">Timestamp</th>
                    <th class="px-8 py-5">Administrator</th>
                    <th class="px-8 py-5">Event</th>
                    <th class="px-8 py-5">Identity Data</th>
                    <th class="px-8 py-5">Origin</th>
                    <th class="px-8 py-5 text-right">Details</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($logs as $log)
                <tr class="group hover:bg-white/[0.03] transition-colors">
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-gray-400">{{ $log->created_at->format('Y/m/d') }}</div>
                        <div class="text-xs font-black text-white">{{ $log->created_at->format('H:i:s') }}</div>
                    </td>
                    <td class="px-8 py-6">
                        @if($log->admin)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-[#d4a574]/20 flex items-center justify-center text-[#d4a574] font-black text-[10px]">
                                    {{ substr($log->admin->name, 0, 1) }}
                                </div>
                                <span class="text-xs font-black uppercase">{{ $log->admin->name }}</span>
                            </div>
                        @else
                            <span class="text-[10px] font-black uppercase tracking-widest text-rose-500/50 italic">System / Anonymous</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                            {{ in_array($log->action, ['login_success', 'settings_changed']) ? 'bg-emerald-500/10 text-emerald-400' : 'bg-rose-500/10 text-rose-400' }}">
                            {{ str_replace('_', ' ', $log->action) }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <i data-lucide="{{ $log->device_type === 'Mobile' ? 'smartphone' : 'monitor' }}" class="w-3 h-3 text-gray-500"></i>
                                <span class="text-[10px] font-bold text-gray-300 italic">{{ $log->os_name }}</span>
                            </div>
                            <div class="text-[10px] text-gray-600 font-bold uppercase tracking-widest">{{ $log->browser_name }}</div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-xs font-black text-[#d4a574] font-mono">{{ $log->ip_address }}</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <p class="text-[11px] text-gray-500 line-clamp-1 max-w-[200px] italic">{{ $log->description }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($logs->hasPages())
    <div class="px-8 py-6 bg-white/[0.01] border-t border-white/5">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection
