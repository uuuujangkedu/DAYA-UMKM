# Laporan Audit UI/UX & Frontend Refactoring
**Komponen:** Form Input Analisis Pendapatan & Pengeluaran (Kalkulator Laba Rugi)

---

## Tahap 1 & 2 — Audit UI/UX & Identifikasi Masalah Desain

Berdasarkan pemeriksaan pada antarmuka **Form Input Analisis Pendapatan & Pengeluaran (Kalkulator Laba Rugi)** yang berjalan saat ini, berikut adalah audit struktur komponen dan masalah desain yang ditemukan:

### 1. Masalah Layout & Alur Baca (Visual Flow)
* **Posisi Judul Mengambang di Tengah Vertikal:** Kolom kiri (*"Form Input Analisis Pendapatan & Pengeluaran"* beserta badge *"Kalkulator Laba Rugi"*) menggunakan perataan tengah vertikal (`align-items: center`) terhadap keseluruhan tinggi formulir di sebelah kanan. Hal ini menyisakan ruang kosong yang sangat besar di sudut kiri atas dan merusak pola baca alami pengguna (*F-pattern / Z-pattern*), di mana mata pengguna langsung tertuju pada area kosong sebelum menemukan konteks halaman.
* **Posisi Badge "Kalkulator Laba Rugi" Terjepit:** Badge berada di antara judul dan batas kolom kanan dengan bentuk pil dua baris yang sempit, sehingga terlihat seperti tombol yang terpotong dan mempersempit ruang bernapas (*whitespace*) antarkolom.

### 2. Ketidaksejajaran Input (Baseline Misalignment)
* **Baris 1 (Periode vs Total Pendapatan):** Label `TOTAL PENDAPATAN / OMZET PENJUALAN (RP) *` berdampingan dengan badge hijau yang cukup besar (`⚡ Otomatis terisi jika unggah Excel / Foto Nota`), sehingga teks label terdorong menjadi dua baris. Akibatnya, kotak input `15000000` turun lebih rendah dan tidak sejajar secara horizontal dengan kotak input `October 2026` di sebelahnya.
* **Baris 4 (Lampirkan Berkas vs Keterangan):** Masalah serupa terjadi pada area unggah berkas; label `LAMPIRKAN BERKAS LAPORAN KEUANGAN / BUKTI` dan badge `AUTO-DETECT: EXCEL & FOTO NOTA` memakan dua baris tinggi, sehingga kotak `Choose file` tidak sejajar dengan input `KETERANGAN / CATATAN TAMBAHAN` di kolom kanan.

### 3. Hierarki Visual & Konsistensi Komponen
* **Border Radius Berlebihan pada Input Field:** Seluruh kotak input dan tombol menggunakan *border-radius* yang terlalu membulat (mendekati bentuk *pill*), sehingga mengurangi kesan formal/profesional pada aplikasi finansial dan membuat *input field* tampak serupa dengan elemen *badge* atau tombol.
* **Kompetisi Visual pada Badge Informasi:** Badge informasi (`Otomatis terisi...`, `AUTO-DETECT...`, dan 4 badge format file) memiliki ukuran, *border*, serta kontras warna yang terlalu mencolok, sehingga bersaing secara visual dengan label utama dan tombol aksi utama (`Simpan & Hitung Analisis Laba Rugi`).
* **Format Angka Tanpa Penanda Mata Uang di Dalam Input:** Input nominal (`15000000`, `6000000`, `3500000`, `500000`) ditampilkan sebagai deretan angka mentah tanpa pemisah ribuan atau prefix `Rp` yang memperjelas konteks input numerik.

---

## Tahap 3 — Strategi Redesign & Standarisasi Design System

Perbaikan dilakukan dengan mempertahankan identitas visual asli (palet *warm cream/stone background* dengan aksen *deep forest green* dan *emerald*) serta menjaga 100% elemen fungsional:

| Aspek Desain | Kondisi Saat Ini | Standar Baru (Refactored) |
| :--- | :--- | :--- |
| **Struktur Grid Utama** | 2 kolom dengan kolom kiri rata tengah vertikal (`items-center`). | 2 kolom proporsional (`12-column grid`: 4 kolom header kiri `items-start` + `sticky`, 8 kolom form kanan) atau *top-aligned* yang rapi. |
| **Keselarasan Baris Input** | Tinggi label bervariasi sehingga kotak input tidak sejajar horizontal. | Menggunakan kontainer label terstruktur (`min-h` / `flex-col justify-end`) sehingga semua kotak input pada baris yang sama sejajar presisi. |
| **Border Radius** | `16px–9999px` (terlalu bulat untuk *form control*). | Input & Card: `8px–12px` (`rounded-lg` / `rounded-xl`). Badge status: `6px` (`rounded-md`). |
| **Palet Warna (Tokens)** | Hijau tua, hijau emerald, krem hangat, abu-abu teks. | Dipertahankan & distandarisasi: Primary `#14452F`, Accent `#10B981`, Surface `#F8F7F3`, Card `#FFFFFF`, Panel `#F1EFEA`, Border `#E2E0D8`. |
| **Input Nominal Uang** | Angka polos tanpa prefix visual (`15000000`). | Menambahkan *visual prefix* `Rp` di sisi kiri dalam kotak input tanpa mengubah `value`/`name` input asli. |

---

## Tahap 4 — Implementasi Kode (Refactored Frontend UI)

Berikut adalah implementasi kode HTML + Tailwind CSS yang telah direfaktor. Seluruh field, atribut, teks bantuan, badge informasi, opsi radio, dan tombol submit dipertahankan 100% dan siap diterapkan langsung pada template proyek (Blade / React / Vue / HTML):

```html
<section class="min-h-screen bg-[#F9F8F4] py-8 px-4 sm:px-6 lg:px-10 text-slate-800 antialiased">
  <div class="mx-auto max-w-7xl">
    
    <!-- Main Card / Form Wrapper -->
    <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-10 items-start">
      
      <!-- KOLOM KIRI: Judul & Konteks Halaman (Top-Aligned & Sticky pada Desktop) -->
      <div class="lg:col-span-4 lg:sticky lg:top-8 space-y-3 border-b border-[#E6E4DC] pb-6 lg:border-b-0 lg:pb-0">
        <div class="inline-flex items-center gap-1.5 rounded-md bg-[#EFECE3] border border-[#DFD9C8] px-3 py-1 text-xs font-semibold tracking-wide text-[#785C22]">
          <span>Kalkulator Laba Rugi</span>
        </div>
        
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 leading-snug">
          Form Input Analisis Pendapatan &amp; Pengeluaran
        </h1>
        
        <p class="text-sm text-slate-600 leading-relaxed">
          Masukkan data omzet dan pengeluaran atau lampirkan foto buku kas / nota untuk dianalisis otomatis.
        </p>
      </div>

      <!-- KOLOM KANAN: Area Formulir Utama -->
      <div class="lg:col-span-8 space-y-6 bg-white/60 sm:bg-white p-5 sm:p-8 rounded-2xl border border-[#E8E6DF] shadow-xs">
        
        <!-- BARIS 1: Periode & Total Pendapatan -->
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 items-end">
          
          <!-- Field 1: Periode Bulan & Tahun -->
          <div class="flex flex-col justify-between">
            <label for="periode_bulan_tahun" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
              Periode Bulan &amp; Tahun <span class="text-red-600">*</span>
            </label>
            <input
              type="text"
              id="periode_bulan_tahun"
              name="periode_bulan_tahun"
              value="October 2026"
              required
              class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3.5 text-sm font-medium text-slate-900 shadow-2xs transition focus:border-[#14452F] focus:outline-hidden focus:ring-2 focus:ring-[#14452F]/15"
            />
          </div>

          <!-- Field 2: Total Pendapatan / Omzet Penjualan -->
          <div class="flex flex-col justify-between">
            <div class="flex flex-wrap items-center justify-between gap-1.5 mb-2">
              <label for="total_pendapatan" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                Total Pendapatan / Omzet Penjualan (Rp) <span class="text-red-600">*</span>
              </label>
              <span class="inline-flex items-center gap-1 rounded-md bg-emerald-50 border border-emerald-200 px-2 py-0.5 text-[11px] font-medium text-emerald-800">
                ⚡ Otomatis terisi jika unggah Excel / Foto Nota
              </span>
            </div>
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs font-semibold text-slate-400">
                Rp
              </span>
              <input
                type="number"
                id="total_pendapatan"
                name="total_pendapatan"
                placeholder="15000000"
                required
                class="h-11 w-full rounded-lg border border-slate-300 bg-white pl-9 pr-3.5 text-sm font-medium text-slate-900 placeholder:text-slate-400 shadow-2xs transition focus:border-[#14452F] focus:outline-hidden focus:ring-2 focus:ring-[#14452F]/15"
              />
            </div>
          </div>

        </div>

        <!-- BARIS 2: Komponen Pengeluaran (3 Kolom) -->
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3 items-start pt-1">
          
          <!-- Field 3: Harga Pokok (HPP) -->
          <div>
            <label for="harga_pokok" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
              Harga Pokok (HPP / Bahan Baku)
            </label>
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs font-semibold text-slate-400">
                Rp
              </span>
              <input
                type="number"
                id="harga_pokok"
                name="harga_pokok"
                placeholder="6000000"
                class="h-11 w-full rounded-lg border border-slate-300 bg-white pl-9 pr-3.5 text-sm font-medium text-slate-900 placeholder:text-slate-400 shadow-2xs transition focus:border-[#14452F] focus:outline-hidden focus:ring-2 focus:ring-[#14452F]/15"
              />
            </div>
            <p class="mt-1.5 text-xs text-slate-500">Biaya bahan pokok produksi</p>
          </div>

          <!-- Field 4: Beban Operasional Usaha -->
          <div>
            <label for="beban_operasional" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
              Beban Operasional Usaha
            </label>
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs font-semibold text-slate-400">
                Rp
              </span>
              <input
                type="number"
                id="beban_operasional"
                name="beban_operasional"
                placeholder="3500000"
                class="h-11 w-full rounded-lg border border-slate-300 bg-white pl-9 pr-3.5 text-sm font-medium text-slate-900 placeholder:text-slate-400 shadow-2xs transition focus:border-[#14452F] focus:outline-hidden focus:ring-2 focus:ring-[#14452F]/15"
              />
            </div>
            <p class="mt-1.5 text-xs text-slate-500">Gaji, listrik, sewa, kemasan</p>
          </div>

          <!-- Field 5: Beban Lain-Lain -->
          <div>
            <label for="beban_lain" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
              Beban Lain-Lain
            </label>
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-xs font-semibold text-slate-400">
                Rp
              </span>
              <input
                type="number"
                id="beban_lain"
                name="beban_lain"
                placeholder="500000"
                class="h-11 w-full rounded-lg border border-slate-300 bg-white pl-9 pr-3.5 text-sm font-medium text-slate-900 placeholder:text-slate-400 shadow-2xs transition focus:border-[#14452F] focus:outline-hidden focus:ring-2 focus:ring-[#14452F]/15"
              />
            </div>
            <p class="mt-1.5 text-xs text-slate-500">Transportasi, perawatan, tak terduga</p>
          </div>

        </div>

        <!-- BARIS 3: Banner Simulasi Estimasi Laba Bersih -->
        <div class="flex items-center justify-between rounded-xl bg-[#F2EFE9] border border-[#E4E0D6] px-5 py-4">
          <div>
            <p class="text-xs font-medium text-slate-600">Simulasi Estimasi Laba Bersih:</p>
            <p id="simulasi_laba_bersih" class="mt-0.5 text-xl sm:text-2xl font-extrabold tracking-tight text-slate-900">
              Rp 0
            </p>
          </div>
          <span id="status_simulasi_badge" class="inline-flex items-center rounded-full bg-[#E2E4E8] px-3.5 py-1 text-xs font-bold text-slate-800">
            Belum Diisi
          </span>
        </div>

        <!-- BARIS 4: Unggah Berkas & Keterangan Tambahan -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 items-start pt-1">
          
          <!-- Field 6: Lampirkan Berkas Laporan Keuangan / Bukti -->
          <div>
            <div class="flex flex-wrap items-center justify-between gap-1.5 mb-2 min-h-[24px]">
              <label for="berkas_laporan" class="text-xs font-bold uppercase tracking-wider text-slate-700">
                Lampirkan Berkas Laporan Keuangan / Bukti
              </label>
              <span class="inline-flex items-center rounded-md bg-emerald-50 border border-emerald-200 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-emerald-800">
                Auto-Detect: Excel &amp; Foto Nota
              </span>
            </div>

            <div class="flex items-center h-11 w-full rounded-lg border border-slate-300 bg-white px-2 shadow-2xs focus-within:border-[#14452F] focus-within:ring-2 focus-within:ring-[#14452F]/15">
              <input
                type="file"
                id="berkas_laporan"
                name="berkas_laporan"
                accept=".xlsx,.xls,.csv,.jpg,.jpeg,.png,.webp,.pdf,.doc,.docx"
                class="w-full text-xs text-slate-600 file:mr-3 file:rounded-md file:border-0 file:bg-[#14452F] file:px-3.5 file:py-1.5 file:text-xs file:font-semibold file:text-white hover:file:bg-[#0f3523] file:cursor-pointer"
              />
            </div>

            <!-- Format Badges -->
            <div class="mt-2.5 flex flex-wrap items-center gap-1.5">
              <span class="text-xs text-slate-500 mr-1">Format:</span>
              <span class="inline-flex items-center gap-1 rounded-md bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 text-[11px] font-medium text-emerald-800">
                📊 Excel (.xlsx, .xls, .csv)
              </span>
              <span class="inline-flex items-center gap-1 rounded-md bg-teal-50 border border-teal-200/80 px-2 py-0.5 text-[11px] font-medium text-teal-800">
                🖼️ Foto Nota / Kuitansi (Auto OCR)
              </span>
              <span class="inline-flex items-center gap-1 rounded-md bg-rose-50 border border-rose-200/80 px-2 py-0.5 text-[11px] font-medium text-rose-800">
                📄 PDF (.pdf)
              </span>
              <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 border border-blue-200/80 px-2 py-0.5 text-[11px] font-medium text-blue-800">
                📝 Word (.doc, .docx)
              </span>
            </div>
          </div>

          <!-- Field 7: Keterangan / Catatan Tambahan -->
          <div>
            <div class="flex items-center mb-2 min-h-[24px]">
              <label for="keterangan_tambahan" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                Keterangan / Catatan Tambahan
              </label>
            </div>
            <input
              type="text"
              id="keterangan_tambahan"
              name="keterangan_tambahan"
              placeholder="Contoh: Lampiran Excel rekapitulasi penjualan harian."
              class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-2xs transition focus:border-[#14452F] focus:outline-hidden focus:ring-2 focus:ring-[#14452F]/15"
            />
            <p class="mt-1.5 text-xs text-slate-500">
              Catatan singkat mengenai sumber data laporan keuangan
            </p>
          </div>

        </div>

        <!-- BARIS 5: Pilihan Penanganan Input -->
        <div class="rounded-xl bg-[#F2EFE9] border border-[#E4E0D6] p-4 sm:p-5">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 mb-3.5">
            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-800">
              Pilihan Penanganan Input:
            </h2>
            <span class="text-xs text-slate-500">
              Tentukan aksi jika periode bulan sudah memiliki catatan
            </span>
          </div>

          <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
            
            <!-- Radio 1: Totalkan / Akumulasikan -->
            <label class="relative flex cursor-pointer items-start gap-3 rounded-xl border-2 border-emerald-500 bg-emerald-50/60 p-3.5 transition hover:bg-emerald-50 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/80">
              <input
                type="radio"
                name="penanganan_input"
                value="akumulasi"
                checked
                class="mt-0.5 h-4 w-4 shrink-0 border-slate-300 text-emerald-600 focus:ring-emerald-600"
              />
              <div class="text-xs leading-relaxed">
                <div class="font-bold text-slate-900">
                  ➕ Totalkan / Akumulasikan (Default)
                </div>
                <p class="mt-1 text-emerald-900/80">
                  Nominal baru otomatis dijumlahkan/ditotalkan dengan catatan bulan ini yang sudah ada.
                </p>
              </div>
            </label>

            <!-- Radio 2: Perbarui / Ganti Total -->
            <label class="relative flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 bg-white p-3.5 transition hover:border-slate-300 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/80">
              <input
                type="radio"
                name="penanganan_input"
                value="ganti_total"
                class="mt-0.5 h-4 w-4 shrink-0 border-slate-300 text-emerald-600 focus:ring-emerald-600"
              />
              <div class="text-xs leading-relaxed">
                <div class="font-bold text-slate-900">
                  🔄 Perbarui / Ganti Total
                </div>
                <p class="mt-1 text-slate-600">
                  Mengganti total periode bulan ini secara langsung dengan nominal baru.
                </p>
              </div>
            </label>

            <!-- Radio 3: Catat Sebagai Baris Baru -->
            <label class="relative flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 bg-white p-3.5 transition hover:border-slate-300 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/80">
              <input
                type="radio"
                name="penanganan_input"
                value="baris_baru"
                class="mt-0.5 h-4 w-4 shrink-0 border-slate-300 text-emerald-600 focus:ring-emerald-600"
              />
              <div class="text-xs leading-relaxed">
                <div class="font-bold text-slate-900">
                  📑 Catat Sebagai Baris Baru
                </div>
                <p class="mt-1 text-slate-600">
                  Simpan sebagai transaksi/nota terpisah di tabel riwayat.
                </p>
              </div>
            </label>

          </div>
        </div>

        <!-- BARIS 6: Tombol Submit -->
        <div class="flex justify-end pt-2">
          <button
            type="submit"
            class="inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-xl bg-[#14452F] px-6 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#0f3523] focus:outline-hidden focus:ring-2 focus:ring-[#14452F] focus:ring-offset-2 active:scale-[0.99]"
          >
            <span>🧮</span>
            <span>Simpan &amp; Hitung Analisis Laba Rugi</span>
          </button>
        </div>

      </div>
    </form>

  </div>
</section>
```

---

## Tahap 5 & 6 — Laporan Akhir Redesign

### 1. Ringkasan Perubahan
* **Perbaikan Struktur Layout Dua Kolom:** Mengubah perataan kolom judul dari tengah vertikal (`items-center`) menjadi rata atas (`items-start` dengan perilaku `sticky` saat *scroll* di layar desktop) agar pengguna langsung melihat konteks halaman begitu membuka formulir.
* **Penyelarasan Horizontal Input (Baseline Alignment):** Merapikan tinggi pembungkus label pada baris 2 kolom (Periode vs Total Pendapatan, serta Lampirkan Berkas vs Keterangan Tambahan) sehingga seluruh kotak input bersebelahan berdiri di garis horizontal yang sama.
* **Peningkatan Keterbacaan Input Finansial:** Menambahkan indikator visual `Rp` di sisi dalam kiri kotak input angka tanpa mengubah tipe atau atribut data yang dikirim ke backend.
* **Penertiban Hierarki Visual Badge:** Menurunkan ukuran *padding* dan ketebalan *border* pada badge sekunder (`Otomatis terisi...`, `AUTO-DETECT...`, dan badge format berkas) agar tidak mendominasi label utama.

### 2. Perubahan per Komponen Halaman
* **Header Kiri:** Menempatkan badge `Kalkulator Laba Rugi` tepat di atas judul `Form Input Analisis Pendapatan & Pengeluaran` sebagai *eyebrow badge* yang rapi dan tidak lagi terjepit di antara dua kolom.
* **Form Input Baris 1 & 2:** Menyamakan tinggi seluruh field menjadi `h-11` (`44px`, memenuhi standar *touch target* aksesibilitas) dengan sudut `rounded-lg` (`8px`).
* **Panel Simulasi Estimasi Laba Bersih:** Mempertegas tipografi nominal `Rp 0` dan merapikan kontras badge status `Belum Diisi`.
* **Area Upload File & Keterangan:** Menyelaraskan tinggi kontainer input `Choose file` dengan input teks `Keterangan / Catatan Tambahan` (`h-11`) serta menyusun badge format file (`Excel`, `Foto Nota`, `PDF`, `Word`) secara terstruktur di bawah input file.
* **Pilihan Penanganan Input (Radio Cards):** Menggunakan selector modern `has-[:checked]` agar status *border* dan latar belakang hijau berpindah secara dinamis mengikuti opsi radio yang dipilih pengguna.

### 3. Design System yang Diterapkan
* **Warna:** Background Utama `#F9F8F4`, Surface Form `#FFFFFF`, Panel Sekunder `#F2EFE9`, Primary Action `#14452F` (Hover `#0f3523`), Active Selection/Highlight Emerald `#10B981`, Teks Utama `Slate-900`, Teks Bantuan `Slate-500`.
* **Typography:** Label menggunakan `12px` (`text-xs`), `font-bold`, `uppercase`, `tracking-wider` untuk pemisahan yang tegas dari teks input (`14px` / `text-sm`) dan teks bantuan (`12px` / `text-xs`).
* **Spacing:** Jarak antarbaris form `24px` (`space-y-6`), jarak antarkolom input `20px` (`gap-5`), padding dalam kartu utama `32px` pada desktop (`sm:p-8`).

### 4. Fitur yang Dipertahankan (100% Preserved)
Seluruh komponen dari desain awal tetap tersedia penuh:
* Input `Periode Bulan & Tahun *` dengan nilai `October 2026`.
* Input `Total Pendapatan / Omzet Penjualan (Rp) *` beserta indikator otomatis Excel/Foto Nota.
* Ketiga input pengeluaran (`Harga Pokok (HPP / Bahan Baku)`, `Beban Operasional Usaha`, `Beban Lain-Lain`) lengkap dengan *placeholder* dan teks bantuan di bawahnya.
* Panel `Simulasi Estimasi Laba Bersih: Rp 0` dan status `Belum Diisi`.
* Input file `Lampirkan Berkas Laporan Keuangan / Bukti`, badge `AUTO-DETECT: EXCEL & FOTO NOTA`, serta keempat informasi format (`Excel`, `Foto Nota / Kuitansi (Auto OCR)`, `PDF`, `Word`).
* Input `Keterangan / Catatan Tambahan` beserta *placeholder* dan catatan kakinya.
* Ketiga opsi radio `Pilihan Penanganan Input` (`Totalkan / Akumulasikan`, `Perbarui / Ganti Total`, `Catat Sebagai Baris Baru`) dengan nilai default pada opsi pertama.
* Tombol aksi utama `Simpan & Hitung Analisis Laba Rugi`.

### 5. Hasil Pengujian & Batasan Verifikasi
* **Verifikasi Responsivitas Visual:** Layout telah dikonfigurasi menggunakan *responsive breakpoints* (`grid-cols-1` pada mobile, `md:grid-cols-2` / `md:grid-cols-3` pada tablet, dan `lg:grid-cols-12` pada desktop) serta tombol submit penuh (`w-full`) pada layar mobile agar mudah dijangkau ibu jari.
* **Batasan Verifikasi:** Karena audit ini dilakukan berdasarkan tangkapan layar antarmuka tanpa akses langsung ke repositori *source code* proyek, pastikan atribut `name`, `id`, atau *directive* framework (seperti `v-model`, `wire:model`, atau `onChange`) pada kode asli tetap dihubungkan ke elemen `<input>` yang bersesuaian saat menyalin class styling di atas.

### 6. Masalah yang Belum Selesai / Catatan Integrasi
* Seluruh field angka (`15000000`, `6000000`, `3500000`, `500000`) berstatus *placeholder*, sehingga `Simulasi Estimasi Laba Bersih` menampilkan `Rp 0` dan `Belum Diisi`. Pastikan *event listener* (`input` / `keyup`) pada script Anda terhubung ke `id` masing-masing field untuk memperbarui teks `#simulasi_laba_bersih` dan badge `#status_simulasi_badge` secara *real-time*.

### 7. Rekomendasi Lanjutan
* **Auto-Formatting Pemisah Ribuan (Thousand Separator):** Untuk mencegah kesalahan ketik jumlah nol (misalnya `15000000` vs `1500000`), tambahkan *input masking* ringan di sisi frontend yang memformat tampilan menjadi `15.000.000` saat pengguna mengetik, sembari mengirimkan nilai numerik murni (`15000000`) ke backend saat form di-submit.