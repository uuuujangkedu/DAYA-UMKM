# Prompt Redesign UI/UX Website "Daya UMKM"

---

## Konteks & Tujuan

Buat sebuah **halaman web satu halaman (single-page)** yang merupakan redesign modern dari website "Daya UMKM" — platform permodalan produktif dan sewa ruko bagi pelaku usaha kecil menengah di Indonesia. Redesign ini mempertahankan **seluruh struktur layout, teks, navigasi, dan fungsi asli** dari referensi desain, namun memperkaya tampilan visual agar terasa lebih hidup, modern, dan memiliki kedalaman (depth) — tanpa merusak keterbacaan atau aksesibilitas.

---

## Palet Warna & Token Desain

| Token | Nilai | Penggunaan |
|---|---|---|
| `--green-dark` | `#0F5A47` | Tombol CTA utama, label tahap, ikon aktif |
| `--green-mid` | `#1A7A5E` | Hover state, aksen navigasi aktif |
| `--green-light` | `#C8E6DC` | Latar lingkaran dekoratif, bokeh blur |
| `--teal-glow` | `rgba(26,122,94,0.12)` | Bokeh/blur transparan latar belakang |
| `--yellow-accent` | `#F5C842` | Tombol "Masuk"/CTA sekunder, aksen kuning |
| `--yellow-soft` | `rgba(245,200,66,0.15)` | Bokeh kuning transparan di hero |
| `--white` | `#FFFFFF` | Latar kartu, teks di atas hijau gelap |
| `--gray-bg` | `#F4F7F5` | Latar section bergantian |
| `--text-primary` | `#1A1A1A` | Judul dan body teks utama |
| `--text-secondary` | `#4A5E57` | Teks deskripsi, subtitle |

---

## Tipografi

- **Font Utama:** `Plus Jakarta Sans` (Google Fonts) — digunakan untuk semua teks
- **Headline Hero:** `700` weight, `48px`, warna `#1A1A1A`
- **Subheading Section:** `700` weight, `28–32px`
- **Body Text:** `400` weight, `15–16px`, `line-height: 1.7`
- **Label Tahap (badge):** `600` weight, `12px`, huruf kapital, latar `--green-dark`, teks putih, `border-radius: 20px`
- **Tombol:** `600` weight, `14–15px`

---

## Latar Belakang Global (Background System)

Seluruh halaman menggunakan sistem latar belakang berlapis (layered background), bukan warna solid atau putih polos:

1. **Base gradient:** `linear-gradient(180deg, #E8F5EF 0%, #F4F7F5 40%, #FFFFFF 70%, #F0F7F4 100%)` — mengalir lembut dari atas ke bawah.

2. **Elemen dekoratif abstrak (absolute positioned, non-interactive, pointer-events: none):**
   - **Curved SVG lines:** Garis-garis lengkung tipis (`stroke: rgba(15,90,71,0.07)`, `stroke-width: 1px`) yang membentang diagonal dari pojok kanan atas ke kiri bawah, tersebar di 2–3 titik di halaman.
   - **Bokeh circles (blur blobs):** 6–8 lingkaran elips dengan `filter: blur(60–100px)`, warna `--teal-glow` dan `--yellow-soft`, ditempatkan di pojok-pojok section (kanan atas hero, kiri tengah "Tentang Kami", kanan bawah "Alur Kerja"). Ukuran bervariasi antara `200px–400px`.
   - **Dot grid pattern:** Pola titik-titik sangat halus (`radial-gradient` atau SVG pattern), `opacity: 0.04`, di area tertentu sebagai tekstur latar.

---

## Section 1: Navigasi Bar (Sticky, Top)

**Layout:** Horizontal bar penuh lebar, `height: 64px`, latar `rgba(255,255,255,0.92)` dengan `backdrop-filter: blur(12px)`, `box-shadow: 0 1px 0 rgba(0,0,0,0.06)`.

**Konten (kiri ke kanan):**
- **Kiri:** Ikon logo kotak hijau toska + teks dua baris: `"Daya UMKM"` (bold, hijau gelap) dan `"Produktsi & sewa suto"` (kecil, abu-abu)
- **Tengah:** Menu navigasi horizontal: `Betanda` (dengan garis bawah aktif hijau), `Tentang kami`, `Gabung ▾` (dengan dropdown caret), `Tautool`, `Bastuan`, `Kontok` — spasi merata, font `14px`, warna `#1A1A1A`
- **Kanan:** Toggle language pill `MM | ENS` (pill abu-abu muda, teks kecil) + tombol `"Maculi"` (latar `--yellow-accent`, teks `#1A1A1A`, `border-radius: 8px`, `padding: 8px 20px`)

---

## Section 2: Hero Section

**Layout:** Dua kolom — teks di kiri (55%), ilustrasi di kanan (45%). Min-height `520px`. Latar hero menggunakan gradasi sangat lembut dari `#D9EFE6` di atas ke putih di bawah, dengan bokeh hijau di pojok kanan atas dan bokeh kuning di tengah kanan.

**Kolom Kiri — Konten:**
- **Headline besar (H1):** `"Wadah permodalan produktif dan sewa ruko bagi pelaku usaha"` — font `48px`, `700`, `line-height: 1.2`, `color: #1A1A1A`, max `520px` lebar
- **Subtext:** `"Platform terimegrasi bagi investor untuk menyalurkan modal usaha dan memfasilitasi pelaku UMKM memporehin sewa ruko strategis secera transapara."` — `15px`, `#4A5E57`, `line-height: 1.7`
- **CTA Buttons (dua tombol, horizontal):**
  - Tombol 1: `"Daftar jadi Investor"` — latar `#0F5A47`, teks putih, `border-radius: 8px`, `padding: 12px 24px`, `font-weight: 600`
  - Tombol 2: `"Daftar jadi UMKM"` — latar transparan, `border: 2px solid #0F5A47`, teks `#0F5A47`, `border-radius: 8px`, `padding: 12px 24px`

**Kolom Kanan — Ilustrasi:**
- Karakter 3D pria berkaos hijau (gunakan placeholder SVG atau gambar karakter ilustrasi jika tidak ada aset asli) di tengah, diberi `drop-shadow` lembut
- **Floating micro-assets** mengelilingi karakter (animasi `float` naik-turun lambat, `4–6s ease-in-out infinite`):
  - Ikon koin emas bulat (`🪙` atau SVG) — kiri atas dan kanan bawah karakter
  - Kartu mini grafik pertumbuhan (panah naik + bar chart kecil) — kanan atas
  - Ilustrasi ruko/toko kecil isometrik — kanan bawah
- Semua elemen floating punya `filter: drop-shadow(0 8px 16px rgba(0,0,0,0.12))`

---

## Section 3: "Tentang Kami"

**Layout:** Dua kolom setara. Latar section: `#F4F7F5` dengan dot texture sangat halus. Padding vertikal `80px`.

**Kolom Kiri — Ilustrasi:**
- Karakter 3D yang sama, pose melambai (waving), diposisikan di tengah kolom
- Di belakang karakter: **lingkaran dekoratif berlapis** — 3 lingkaran konsentris dengan ukuran berbeda:
  - Terluar: `border: 2px dashed rgba(26,122,94,0.15)`, diameter `~320px`
  - Tengah: `background: rgba(200,230,220,0.3)`, diameter `~260px`
  - Dalam: `background: rgba(245,200,66,0.15)`, diameter `~200px`
- Semua lingkaran center-aligned di belakang karakter, `border-radius: 50%`

**Kolom Kanan — Konten:**
- **Label kecil** di atas: `"Tentang kami"` — `H2`, `700`, `28px`, `#1A1A1A`
- **Paragraf 1:** `"Daya UMKM hadir untuk menjembatkan keoonjangan akses permodalan bagi pemilik useha kecil dan menengah di Indonesia. Mataiki vialam verifikasi berhaca dan audit astIItas yang terpercaya, tami mememikan soltap dana investasi tersallukan secara optimal dan memberi mankiat timbal balik yang sahat bagi investor maupun pengusaha."`
- **Paragraf 2:** `"Koamasan data dan transaksi ciprestisaker. Iwast mekanisme automikasi servorifikani dan pembagian hasil usaha yang beredat raçi di sistem."`
- Font: `15px`, `#4A5E57`, `line-height: 1.7`, max-width `480px`

---

## Section 4: "Panduan dan Alur Kerja"

**Layout:** Satu kolom header di atas, lalu tiga kartu horizontal sejajar di bawah. Latar: putih dengan bokeh hijau di kanan bawah. Padding vertikal `80px`.

**Header:**
- **H2:** `"Panduan dan alur kerja"` — `700`, `32px`
- **Subtext:** `"Langkah tenstruktur menghubungkan pendanaan investor dan pelaku UMKM di dalam platform."` — `15px`, `#4A5E57`

**Tiga Kartu (Cards) — layout `grid: 1fr 1fr 1fr`, gap `24px`:**

Setiap kartu punya:
- Latar: `#FFFFFF`
- `border: 1px solid rgba(15,90,71,0.10)`
- `border-radius: 16px`
- `box-shadow: 0 4px 24px rgba(15,90,71,0.08)`
- `padding: 28px`
- Hover: `transform: translateY(-4px)`, `box-shadow` lebih dalam — transisi `0.25s ease`

**Kartu 1 — Tahap 1:**
- Badge: `"Tahap 1"` — pill hijau gelap (`#0F5A47`), teks putih, `border-radius: 20px`, `font-size: 12px`, `padding: 4px 12px`
- Ikon: `👤` atau ikon pendaftaran akun SVG, ukuran `32px`, warna hijau toska
- **Judul:** `"Pendaftaran akun"` — `700`, `18px`
- **Deskripsi:** `"Pilin paran sebagai mitra investor atau poloku UMKM, lalu lengkapi vertifikasi email OTP maun."`

**Kartu 2 — Tahap 2:**
- Badge: `"Tahap 2"` — sama seperti Tahap 1
- Ikon: ikon verifikasi/centang SVG, ukuran `32px`, warna hijau toska
- **Judul:** `"Verifikasi dan penyesuaian"` — `700`, `18px`
- **Deskripsi:** `"Pelaku nssa mengajukan kebutuhan sewa atau mocei, sedangkan investor meninjua katalog kelaung turkurasi."`

**Kartu 3 — Tahap 3:**
- Badge: `"Tahap 3"` — sama seperti Tahap 1, namun warna badge `#1A7A5E` (sedikit lebih terang untuk variasi)
- Ikon: ikon bagi hasil/uang SVG, ukuran `32px`, warna hijau toska
- **Judul:** `"Realisasi dan bagi hasil"` — `700`, `18px`
- **Deskripsi:** `"Penyuraan morail ditakakan cengan transparenti penufi, disklen bag hasil cicatat berlisie cf sas ibnard."`

---

## Section 5: Pusat Bantuan & Kontak Resmi

**Layout:** Dua kartu sejajar (50/50), latar section `#F4F7F5`. Padding `80px` vertikal.

**Kartu Kiri — "Pusat bantuan":**
- Latar: `#FFFFFF`, `border-radius: 20px`, `box-shadow: 0 4px 20px rgba(0,0,0,0.06)`, `padding: 36px`
- **Ikon header:** Kotak ikon `48x48px`, latar `rgba(15,90,71,0.10)`, `border-radius: 12px`, ikon chat/pesan bubble SVG warna `#0F5A47` di dalamnya
- **Judul:** `"Pusat bantuan"` — `700`, `22px`
- **Deskripsi:** `"Butuh panduan mengunci tata sara pendistaran, syamc pengajaan sewa ruko, atau makaniame bagi hesiff Tim dukungan kemi nijsi melayani Amin"` — `14px`, `#4A5E57`
- **Tombol:** `"Kirim pesan ke tim bantuan"` — outline button, `border: 1.5px solid #0F5A47`, teks `#0F5A47`, `border-radius: 8px`, `padding: 10px 20px`, `font-weight: 600`

**Kartu Kanan — "Kontak resmi":**
- Styling kartu sama dengan kartu kiri
- **Ikon header:** Kotak ikon `48x48px`, latar `rgba(15,90,71,0.10)`, `border-radius: 12px`, ikon amplop/email SVG warna `#0F5A47`
- **Judul:** `"Kontak resmi"` — `700`, `22px`
- **Deskripsi:** `"Hubungi soivestoraz operasional Daya UMKM untuk keperihan kamtraan ruko, konsultasi kelambngaan, can verifikasi profil usaha."` — `14px`, `#4A5E57`
- **Info kontak dengan ikon inline:**
  - `📧 Email: kontak@daya-unkm.id`
  - `🕐 Jiim operasional: Senin – Junut, 08:00 – 17.00 WIB`
  - Font `14px`, `#1A1A1A`, setiap baris punya ikon kecil berwarna hijau di depannya

---

## Section 6: Footer

**Layout:** Satu baris horizontal penuh, `background: #F4F7F5`, `border-top: 1px solid rgba(15,90,71,0.10)`, padding `24px 48px`.

**Kiri:** Teks `"Termlptatas © 2026. Hak coat difintung."` — `13px`, `#6B7E78`

**Kanan:** Tiga link teks horizontal dengan spasi: `Kabilaker seken` | `Syarat dan selenntan` | `Husung sanitam` — `13px`, `#4A5E57`, hover: `color: #0F5A47`, `text-decoration: underline`

---

## Efek & Animasi

- **Float animation** pada micro-assets hero: `@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }` — duration `5s`, staggered delay antar elemen
- **Hover lift** pada kartu alur kerja: `transform: translateY(-4px)`, `transition: 0.25s ease`
- **Smooth scroll** antar section: `scroll-behavior: smooth`
- **Reduced motion:** Semua animasi dibungkus `@media (prefers-reduced-motion: reduce)` untuk aksesibilitas

---

## Catatan Teknis

- Gunakan **HTML + CSS + vanilla JS** dalam satu file `.html`
- Import Google Font `Plus Jakarta Sans` dari `fonts.googleapis.com`
- Semua elemen dekoratif (bokeh, garis) pakai `position: absolute; z-index: 0; pointer-events: none`
- Konten utama selalu `position: relative; z-index: 1`
- Responsif minimal untuk lebar `>= 768px` (desktop-first)
- Warna kontras memenuhi WCAG AA (rasio minimum 4.5:1 untuk teks body)
