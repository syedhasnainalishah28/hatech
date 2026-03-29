@extends('layouts.app')

@section('title', 'Our Solutions | HA Tech')

@section('content')
<div class="min-h-screen relative pt-28 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <div class="relative max-w-7xl mx-auto">
        <div class="reveal-up text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-white via-[#d4a574] to-white bg-clip-text text-transparent">
                    Our Solutions
                </span>
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                We provide comprehensive digital services tailored to your business needs.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="reveal-up group relative">
                <div class="absolute inset-0 bg-gradient-to-r {{ $service->gradient_class }} rounded-3xl blur-xl opacity-0 group-hover:opacity-40 transition-opacity duration-300"></div>
                <div class="relative bg-white/5 border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 h-full">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-r {{ $service->gradient_class }} flex items-center justify-center mb-6 text-white group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="{{ $service->icon }}" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">{{ $service->name }}</h3>
                    <p class="text-gray-400 mb-6">{{ $service->description }}</p>
                    
                    <button onclick='openOrderModal(@json($service))' class="w-full py-3 rounded-2xl border border-white/10 text-white font-bold hover:bg-gradient-to-r {{ $service->gradient_class }} hover:text-[#0a0506] transition-all duration-300 group/btn flex items-center justify-center gap-2">
                        Order Now
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Ready to Get Started -->
        <div class="reveal-up mt-20 text-center">
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-gradient-to-r from-[#3B0000] to-[#d4a574] rounded-3xl blur-2xl opacity-50"></div>
                <div class="relative bg-gradient-to-r from-[#2b0e14] to-[#3d1a0f] border border-white/10 rounded-3xl p-12 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 ">Ready to Get Started?</h2>
                    <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">Let's discuss your project and bring your vision to life</p>
                    <a href="{{ url('/contact') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#2b0e14] font-semibold rounded-full hover:from-[#e8b44a] hover:to-[#d4a574] transition-all duration-300 shadow-lg shadow-[#d4a574]/30">
                        Contact Us Today
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modals')
<!-- Order Modal -->
<div id="orderModal" class="fixed inset-0 z-[110] hidden flex items-center justify-center p-4 md:p-6 cursor-auto">
    <div class="absolute inset-0 bg-black/95" onclick="closeOrderModal()"></div>
    <div class="relative w-full max-w-xl bg-[#1a0f11] border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-2xl overflow-y-auto max-h-[90vh] reveal-up custom-scrollbar">
        <!-- Texture -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5 pointer-events-none"></div>
        
        <button onclick="closeOrderModal()" class="absolute top-8 right-8 text-gray-500 hover:text-white transition-colors z-20">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

        <div class="relative z-10">
            <h2 class="text-3xl font-black text-white mb-2 tracking-tighter uppercase">Order Customization</h2>
            <p id="modalServiceName" class="text-[#d4a574] font-black tracking-[0.2em] uppercase text-[10px] mb-8">Service Name</p>

            <form action="{{ route('service.order.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="service_name" id="hiddenServiceName">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Strategy</label>
                        <select name="project_tech" onchange="toggleTechStack(this.value)" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs appearance-none cursor-pointer">
                            <option value="">Generic Project</option>
                            <option value="CMS">CMS Platform</option>
                            <option value="Custom Website">Custom Build</option>
                        </select>
                    </div>

                    <div id="defaultTechContainer" class="hidden grid grid-cols-1 gap-6 md:col-span-2">
                        <div id="cmsStackContainer" class="space-y-2 hidden">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Platform</label>
                            <select id="cmsSelect" onchange="updateStackValue(this.value)" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs appearance-none cursor-pointer">
                                <option value="WordPress">WordPress</option>
                                <option value="Shopify">Shopify</option>
                                <option value="Wix/Squarespace">Wix/Squarespace</option>
                                <option value="Custom CMS">Other CMS</option>
                            </select>
                        </div>

                        <div id="customStackContainer" class="space-y-2 hidden">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Technology Stack</label>
                            <select id="customSelect" onchange="updateStackValue(this.value)" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs appearance-none cursor-pointer">
                                <option value="React / Next.js">React / Next.js</option>
                                <option value="Laravel / PHP">Laravel / PHP</option>
                                <option value="Python / Django">Python / Django</option>
                                <option value="MERN Stack">MERN Stack</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- DYNAMIC CUSTOM FIELDS -->
                <div id="dynamicFieldsContainer" class="space-y-6"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Budget Range</label>
                        <input type="text" name="budget" placeholder="e.g. $1000 - $3000" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Expected Timeline</label>
                        <input type="text" name="timeline" placeholder="e.g. 2-4 Weeks" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Brief Summary</label>
                    <textarea name="requirements" rows="3" required
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs leading-relaxed placeholder:text-gray-600 cursor-text"
                        placeholder="Key project goals..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2 text-primary" id="fileLimitLabel">Files (Max 1)</label>
                    <input type="file" name="requirements_file[]" id="fileInput" multiple
                        class="block w-full text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#d4a574] file:text-[#0a0506] hover:file:bg-[#e8b44a] transition-all cursor-pointer">
                </div>

                <div class="pt-4">
                    @auth
                        <button type="submit" class="w-full py-5 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#0a0506] font-black rounded-2xl hover:scale-[1.02] transition-all shadow-xl shadow-[#d4a574]/20 uppercase tracking-widest text-sm cursor-pointer">
                            Submit Order & Get Quote
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="w-full py-5 bg-white/10 text-white font-black rounded-2xl hover:bg-white/20 transition-all flex items-center justify-center uppercase tracking-widest text-sm border border-white/5 cursor-pointer">
                            Login to Place Order
                        </a>
                    @endauth
                </div>
                
                <p class="text-[9px] text-gray-500 text-center uppercase tracking-widest mt-6">
                    <i data-lucide="shield-check" class="w-3 h-3 inline-block mr-1"></i> 
                    Secure process • Real-time tracking • Premium support
                </p>
            </form>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
    function toggleTechStack(val) {
        const cmsStack = document.getElementById('cmsStackContainer');
        const customStack = document.getElementById('customStackContainer');
        const defaultContainer = document.getElementById('defaultTechContainer');
        const stackInput = document.getElementById('finalTechStack');
        
        if (val === 'CMS') {
            defaultContainer.classList.remove('hidden');
            cmsStack.classList.remove('hidden');
            customStack.classList.add('hidden');
            stackInput.value = document.getElementById('cmsSelect').value;
        } else if (val === 'Custom Website') {
            defaultContainer.classList.remove('hidden');
            cmsStack.classList.add('hidden');
            customStack.classList.remove('hidden');
            stackInput.value = document.getElementById('customSelect').value;
        } else {
            defaultContainer.classList.add('hidden');
            cmsStack.classList.add('hidden');
            customStack.classList.add('hidden');
            stackInput.value = '';
        }
    }

    function updateStackValue(val) {
        document.getElementById('finalTechStack').value = val;
    }

    function openOrderModal(service) {
        document.getElementById('modalServiceName').innerText = service.name;
        document.getElementById('hiddenServiceName').value = service.name;
        
        // Handle Dynamic Fields
        const container = document.getElementById('dynamicFieldsContainer');
        container.innerHTML = '';
        
        if (service.custom_fields && service.custom_fields.length > 0) {
            service.custom_fields.forEach(field => {
                const div = document.createElement('div');
                div.className = 'space-y-2';
                
                let inputHtml = '';
                if (field.type === 'text') {
                    inputHtml = `<input type="text" name="${field.label}" placeholder="Your answer..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs">`;
                } else if (field.type === 'textarea') {
                    inputHtml = `<textarea name="${field.label}" rows="3" placeholder="Detailed response..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs"></textarea>`;
                } else if (field.type === 'select') {
                    const options = field.options.map(opt => `<option value="${opt}">${opt}</option>`).join('');
                    inputHtml = `<select name="${field.label}" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 outline-none focus:border-[#d4a574] transition-all text-white text-xs appearance-none">${options}</select>`;
                }

                div.innerHTML = `
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">${field.label}</label>
                    ${inputHtml}
                `;
                container.appendChild(div);
            });
        }

        // Handle File Limit
        const fileInput = document.getElementById('fileInput');
        fileInput.setAttribute('max', service.file_limit || 1);
        document.getElementById('fileLimitLabel').innerText = `Reference Assets (Max ${service.file_limit || 1})`;

        document.getElementById('orderModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endpush
@endsection
