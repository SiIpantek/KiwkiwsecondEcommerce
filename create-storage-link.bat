@echo off
echo Membuat symlink storage...
echo.
echo Catatan: Script ini memerlukan hak Administrator
echo.

cd /d "%~dp0"

if exist "public\storage" (
    echo Menghapus folder public\storage yang sudah ada...
    rmdir /s /q "public\storage"
)

echo Membuat symlink dari public\storage ke storage\app\public...
mklink /D "public\storage" "storage\app\public"

if %errorlevel% == 0 (
    echo.
    echo Symlink berhasil dibuat!
    echo Folder public\storage sekarang terhubung ke storage\app\public
) else (
    echo.
    echo Gagal membuat symlink. Pastikan:
    echo 1. Menjalankan script ini sebagai Administrator (klik kanan -^> Run as Administrator)
    echo 2. Folder public\storage tidak sedang digunakan oleh aplikasi lain
)

pause

