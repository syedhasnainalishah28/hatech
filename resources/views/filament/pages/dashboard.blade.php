<x-filament-panels::page>
    <div style="padding-bottom: 2rem;">
        <!-- Stats Grid (Dynamic Data) -->
        <div style="display: grid; grid-template-cols: repeat(auto-fit, minmax(240px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            @php
                $statCards = [
                    [
                        'label' => 'Total Revenue', 
                        'value' => '$' . number_format($totalRevenue, 2), 
                        'change' => '+12.5%', 
                        'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        'grad' => 'linear-gradient(135deg, #4f46e5, #9333ea)'
                    ],
                    [
                        'label' => 'Total Users', 
                        'value' => number_format($totalUsers), 
                        'change' => '+8.2%', 
                        'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'grad' => 'linear-gradient(135deg, #9333ea, #db2777)'
                    ],
                    [
                        'label' => 'Products', 
                        'value' => number_format($totalProducts), 
                        'change' => '+5.4%', 
                        'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                        'grad' => 'linear-gradient(135deg, #db2777, #e11d48)'
                    ],
                    [
                        'label' => 'Total Orders', 
                        'value' => number_format($totalOrders), 
                        'change' => '+15.3%', 
                        'icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                        'grad' => 'linear-gradient(135deg, #10b981, #14b8a6)'
                    ],
                ];
            @endphp

            @foreach($statCards as $stat)
                <div style="position: relative; padding: 2.25rem; border-radius: 2.5rem; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.07); backdrop-filter: blur(30px); transition: all 0.3s ease; height: 100%; box-shadow: 0 20px 40px rgba(0,0,0,0.4);" onmouseover="this.style.background='rgba(255, 255, 255, 0.05)'; this.style.borderColor='rgba(212, 165, 116, 0.3)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.03)'; this.style.borderColor='rgba(255, 255, 255, 0.07)'">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                        <div style="width: 3.5rem; height: 3.5rem; border-radius: 1.25rem; background: {{ $stat['grad'] }}; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px rgba(0,0,0,0.2);">
                            <svg style="width: 1.75rem; height: 1.75rem; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" />
                            </svg>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-end;">
                            <span style="color: #34d399; font-size: 0.85rem; font-weight: 900; background: rgba(52, 211, 153, 0.1); padding: 0.35rem 0.85rem; border-radius: 9999px; border: 1px solid rgba(52, 211, 153, 0.2);">{{ $stat['change'] }}</span>
                        </div>
                    </div>
                    <div style="font-size: 2.25rem; font-weight: 900; color: #ffffff; letter-spacing: -0.05em; margin-bottom: 0.5rem; font-family: 'Outfit', sans-serif;">{{ $stat['value'] }}</div>
                    <div style="font-size: 0.85rem; font-weight: 800; color: rgba(255, 255, 255, 0.4); text-transform: uppercase; letter-spacing: 0.15em;">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Recent Activity Table (Dynamic) -->
            <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(40px); border-radius: 3rem; padding: 2.5rem; box-shadow: 0 30px 60px rgba(0,0,0,0.5);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem;">
                    <div style="display: flex; flex-direction: column;">
                        <h2 style="font-size: 1.5rem; font-weight: 900; color: white; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.25rem;">Recent Activity</h2>
                        <div style="height: 3px; width: 40px; background: #d4a574; border-radius: 999px;"></div>
                    </div>
                    <a href="/admin/orders" style="font-size: 0.7rem; font-weight: 900; color: #d4a574; text-transform: uppercase; letter-spacing: 0.2em; border: 1px solid rgba(212, 165, 116, 0.3); padding: 0.5rem 1.25rem; border-radius: 1rem; transition: all 0.3s;" onmouseover="this.style.background='#d4a574'; this.style.color='#000'" onmouseout="this.style.background='transparent'; this.style.color='#d4a574'">View All</a>
                </div>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 0 1rem;">
                        <thead>
                            <tr style="text-align: left; color: rgba(255, 255, 255, 0.3); font-size: 0.7rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.25em;">
                                <th style="padding: 0 1rem;">Order</th>
                                <th style="padding: 0 1rem;">Buyer</th>
                                <th style="padding: 0 1rem;">Value</th>
                                <th style="padding: 0 1rem; text-align: right;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr style="background: rgba(255, 255, 255, 0.01); border-radius: 1.25rem; transition: all 0.3s;" onmouseover="this.style.background='rgba(255, 255, 255, 0.04)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.01)'">
                                <td style="padding: 1.5rem 1rem; font-weight: 700; color: rgba(255, 255, 255, 0.4); border-radius: 1.25rem 0 0 1.25rem;">#{{ $order->id }}</td>
                                <td style="padding: 1.5rem 1rem; font-weight: 800; color: #ffffff;">{{ $order->buyer->name ?? 'Guest' }}</td>
                                <td style="padding: 1.5rem 1rem; font-weight: 900; color: #d4a574; font-size: 1.1rem;">${{ number_format($order->total, 2) }}</td>
                                <td style="padding: 1.5rem 1rem; text-align: right; border-radius: 0 1.25rem 1.25rem 0;">
                                    <span style="padding: 0.45rem 1rem; border-radius: 0.85rem; font-size: 0.65rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; background: {{ $order->status === 'completed' ? 'rgba(52, 211, 153, 0.1)' : 'rgba(156, 163, 175, 0.1)' }}; color: {{ $order->status === 'completed' ? '#34d399' : '#9ca3af' }}; border: 1px solid {{ $order->status === 'completed' ? 'rgba(52, 211, 153, 0.2)' : 'rgba(156, 163, 175, 0.2)' }};">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding: 3rem; text-align: center; color: rgba(255, 255, 255, 0.2); font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;">No recent orders found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Dashboard Tips / Quick Actions -->
            <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(40px); border-radius: 3rem; padding: 2.5rem; box-shadow: 0 30px 60px rgba(0,0,0,0.5); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 900; color: white; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 2rem;">Quick Management</h2>
                    <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 1.5rem;">
                        <a href="/admin/products/create" style="padding: 2rem; border-radius: 2rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); color: white; text-align: center; transition: all 0.3s;" onmouseover="this.style.borderColor='#d4a574'; this.style.background='rgba(212, 165, 116, 0.05)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)'; this.style.background='rgba(255,255,255,0.03)'">
                            <div style="font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; color: #d4a574; margin-bottom: 0.5rem;">New Inventory</div>
                            <div style="font-size: 1.1rem; font-weight: 800;">Add Product</div>
                        </a>
                        <a href="/admin/site-pages" style="padding: 2rem; border-radius: 2rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); color: white; text-align: center; transition: all 0.3s;" onmouseover="this.style.borderColor='#d4a574'; this.style.background='rgba(212, 165, 116, 0.05)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.05)'; this.style.background='rgba(255,255,255,0.03)'">
                            <div style="font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; color: #d4a574; margin-bottom: 0.5rem;">Visual Builder</div>
                            <div style="font-size: 1.1rem; font-weight: 800;">Edit Pages</div>
                        </a>
                    </div>
                </div>

                <div style="margin-top: 3rem; padding: 2rem; border-radius: 2rem; background: linear-gradient(to right, rgba(212, 165, 116, 0.1), transparent); border-left: 4px solid #d4a574;">
                    <div style="color: #d4a574; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.5rem;">Strategy Tip</div>
                    <p style="color: white; font-weight: 500; font-size: 0.95rem; line-height: 1.6;">Use the <b>Visual Builder</b> to create high-converting landing pages for your new products. Real-time changes are synchronized instantly.</p>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
