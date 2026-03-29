@extends('layouts.admin')

@section('page_title', 'Order #' . $order->order_number)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Details -->
    <div class="lg:col-span-2 space-y-8">
        <div class="glass-card p-8 md:p-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-5"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 pb-8 border-b border-white/5">
                    <div>
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">Service Request</h2>
                        <p class="text-[#d4a574] font-black tracking-[0.4em] uppercase text-[10px] mt-2">Client: {{ $order->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <span class="block text-gray-500 font-bold text-[10px] uppercase tracking-widest mb-1">Current Status</span>
                        @php
                            $statusColors = [
                                'pending' => 'text-amber-500 bg-amber-500/10 border-amber-500/20',
                                'reviewing' => 'text-blue-400 bg-blue-400/10 border-blue-400/20',
                                'working' => 'text-emerald-400 bg-emerald-400/10 border-emerald-400/20',
                                'completed' => 'text-purple-400 bg-purple-400/10 border-purple-400/20',
                                'canceled' => 'text-rose-400 bg-rose-400/10 border-rose-400/20',
                            ];
                        @endphp
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border {{ $statusColors[$order->status] }}">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-4">Service Type</h3>
                        <p class="text-xl font-bold text-white uppercase italic tracking-tight mb-8">{{ $order->service_name }}</p>

                        @if($order->project_tech || $order->tech_stack || $order->budget || $order->timeline)
                            <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-4">Project Specifications</h3>
                            <div class="grid grid-cols-2 gap-4 mb-8">
                                @if($order->project_tech)
                                    <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                                        <span class="block text-[9px] text-gray-500 uppercase font-black mb-1">Strategy</span>
                                        <span class="text-sm text-white font-bold">{{ $order->project_tech }}</span>
                                    </div>
                                @endif
                                @if($order->tech_stack)
                                    <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                                        <span class="block text-[9px] text-gray-500 uppercase font-black mb-1">Platform/Stack</span>
                                        <span class="text-sm text-white font-bold">{{ $order->tech_stack }}</span>
                                    </div>
                                @endif
                                @if($order->budget)
                                    <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                                        <span class="block text-[9px] text-gray-500 uppercase font-black mb-1">Budget</span>
                                        <span class="text-sm text-[#d4a574] font-black italic">{{ $order->budget }}</span>
                                    </div>
                                @endif
                                @if($order->timeline)
                                    <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                                        <span class="block text-[9px] text-gray-500 uppercase font-black mb-1">Timeline</span>
                                        <span class="text-sm text-white font-bold">{{ $order->timeline }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($order->custom_responses && count($order->custom_responses) > 0)
                            <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-4">Custom Configuration</h3>
                            <div class="grid grid-cols-1 gap-4 mb-8">
                                @foreach($order->custom_responses as $label => $response)
                                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                                        <span class="block text-[9px] text-gray-500 uppercase font-black mb-1">{{ $label }}</span>
                                        <span class="text-sm text-white font-bold leading-relaxed">{{ is_array($response) ? implode(', ', $response) : $response }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-4">Client Requirements</h3>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-gray-300 leading-relaxed italic mb-8">
                            {!! nl2br(e($order->requirements)) !!}
                        </div>

                        @if($order->requirements_file)
                            <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-4">Project Assets</h3>
                            <div class="space-y-3">
                                @php
                                    $files = json_decode($order->requirements_file, true);
                                    if(!is_array($files)) $files = [$order->requirements_file];
                                @endphp
                                @foreach($files as $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:border-[#d4a574]/30 hover:bg-white/10 transition-all group">
                                        <div class="w-10 h-10 rounded-xl bg-[#d4a574]/10 flex items-center justify-center text-[#d4a574] group-hover:bg-[#d4a574]/20 transition-colors">
                                            <i data-lucide="file-text" class="w-5 h-5"></i>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <span class="block text-[10px] font-black text-white uppercase tracking-widest truncate">{{ basename($file) }}</span>
                                            <span class="text-[8px] text-gray-500 uppercase font-bold tracking-tighter">Click to view/download</span>
                                        </div>
                                        <i data-lucide="external-link" class="w-4 h-4 text-gray-600 group-hover:text-white transition-colors"></i>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-gray-500 font-black text-[10px] uppercase tracking-widest mb-4">Project Timeline</h3>
                            <div class="space-y-4">
                                @forelse($order->updates as $update)
                                    <div class="relative pl-6 border-l border-[#d4a574]/30 pb-4 last:pb-0">
                                        <div class="absolute -left-1.5 top-0 w-3 h-3 rounded-full bg-[#d4a574] shadow-[0_0_10px_#d4a574]"></div>
                                        <div class="text-[10px] text-gray-500 font-black uppercase mb-1">{{ $update->created_at->format('M d, Y - H:i') }}</div>
                                        <p class="text-sm text-gray-300 font-medium">{{ $update->message }}</p>
                                        @if($update->proof_image)
                                            <a href="{{ asset('storage/' . $update->proof_image) }}" target="_blank" class="mt-3 block rounded-xl overflow-hidden border border-white/10 group">
                                                <img src="{{ asset('storage/' . $update->proof_image) }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                                            </a>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-xs text-gray-600 uppercase font-black italic tracking-widest">No progress updates yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Sidebar -->
    <div class="space-y-8">
        <div class="glass-card p-8">
            <h3 class="text-lg font-black text-white uppercase tracking-tight mb-6">Manage Order</h3>
            
            <form action="{{ route('admin.service_orders.update', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Update Status</label>
                    <select name="status" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-sm">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="reviewing" {{ $order->status == 'reviewing' ? 'selected' : '' }}>Reviewing Requirements</option>
                        <option value="working" {{ $order->status == 'working' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Project Price ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ $order->price }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-sm" placeholder="e.g. 500.00">
                </div>

                <div class="space-y-2 pt-4 border-t border-white/5">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Tracking Message</label>
                    <textarea name="update_message" rows="4" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 outline-none focus:border-[#d4a574] text-white text-xs leading-relaxed" placeholder="Tell the client what's happening..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest pl-2">Upload Proof (Image)</label>
                    <input type="file" name="proof_image" class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-[#d4a574] file:text-[#0a0506] hover:file:bg-[#e8b44a] transition-all cursor-pointer">
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#d4a574] to-[#e8b44a] text-[#0a0506] font-black rounded-xl hover:scale-[1.02] transition-all shadow-xl shadow-[#d4a574]/20 uppercase tracking-widest text-xs mt-4">
                    Update & Notify Client
                </button>
            </form>
        </div>

        <div class="glass-card p-8">
            <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4 text-[#d4a574]"></i> Pro Tip
            </h3>
            <p class="text-[11px] text-gray-400 leading-relaxed font-medium">
                Updating the status or adding a message will automatically send an email notification to the client from <span class="text-[#d4a574]">contact@hatechservices.com.pk</span>.
            </p>
        </div>
    </div>
</div>
@endsection
