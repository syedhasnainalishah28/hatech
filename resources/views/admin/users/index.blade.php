@extends('layouts.admin')

@section('page_title', 'User Management')

@section('content')
<div class="glass-card p-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-bold text-white uppercase tracking-tight">Active Users</h2>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Manage registered buyers and clients</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.emails.send') }}" class="px-6 py-3 bg-[#d4a574] text-[#0a0506] font-black rounded-xl hover:bg-[#b0895d] transition-all uppercase tracking-widest text-[10px]">
                Bulk Email
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">ID</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">User Details</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Role</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Joined</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($users as $user)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-6 text-sm font-bold text-gray-500">#{{ $user->id }}</td>
                    <td class="px-6 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#d4a574]/20 to-[#e8b44a]/20 border border-[#d4a574]/20 flex items-center justify-center text-[#d4a574] font-black">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-white">{{ $user->name }}</span>
                                <span class="text-[10px] text-gray-500">{{ $user->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-widest text-gray-400">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-6 text-xs text-gray-400">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.emails.send', ['user_id' => $user->id]) }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-[#d4a574] hover:bg-white/10 transition-all" title="Send Email">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $users->links() }}
    </div>
</div>
@endsection
