# Titik UMKM

Titik UMKM adalah aplikasi Laravel untuk menghubungkan pelaku UMKM, investor, dan pengelolaan ruko. Aplikasi menyediakan pendaftaran dan verifikasi akun, formulir pengajuan, dashboard mitra, pengelolaan investasi dan sewa, serta panel administrasi.

## Teknologi

- PHP 8.3+
- Laravel 13
- Filament
- Database ditentukan lewat konfigurasi Laravel (`.env`)
- Vite, Tailwind CSS 4, JavaScript
- PHPUnit untuk tes; Playwright tersedia untuk tes browser

## Persiapan

Prasyarat: PHP 8.3+, Composer, Node.js dan npm. Siapkan juga ekstensi PHP yang dibutuhkan Laravel serta database yang dipilih.

```bash
composer install
copy .env.example .env
php artisan key:generate
npm install
php artisan migrate
npm run build
```

Di PowerShell, `copy` memakai perintah bawaan; pada shell Unix gunakan `cp .env.example .env`. Periksa `.env` sebelum menjalankan migrasi. Pastikan konfigurasi database, mail, Google OAuth, chatbot, dan penyimpanan sesuai lingkungan Anda. Jangan commit `.env` atau kredensial.

## Menjalankan aplikasi

```bash
php artisan serve
```

Untuk pengembangan aset, jalankan di terminal lain:

```bash
npm run dev
```

## Tes dan pemeriksaan

```bash
php artisan test
npm run build
```

Tes browser tersedia melalui Playwright; periksa konfigurasi `playwright.config.ts` sebelum menjalankannya.

## Akun administrasi

`database/seeders/AdminUserSeeder.php` menyiapkan akun superadmin `admin@dayaumkm.id` dan akun staf. Alamat superadmin dipertahankan untuk login sesuai konfigurasi proyek. Seeder memakai kata sandi awal yang hanya untuk pengembangan. Sebelum menggunakan seeder, tetapkan `SUPERADMIN_PASSWORD` di lingkungan lokal yang terlindungi, jalankan seeder hanya pada database yang Anda maksud, lalu ganti kredensial awal. Jangan gunakan kredensial contoh di layanan publik.

## Dokumen legal

Halaman Syarat dan Ketentuan serta Kebijakan Privasi di aplikasi masih berstatus draf. Isinya untuk demonstrasi perlombaan, bukan nasihat atau pengesahan hukum. Jangan anggap berlaku bagi pengguna sebelum data operasional dilengkapi dan dokumen ditinjau oleh penasihat hukum.

## Catatan proyek

Rute aplikasi berada di `routes/web.php`, logika di `app/`, tampilan Blade di `resources/views/`, migrasi dan seeder di `database/`, serta tes di `tests/`. Sesuaikan panduan ini bila perintah setup atau alur aplikasi berubah.
