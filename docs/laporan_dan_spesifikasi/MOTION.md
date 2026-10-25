# MOTION.md — Daya UMKM

Dokumen ini khusus mengatur animasi dan smooth scroll. Dokumen ini **tidak** menggantikan `DESIGN.md`. Untuk warna, tipografi, layout, dan komponen, tetap ikuti `DESIGN.md`. Jika ada konflik visual, `DESIGN.md` yang diutamakan.

## 1. Prinsip

- **Tenang dan bisa dipercaya.** Gerakan hanya menegaskan urutan informasi, tidak untuk hiburan.
- **Sekali, lalu diam.** Elemen muncul sekali saat masuk viewport. Tidak ada animasi berulang atau looping.
- **Konten harus terbaca tanpa motion.** Mode reduced motion, mode tanpa JavaScript, dan screen reader harus menampilkan konten dalam keadaan akhir.
- **Tidak ada efek dekoratif.** Tidak ada parallax, rotasi, bounce, elastic, atau efek cursor.
- **Slide-up harus terlihat jelas.** Jarak gerak minimal 24px agar mata bisa membaca gerakan. Tidak boleh fade-only.

## 2. Cakupan

| Area | Motion | Smooth scroll (Lenis) |
| --- | --- | --- |
| Landing page & halaman publik (`/`, `/gabung/investor`, `/gabung/umkm`) | Ya | Ya |
| Dashboard admin, super admin, UMKM, investor, dan semua dashboard user | **Tidak** | **Tidak** |

Dashboard memakai scroll native dan navbar statis sesuai `DESIGN.md` bagian 8. Motion modul ini tidak boleh di-import di layout dashboard.

## 3. Timing dan easing

- Durasi: 0.8s sampai 1.2s. Tidak boleh di bawah 0.8s.
- Easing: `power3.out`. Tidak memakai `back`, `elastic`, atau `bounce`.
- Jarak gerak: 24px sampai 48px, hanya di sumbu Y. Tidak boleh kurang dari 24px.
- Yang boleh dianimasikan: `opacity` dan `transform` (translateY). Tidak boleh `width`, `height`, `top`, `left`, `margin`, atau `box-shadow`.
- Tidak boleh fade-only. Setiap elemen harus slide-up.

## 4. Pola animasi

### Masuk halaman (hero)

Konten hero **tidak boleh muncul sekaligus**. Urutan reveal sekuensial:

1. Kartu hero (section `#beranda`): slide up 40px, durasi 1.0s, ease `power3.out`.
2. Di dalam kartu, anak elemen muncul satu per satu dengan stagger 0.15s:
   - Headline (`h1`): slide up 32px, durasi 0.9s.
   - Paragraf (`p`): slide up 32px, durasi 0.9s.
   - Grup tombol (`.flex`): slide up 32px, durasi 0.9s.
   - Panel peluang (`.animate-hero-panel`): slide up 40px, durasi 1.0s.
3. Semua dimulai setelah 0.1s delay dari page load.

### Reveal saat scroll

- Section utama (`#tentang-kami`, `#tutorial`, `#bantuan`, `#kontak`): slide up 40px, durasi 0.9s, ease `power3.out`.
- Trigger di `top 85%`.
- Play sekali. Tidak dibalik saat scroll ke atas.
- Anak elemen di dalam section (heading, paragraf, card, tombol) stagger 0.15s, slide up 32px, durasi 0.9s.

### Daftar bertahap

- Anak elemen pada daftar langkah (cards di dalam grid): stagger 0.15s, slide up 32px, durasi 0.9s.

### Hover dan fokus

- Hanya perubahan warna sesuai `DESIGN.md`, dengan transisi 0.2s. Tidak ada transform pada hover kartu atau tombol.

## 5. Smooth scroll

- Library: Lenis, dihubungkan ke GSAP ticker.
- `duration` sekitar 1.1, `smoothWheel` aktif.
- `smoothTouch` dibiarkan default (nonaktif) kecuali ada alasan khusus. Scroll sentuh di mobile sudah cukup halus secara native.
- Anchor link (`#...`) harus lewat `lenis.scrollTo`, bukan scroll native.
- Header sticky dan class `scrolled` tetap bekerja dengan Lenis.

## 6. Aksesibilitas

- Jika pengguna memilih `prefers-reduced-motion: reduce`:
  - Lenis tidak diinisialisasi.
  - Semua animasi ScrollTrigger dilewati.
  - Konten langsung tampil dalam keadaan akhir.
- Tanpa JavaScript, tidak ada elemen yang tertinggal dengan `opacity: 0`.
- Animasi tidak boleh menghalangi fokus keyboard atau pembacaan screen reader.

## 7. Teknis

- Library: `gsap` (dengan plugin `ScrollTrigger`) dan `lenis`. Versi harus di-pin.
- Registrasi plugin GSAP dilakukan sekali.
- Cleanup: `ScrollTrigger` di-kill dan Lenis di-destroy saat komponen unmount atau pindah route. Di React/Next.js gunakan `gsap.context`.
- `ScrollTrigger.refresh()` dipanggil setelah font selesai dimuat dan saat resize.
- Semua kode motion berada di satu modul (misalnya `motion.js` atau `lib/motion.ts`) dan hanya di-import di halaman publik.
- Tidak ada CSS `@keyframes` untuk hero. Semua animasi hero dikendalikan oleh GSAP di `motion.js`.

## 8. Checklist sebelum merge

- [ ] Halaman tampil lengkap dengan JavaScript dinonaktifkan.
- [ ] Mode reduced motion menonaktifkan semua motion.
- [ ] Dashboard scroll native dan navbar tidak berubah saat scroll.
- [ ] Navbar `scrolled` tetap berfungsi di landing page.
- [ ] Anchor link berjalan mulus lewat Lenis.
- [ ] Tidak ada animasi yang berulang atau looping.
- [ ] Tidak ada warna, font, atau spacing baru yang bertentangan dengan `DESIGN.md`.
- [ ] Hero muncul sekuensial, bukan sekaligus.
- [ ] Slide distance minimal 24px, terlihat jelas oleh mata.
- [ ] Tidak ada animasi fade-only tanpa slide.
