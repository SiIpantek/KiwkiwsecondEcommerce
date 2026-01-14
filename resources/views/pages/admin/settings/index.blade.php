@extends('layouts.dashboard')

@section('title', 'Pengaturan | E-Commerce')

@section('content')
<div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
  {{-- Header --}}
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Pengaturan</h1>
    <p class="mt-2 text-gray-600">Kelola logo, gambar hero, dan gambar koleksi produk untuk website Anda.</p>
  </header>

  <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    {{-- Logo Section --}}
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Logo Website</h2>
        <p class="text-sm text-gray-600 mb-6">Unggah logo yang akan ditampilkan di navbar website. Format: JPG, PNG, GIF, SVG. Maksimal 2MB.</p>
        
        <div class="flex flex-col md:flex-row gap-6">
          {{-- Current Logo Preview --}}
          <div class="flex-shrink-0">
            <label class="block text-sm font-medium text-gray-700 mb-2">Logo Saat Ini</label>
            <div class="w-48 h-32 border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
              @if($logo)
                <img src="{{ $logo }}" alt="Current Logo" class="max-w-full max-h-full object-contain" id="logo-preview">
              @else
                <span class="text-gray-400 text-sm">Tidak ada logo</span>
              @endif
            </div>
          </div>

          {{-- Upload Logo --}}
          <div class="flex-1">
            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Unggah Logo Baru</label>
            <input 
              type="file" 
              name="logo" 
              id="logo" 
              accept="image/*"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
              onchange="previewImage(this, 'logo-preview')"
            >
            @error('logo')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Maksimal 2MB.</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Hero Image Section --}}
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Gambar Hero (Banner Homepage)</h2>
        <p class="text-sm text-gray-600 mb-6">Unggah gambar yang akan ditampilkan di bagian hero homepage. Format: JPG, PNG, GIF, SVG. Maksimal 5MB.</p>
        
        <div class="flex flex-col md:flex-row gap-6">
          {{-- Current Hero Image Preview --}}
          <div class="flex-shrink-0">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Hero Saat Ini</label>
            <div class="w-full md:w-96 h-64 border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
              @if($heroImage)
                <img src="{{ $heroImage }}" alt="Current Hero Image" class="w-full h-full object-cover" id="hero-preview">
              @else
                <span class="text-gray-400 text-sm">Tidak ada gambar</span>
              @endif
            </div>
          </div>

          {{-- Upload Hero Image --}}
          <div class="flex-1">
            <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">Unggah Gambar Hero Baru</label>
            <input 
              type="file" 
              name="hero_image" 
              id="hero_image" 
              accept="image/*"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
              onchange="previewImage(this, 'hero-preview')"
            >
            @error('hero_image')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Maksimal 5MB.</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Product Hero Image Section (Koleksi Terbaru Banner) --}}
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Gambar Background Hero "Koleksi Terbaru"</h2>
        <p class="text-sm text-gray-600 mb-6">Unggah gambar background untuk banner "Koleksi Terbaru" di halaman produk. Gambar akan menggantikan background hitam polos. Format: JPG, PNG, GIF, SVG. Maksimal 5MB.</p>
        
        <div class="flex flex-col md:flex-row gap-6">
          {{-- Current Background Preview --}}
          <div class="flex-shrink-0">
            <label class="block text-sm font-medium text-gray-700 mb-2">Background Saat Ini</label>
            <div class="w-full md:w-96 h-64 border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-900 flex items-center justify-center">
              @if($productHeroImage)
                <img src="{{ $productHeroImage }}" alt="Product Hero Background" class="w-full h-full object-cover" id="product-hero-preview">
                <span class="text-gray-400 text-sm" id="product-hero-placeholder" style="display: none;">Background hitam polos (default)</span>
              @else
                <img src="" alt="Product Hero Background" class="w-full h-full object-cover" id="product-hero-preview" style="display: none;">
                <span class="text-gray-400 text-sm" id="product-hero-placeholder">Background hitam polos (default)</span>
              @endif
            </div>
          </div>

          {{-- Upload Background --}}
          <div class="flex-1">
            <label for="product_hero_image" class="block text-sm font-medium text-gray-700 mb-2">Unggah Background Baru</label>
            <input 
              type="file" 
              name="product_hero_image" 
              id="product_hero_image" 
              accept="image/*"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
              onchange="previewImage(this, 'product-hero-preview', 'product-hero-placeholder')"
            >
            @error('product_hero_image')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG. Maksimal 5MB.</p>
            @if($productHeroImage)
              <button 
                type="button"
                onclick="if(confirm('Hapus background image? Akan kembali ke background hitam polos.')) { document.getElementById('remove_product_hero_image').value = '1'; }"
                class="mt-2 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100"
              >
                Hapus Background
              </button>
              <input type="hidden" name="remove_product_hero_image" id="remove_product_hero_image" value="0">
            @endif
          </div>
        </div>
      </div>
    </div>

    {{-- Collection Images Section --}}
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Gambar Koleksi Produk</h2>
        <p class="text-sm text-gray-600 mb-6">Unggah gambar yang akan ditampilkan di bagian koleksi produk homepage. Format: JPG, PNG, GIF, SVG. Maksimal 5MB per gambar.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          @foreach([1, 2, 3] as $index)
            @php
              $imageVar = "collectionImage{$index}";
              $previewId = "collection-{$index}-preview";
              $inputId = "collection_image_{$index}";
            @endphp
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Koleksi {{ $index }}</label>
              <div class="w-full h-48 border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center mb-2" id="collection-{{ $index }}-container">
                @if($$imageVar)
                  <img src="{{ $$imageVar }}" alt="Collection Image {{ $index }}" class="w-full h-full object-cover" id="{{ $previewId }}">
                  <span class="text-gray-400 text-sm" id="collection-{{ $index }}-placeholder" style="display: none;">Tidak ada gambar</span>
                @else
                  <img src="" alt="Collection Image {{ $index }}" class="w-full h-full object-cover" id="{{ $previewId }}" style="display: none;">
                  <span class="text-gray-400 text-sm" id="collection-{{ $index }}-placeholder">Tidak ada gambar</span>
                @endif
              </div>
              <input 
                type="file" 
                name="collection_image_{{ $index }}" 
                id="{{ $inputId }}" 
                accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                onchange="previewImage(this, '{{ $previewId }}')"
              >
              @error("collection_image_{$index}")
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Footer Settings Section --}}
    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Pengaturan Footer</h2>
        <p class="text-sm text-gray-600 mb-6">Kelola informasi kontak dan sosial media yang ditampilkan di footer website.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          {{-- Email --}}
          <div>
            <label for="footer_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input 
              type="email" 
              id="footer_email" 
              name="footer_email" 
              value="{{ old('footer_email', $footerEmail) }}"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="contoh@email.com"
            >
            @error('footer_email')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Instagram --}}
          <div>
            <label for="footer_instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram Username</label>
            <input 
              type="text" 
              id="footer_instagram" 
              name="footer_instagram" 
              value="{{ old('footer_instagram', $footerInstagram) }}"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="@username atau username"
            >
            <p class="mt-1 text-xs text-gray-500">Contoh: @kiwkiwecommerce atau kiwkiwecommerce. Bisa juga dengan URL lengkap.</p>
            @error('footer_instagram')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- TikTok --}}
          <div>
            <label for="footer_tiktok" class="block text-sm font-medium text-gray-700 mb-2">TikTok Username</label>
            <input 
              type="text" 
              id="footer_tiktok" 
              name="footer_tiktok" 
              value="{{ old('footer_tiktok', $footerTiktok) }}"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="@username atau username"
            >
            <p class="mt-1 text-xs text-gray-500">Contoh: @kiwkiwecommerce atau kiwkiwecommerce. Bisa juga dengan URL lengkap.</p>
            @error('footer_tiktok')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Alamat --}}
          <div class="md:col-span-2">
            <label for="footer_alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <textarea 
              id="footer_alamat" 
              name="footer_alamat" 
              rows="3"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Masukkan alamat lengkap toko/alamat perusahaan"
            >{{ old('footer_alamat', $footerAlamat) }}</textarea>
            @error('footer_alamat')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>
    </div>

    {{-- Submit Button --}}
    <div class="flex justify-end">
      <button 
        type="submit" 
        class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
      >
        Simpan Perubahan
      </button>
    </div>
  </form>
</div>

<script>
function previewImage(input, previewId) {
  const preview = document.getElementById(previewId);
  const file = input.files[0];
  
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
      
      // Hide placeholder if exists
      const placeholderId = previewId.replace('-preview', '-placeholder');
      const placeholder = document.getElementById(placeholderId);
      if (placeholder) {
        placeholder.style.display = 'none';
      } else {
        // Fallback: hide any span in parent
        const span = preview.parentElement.querySelector('span');
        if (span) {
          span.style.display = 'none';
        }
      }
    };
    reader.readAsDataURL(file);
  }
}
</script>
@endsection
