<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeaturedCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = FeaturedCollection::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('pages.admin.featured-collection.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.featured-collection.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul harus diisi.',
            'image.required' => 'Gambar harus diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, PNG, GIF, atau SVG.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('collections', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order'] = $request->input('order', 0);

        FeaturedCollection::create($validated);

        return redirect()->route('dashboard.featured-collections.index')
            ->with('success', 'Koleksi terbaru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collection = FeaturedCollection::findOrFail($id);
        return view('pages.admin.featured-collection.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection = FeaturedCollection::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul harus diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, PNG, GIF, atau SVG.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($collection->image && strpos($collection->image, 'storage/') !== false) {
                $oldPath = str_replace('storage/', '', $collection->image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $imagePath = $request->file('image')->store('collections', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order'] = $request->input('order', $collection->order);

        $collection->update($validated);

        return redirect()->route('dashboard.featured-collections.index')
            ->with('success', 'Koleksi terbaru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collection = FeaturedCollection::findOrFail($id);

        // Delete image
        if ($collection->image && strpos($collection->image, 'storage/') !== false) {
            $oldPath = str_replace('storage/', '', $collection->image);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $collection->delete();

        return redirect()->route('dashboard.featured-collections.index')
            ->with('success', 'Koleksi terbaru berhasil dihapus.');
    }
}
