@extends('layouts.admin')

@section('page_title', 'Email Templates')

@section('content')
<div class="glass-card p-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-xl font-bold text-white uppercase tracking-tight">Email Layouts</h2>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Manage branded email templates for marketing</p>
        </div>
        <a href="{{ route('admin.email_templates.create') }}" class="px-6 py-3 bg-[#d4a574] text-[#0a0506] font-black rounded-xl hover:bg-[#b0895d] transition-all uppercase tracking-widest text-[10px]">
            Create New Template
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/5">
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Template Name</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Subject</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Branding</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($templates as $template)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="px-6 py-6 font-bold text-white">{{ $template->template_name }}</td>
                    <td class="px-6 py-6 text-sm text-gray-400 italic">"{{ $template->subject }}"</td>
                    <td class="px-6 py-6">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-[#d4a574]">{{ $template->brand_name }}</span>
                            <span class="text-[9px] text-gray-600 uppercase">{{ $template->tagline }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.email_templates.edit', $template->id) }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-[#d4a574] hover:bg-white/10 transition-all">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.email_templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Delete this template?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:text-rose-500 hover:bg-white/10 transition-all">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $templates->links() }}
    </div>
</div>
@endsection
