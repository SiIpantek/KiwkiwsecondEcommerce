@extends('layouts.dashboard')

@section('title', 'Koleksi Terbaru | E-Commerce')

@section('content')
{{-- Header --}}
<header class="bg-white">
  <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
    <div class="flex flex-col items-start gap-4 md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Koleksi Terbaru</h1>

        <p class="mt-1.5 text-sm text-gray-500">
          Kelola foto koleksi terbaru yang ditampilkan di halaman produk.
        </p>
      </div>

      <div class="flex items-center gap-4">
        <a href="{{ route('dashboard.featured-collections.create') }}"
          class="inline-block px-5 py-3 text-sm font-medium text-white transition bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring"
          type="button"
        >
          Tambah Koleksi
        </a>
      </div>
    </div>
  </div>
</header>

<section class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
  @if($collections->count() > 0)
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
      @foreach($collections as $collection)
        <div class="overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm">
          <div class="relative h-48 overflow-hidden bg-gray-100">
            <img 
              src="{{ $collection->image_url }}" 
              alt="{{ $collection->title }}"
              class="object-cover w-full h-full"
            >
            @if($collection->is_active)
              <span class="absolute top-2 right-2 px-2 py-1 text-xs font-medium text-white bg-green-500 rounded">Aktif</span>
            @else
              <span class="absolute top-2 right-2 px-2 py-1 text-xs font-medium text-white bg-gray-500 rounded">Nonaktif</span>
            @endif
          </div>
          
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900">{{ $collection->title }}</h3>
            @if($collection->description)
              <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $collection->description }}</p>
            @endif
            <p class="mt-2 text-xs text-gray-500">Urutan: {{ $collection->order }}</p>
            
            <div class="flex items-center gap-2 mt-4">
              <a 
                href="{{ route('dashboard.featured-collections.edit', $collection->id) }}"
                class="flex-1 px-4 py-2 text-sm font-medium text-center text-indigo-600 transition bg-indigo-50 rounded hover:bg-indigo-100"
              >
                Edit
              </a>
              <form 
                action="{{ route('dashboard.featured-collections.destroy', $collection->id) }}" 
                method="POST"
                class="flex-1"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus koleksi ini?');"
              >
                @csrf
                @method('DELETE')
                <button 
                  type="submit"
                  class="w-full px-4 py-2 text-sm font-medium text-center text-red-600 transition bg-red-50 rounded hover:bg-red-100"
                >
                  Hapus
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="text-center py-12">
      <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada koleksi</h3>
      <p class="mt-2 text-sm text-gray-500">Mulai dengan menambahkan koleksi terbaru pertama Anda.</p>
      <div class="mt-6">
        <a 
          href="{{ route('dashboard.featured-collections.create') }}"
          class="inline-block px-5 py-3 text-sm font-medium text-white transition bg-indigo-600 rounded hover:bg-indigo-700"
        >
          Tambah Koleksi
        </a>
      </div>
    </div>
  @endif
</section>
@endsection
