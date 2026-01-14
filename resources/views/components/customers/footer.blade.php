@php
  $instagram = \App\Models\Setting::getValue('footer_instagram', '');
  $tiktok = \App\Models\Setting::getValue('footer_tiktok', '');
  $email = \App\Models\Setting::getValue('footer_email', '');
  $alamat = \App\Models\Setting::getValue('footer_alamat', '');
  $logo = \App\Models\Setting::getValue('logo', null);
  
  // Format Instagram URL
  $instagramUrl = $instagram;
  if ($instagram) {
    if (str_starts_with($instagram, 'http://') || str_starts_with($instagram, 'https://')) {
      $instagramUrl = $instagram;
    } elseif (str_starts_with($instagram, '@')) {
      $instagramUrl = 'https://instagram.com/' . substr($instagram, 1);
    } else {
      $instagramUrl = 'https://instagram.com/' . $instagram;
    }
  }
  
  // Format TikTok URL
  $tiktokUrl = $tiktok;
  if ($tiktok) {
    if (str_starts_with($tiktok, 'http://') || str_starts_with($tiktok, 'https://')) {
      $tiktokUrl = $tiktok;
    } elseif (str_starts_with($tiktok, '@')) {
      $tiktokUrl = 'https://tiktok.com/@' . substr($tiktok, 1);
    } else {
      $tiktokUrl = 'https://tiktok.com/@' . $tiktok;
    }
  }
  
  // Extract username untuk display (tanpa @ dan URL)
  $instagramUsername = '';
  if ($instagram) {
    // Hapus protocol dan domain
    $instagramUsername = preg_replace('/^(https?:\/\/)?(www\.)?(instagram\.com\/|instagram\.com\/@?)/i', '', $instagram);
    // Hapus @ di awal
    $instagramUsername = ltrim($instagramUsername, '@');
    // Hapus trailing slash
    $instagramUsername = rtrim($instagramUsername, '/');
  }
  
  $tiktokUsername = '';
  if ($tiktok) {
    // Hapus protocol dan domain
    $tiktokUsername = preg_replace('/^(https?:\/\/)?(www\.)?(tiktok\.com\/@?|vm\.tiktok\.com\/)/i', '', $tiktok);
    // Hapus @ di awal
    $tiktokUsername = ltrim($tiktokUsername, '@');
    // Hapus trailing slash
    $tiktokUsername = rtrim($tiktokUsername, '/');
  }
@endphp
<footer class="bg-slate-950 text-slate-50">
  <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
      {{-- Logo Section --}}
      <div class="lg:col-span-1">
        <div class="flex justify-center md:justify-start mb-4">
          @if($logo)
            <img src="{{ $logo }}" alt="Logo" class="h-10 object-contain">
          @else
            <span class="text-teal-400 font-semibold text-xl">LOGO</span>
          @endif
        </div>
        <p class="text-sm text-slate-300 text-center md:text-left">
          Platform e-commerce terpercaya untuk kebutuhan fashion Anda.
        </p>
      </div>

      {{-- Kontak Section --}}
      @if($email || $alamat)
      <div>
        <h3 class="text-lg font-semibold mb-4 text-center md:text-left">Kontak</h3>
        <ul class="space-y-3 text-sm">
          @if($email)
          <li class="flex items-start gap-3 justify-center md:justify-start">
            <svg class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <a href="mailto:{{ $email }}" class="text-slate-300 hover:text-teal-400 transition">{{ $email }}</a>
          </li>
          @endif
          @if($alamat)
          <li class="flex items-start gap-3 justify-center md:justify-start">
            <svg class="w-5 h-5 text-teal-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-slate-300">{{ $alamat }}</span>
          </li>
          @endif
        </ul>
      </div>
      @endif

      {{-- Social Media Section --}}
      @if($instagram || $tiktok)
      <div>
        <h3 class="text-lg font-semibold mb-4 text-center md:text-left">Ikuti Kami</h3>
        <ul class="space-y-3 text-sm">
          @if($instagram)
          <li class="flex items-center gap-3 justify-center md:justify-start">
            <svg class="w-5 h-5 text-teal-400" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="text-slate-300 hover:text-teal-400 transition">
              {{ '@' . $instagramUsername }}
            </a>
          </li>
          @endif
          @if($tiktok)
          <li class="flex items-center gap-3 justify-center md:justify-start">
            <svg class="w-5 h-5 text-teal-400" fill="currentColor" viewBox="0 0 24 24">
              <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
            </svg>
            <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" class="text-slate-300 hover:text-teal-400 transition">
              {{ '@' . $tiktokUsername }}
            </a>
          </li>
          @endif
        </ul>
      </div>
      @endif

      {{-- Links Section --}}
      <div>
        <h3 class="text-lg font-semibold mb-4 text-center md:text-left">Tautan</h3>
        <ul class="space-y-3 text-sm">
          <li class="text-center md:text-left">
            <a href="{{ route('home.index') }}" class="text-slate-300 hover:text-teal-400 transition">Beranda</a>
          </li>
          <li class="text-center md:text-left">
            <a href="{{ route('products.index') }}" class="text-slate-300 hover:text-teal-400 transition">Produk</a>
          </li>
          @auth
          <li class="text-center md:text-left">
            <a href="{{ route('orders.index') }}" class="text-slate-300 hover:text-teal-400 transition">Pesanan</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>

    {{-- Copyright --}}
    <div class="mt-8 pt-8 border-t border-slate-800">
      <p class="text-center text-sm text-slate-400">
        Copyright &copy; {{ date('Y') }}. All rights reserved.
      </p>
    </div>
  </div>
</footer>
