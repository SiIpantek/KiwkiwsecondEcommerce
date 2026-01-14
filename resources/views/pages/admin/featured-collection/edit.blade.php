@extends('layouts.dashboard')

@section('title', 'Edit Koleksi Terbaru | E-Commerce')

@section('content')
<div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Edit Koleksi Terbaru</h1>
    <p class="mt-2 text-gray-600">Edit informasi dan gambar koleksi terbaru.</p>
  </header>

  <form action="{{ route('dashboard.featured-collections.update', $collection->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <div class="overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="p-6 space-y-6">
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Koleksi</label>
          <input 
            type="text" 
            id="title" 
            name="title" 
            value="{{ old('title', $collection->title) }}"
            required
            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Contoh: Koleksi Musim Panas 2024"
          >
          @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
          <textarea 
            id="description" 
            name="description" 
            rows="3"
            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Deskripsi singkat tentang koleksi ini..."
          >{{ old('description', $collection->description) }}</textarea>
          @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Koleksi</label>
          <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-shrink-0">
              <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
              <div class="w-full md:w-64 h-48 border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                <img src="{{ $collection->image_url }}" alt="{{ $collection->title }}" class="w-full h-full object-cover" id="current-image">
              </div>
            </div>
            <div class="flex-1">
              <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Unggah Gambar Baru (Opsional)</label>
              <input 
                type="file" 
                id="image" 
                name="image" 
                accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                onchange="previewImage(this, 'current-image', null)"
              >
              @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
              <p class="mt-2 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, GIF, SVG. Maksimal 5MB.</p>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Urutan Tampil</label>
            <input 
              type="number" 
              id="order" 
              name="order" 
              value="{{ old('order', $collection->order) }}"
              min="0"
              class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            >
            <p class="mt-1 text-xs text-gray-500">Angka lebih kecil akan ditampilkan lebih dulu</p>
            @error('order')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="flex items-center gap-2 mt-6">
              <input 
                type="checkbox" 
                name="is_active" 
                value="1"
                {{ old('is_active', $collection->is_active) ? 'checked' : '' }}
                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
              >
              <span class="text-sm font-medium text-gray-700">Aktifkan koleksi ini</span>
            </label>
            <p class="mt-1 text-xs text-gray-500">Koleksi yang tidak aktif tidak akan ditampilkan</p>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-end gap-4">
      <a 
        href="{{ route('dashboard.featured-collections.index') }}"
        class="px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
      >
        Batal
      </a>
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
function previewImage(input, previewId, placeholderId) {
  const preview = document.getElementById(previewId);
  const file = input.files[0];
  
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
      if (placeholderId) {
        const placeholder = document.getElementById(placeholderId);
        if (placeholder) {
          placeholder.style.display = 'none';
        }
      }
    };
    reader.readAsDataURL(file);
  }
}
</script>
@endsection
