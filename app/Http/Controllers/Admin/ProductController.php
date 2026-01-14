<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        
        return view('pages.admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('pages.admin.product.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'required|integer',
            'discount' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10024',
        ], [
            'name.required' => 'Nama produk harus diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk tidak boleh lebih dari :max karakter.',
            'description.required' => 'Deskripsi produk harus diisi.',
            'description.string' => 'Deskripsi produk harus berupa teks.',
            'price.required' => 'Harga produk harus diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'category_id.required' => 'Kategori produk harus dipilih.',
            'category_id.exists' => 'Kategori produk tidak ditemukan.',
            'stock_quantity.required' => 'Stok produk harus diisi.',
            'stock_quantity.integer' => 'Stok produk harus berupa angka.',
            'discount.numeric' => 'Diskon produk harus berupa angka.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format file gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 10 MB.',
        ]);

        // Proses upload file gambar jika ada
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            
            // Buat nama file unik untuk menghindari konflik
            $fileName = $nameWithoutExtension . '_' . time() . '_' . uniqid() . '.' . $extension;
            
            // Simpan file
            $file->storeAs('products', $fileName, 'public');
            
            // Pastikan file tersimpan sebelum menyimpan ke database
            if (Storage::disk('public')->exists('products/' . $fileName)) {
                $validatedData['image'] = $fileName;
            } else {
                return back()->withErrors(['image' => 'Gagal menyimpan gambar. Silakan coba lagi.'])->withInput();
            }
        }

        // Buat slug dari nama produk
        $validatedData['slug'] = Str::slug($validatedData['name']);

        // Simpan data ke dalam database
        Product::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('pages.admin.product.edit', compact('product'));
    }

    public function update(Request $request, $slug)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'required|integer',
            'discount' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10024',
        ], [
            'name.required' => 'Nama produk harus diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk tidak boleh lebih dari :max karakter.',
            'description.required' => 'Deskripsi produk harus diisi.',
            'description.string' => 'Deskripsi produk harus berupa teks.',
            'price.required' => 'Harga produk harus diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'category_id.required' => 'Kategori produk harus dipilih.',
            'category_id.exists' => 'Kategori produk tidak ditemukan.',
            'stock_quantity.required' => 'Stok produk harus diisi.',
            'stock_quantity.integer' => 'Stok produk harus berupa angka.',
            'discount.required' => 'Diskon produk harus diisi.',
            'discount.numeric' => 'Diskon produk harus berupa angka.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format file gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 10 MB.',
        ]);

        // Temukan produk berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Update data produk
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        $product->stock_quantity = $validatedData['stock_quantity'];
        $product->discount = $validatedData['discount'];

        // Perbarui file gambar jika ada
        if ($request->hasFile('image')) {
            // Simpan gambar baru terlebih dahulu
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            
            // Buat nama file unik untuk menghindari konflik
            $fileName = $nameWithoutExtension . '_' . time() . '_' . uniqid() . '.' . $extension;
            
            // Simpan file baru
            $stored = $file->storeAs('products', $fileName, 'public');
            
            // Pastikan file baru benar-benar tersimpan
            if ($stored && Storage::disk('public')->exists('products/' . $fileName)) {
                // Simpan nama file lama untuk dihapus nanti
                $oldImage = $product->image;
                
                // Update nama file di database
                $product->image = $fileName;
                
                // Simpan perubahan ke database terlebih dahulu
                $product->save();
                
                // Refresh model untuk memastikan data terbaru
                $product->refresh();
                
                // Hapus gambar lama jika ada dan berbeda dengan file baru
                if ($oldImage && $oldImage !== $fileName) {
                    // Cek dan hapus dari storage
                    if (Storage::disk('public')->exists('products/' . $oldImage)) {
                        Storage::disk('public')->delete('products/' . $oldImage);
                    }
                    // Cek dan hapus dari filesystem langsung juga
                    $oldPath = storage_path('app/public/products/' . $oldImage);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            } else {
                // Jika file gagal disimpan, kembalikan error
                return back()->withErrors(['image' => 'Gagal menyimpan gambar. Silakan coba lagi.'])->withInput();
            }
        } else {
            // Jika tidak ada file baru, simpan perubahan lainnya
            $product->save();
        }

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Pastikan untuk mengecek apakah produk memiliki file gambar sebelum menghapus
        if ($product->image) {
            $imagePath = storage_path('app/public/products/' . $product->image);

            // Cek apakah file gambar benar-benar ada, lalu hapus
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus data produk dari database
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Produk berhasil dihapus.');
    }

}
