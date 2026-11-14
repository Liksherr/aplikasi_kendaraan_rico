# AntriKendaraan

Aplikasi Laravel untuk mengelola kendaraan dan antrian secara terpisah untuk setiap akun.

## Fitur

- Registrasi, login, dan logout.
- CRUD kendaraan dengan nomor polisi, jenis kendaraan, dan nama pemilik.
- CRUD antrian dengan nomor, tanggal, waktu, kendaraan, dan status.
- Dashboard ringkasan serta daftar antrian.
- Unduh laporan kendaraan dan laporan antrian dalam format PDF.
- Setiap kendaraan dan antrian hanya dapat dilihat dan dikelola oleh akun pemiliknya.

## Menjalankan aplikasi

Persyaratan: PHP 8.3+, Composer, ekstensi PDO SQLite, serta Node.js/npm bila ingin membangun aset frontend.

```powershell
composer install
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
php artisan key:generate
New-Item -ItemType File -Force database\database.sqlite
php artisan migrate
npm install
npm run build
php artisan serve
```

Buka alamat yang ditampilkan oleh `php artisan serve`, lalu buat akun melalui halaman **Daftar**. Build frontend membutuhkan Node.js 20.19+ atau 22.12+. Aplikasi menggunakan SQLite secara default. Sesuaikan koneksi database di `.env` bila menggunakan database lain.

## Pengujian

```powershell
php artisan test
```
