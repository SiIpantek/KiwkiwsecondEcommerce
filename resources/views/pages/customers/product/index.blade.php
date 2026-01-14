@extends('layouts.app')

@section('title', 'Produk | E-Commerce')

@section('content')
  <main>
    @include('components.customers.produk.hero')
  </main>

  {{-- Featured Collections Section --}}
  @if($featuredCollections->count() > 0)
  <section class="py-12 bg-white">
    <div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Koleksi Terbaru</h2>
        <p class="mt-2 text-gray-600">Temukan pilihan produk terbaru dengan kualitas terbaik</p>
      </div>
      
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($featuredCollections as $collection)
          <div class="relative overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm transition-all duration-300 hover:shadow-lg hover:border-gray-300 group">
            <div class="relative h-64 overflow-hidden bg-gray-100">
              <img 
                src="{{ $collection->image_url }}" 
                alt="{{ $collection->title }}"
                class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110"
              >
              <div class="absolute inset-0 flex flex-col items-start justify-end p-4 md:p-6 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                <h3 class="text-xl font-semibold text-white mb-1 md:mb-2" style="text-shadow: 0 2px 4px rgba(0,0,0,0.9);">{{ $collection->title }}</h3>
                @if($collection->description)
                  <p class="text-sm text-white" style="text-shadow: 0 1px 3px rgba(0,0,0,0.9);">{{ mb_strlen($collection->description) > 100 ? mb_substr($collection->description, 0, 100) . '...' : $collection->description }}</p>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <section>
    @include('components.customers.produk.collection', ['products' => $products])
  </section>
@endsection
