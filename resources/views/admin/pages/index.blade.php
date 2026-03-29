@extends('layouts.admin')

@section('page_title', 'Pages Management')

@section('content')
<div class="glass-card p-10">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h3 class="text-2xl font-black uppercase tracking-tight">All Pages</h3>
            <p class="text-gray-400 text-sm mt-1">Manage static site content here.</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="px-8 py-4 bg-[#d4a574] text-black font-black rounded-2xl hover:scale-105 transition-all shadow-lg flex items-center gap-2">
            <i data-lucide="plus" class="w-5 h-5"></i> ADD NEW PAGE
        </a>
    </div>

    @if(session('success'))
    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-xl flex items-center gap-3">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left text-gray-500 text-[10px] uppercase font-black tracking-widest border-b border-white/5">
                    <th class="px-6 py-4">Page Name</th>
                    <th class="px-6 py-4">Slug / URL</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($pages as $page)
                <tr class="group hover:bg-white/5 transition-colors">
                    <td class="px-6 py-6 font-bold uppercase tracking-tight">{{ $page->name }}</td>
                    <td class="px-6 py-6 text-gray-400 font-mono text-sm italic">/{{ $page->slug }}</td>
                    <td class="px-6 py-6">
                        <span class="px-3 py-1 bg-green-500/10 text-green-500 text-[10px] font-black uppercase tracking-widest rounded-full">Active</span>
                    </td>
                    <td class="px-6 py-6 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="p-2 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Delete this page?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-red-500/10 rounded-lg text-gray-400 hover:text-red-500 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach

                <!-- Pre-seeded hint rows if empty -->
                @if($pages->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-gray-500 italic">
                        No custom pages found. Start by creating 'about', 'about/founder', or 'about/ceo'.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="mt-10 glass-card p-8 border-blue-500/20 bg-blue-500/5">
    <div class="flex items-start gap-4">
        <i data-lucide="info" class="w-6 h-6 text-blue-400 mt-1"></i>
        <div>
            <h4 class="font-bold mb-1">PRO TIP: Page Slugs</h4>
            <p class="text-sm text-gray-400">To override the About pages, use slugs: <code class="bg-black/40 px-2 py-1 rounded text-blue-300">about</code>, <code class="bg-black/40 px-2 py-1 rounded text-blue-300">about/founder</code>, and <code class="bg-black/40 px-2 py-1 rounded text-blue-300">about/ceo</code>.</p>
        </div>
    </div>
</div>
@endsection
