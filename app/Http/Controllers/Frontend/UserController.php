<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderItem;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get recent orders
        $recentOrders = Order::where('buyer_id', $user->id)
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        // Calculate some basic stats
        $totalOrders = Order::where('buyer_id', $user->id)->count();
        $totalSpent = Order::where('buyer_id', $user->id)->where('status', 'completed')->sum('total');
        
        // Count digital products owned
        $digitalProductsCount = OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('buyer_id', $user->id)->where('status', 'completed');
            })
            ->whereHas('product', function ($query) {
                $query->whereNotNull('file_url');
            })
            ->count();

        return view('frontend.user.dashboard', compact('user', 'recentOrders', 'totalOrders', 'totalSpent', 'digitalProductsCount'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('buyer_id', $user->id)
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('frontend.user.orders', compact('user', 'orders'));
    }

    public function downloads()
    {
        $user = Auth::user();
        
        // Get all completed order items that have a product with a file_url
        $downloads = OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('buyer_id', $user->id)->where('status', 'completed');
            })
            ->whereHas('product', function ($query) {
                $query->whereNotNull('file_url');
            })
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('frontend.user.downloads', compact('user', 'downloads'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('frontend.user.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Update password if provided
        if ($request->filled('current_password') && $request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match.']);
            }
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return back()->with('success', 'Profile updated successfully.');
    }
}
