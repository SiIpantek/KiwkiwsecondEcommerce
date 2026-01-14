<section>
  <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
    <header>
      <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Koleksi Produk</h2>
    
      <p class="max-w-md mt-4 text-gray-500">
        Temukan berbagai produk pilihan yang sesuai dengan kebutuhan dan gaya Anda.
      </p>
    </header>
    
    @if($products->total() > 0)
    <div class="mt-8">
      <p class="text-sm text-gray-500">
        Menampilkan 
        <span class="font-medium text-gray-900">{{ $products->firstItem() }}</span> 
        hingga 
        <span class="font-medium text-gray-900">{{ $products->lastItem() }}</span> 
        dari 
        <span class="font-medium text-gray-900">{{ $products->total() }}</span> 
        produk
      </p>
    </div>    

    <ul class="grid gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-4">
      @foreach ( $products as $product )
      <li class="group">
        <div class="relative block overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm transition-all duration-300 hover:shadow-lg hover:border-gray-300">
          <!-- Badge Diskon -->
          @if ($product->discount > 0)
          <div class="absolute top-2 right-2 z-10">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500 text-white">
              -{{ number_format($product->discount, 0) }}%
            </span>
          </div>
          @endif

          <!-- Container Gambar -->
          <div 
            style="width: 100%; height: 300px; background-color: #e5e7eb; overflow: hidden; position: relative; background-image: url('{{ $product->image_url }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"
            class="product-image-container"
            data-image-url="{{ $product->image_url }}"
          >
            @php
              $imageUrl = $product->image_url;
              $fallbackUrl = asset('images/logo/logo.jpeg');
            @endphp
            <img
              src="{{ $imageUrl }}"
              alt="{{ $product->name }}"
              onerror="console.error('Image error:', this.src); this.style.display='none'; if(this.src !== '{{ $fallbackUrl }}') { this.src='{{ $fallbackUrl }}'; }"
              style="width: 100%; height: 100%; object-fit: cover; display: block;"
              onload="console.log('Image loaded successfully:', this.src, 'Dimensions:', this.naturalWidth, 'x', this.naturalHeight);"
            />
          </div>
        
          <div class="p-4">
            <!-- Harga -->
            <div class="flex items-baseline gap-2">
              @if ($product->discount > 0)
              <p class="text-lg font-bold text-gray-900">
                Rp{{ number_format($product->price - ($product->price * $product->discount / 100), 0, ',', '.') }}
              </p>
              <p class="text-sm text-gray-400 line-through">
                Rp{{ number_format($product->price, 0, ',', '.') }}
              </p>
              @else
              <p class="text-lg font-bold text-gray-900">
                Rp{{ number_format($product->price, 0, ',', '.') }}
              </p>
              @endif
            </div>
        
            <!-- Nama Produk -->
            <h3 class="mt-2 text-base font-semibold text-gray-900 line-clamp-1">
              {{ $product->name }}
            </h3>
        
            <!-- Deskripsi -->
            <p class="mt-1.5 text-sm text-gray-600 line-clamp-2 min-h-[2.5rem]">
              {{ $product->description }}
            </p>

            <!-- Stok -->
            @if($product->stock_quantity > 0)
            <p class="mt-2 text-xs text-green-600">
              <i class='bx bx-check-circle'></i> Stok tersedia
            </p>
            @else
            <p class="mt-2 text-xs text-red-600">
              <i class='bx bx-x-circle'></i> Stok habis
            </p>
            @endif
        
            <!-- Tombol Aksi -->
            <div class="flex flex-col gap-2 mt-4">
              <a
                href="{{ route('checkout.buy_now', $product->slug) }}"
                class="block w-full px-4 py-2.5 text-sm font-medium text-center text-white transition bg-gray-900 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed {{ $product->stock_quantity <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                @if($product->stock_quantity <= 0) onclick="return false;" @endif
              >
                Beli Sekarang
              </a>
              
              @auth
              @if(Auth::user()->role == 'customer')
              <form action="{{ route('cart.store', $product->slug) }}" method="POST" class="w-full">
                @csrf
                <button 
                  type="submit"
                  class="block w-full px-4 py-2.5 text-sm font-medium text-center text-gray-900 transition bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed {{ $product->stock_quantity <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                  @if($product->stock_quantity <= 0) disabled onclick="return false;" @endif
                >
                  <i class='bx bx-cart'></i> Tambah Ke Keranjang
                </button>
              </form>
              @endif
              @endauth
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
    @else
    <!-- Empty State -->
    <div class="mt-12 text-center">
      <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
      </svg>
      <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada produk</h3>
      <p class="mt-2 text-sm text-gray-500">Belum ada produk yang tersedia saat ini.</p>
    </div>
    @endif

    @if($products->hasPages())
    <nav class="flex items-center justify-center gap-2 mt-12" aria-label="Pagination">
      <!-- Tombol Previous -->
      @if ($products->onFirstPage())
          <span class="inline-flex items-center justify-center w-10 h-10 text-gray-400 border border-gray-200 rounded-md cursor-not-allowed bg-gray-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
          </span>
      @else
          <a href="{{ $products->previousPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
              <span class="sr-only">Halaman Sebelumnya</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
          </a>
      @endif

      <!-- Nomor Halaman -->
      @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
          @if ($page == $products->currentPage())
              <span class="inline-flex items-center justify-center w-10 h-10 text-white bg-indigo-600 border border-indigo-600 rounded-md font-medium">
                  {{ $page }}
              </span>
          @else
              <a href="{{ $url }}" class="inline-flex items-center justify-center w-10 h-10 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                  {{ $page }}
              </a>
          @endif
      @endforeach

      <!-- Tombol Next -->
      @if ($products->hasMorePages())
          <a href="{{ $products->nextPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
              <span class="sr-only">Halaman Selanjutnya</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
              </svg>
          </a>
      @else
          <span class="inline-flex items-center justify-center w-10 h-10 text-gray-400 border border-gray-200 rounded-md cursor-not-allowed bg-gray-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
              </svg>
          </span>
      @endif
    </nav>
    @endif
  </div>
</section>