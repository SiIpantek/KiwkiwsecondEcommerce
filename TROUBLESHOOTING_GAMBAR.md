# Troubleshooting Masalah Gambar Produk

## Masalah: Foto hilang setelah diganti di dashboard admin

### Perbaikan yang sudah dilakukan:
1. ✅ File baru disimpan terlebih dahulu sebelum menghapus file lama
2. ✅ Nama file dibuat unik untuk menghindari konflik
3. ✅ Model di-refresh setelah update
4. ✅ Cache busting ditambahkan pada URL gambar
5. ✅ Verifikasi file tersimpan sebelum update database

### Langkah Troubleshooting:

#### 1. Pastikan Symlink Storage Sudah Dibuat
Jalankan salah satu cara berikut:

**Cara 1: Menggunakan Script Batch**
- Klik kanan pada file `create-storage-link.bat`
- Pilih "Run as Administrator"
- Tunggu sampai selesai

**Cara 2: Manual via Command Prompt (Admin)**
```cmd
cd "C:\laragon\www\kiwkiw E comers"
mklink /D "public\storage" "storage\app\public"
```

**Cara 3: Menggunakan Laravel Artisan**
```bash
php artisan storage:link
```

#### 2. Clear Browser Cache
- Tekan `Ctrl + Shift + Delete` untuk membuka dialog clear cache
- Atau tekan `Ctrl + F5` untuk hard refresh halaman

#### 3. Periksa File di Storage
Pastikan file benar-benar ada di:
```
storage/app/public/products/
```

#### 4. Periksa Permission Folder
Pastikan folder `storage/app/public/products` memiliki permission write

#### 5. Test Upload Gambar Baru
1. Login ke dashboard admin
2. Edit produk yang bermasalah
3. Upload gambar baru
4. Simpan
5. Refresh halaman produk (Ctrl + F5)
6. Cek apakah gambar muncul

### Catatan Penting:
- Setelah upload gambar baru, selalu refresh halaman dengan `Ctrl + F5`
- Pastikan symlink sudah dibuat sebelum upload gambar
- Jika masih bermasalah, cek log Laravel di `storage/logs/laravel.log`

