# Spesifikasi Aplikasi Laravel

Dokumen kebutuhan awal aplikasi investasi UMKM dan sewa ruko, diselaraskan dengan ERD di `erd.md` dan alur pada `alur-visual.html`.

> Batasan model data: ERD belum menghubungkan `umkm` dengan `pengguna` sebagai pemilik usaha, dan belum menyimpan pembayaran/transaksi keuangan secara rinci. Spesifikasi ini tidak mengasumsikan kolom atau tabel tambahan; konfirmasi kebutuhan sebelum implementasi.

## 1. Tujuan dan ruang lingkup

Aplikasi menyediakan:
- Autentikasi manual dan Google OAuth, verifikasi email/telepon, serta pengelolaan sesi.
- Pengelolaan profil UMKM dan daftar ruko.
- Pencatatan investasi, persetujuan admin, serta riwayat bagi hasil.
- Pencatatan kontrak sewa ruko dan status pembayaran.
- Pengelolaan akun dan audit tindakan admin.

Aktor berdasarkan `pengguna.role`:
- `investor`: melihat UMKM, membuat investasi, melihat investasi dan bagi hasil miliknya.
- `penyedia_ruko`: mengelola ruko miliknya, melihat transaksi sewa yang melibatkan rukonya.
- `admin`: mengelola data operasional, memproses investasi dan sewa, mengelola akun sesuai izin.
- `super_admin`: seluruh izin admin serta tata kelola admin.
- Pemilik UMKM belum memiliki relasi akun di ERD; pengelolaan datanya dilakukan admin sampai model data diperluas.

## 2. Fitur dan aturan bisnis

### 2.1 Autentikasi dan akun
- Daftar manual menggunakan nama, email, kata sandi, dan nomor telepon.
- Email harus unik; simpan kata sandi dalam bentuk hash, bukan teks biasa.
- Pendaftaran manual membuat `pengguna.status_akun = menunggu_verifikasi`.
- Verifikasi email memakai `kode_verifikasi.tipe_verifikasi = link_email`; verifikasi telepon memakai `otp_telepon`.
- Kode harus belum digunakan dan belum kedaluwarsa. OTP berlaku kurang dari 5 menit sesuai kamus data.
- Setelah verifikasi yang diwajibkan selesai, ubah status akun menjadi `aktif`.
- Login Google membuat atau menghubungkan data `pengguna` dan `autentikasi_pihak_ketiga`; tetapkan `email_terverifikasi = TRUE` sesuai alur saat ini.
- Login berhasil membuat `sesi_pengguna`; logout mengakhiri sesi. Tolak sesi kedaluwarsa.
- Akun `ditangguhkan` atau `menunggu_verifikasi` tidak boleh mengakses fitur yang memerlukan akun aktif.
- Jangan simpan token sesi atau rahasia verifikasi dalam log aplikasi.

### 2.2 UMKM
- Admin membuat dan memperbarui profil UMKM: nama usaha, jenis usaha, pemilik, deskripsi.
- Investor dapat menelusuri daftar dan melihat detail UMKM.
- ERD belum menyediakan status publikasi UMKM maupun relasi pemilik UMKM ke akun. Jangan menganggap semua data otomatis layak ditampilkan ke publik.

### 2.3 Investasi dan bagi hasil
- Investor aktif memilih UMKM, memasukkan jumlah modal dan periode pembagian (`bulanan` atau `tahunan`).
- Buat `investasi` dengan referensi investor (`id_pengguna`) dan UMKM (`id_umkm`).
- Investasi menunggu keputusan admin sebelum dianggap disetujui. ERD tidak memiliki status `pending`; jangan menyamakan status `aktif` dengan menunggu persetujuan tanpa keputusan produk.
- Admin menyetujui atau menolak/menangguhkan investasi; catat tindakan di `log_aktivitas_admin`.
- Untuk investasi yang disetujui, admin mencatat distribusi melalui `bagi_hasil_log`, termasuk tanggal, nominal, dan bukti transfer.
- Saat kontrak investasi berakhir, ubah `investasi.status` menjadi `selesai`.
- Pastikan investor hanya melihat investasi dan bagi hasil miliknya.
- ERD belum menentukan aturan validasi modal minimum, persentase bagi hasil, jadwal kontrak, maupun mekanisme pencairan. Tetapkan aturan ini sebelum implementasi.

### 2.4 Sewa ruko
- Penyedia ruko mengelola daftar ruko miliknya: nama, lokasi, harga sewa, dan status ketersediaan.
- Penyedia ruko hanya dapat melihat dan mengelola ruko yang terhubung dengan akunnya (`penyedia_ruko.id_pengguna`).
- Admin dan pengguna dapat melihat ruko berstatus `tersedia` sesuai izin aplikasi.
- UMKM atau pihak berwenang membuat transaksi sewa memakai `id_umkm`, `id_ruko`, tanggal mulai/selesai, total harga, dan status pembayaran.
- Validasi tanggal selesai setelah tanggal mulai; hitung total harga dari tarif dan durasi dengan aturan pembulatan yang disepakati.
- `pending` berarti pembayaran belum selesai; `dibatalkan` berarti transaksi batal; `lunas` berarti pembayaran tercatat selesai.
- Setelah sewa sah/lunas, ruko menjadi `tersewa`; setelah masa sewa berakhir, ketersediaan dapat kembali menjadi `tersedia`.
- Cegah dua transaksi sewa yang waktunya tumpang tindih untuk ruko yang sama. Lakukan pemeriksaan transaksional di server; status ruko saja tidak cukup untuk riwayat jadwal.
- Penyedia ruko dapat melihat semua transaksi sewa yang melibatkan rukonya, termasuk status pembayaran dan durasi kontrak.
- Perubahan status pembayaran dari `pending` ke `lunas` atau `dibatalkan` dilakukan oleh admin setelah verifikasi pembayaran.
- ERD tidak menyimpan pembayaran, penyedia pembayaran, atau bukti pembayaran sewa. Jangan menyatakan pembayaran terverifikasi otomatis tanpa mekanisme yang disepakati.

### 2.5 Admin dan audit
- Batasi endpoint admin berdasarkan role, bukan hanya menyembunyikan tombol antarmuka.
- Penyedia ruko tidak memiliki akses admin; mereka hanya dapat mengelola ruko dan melihat transaksi sewa miliknya.
- Catat aksi penting admin pada `log_aktivitas_admin`: pengguna, nama aksi, perubahan sebelum/sesudah, IP, waktu.
- Audit minimal untuk persetujuan investasi, perubahan status akun, perubahan data ruko/UMKM, dan perubahan transaksi.
- Log audit hanya dapat dibaca pihak berwenang; jangan izinkan pengubahan/penghapusan biasa oleh admin.

## 3. Alur pengguna

### Registrasi dan login
1. Pengguna memilih pendaftaran manual atau Google.
2. Pendaftaran manual membuat akun berstatus `menunggu_verifikasi`; sistem mengirim kode verifikasi.
3. Sistem memvalidasi kode, tujuan, penggunaan, dan masa berlaku; tandai kode telah digunakan.
4. Setelah verifikasi sukses, aktifkan akun sesuai kebijakan verifikasi.
5. Login sukses membuat sesi; akses diberikan menurut role dan status akun.

### Investasi
1. Investor aktif menelusuri UMKM.
2. Investor mengirim jumlah modal dan periode pembagian.
3. Sistem mencatat permintaan investasi; status persetujuan perlu ditetapkan karena ERD belum menyediakan status menunggu.
4. Admin meninjau dan menyetujui atau menolak; sistem mencatat audit.
5. Untuk investasi aktif yang disetujui, distribusi bagi hasil dicatat di `bagi_hasil_log`.
6. Ketika kontrak berakhir, investasi ditandai `selesai`.

### Sewa ruko
1. Pengguna memilih ruko tersedia dan mengirim rentang tanggal.
2. Sistem memvalidasi ketersediaan tanpa bentrok dan membuat transaksi `pending`.
3. Pembayaran gagal/batal mengubah status menjadi `dibatalkan`; pembayaran terkonfirmasi mengubah status menjadi `lunas` dan ruko menjadi `tersewa`.
4. Setelah masa sewa berakhir, ruko kembali tersedia.
5. Penyedia ruko dapat melihat semua transaksi sewa yang melibatkan rukonya melalui dashboard.

### Tindakan admin
1. Admin login dan sistem memeriksa sesi, status akun, serta role.
2. Admin melakukan perubahan yang diizinkan.
3. Sistem menyimpan perubahan dan audit trail dalam operasi yang konsisten.
4. Super Admin meninjau log audit.

## 4. Peta halaman

### Umum
- Daftar, masuk, verifikasi email/OTP, lupa/reset kata sandi, profil, keluar.
- Pesan kesalahan validasi dan status proses yang jelas.

### Investor
- Dasbor ringkasan.
- Daftar dan detail UMKM.
- Form pengajuan investasi.
- Daftar/detail investasi dan riwayat bagi hasil.
- Daftar/detail ruko dan pengajuan sewa, bila fitur ini dibuka untuk investor.
- Riwayat transaksi sewa milik UMKM yang berhak diakses.

### Penyedia Ruko
- Dasbor ringkasan ruko dan transaksi sewa.
- CRUD ruko miliknya sendiri (nama, lokasi, harga, status).
- Daftar/detail transaksi sewa yang melibatkan rukonya.
- Profil dan pengaturan akun.

### Admin/Super Admin
- Dasbor operasional.
- CRUD UMKM, penyedia ruko, dan ruko.
- Daftar/detail investasi dan tindakan persetujuan.
- Daftar/detail transaksi sewa dan pembaruan status sesuai bukti pembayaran.
- Pengelolaan akun/status pengguna.
- Riwayat audit; fitur tata kelola admin untuk Super Admin.

> Penyedia ruko sekarang dapat mengelola rukonya sendiri. Admin tetap memiliki akses penuh untuk moderasi dan verifikasi data ruko jika diperlukan.

## 5. API/aksi aplikasi

Rute Laravel dapat berupa web route atau API; pola berikut adalah kebutuhan, bukan kontrak URL final.

| Aksi | Role | Data utama |
|---|---|---|
| Daftar/login/verifikasi/logout | Publik/pengguna | `pengguna`, `kode_verifikasi`, `sesi_pengguna` |
| Lihat UMKM | Pengguna aktif | `umkm` |
| Kelola UMKM | Admin | `umkm`, audit |
| Ajukan/lihat investasi | Investor | `investasi`, `umkm` |
| Setujui/tolak investasi | Admin | `investasi`, audit |
| Catat bagi hasil | Admin | `bagi_hasil_log`, audit |
| Lihat ruko tersedia | Pengguna aktif | `ruko`, `penyedia_ruko` |
| Kelola ruko milik sendiri | Penyedia Ruko | `ruko`, `penyedia_ruko` |
| Kelola semua ruko/penyedia | Admin | `ruko`, `penyedia_ruko`, audit |
| Ajukan/lihat transaksi sewa | Role yang ditetapkan | `transaksi_sewa`, `ruko`, `umkm` |
| Lihat transaksi sewa rukonya | Penyedia Ruko | `transaksi_sewa`, `ruko` |
| Perbarui status sewa | Admin/sistem terotorisasi | `transaksi_sewa`, `ruko`, audit |
| Lihat log audit | Admin berizin/Super Admin | `log_aktivitas_admin` |

Setiap aksi tulis harus memvalidasi input, otorisasi objek, dan perubahan status di server. Gunakan respons validasi yang konsisten; jangan percaya `id_pengguna` atau role dari input klien.

## 6. Pemetaan ERD ke Laravel

| Tabel | Model yang disarankan | Catatan |
|---|---|---|
| `pengguna` | `Pengguna` | PK `id_pengguna`; autentikasi perlu disesuaikan jika memakai model bawaan Laravel |
| `autentikasi_pihak_ketiga` | `AutentikasiPihakKetiga` | FK ke `pengguna` |
| `kode_verifikasi` | `KodeVerifikasi` | Simpan hash kode/token jika alur memungkinkan |
| `sesi_pengguna` | `SesiPengguna` | Atur penyimpanan token secara aman |
| `penyedia_ruko` | `PenyediaRuko` | FK ke `pengguna` (role `penyedia_ruko`); memiliki banyak ruko |
| `ruko` | `Ruko` | Milik penyedia; memiliki banyak transaksi sewa |
| `umkm` | `Umkm` | Memiliki banyak investasi dan transaksi sewa |
| `transaksi_sewa` | `TransaksiSewa` | FK ke UMKM dan ruko |
| `investasi` | `Investasi` | FK ke investor (`Pengguna`) dan UMKM |
| `bagi_hasil_log` | `BagiHasilLog` | FK ke investasi |
| `log_aktivitas_admin` | `LogAktivitasAdmin` | FK ke pengguna admin |

Nama tabel/PK non-standar harus ditetapkan eksplisit pada model/migrasi Laravel. Buat migrasi mengikuti urutan dependensi FK. Gunakan constraint FK, unique email, tipe desimal presisi untuk uang, dan transaksi database untuk operasi multi-tabel.

## 7. Validasi data minimum

- Email valid dan unik; kata sandi memenuhi kebijakan keamanan.
- Role/status hanya menerima nilai yang diizinkan.
- Nomor telepon memiliki format yang diterima sistem.
- Kode verifikasi belum digunakan, cocok dengan tujuan, dan belum kedaluwarsa.
- Modal dan nominal bagi hasil tidak negatif; rentang persentase ditentukan oleh kebijakan produk.
- Tanggal sewa valid, urut, dan tidak bentrok dengan sewa lain untuk ruko terkait.
- `id_pengguna`, `id_umkm`, `id_ruko`, dan `id_investasi` harus merujuk data yang ada dan boleh diakses pelaku.
- Status transaksi hanya berubah melalui transisi yang diizinkan; contoh `pending` ke `lunas` atau `dibatalkan`.

## 8. Keamanan, privasi, aksesibilitas

- Gunakan autentikasi Laravel yang terpelihara; simpan kata sandi dengan hashing Laravel.
- Terapkan middleware autentikasi dan policy/gate untuk role serta kepemilikan objek.
- Gunakan proteksi CSRF untuk form web; validasi server untuk semua input.
- Hash token/kode verifikasi bila memungkinkan; batasi percobaan dan masa berlaku.
- Cookie sesi aman (HTTPS, HttpOnly, SameSite); hindari menyimpan token sensitif di local storage.
- Lindungi data pribadi dan finansial; batasi akses berdasarkan kebutuhan, jangan tampilkan rahasia di log.
- Gunakan HTTPS, konfigurasi rahasia melalui environment, dan lakukan backup database.
- Antarmuka mendukung keyboard, label form, fokus terlihat, kontras memadai, serta pesan error yang dapat dibaca teknologi bantu.

## 9. Pengujian penerimaan

1. Email duplikat ditolak; kata sandi tersimpan sebagai hash.
2. Kode salah, kedaluwarsa, atau sudah digunakan ditolak; kode valid hanya dapat digunakan sekali.
3. Akun nonaktif tidak dapat mengakses area terlindungi.
4. Investor tidak dapat melihat/mengubah investasi milik investor lain.
5. Pengguna non-admin ditolak saat memanggil aksi admin langsung.
6. Aksi admin yang mengubah data menghasilkan catatan audit yang sesuai.
7. Investasi terhubung ke investor dan UMKM yang benar; bagi hasil terhubung ke investasi yang benar.
8. Sewa dengan tanggal terbalik atau bentrok ditolak, termasuk dua pengajuan bersamaan.
9. Status sewa dan ketersediaan ruko tetap konsisten ketika transaksi berhasil atau gagal.
10. Nominal uang tersimpan dengan presisi yang ditentukan; input tidak valid tidak mengubah data.

## 10. Keputusan yang diperlukan sebelum implementasi

- Apakah setiap UMKM harus terhubung ke akun pemilik? Jika ya, tambahkan relasi pengguna-pemilik pada ERD.
- Siapa yang dapat mengajukan sewa: pemilik UMKM, investor, admin, atau pihak lain?
- Bagaimana status investasi membedakan menunggu persetujuan, disetujui, ditolak, aktif, dan selesai?
- Bagaimana pembayaran investasi/sewa dilakukan dan diverifikasi? Apakah perlu tabel pembayaran?
- Apa aturan modal minimum, persentase bagi hasil, durasi kontrak, pembatalan, dan pengembalian dana?
- Apakah ruko dapat disewakan untuk rentang masa depan, dan bagaimana aturan bentrok/perpanjangan?
- Apa batas akses Admin dibanding Super Admin, serta kebijakan retensi audit dan data pribadi?
- Apakah penyedia ruko perlu persetujuan admin sebelum ruko yang dibuat tampil publik?
- Bagaimana penyedia ruko menerima pembayaran sewa dari UMKM? Apakah sistem mencatat pembagian hasil sewa?

## 11. Di luar cakupan awal

Dokumen ini belum menetapkan desain visual, pilihan gateway pembayaran, notifikasi provider, deployment, maupun kebijakan hukum/keuangan. Tambahkan setelah keputusan produk dan kebutuhan operasional disepakati.
