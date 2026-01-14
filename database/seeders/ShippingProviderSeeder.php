<?php

namespace Database\Seeders;

use App\Models\ShippingProvider;
use App\Models\ShippingRate;
use Illuminate\Database\Seeder;

class ShippingProviderSeeder extends Seeder
{
    public function run(): void
    {
        $providers = [
            ['name' => 'JNE', 'code' => 'jne', 'base_price' => 10000, 'price_per_kg' => 5000],
            ['name' => 'J&T Express', 'code' => 'jnt', 'base_price' => 12000, 'price_per_kg' => 6000],
            ['name' => 'TIKI', 'code' => 'tiki', 'base_price' => 15000, 'price_per_kg' => 7000],
            ['name' => 'POS Indonesia', 'code' => 'pos', 'base_price' => 8000, 'price_per_kg' => 4000],
            ['name' => 'SiCepat', 'code' => 'sicepat', 'base_price' => 11000, 'price_per_kg' => 5500],
        ];

        $provinces = [
            'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau',
            'Jambi', 'Sumatera Selatan', 'Bangka Belitung', 'Bengkulu', 'Lampung',
            'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Tengah', 'DI Yogyakarta',
            'Jawa Timur', 'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
            'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
            'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat',
            'Maluku', 'Maluku Utara', 'Papua Barat', 'Papua'
        ];

        foreach ($providers as $providerData) {
            $provider = ShippingProvider::create($providerData);

            // Buat shipping rates untuk setiap provinsi
            foreach ($provinces as $province) {
                // Tarif berbeda berdasarkan provinsi (Jawa lebih murah, luar Jawa lebih mahal)
                $baseRate = in_array($province, ['DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur']) 
                    ? $provider->base_price 
                    : $provider->base_price * 1.5;

                ShippingRate::create([
                    'shipping_provider_id' => $provider->id,
                    'province' => $province,
                    'rate' => $baseRate,
                ]);
            }
        }
    }
}
