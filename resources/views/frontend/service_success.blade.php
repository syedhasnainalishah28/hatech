@extends('layouts.app')

@section('title', 'Order Received | HA Tech')

@section('content')
<div class="min-h-screen relative pt-28 pb-20 px-4 sm:px-6 lg:px-8 flex items-center justify-center overflow-hidden antialiased">
    <!-- Background Accents -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-full max-h-[600px] bg-[#3B0000]/10 rounded-full blur-[120px] pointer-events-none"></div>
    
    <div class="relative max-w-2xl w-full text-center reveal-up">
        <div class="w-24 h-24 rounded-3xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-emerald-500/10">
            <i data-lucide="check-circle-2" class="w-12 h-12 text-emerald-500"></i>
        </div>

        <h1 class="text-4xl md:text-6xl font-black text-white mb-4 tracking-tighter uppercase italic">
            Revolution Started
        </h1>
        <p class="text-[#d4a574] font-black tracking-[0.4em] uppercase text-[10px] mb-8">Order #{{ $order->order_number }} Received</p>

        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-8 md:p-12 backdrop-blur-xl mb-10 text-left relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5"></div>
            
            <div class="relative z-10 space-y-6">
                <div>
                    <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-2">Service Details</h3>
                    <p class="text-xl font-bold text-white uppercase tracking-tight">{{ $order->service_name }}</p>
                </div>
                
                <div>
                    <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-2">Next Step</h3>
                    <p class="text-gray-300 leading-relaxed font-medium">
                        Please message us on WhatsApp and share your Order Number. Our team will review your requirements and get back to you shortly to start the evolution.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @php
                $waMessage = "Hey HA Tech, I just submitted an order. Order Number: #{$order->order_number}";
                $waUrl = "https://wa.me/923259220167?text=" . urlencode($waMessage);
            @endphp
            <a href="{{ $waUrl }}" target="_blank" class="px-10 py-5 bg-[#25D366] text-white font-black rounded-2xl hover:scale-[1.05] transition-all shadow-xl shadow-[#25D366]/20 uppercase tracking-widest text-sm flex items-center justify-center gap-3">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Message on WhatsApp
            </a>
            
            <a href="{{ route('user.orders') }}" class="px-10 py-5 bg-white/5 border border-white/10 text-white font-black rounded-2xl hover:bg-white/10 transition-all uppercase tracking-widest text-sm flex items-center justify-center gap-3">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                Track Progress
            </a>
        </div>
    </div>
</div>
@endsection
