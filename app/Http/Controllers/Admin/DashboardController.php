<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalSubscriptions = Subscription::count();
        
        // Statistik pesanan
        $pendingOrders = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $arrivedOrders = Order::where('status', 'arrived')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $rejectedOrders = Order::where('status', 'rejected')->count();
        
        // Pendapatan
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_price');
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');
        
        // Produk terbaru
        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();
        
        // Pesanan terbaru
        $recentOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();
        
        // Produk dengan stok rendah
        $lowStockProducts = Product::where('stock_quantity', '<=', 10)
            ->orderBy('stock_quantity', 'asc')
            ->take(5)
            ->get();
        
        return view('pages.admin.dashboard.index', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalSubscriptions',
            'pendingOrders',
            'deliveredOrders',
            'arrivedOrders',
            'completedOrders',
            'rejectedOrders',
            'totalRevenue',
            'monthlyRevenue',
            'recentProducts',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}
