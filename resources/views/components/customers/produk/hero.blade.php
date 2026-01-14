@php
  $productHeroBg = \App\Models\Setting::getValue('product_hero_image', null);
@endphp
<section class="relative overflow-hidden pt-16" style="{{ $productHeroBg ? 'background-image: url(\'' . $productHeroBg . '\'); background-size: cover; background-position: center;' : 'background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #1f2937 100%);' }}">
  @if($productHeroBg)
    <!-- Overlay gradient untuk readability yang lebih baik -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/50 to-black/70"></div>
  @else
    <!-- Background Pattern (jika tidak ada background image) -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
  @endif
  
  <div class="relative p-8 md:p-12 lg:px-16 lg:py-24">
    <div class="max-w-screen-xl mx-auto">
      <div class="text-center">
        <h2 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl lg:text-6xl" style="color: #ffffff !important; text-shadow: 0 4px 8px rgba(0,0,0,0.8), 0 2px 4px rgba(0,0,0,0.9);">
          Koleksi Terbaru
        </h2>

        <p class="max-w-2xl mx-auto mt-4 text-base sm:text-lg md:text-xl md:mt-6 md:leading-relaxed" style="color: #ffffff !important; text-shadow: 0 2px 6px rgba(0,0,0,0.8), 0 1px 3px rgba(0,0,0,0.9);">
          Temukan pilihan produk terbaru dengan kualitas terbaik, hadir untuk melengkapi gaya dan kebutuhan Anda dengan sentuhan modern.
        </p>
      </div>
    </div>
  </div>
</section>
