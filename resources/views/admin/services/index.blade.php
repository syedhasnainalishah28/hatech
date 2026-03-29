@extends('layouts.admin')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-12">
        <div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic">Services Catalog</h1>
            <p class="text-[10px] text-gray-500 font-black tracking-[0.3em] uppercase mt-2">Manage dynamic project offerings & forms</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-8 py-3 bg-[#d4a574] text-[#0a0506] font-black rounded-xl hover:bg-[#e8b44a] transition-all uppercase tracking-widest text-xs">
            Add New Service
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @foreach($services as $service)
        <div class="bg-[#1a0f11] border border-white/10 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between group hover:border-[#d4a574]/30 transition-all">
            <div class="flex items-center gap-8 mb-6 md:mb-0">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-r {{ $service->gradient_class }} flex items-center justify-center text-white shadow-lg">
                    <i data-lucide="{{ $service->icon }}" class="w-8 h-8"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-white uppercase tracking-tight">{{ $service->name }}</h3>
                    <p class="text-gray-500 text-xs mt-1 max-w-md">{{ Str::limit($service->description, 80) }}</p>
                    <div class="flex gap-4 mt-4">
                        <span class="text-[9px] font-black text-[#d4a574] uppercase tracking-widest bg-[#d4a574]/10 px-3 py-1 rounded-full border border-[#d4a574]/20">
                            {{ count($service->custom_fields ?? []) }} Custom Questions
                        </span>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest bg-white/5 px-3 py-1 rounded-full border border-white/10">
                            Max {{ $service->file_limit }} Files
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.services.edit', $service->id) }}" class="p-4 bg-white/5 border border-white/10 rounded-2xl text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                </a>
                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-500 hover:bg-red-500/20 transition-all">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $services->links() }}
    </div>
</div>
@endsection
