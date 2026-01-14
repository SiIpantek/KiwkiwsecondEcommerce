<div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
  <header class="text-center">
    <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Koleksi Produk Kami</h2>

    <p class="max-w-md mx-auto mt-4 text-gray-500">
      Temukan berbagai pilihan produk terbaru kami, dengan kualitas terbaik dan desain yang menarik.
    </p>
  </header>

  <ul class="grid grid-cols-1 gap-4 mt-8 lg:grid-cols-3">
    @php
      $collectionImage1 = \App\Models\Setting::getValue('collection_image_1', asset('images/koleksi/koleksi1.jpeg'));
      $collectionImage2 = \App\Models\Setting::getValue('collection_image_2', asset('images/koleksi/koleksi2.jpeg'));
      $collectionImage3 = \App\Models\Setting::getValue('collection_image_3', asset('images/koleksi/koleksi3.jpeg'));
    @endphp
    
    <li>
      <a href="{{ route('products.index') }}" class="relative block group overflow-hidden rounded-lg">
        <img
          src="{{ $collectionImage2 }}"
          alt="Casual Outfit"
          class="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
          <h3 class="text-xl font-medium text-white" style="text-shadow: 0 3px 6px rgba(0,0,0,0.9), 0 1px 3px rgba(0,0,0,0.8);">Casual Outfit</h3>
        </div>
      </a>
    </li>

    <li>
      <a href="{{ route('products.index') }}" class="relative block group overflow-hidden rounded-lg">
        <img
          src="{{ $collectionImage3 }}"
          alt="Hodie Branded"
          class="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
          <h3 class="text-xl font-medium text-white" style="text-shadow: 0 3px 6px rgba(0,0,0,0.9), 0 1px 3px rgba(0,0,0,0.8);">Hodie Branded</h3>
        </div>
      </a>
    </li>

    <li class="lg:col-span-2 lg:col-start-2 lg:row-span-2 lg:row-start-1">
      <a href="{{ route('products.index') }}" class="relative block group overflow-hidden rounded-lg">
        <img
          src="{{ $collectionImage1 }}"
          alt="Stretwear Hoodie"
          class="object-cover w-full transition duration-500 aspect-square group-hover:opacity-90"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col items-start justify-end p-6">
          <h3 class="text-xl font-medium text-white" style="text-shadow: 0 3px 6px rgba(0,0,0,0.9), 0 1px 3px rgba(0,0,0,0.8);">Stretwear Hoodie</h3>
        </div>
      </a>
    </li>
  </ul>
</div>