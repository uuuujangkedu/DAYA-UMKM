@extends('layouts.auth')

@section('title', 'Beranda')

@section('content')
<div class="max-w-[1200px] mx-auto px-5 sm:px-8 space-y-12 sm:space-y-16 pt-10 sm:pt-12 pb-8">

    <!-- 1. HERO SECTION (Sesuai DESIGN.md: Kartu putih, 1.2fr : 1fr, max-w 46ch, sentence case) -->
    <section id="beranda" class="hero-card animate-hero scroll-mt-[100px]">
        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-10 lg:gap-16 items-center">
            
            <div class="space-y-6 text-left">
                <h1 class="text-[#161d1a] font-bold text-[36px] sm:text-[46px] lg:text-[52px] leading-[1.08] tracking-[-0.025em]">
                    Wadah permodalan produktif dan sewa ruko bagi pelaku usaha
                </h1>

                <p class="text-[#4b5551] text-[18px] leading-[1.6] max-w-[46ch]">
                    Platform terintegrasi bagi investor untuk menyalurkan modal usaha dan memfasilitasi pelaku UMKM memperoleh sewa ruko strategis secara transparan.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('gabung.investor') }}" class="btn-primary">
                        Daftar jadi investor
                    </a>
                    <a href="{{ route('gabung.umkm') }}" class="btn-secondary">
                        Daftar jadi UMKM
                    </a>
                </div>
            </div>

            <!-- Panel Peluang (Sesuai DESIGN.md: latar mint, radius 10px, min-height 320px, rata tengah) -->
            <div class="animate-hero-panel">
                <div class="panel-peluang">
                    <svg class="w-10 h-10 text-[#0b5a4a] mb-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h2 class="text-[18px] font-bold text-[#084539] leading-snug">
                        Peluang investasi dan sewa ruko
                    </h2>
                    <p class="text-[15px] text-[#4b5551] mt-2 max-w-xs leading-[1.5]">
                        Tersebar di berbagai lokasi strategis dengan tata kelola transparan dan imbal hasil terukur.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. SECTION TENTANG KAMI -->
    <section id="tentang-kami" class="hero-card scroll-mt-[100px]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <div class="lg:col-span-4">
                <div class="rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] p-8 flex flex-col items-center justify-center text-center min-h-[220px]">
                    <svg class="w-10 h-10 text-[#0b5a4a] mb-3" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-bold text-[16px] text-[#084539]">Kemitraan produktif</span>
                    <span class="text-[14px] text-[#4b5551] mt-1">Menghubungkan modal dengan potensi usaha nyata</span>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-4 text-left">
                <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight">
                    Tentang kami
                </h2>
                <p class="text-[#4b5551] text-[16px] leading-[1.6]">
                    Daya UMKM hadir untuk menjembatani kesenjangan akses permodalan bagi pemilik usaha kecil dan menengah di Indonesia. Melalui sistem verifikasi berlapis dan audit aktivitas yang terpercaya, kami memastikan setiap dana investasi tersalurkan secara optimal dan memberi manfaat timbal balik yang sehat bagi investor maupun pengusaha.
                </p>
                <p class="text-[#4b5551] text-[16px] leading-[1.6]">
                    Keamanan data dan transaksi diprioritaskan lewat mekanisme autentikasi terverifikasi dan pembagian hasil usaha yang tercatat rapi di sistem.
                </p>
            </div>

        </div>
    </section>

    <!-- 3. SECTION PANDUAN DAN ALUR KERJA (TUTORIAL) -->
    <section id="tutorial" class="hero-card space-y-8 scroll-mt-[100px]">
        <div class="text-left space-y-2">
            <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight">
                Panduan dan alur kerja
            </h2>
            <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]">
                Langkah terstruktur menghubungkan pendanaan investor dan pelaku UMKM di dalam platform.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3">
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 1</span>
                <h3 class="font-bold text-[17px] text-[#161d1a]">Pendaftaran akun</h3>
                <p class="text-[15px] text-[#4b5551] leading-[1.6]">
                    Pilih peran sebagai mitra investor atau pelaku UMKM, lalu lengkapi verifikasi email OTP resmi.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3">
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 2</span>
                <h3 class="font-bold text-[17px] text-[#161d1a]">Verifikasi dan penyesuaian</h3>
                <p class="text-[15px] text-[#4b5551] leading-[1.6]">
                    Pelaku usaha mengajukan kebutuhan sewa atau modal, sedangkan investor meninjau katalog peluang terkurasi.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3">
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 3</span>
                <h3 class="font-bold text-[17px] text-[#161d1a]">Realisasi dan bagi hasil</h3>
                <p class="text-[15px] text-[#4b5551] leading-[1.6]">
                    Penyaluran modal dilakukan dengan transparansi penuh, dividen bagi hasil dicatat berkala di dashboard.
                </p>
            </div>
        </div>
    </section>

    <!-- 4. SECTION BANTUAN & KONTAK -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <section id="bantuan" class="hero-card space-y-4 text-left scroll-mt-[100px]">
            <h2 class="text-[24px] sm:text-[28px] font-bold text-[#161d1a] leading-tight">
                Pusat bantuan
            </h2>
            <p class="text-[#4b5551] text-[15px] leading-[1.6]">
                Butuh panduan mengenai tata cara pendaftaran, syarat pengajuan sewa ruko, atau mekanisme bagi hasil? Tim dukungan kami siap melayani Anda.
            </p>
            <div class="pt-2">
                <a href="mailto:bantuan@daya-umkm.id" class="btn-secondary">
                    Kirim pesan ke tim bantuan
                </a>
            </div>
        </section>

        <section id="kontak" class="hero-card space-y-4 text-left scroll-mt-[100px]">
            <h2 class="text-[24px] sm:text-[28px] font-bold text-[#161d1a] leading-tight">
                Kontak resmi
            </h2>
            <p class="text-[#4b5551] text-[15px] leading-[1.6]">
                Hubungi sekretariat operasional Daya UMKM untuk keperluan kemitraan ruko, konsultasi kelembagaan, dan verifikasi profil usaha.
            </p>
            <div class="text-[14px] text-[#4b5551] space-y-1.5 pt-1">
                <div>Email: <span class="text-[#161d1a] font-medium">kontak@daya-umkm.id</span></div>
                <div>Jam operasional: <span class="text-[#161d1a] font-medium">Senin – Jumat, 08.00 – 17.00 WIB</span></div>
            </div>
        </section>
    </div>

</div>
@endsection
