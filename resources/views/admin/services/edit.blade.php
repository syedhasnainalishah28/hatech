@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-5xl mx-auto">
    <div class="mb-12 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic">Edit Service Strategy</h1>
            <p class="text-[10px] text-gray-500 font-black tracking-[0.3em] uppercase mt-2">Update requirements & visual identity</p>
        </div>
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-r {{ $service->gradient_class }} flex items-center justify-center text-white shadow-lg">
            <i data-lucide="{{ $service->icon }}" class="w-8 h-8"></i>
        </div>
    </div>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" id="serviceForm">
        @csrf
        @method('POST')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- Basic Info -->
            <div class="bg-[#1a0f11] border border-white/10 rounded-[2.5rem] p-8 space-y-6 shadow-2xl">
                <h3 class="text-[10px] font-black text-[#d4a574] uppercase tracking-[0.2em] mb-4">Identity</h3>
                <div class="space-y-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest pl-2">Service Name</label>
                    <input type="text" name="name" value="{{ $service->name }}" required 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest pl-2">Description</label>
                    <textarea name="description" rows="4" required 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-sm">{{ $service->description }}</textarea>
                </div>
            </div>

            <!-- Visuals -->
            <div class="bg-[#1a0f11] border border-white/10 rounded-[2.5rem] p-8 space-y-6 shadow-2xl">
                <h3 class="text-[10px] font-black text-[#d4a574] uppercase tracking-[0.2em] mb-4">Aesthetics</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest pl-2">Lucide Icon</label>
                        <input type="text" name="icon" value="{{ $service->icon }}" required 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-sm" placeholder="e.g. code, palette">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest pl-2">File Limit</label>
                        <input type="number" name="file_limit" value="{{ $service->file_limit }}" min="1" required 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-sm">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest pl-2">Gradient Class (Tailwind)</label>
                    <input type="text" name="gradient_class" value="{{ $service->gradient_class }}" required 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs font-mono">
                </div>
            </div>
        </div>

        <!-- Dynamic Form Builder -->
        <div class="bg-[#1a0f11] border border-white/10 rounded-[2.5rem] p-8 md:p-12 mb-12 shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5 pointer-events-none"></div>
            
            <div class="relative z-10 flex justify-between items-center mb-10">
                <div>
                    <h3 class="text-[10px] font-black text-[#d4a574] uppercase tracking-[0.2em]">Form Architecture</h3>
                    <p class="text-[8px] text-gray-500 uppercase font-bold mt-1 tracking-widest">Add dynamic requirements to the client modal</p>
                </div>
                <button type="button" onclick="addField()" class="flex items-center gap-2 text-[10px] font-black text-white uppercase tracking-widest bg-white/5 border border-white/10 px-6 py-3 rounded-2xl hover:bg-white/10 transition-all group">
                    <i data-lucide="plus-circle" class="w-4 h-4 group-hover:scale-110 transition-transform"></i> Add Requirement
                </button>
            </div>

            <div id="fieldContainer" class="space-y-4 relative z-10">
                <!-- Fields will be added here -->
            </div>

            <input type="hidden" name="custom_fields" id="customFieldsInput">
        </div>

        <div class="flex gap-4">
            <button type="submit" onclick="prepareSubmission()" class="flex-1 py-6 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#0a0506] font-black rounded-3xl hover:scale-[1.02] transition-all shadow-2xl shadow-[#d4a574]/30 uppercase tracking-[0.3em] text-sm italic">
                Synchronize Strategy
            </button>
            <a href="{{ route('admin.services') }}" class="px-12 py-6 bg-white/5 border border-white/10 text-white font-black rounded-3xl hover:bg-white/10 transition-all uppercase tracking-[0.3em] text-sm text-center flex items-center justify-center">
                Return
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let fields = {!! json_encode($service->custom_fields ?? []) !!};

    function renderFields() {
        const container = document.getElementById('fieldContainer');
        container.innerHTML = '';
        
        fields.forEach((field, index) => {
            const row = document.createElement('div');
            row.className = 'grid grid-cols-12 gap-4 items-end bg-[#0a0506]/40 p-8 rounded-[2rem] border border-white/5 hover:border-white/10 transition-all group/row';
            row.innerHTML = `
                <div class="col-span-5 space-y-2">
                    <label class="text-[8px] font-black text-gray-500 uppercase tracking-widest pl-2">Question Title</label>
                    <input type="text" value="${field.label}" onchange="updateField(${index}, 'label', this.value)" 
                        class="w-full bg-[#1a0f11] border border-white/10 rounded-xl px-5 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs">
                </div>
                <div class="col-span-3 space-y-2">
                    <label class="text-[8px] font-black text-gray-500 uppercase tracking-widest pl-2">Input Mode</label>
                    <select onchange="updateField(${index}, 'type', this.value)" 
                        class="w-full bg-[#1a0f11] border border-white/10 rounded-xl px-5 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs appearance-none">
                        <option value="text" ${field.type === 'text' ? 'selected' : ''}>Brief String</option>
                        <option value="textarea" ${field.type === 'textarea' ? 'selected' : ''}>Detailed Block</option>
                        <option value="select" ${field.type === 'select' ? 'selected' : ''}>Dropdown Logic</option>
                    </select>
                </div>
                <div class="col-span-3 space-y-2">
                    <label class="text-[8px] font-black text-gray-500 uppercase tracking-widest pl-2">Parameters (CSV)</label>
                    <input type="text" value="${field.options ? field.options.join(', ') : ''}" 
                        onchange="updateField(${index}, 'options', this.value)"
                        ${field.type !== 'select' ? 'disabled bg-transparent border-transparent opacity-0' : ''}
                        class="w-full bg-[#1a0f11] border border-white/10 rounded-xl px-5 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs"
                        placeholder="e.g. Starter, Pro, Enterprise">
                </div>
                <div class="col-span-1">
                    <button type="button" onclick="removeField(${index})" class="w-full aspect-square flex items-center justify-center bg-red-500/5 text-red-500/40 rounded-xl border border-red-500/10 hover:bg-red-500/20 hover:text-red-500 hover:border-red-500/30 transition-all">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </div>
            `;
            container.appendChild(row);
        });
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function addField() {
        fields.push({ label: '', type: 'text', options: [] });
        renderFields();
    }

    function removeField(index) {
        fields.splice(index, 1);
        renderFields();
    }

    function updateField(index, key, value) {
        if (key === 'options') {
            fields[index][key] = value.split(',').map(s => s.trim()).filter(s => s.length > 0);
        } else {
            fields[index][key] = value;
        }
        renderFields();
    }

    function prepareSubmission() {
        document.getElementById('customFieldsInput').value = JSON.stringify(fields);
    }

    renderFields();
</script>
@endpush
@endsection
