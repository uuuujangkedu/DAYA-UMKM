@extends('layouts.auth')

@section('title', 'Gabung Jadi Pelaku UMKM')

@section('content')
<div class="max-w-[1200px] mx-auto px-5 sm:px-8 space-y-12 sm:space-y-16 pt-10 sm:pt-12 pb-8">

    <!-- 1. HERO SECTION UMKM -->
    <section class="hero-card scroll-mt-[100px]" data-reveal data-hero>
        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-10 lg:gap-16 items-center">
            
            <div class="space-y-6 text-left">
                <h1 class="text-[#161d1a] font-bold text-[36px] sm:text-[46px] lg:text-[50px] leading-[1.08] tracking-[-0.025em]" data-reveal-item>
                    Solusi modal dan sewa ruko bagi pelaku usaha
                </h1>

                <p class="text-[#4b5551] text-[18px] leading-[1.6] max-w-[46ch]" data-reveal-item>
                    Kembangkan bisnis Anda dengan kemudahan akses permodalan produktif dan direktori sewa ruko strategis tanpa beban agunan memberatkan.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2" data-reveal-item>
                    <a href="{{ route('register.umkm') }}" class="btn-primary">
                        Daftar sebagai pelaku UMKM
                    </a>
                    <a href="#manfaat-umkm" class="btn-secondary">
                        Pelajari fasilitas
                    </a>
                </div>
            </div>

            <!-- Panel Profil & Fasilitas Bisnis -->
            <div data-reveal-item>
                <div class="panel-peluang space-y-5">
                    <div class="text-center space-y-1">
                        <h2 class="text-[18px] font-bold text-[#084539] leading-snug">
                            Fasilitas ekosistem usaha
                        </h2>
                        <p class="text-[14px] text-[#4b5551]">
                            Dukungan menyeluruh bagi pelaku UMKM
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 w-full text-left">
                        <div class="bg-white rounded-[6px] p-4 border border-[#e2e1d8]">
                            <span class="text-[12px] text-[#4b5551] block">Kebutuhan modal</span>
                            <span class="text-[18px] font-bold text-[#084539] mt-0.5 block">Fleksibel</span>
                            <span class="text-[12px] text-[#4b5551] mt-0.5 block">Sesuai kapasitas usaha</span>
                        </div>
                        <div class="bg-white rounded-[6px] p-4 border border-[#e2e1d8]">
                            <span class="text-[12px] text-[#4b5551] block">Ketersediaan ruko</span>
                            <span class="text-[18px] font-bold text-[#161d1a] mt-0.5 block">Strategis</span>
                            <span class="text-[12px] text-[#4b5551] mt-0.5 block">Pusat keramaian</span>
                        </div>
                    </div>

                    <p class="text-[13px] text-[#4b5551] text-left leading-[1.5] border-t border-[#c6dfd8] pt-3">
                        Tumbuh bersama jejaring investor terpercaya dan fasilitas sewa komersial dengan tata kelola jelas.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. KEUNGGULAN BERGABUNG SEBAGAI UMKM -->
    <section id="manfaat-umkm" class="hero-card space-y-8 scroll-mt-[100px]" data-reveal>
        <div class="text-left space-y-2" data-reveal-item>
            <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight">
                Keunggulan bergabung di Daya UMKM
            </h2>
            <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]">
                Dukungan fasilitas menyeluruh dari permodalan usaha hingga kemudahan sewa tempat berdagang.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Akses modal produktif</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Pendanaan dari investor terverifikasi dengan mekanisme bagi hasil murni yang ramah bagi arus kas usaha.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Sewa ruko strategis</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Akses direktori ruko komersial dari penyedia terpercaya dengan spesifikasi lengkap dan harga transparan.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Pencatatan transparan</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Semua transaksi sewa ruko dan penyaluran bagi hasil tercatat rapi di sistem untuk reputasi usaha Anda.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Peluang naik kelas</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Dukungan ekspansi lokasi gerai dan kapasitas produksi membantu UMKM bertumbuh secara berkelanjutan.
                </p>
            </div>
        </div>
    </section>

    <!-- 3. CARA MEMULAI PERJALANAN USAHA -->
    <section class="hero-card space-y-8 scroll-mt-[100px]" data-reveal>
        <div class="text-left space-y-2" data-reveal-item>
            <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight">
                Tahapan pendaftaran usaha
            </h2>
            <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]">
                Langkah teratur dari registrasi hingga operasional gerai usaha Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 1</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Daftar akun UMKM</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Isi formulir pendaftaran akun usaha dan lakukan verifikasi alamat email lewat kode OTP resmi.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 2</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Lengkapi profil usaha</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Masukkan nama usaha, bidang industri, kontak aktif, dan deskripsi kebutuhan pengembangan.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 3</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Pilih ruko atau modal</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Pilih lokasi ruko yang tersedia atau ajukan kebutuhan modal kerja agar dapat ditinjau investor.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 4</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Operasional & tumbuh</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Jalankan operasional usaha, catat perkembangan omzet, dan bangun hubungan kemitraan yang sehat.
                </p>
            </div>
        </div>
    </section>

    <!-- 4. BOTTOM ACTION CARD -->
    <section class="hero-card space-y-6 text-left scroll-mt-[100px]" data-reveal>
        <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight" data-reveal-item>
            Saatnya membawa usaha Anda ke tingkat selanjutnya
        </h2>
        <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]" data-reveal-item>
            Daftarkan unit usaha Anda sekarang untuk mendapatkan akses modal terukur dan pilihan ruko komersial terbaik.
        </p>
        <div data-reveal-item>
            <a href="{{ route('register.umkm') }}" class="btn-primary">
                Daftar sebagai pelaku UMKM
            </a>
        </div>
    </section>

</div>
@endsection

