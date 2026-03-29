@extends('layouts.app')

@section('title', 'Project Evolution | ' . $order->order_number)

@section('content')
<div class="min-h-screen relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden antialiased">
    <!-- Background Accents -->
    <div class="absolute top-0 right-0 w-full max-w-4xl h-full max-h-[800px] bg-[#3B0000]/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="relative max-w-4xl mx-auto">
        <!-- Back Link -->
        <a href="{{ route('user.orders') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-[#d4a574] transition-colors mb-8 group">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
            <span class="font-bold uppercase tracking-widest text-[10px]">Back to Dashboard</span>
        </a>

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 reveal-up">
            <div>
                <h1 class="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase italic mb-2">Project Evolution</h1>
                <p class="text-[#d4a574] font-black tracking-[0.4em] uppercase text-[10px]">Tracking #{{ $order->order_number }}</p>
            </div>
            <div class="flex flex-col items-end">
                @php
                    $sColors = [
                        'pending' => 'text-amber-500 bg-amber-500/10 border-amber-500/20',
                        'reviewing' => 'text-blue-400 bg-blue-400/10 border-blue-400/20',
                        'working' => 'text-emerald-400 bg-emerald-400/10 border-emerald-400/20',
                        'completed' => 'text-purple-400 bg-purple-400/10 border-purple-400/20',
                        'canceled' => 'text-rose-400 bg-rose-400/10 border-rose-400/20',
                    ];
                @endphp
                <span class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border {{ $sColors[$order->status] }}">
                    {{ $order->status }}
                </span>
                <span class="text-[9px] text-gray-500 font-bold uppercase tracking-widest mt-2 italic">Current Stage</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
            <!-- Timeline -->
            <div class="md:col-span-8 space-y-8">
                <div class="relative bg-white/5 border border-white/10 rounded-[2.5rem] p-8 md:p-12 overflow-hidden reveal-up">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5"></div>
                    
                    <div class="relative z-10">
                        <h2 class="text-xl font-black text-white uppercase tracking-tight mb-10 pb-4 border-b border-white/5">Evolution History</h2>

                        <div class="space-y-12 relative">
                            <!-- Track Line -->
                            <div class="absolute left-4 top-2 bottom-2 w-px bg-white/10"></div>

                            @forelse($order->updates as $update)
                            <div class="relative pl-12 group">
                                <!-- Dot -->
                                <div class="absolute left-[13px] top-1 w-[7px] h-[7px] rounded-full bg-[#d4a574] shadow-[0_0_15px_#d4a574] group-first:scale-150 group-first:bg-emerald-500 group-first:shadow-emerald-500"></div>
                                
                                <div class="transition-all group-hover:translate-x-1">
                                    <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-2">{{ $update->created_at->format('M d, Y • h:i A') }}</div>
                                    <h3 class="text-lg font-bold text-white mb-2 leading-tight italic">{{ $update->message }}</h3>
                                    
                                    @if($update->proof_image)
                                    <div class="mt-4 rounded-2xl overflow-hidden border border-white/10 shadow-2xl">
                                        <img src="{{ asset('storage/' . $update->proof_image) }}" class="w-full h-auto hover:scale-[1.02] transition-transform duration-700">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-12">
                                <i data-lucide="hourglass" class="w-12 h-12 text-gray-600 mx-auto mb-4 animate-pulse"></i>
                                <p class="text-gray-500 font-black text-sm uppercase tracking-widest italic">Awaiting Evolution Startup...</p>
                            </div>
                            @endforelse
                        </div>

                        @if($order->requirements_file)
                        <div class="mt-12 pt-8 border-t border-white/5">
                            <h3 class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-4">Your Project Requirements File</h3>
                            <a href="{{ asset('storage/' . $order->requirements_file) }}" target="_blank" class="inline-flex items-center gap-3 px-6 py-4 bg-white/5 border border-white/10 rounded-2xl text-white hover:bg-white/10 transition-all group">
                                <i data-lucide="file-text" class="w-5 h-5 text-[#d4a574]"></i>
                                <div class="text-left">
                                    <span class="block text-xs font-bold uppercase tracking-tight">View Attachment</span>
                                    <span class="block text-[9px] text-gray-500 uppercase font-black">PDF / Image / Zip</span>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detail Sidebar -->
            <div class="md:col-span-4 space-y-6">
                <div class="glass-card p-8 border border-white/10 rounded-3xl reveal-up">
                    <h3 class="text-sm font-black text-gray-500 uppercase tracking-widest mb-6">Project Metadata</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <span class="block text-[9px] text-gray-600 font-black uppercase tracking-[0.2em] mb-1">Service</span>
                            <span class="text-white font-bold uppercase italic tracking-tight">{{ $order->service_name }}</span>
                        </div>
                        
                        <div>
                            <span class="block text-[9px] text-gray-600 font-black uppercase tracking-[0.2em] mb-1">Estimated Value</span>
                            <span class="text-2xl font-black text-[#d4a574]">{{ $order->price ? '$' . number_format($order->price, 2) : 'AWAITING QUOTE' }}</span>
                        </div>

                        <div class="pt-6 border-t border-white/5 text-gray-400 text-xs italic leading-relaxed">
                            We are working on your project with full focus. Every stage's proof will be available right here.
                        </div>
                    </div>
                </div>

                <div class="glass-card p-8 border border-white/10 rounded-3xl reveal-up">
                    <h3 class="text-sm font-black text-gray-500 uppercase tracking-widest mb-4">Direct Support</h3>
                    <p class="text-[10px] text-gray-400 leading-relaxed mb-6 uppercase tracking-wider font-bold">Instantly talk to our project leads regarding Order #{{ $order->order_number }}</p>
                    
                    <a href="https://wa.me/923259220167?text={{ urlencode('Hey HA Tech, I am tracking my project #' . $order->order_number . '. Need a quick update.') }}" target="_blank" class="w-full py-4 bg-[#25D366] text-white font-black rounded-xl hover:scale-[1.02] transition-all flex items-center justify-center gap-3 uppercase tracking-widest text-[10px] shadow-lg shadow-[#25D366]/20">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Priority WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
