@extends('layouts.auth')

@section('title', 'Beranda')

@section('content')
<div class="max-w-[1200px] w-full mx-auto px-5 sm:px-8 space-y-12 sm:space-y-16 pt-10 sm:pt-12 pb-8">

    <!-- 1. HERO SECTION (Sesuai DESIGN.md: Kartu putih, 1.2fr : 1fr, max-w 46ch, sentence case) -->
    <section id="beranda" class="hero-card scroll-mt-[100px] overflow-hidden" data-reveal>
        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-10 lg:gap-16 items-center lg:items-end">
            
            <div class="space-y-6 text-left py-2 sm:py-4">
                <h1 class="text-[#161d1a] font-bold text-[36px] sm:text-[46px] lg:text-[52px] leading-[1.08] tracking-[-0.025em]" data-reveal-item>
                    Wadah permodalan produktif dan sewa ruko bagi pelaku usaha
                </h1>

                <p class="text-[#4b5551] text-[18px] leading-[1.6] max-w-[46ch]" data-reveal-item>
                    Platform terintegrasi bagi investor untuk menyalurkan modal usaha dan memfasilitasi pelaku UMKM memperoleh sewa ruko strategis secara transparan.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2" data-reveal-item>
                    <a href="{{ route('gabung.investor') }}" class="btn-primary">
                        Daftar jadi investor
                    </a>
                    <a href="{{ route('gabung.umkm') }}" class="btn-secondary">
                        Daftar jadi UMKM
                    </a>
                </div>
            </div>

            <!-- Karakter 3D Maskot / Pelaku UMKM -->
            <div class="hero-character-wrapper" data-reveal-item>
                <img src="{{ asset('images/hero-character.png') }}" 
                     alt="Karakter Pelaku Usaha Daya UMKM" 
                     class="hero-character-img">
            </div>

        </div>
    </section>

    <!-- 2. SECTION TENTANG KAMI -->
    <section id="tentang-kami" class="hero-card scroll-mt-[100px] overflow-hidden" data-reveal>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Karakter 3D Tentang Kami -->
            <div class="lg:col-span-5 about-character-wrapper" data-reveal-item>
                <img src="{{ asset('images/about-character.png') }}" 
                     alt="Karakter Maskot Tentang Kami Daya UMKM" 
                     class="about-character-img">
            </div>

            <div class="lg:col-span-7 space-y-4 text-left">
                <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight" data-reveal-item>
                    Tentang kami
                </h2>
                <p class="text-[#4b5551] text-[16px] leading-[1.6]" data-reveal-item>
                    Daya UMKM hadir untuk menjembatani kesenjangan akses permodalan bagi pemilik usaha kecil dan menengah di Indonesia. Melalui sistem verifikasi berlapis dan audit aktivitas yang terpercaya, kami memastikan setiap dana investasi tersalurkan secara optimal dan memberi manfaat timbal balik yang sehat bagi investor maupun pengusaha.
                </p>
                <p class="text-[#4b5551] text-[16px] leading-[1.6]" data-reveal-item>
                    Keamanan data dan transaksi diprioritaskan lewat mekanisme autentikasi terverifikasi dan pembagian hasil usaha yang tercatat rapi di sistem.
                </p>
            </div>

        </div>
    </section>

    <!-- 3. SECTION PANDUAN DAN ALUR KERJA (TUTORIAL) -->
    <section id="tutorial" class="hero-card space-y-8 scroll-mt-[100px]" data-reveal>
        <div class="text-left space-y-2">
            <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight" data-reveal-item>
                Panduan dan alur kerja
            </h2>
            <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]" data-reveal-item>
                Langkah terstruktur menghubungkan pendanaan investor dan pelaku UMKM di dalam platform.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 1</span>
                <h3 class="font-bold text-[17px] text-[#161d1a]">Pendaftaran akun</h3>
                <p class="text-[15px] text-[#4b5551] leading-[1.6]">
                    Pilih peran sebagai mitra investor atau pelaku UMKM, lalu lengkapi verifikasi email OTP resmi.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 2</span>
                <h3 class="font-bold text-[17px] text-[#161d1a]">Verifikasi dan penyesuaian</h3>
                <p class="text-[15px] text-[#4b5551] leading-[1.6]">
                    Pelaku usaha mengajukan kebutuhan sewa atau modal, sedangkan investor meninjau katalog peluang terkurasi.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3" data-reveal-item>
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
        <section id="bantuan" class="hero-card space-y-4 text-left scroll-mt-[100px]" data-reveal>
            <h2 class="text-[24px] sm:text-[28px] font-bold text-[#161d1a] leading-tight" data-reveal-item>
                Pusat bantuan
            </h2>
            <p class="text-[#4b5551] text-[15px] leading-[1.6]" data-reveal-item>
                Butuh panduan mengenai tata cara pendaftaran, syarat pengajuan sewa ruko, atau mekanisme bagi hasil? Tim dukungan kami siap melayani Anda.
            </p>
            <div class="pt-2" data-reveal-item>
                <a href="mailto:bantuan@daya-umkm.id" class="btn-secondary">
                    Kirim pesan ke tim bantuan
                </a>
            </div>
        </section>

        <section id="kontak" class="hero-card space-y-4 text-left scroll-mt-[100px]" data-reveal>
            <h2 class="text-[24px] sm:text-[28px] font-bold text-[#161d1a] leading-tight" data-reveal-item>
                Kontak resmi
            </h2>
            <p class="text-[#4b5551] text-[15px] leading-[1.6]" data-reveal-item>
                Hubungi sekretariat operasional Daya UMKM untuk keperluan kemitraan ruko, konsultasi kelembagaan, dan verifikasi profil usaha.
            </p>
            <div class="text-[14px] text-[#4b5551] space-y-1.5 pt-1" data-reveal-item>
                <div>Email: <span class="text-[#161d1a] font-medium">kontak@daya-umkm.id</span></div>
                <div>Jam operasional: <span class="text-[#161d1a] font-medium">Senin – Jumat, 08.00 – 17.00 WIB</span></div>
            </div>
        </section>
    </div>

</div>
@endsection
