@extends('layouts.dashboard')

@section('title', 'Dashboard | E-Commerce')

@section('content')
<div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
  {{-- Header --}}
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="mt-2 text-gray-600">Selamat datang! Pantau dan kelola bisnis Anda dari sini.</p>
  </header>

  {{-- Statistik Cards --}}
  <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Total Produk -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-lg">
            <i class='text-2xl text-indigo-600 bx bx-package'></i>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Total Produk</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Pesanan -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
            <i class='text-2xl text-green-600 bx bx-cart'></i>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Pelanggan -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg">
            <i class='text-2xl text-blue-600 bx bx-user'></i>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Langganan -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <div class="flex items-center">
          <div class="flex-shrink-0 p-3 bg-pink-100 rounded-lg">
            <i class='text-2xl text-pink-600 bx bx-heart'></i>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500">Total Langganan</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalSubscriptions }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Statistik Pendapatan --}}
  <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-2">
    <!-- Total Pendapatan -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendapatan</h3>
        <div class="space-y-4">
          <div>
            <p class="text-sm text-gray-500">Total Pendapatan</p>
            <p class="text-2xl font-bold text-gray-900">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Pendapatan Bulan Ini</p>
            <p class="text-xl font-semibold text-indigo-600">Rp{{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Status Pesanan -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Pesanan</h3>
        <div class="space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Pending</span>
            <span class="px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">{{ $pendingOrders }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Delivered</span>
            <span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">{{ $deliveredOrders }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Arrived</span>
            <span class="px-3 py-1 text-sm font-medium text-purple-800 bg-purple-100 rounded-full">{{ $arrivedOrders }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Completed</span>
            <span class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full">{{ $completedOrders }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Rejected</span>
            <span class="px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full">{{ $rejectedOrders }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Quick Actions --}}
  <div class="mb-8">
    <h3 class="text-xl font-semibold text-gray-900 mb-4">Akses Cepat</h3>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
      <a href="{{ route('dashboard.products.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition">
        <i class='text-4xl text-indigo-600 bx bx-package'></i>
        <span class="mt-2 text-sm font-medium text-gray-700">Produk</span>
      </a>
      <a href="{{ route('dashboard.orders.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition">
        <i class='text-4xl text-green-600 bx bx-cart'></i>
        <span class="mt-2 text-sm font-medium text-gray-700">Pesanan</span>
      </a>
      <a href="{{ route('dashboard.users.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition">
        <i class='text-4xl text-blue-600 bx bx-user'></i>
        <span class="mt-2 text-sm font-medium text-gray-700">Pelanggan</span>
      </a>
      <a href="{{ route('dashboard.subscriptions.index') }}" class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition">
        <i class='text-4xl text-pink-600 bx bx-heart'></i>
        <span class="mt-2 text-sm font-medium text-gray-700">Langganan</span>
      </a>
    </div>
  </div>

  {{-- Produk Terbaru & Pesanan Terbaru --}}
  <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Produk Terbaru -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-gray-900">Produk Terbaru</h3>
          <a href="{{ route('dashboard.products.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Lihat semua</a>
        </div>
        <div class="space-y-4">
          @forelse($recentProducts as $product)
          <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50 transition">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
              <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
              <p class="text-sm font-semibold text-gray-900 mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
          </div>
          @empty
          <p class="text-sm text-gray-500 text-center py-4">Belum ada produk</p>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Pesanan Terbaru -->
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h3>
          <a href="{{ route('dashboard.orders.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700">Lihat semua</a>
        </div>
        <div class="space-y-4">
          @forelse($recentOrders as $order)
          <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition">
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900">#{{ $order->id }}</p>
              <p class="text-xs text-gray-500">{{ $order->user->name }}</p>
              <p class="text-sm font-semibold text-gray-900 mt-1">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>
            <span class="px-2 py-1 text-xs font-medium rounded-full
              @if($order->status == 'pending') bg-yellow-100 text-yellow-800
              @elseif($order->status == 'delivered') bg-blue-100 text-blue-800
              @elseif($order->status == 'arrived') bg-purple-100 text-purple-800
              @elseif($order->status == 'completed') bg-green-100 text-green-800
              @else bg-red-100 text-red-800
              @endif">
              {{ ucfirst($order->status) }}
            </span>
          </div>
          @empty
          <p class="text-sm text-gray-500 text-center py-4">Belum ada pesanan</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  {{-- Stok Rendah --}}
  @if($lowStockProducts->count() > 0)
  <div class="mt-6 overflow-hidden bg-white rounded-lg shadow-sm border border-yellow-200">
    <div class="p-6">
      <div class="flex items-center gap-2 mb-4">
        <i class='text-xl text-yellow-600 bx bx-error-circle'></i>
        <h3 class="text-lg font-semibold text-gray-900">Produk dengan Stok Rendah</h3>
      </div>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @foreach($lowStockProducts as $product)
        <div class="p-3 bg-yellow-50 rounded-lg">
          <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
          <p class="text-xs text-yellow-600 mt-1">Stok: {{ $product->stock_quantity }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
