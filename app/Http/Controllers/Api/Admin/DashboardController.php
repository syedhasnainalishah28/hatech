<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'label' => 'Total Revenue',
                'value' => '$' . number_format(Order::where('status', 'completed')->sum('total'), 2),
                'change' => '+12.5%', // Mocked for now, can be calculated
                'gradient' => 'from-[#3B0000] to-[#4a1520]',
            ],
            [
                'label' => 'Total Users',
                'value' => number_format(User::count()),
                'change' => '+8.2%',
                'gradient' => 'from-[#4a1520] to-[#d4a574]',
            ],
            [
                'label' => 'Products',
                'value' => number_format(Product::count()),
                'change' => '+5.4%',
                'gradient' => 'from-[#d4a574] to-[#f4d0a0]',
            ],
            [
                'label' => 'Orders',
                'value' => number_format(Order::count()),
                'change' => '+15.3%',
                'gradient' => 'from-[#e8b44a] to-[#c49a6b]',
            ],
        ];

        $recentOrders = Order::with('buyer', 'orderItems.product')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => '#' . $order->id,
                    'product' => $order->orderItems->first()?->product?->name ?? 'N/A',
                    'seller' => 'N/A', // Assuming seller info is complex, mocked
                    'amount' => '$' . number_format($order->total, 2),
                    'status' => $order->status,
                ];
            });

        return response()->json([
            'stats' => $stats,
            'recentOrders' => $recentOrders,
        ]);
    }
}
