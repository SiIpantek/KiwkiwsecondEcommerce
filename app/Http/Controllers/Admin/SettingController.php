<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $logo = Setting::getValue('logo', asset('images/logo/logo.jpeg'));
        $heroImage = Setting::getValue('hero_image', asset('images/beranda/beranda.jpeg'));
        $collectionImage1 = Setting::getValue('collection_image_1', asset('images/koleksi/koleksi1.jpeg'));
        $collectionImage2 = Setting::getValue('collection_image_2', asset('images/koleksi/koleksi2.jpeg'));
        $collectionImage3 = Setting::getValue('collection_image_3', asset('images/koleksi/koleksi3.jpeg'));
        $productHeroImage = Setting::getValue('product_hero_image', null);
        $footerInstagram = Setting::getValue('footer_instagram', '');
        $footerTiktok = Setting::getValue('footer_tiktok', '');
        $footerEmail = Setting::getValue('footer_email', '');
        $footerAlamat = Setting::getValue('footer_alamat', '');
        
        return view('pages.admin.settings.index', compact('logo', 'heroImage', 'collectionImage1', 'collectionImage2', 'collectionImage3', 'productHeroImage', 'footerInstagram', 'footerTiktok', 'footerEmail', 'footerAlamat'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'collection_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'collection_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'collection_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'product_hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'footer_instagram' => 'nullable|string|max:255',
            'footer_tiktok' => 'nullable|string|max:255',
            'footer_email' => 'nullable|email|max:255',
            'footer_alamat' => 'nullable|string|max:500',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            $oldLogo = Setting::getValue('logo');
            if ($oldLogo && strpos($oldLogo, 'storage/') !== false) {
                $oldPath = str_replace(asset('storage/'), '', $oldLogo);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::setValue('logo', asset('storage/' . $logoPath));
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old hero image if exists
            $oldHeroImage = Setting::getValue('hero_image');
            if ($oldHeroImage && strpos($oldHeroImage, 'storage/') !== false) {
                $oldPath = str_replace(asset('storage/'), '', $oldHeroImage);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new hero image
            $heroImagePath = $request->file('hero_image')->store('settings', 'public');
            Setting::setValue('hero_image', asset('storage/' . $heroImagePath));
        }

        // Handle collection images upload
        for ($i = 1; $i <= 3; $i++) {
            $fieldName = "collection_image_{$i}";
            if ($request->hasFile($fieldName)) {
                // Delete old collection image if exists
                $oldImage = Setting::getValue($fieldName);
                if ($oldImage && strpos($oldImage, 'storage/') !== false) {
                    $oldPath = str_replace(asset('storage/'), '', $oldImage);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                // Store new collection image
                $imagePath = $request->file($fieldName)->store('settings', 'public');
                Setting::setValue($fieldName, asset('storage/' . $imagePath));
            }
        }

        // Handle product hero image (Koleksi Terbaru banner) upload
        if ($request->hasFile('product_hero_image')) {
            // Delete old product hero image if exists
            $oldProductHeroImage = Setting::getValue('product_hero_image');
            if ($oldProductHeroImage && strpos($oldProductHeroImage, 'storage/') !== false) {
                $oldPath = str_replace(asset('storage/'), '', $oldProductHeroImage);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new product hero image
            $productHeroImagePath = $request->file('product_hero_image')->store('settings', 'public');
            Setting::setValue('product_hero_image', asset('storage/' . $productHeroImagePath));
        }

        // Handle remove product hero image
        if ($request->has('remove_product_hero_image') && $request->input('remove_product_hero_image') == '1') {
            $oldProductHeroImage = Setting::getValue('product_hero_image');
            if ($oldProductHeroImage && strpos($oldProductHeroImage, 'storage/') !== false) {
                $oldPath = str_replace(asset('storage/'), '', $oldProductHeroImage);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            Setting::where('key', 'product_hero_image')->delete();
        }

        // Handle footer settings
        Setting::setValue('footer_instagram', $request->input('footer_instagram', ''));
        Setting::setValue('footer_tiktok', $request->input('footer_tiktok', ''));
        Setting::setValue('footer_email', $request->input('footer_email', ''));
        Setting::setValue('footer_alamat', $request->input('footer_alamat', ''));

        return redirect()->route('dashboard.settings.index')
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
