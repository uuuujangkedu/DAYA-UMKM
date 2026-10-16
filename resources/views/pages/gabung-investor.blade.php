@extends('layouts.auth')

@section('title', 'Gabung Jadi Investor')

@section('content')
<div class="max-w-[1200px] mx-auto px-5 sm:px-8 space-y-12 sm:space-y-16 pt-10 sm:pt-12 pb-8">

    <!-- 1. HERO SECTION INVESTOR -->
    <section class="hero-card scroll-mt-[100px]" data-reveal data-hero>
        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-10 lg:gap-16 items-center">
            
            <div class="space-y-6 text-left">
                <h1 class="text-[#161d1a] font-bold text-[36px] sm:text-[46px] lg:text-[50px] leading-[1.08] tracking-[-0.025em]" data-reveal-item>
                    Kemitraan permodalan bagi investor produktif
                </h1>

                <p class="text-[#4b5551] text-[18px] leading-[1.6] max-w-[46ch]" data-reveal-item>
                    Salurkan permodalan langsung kepada pelaku UMKM terverifikasi di ekosistem Daya UMKM dengan imbal hasil terukur, berkala, dan transparan.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2" data-reveal-item>
                    <a href="{{ route('register.investor') }}" class="btn-primary">
                        Daftar sebagai investor
                    </a>
                    <a href="#manfaat-investor" class="btn-secondary">
                        Pelajari manfaat
                    </a>
                </div>
            </div>

            <!-- Panel Profil & Metrik Kemitraan -->
            <div data-reveal-item>
                <div class="panel-peluang space-y-5">
                    <div class="text-center space-y-1">
                        <h2 class="text-[18px] font-bold text-[#084539] leading-snug">
                            Karakteristik portofolio kemitraan
                        </h2>
                        <p class="text-[14px] text-[#4b5551]">
                            Standar tata kelola investasi di Daya UMKM
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 w-full text-left">
                        <div class="bg-white rounded-[6px] p-4 border border-[#e2e1d8]">
                            <span class="text-[12px] text-[#4b5551] block">Estimasi bagi hasil</span>
                            <span class="text-[18px] font-bold text-[#084539] mt-0.5 block">12% – 18%</span>
                            <span class="text-[12px] text-[#4b5551] mt-0.5 block">Per tahun (proyeksian)</span>
                        </div>
                        <div class="bg-white rounded-[6px] p-4 border border-[#e2e1d8]">
                            <span class="text-[12px] text-[#4b5551] block">Periode bagi hasil</span>
                            <span class="text-[18px] font-bold text-[#161d1a] mt-0.5 block">Bulanan</span>
                            <span class="text-[12px] text-[#4b5551] mt-0.5 block">Tercatat di sistem</span>
                        </div>
                    </div>

                    <p class="text-[13px] text-[#4b5551] text-left leading-[1.5] border-t border-[#c6dfd8] pt-3">
                        Setiap transaksi permodalan diaudit oleh admin dan dilengkapi riwayat bukti penyaluran bagi hasil.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. MANFAAT MENJADI INVESTOR -->
    <section id="manfaat-investor" class="hero-card space-y-8 scroll-mt-[100px]" data-reveal>
        <div class="text-left space-y-2" data-reveal-item>
            <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight">
                Keunggulan kemitraan investor
            </h2>
            <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]">
                Jembatan investasi inklusif yang mengedepankan keamanan dana dan akuntabilitas operasional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">UMKM terverifikasi</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Setiap unit usaha melewati kurasi profil, rekam jejak omzet, dan kejelasan identitas pemilik.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Bagi hasil berkala</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Distribusi keuntungan dicatat secara rinci dalam riwayat transaksi dengan bukti transfer resmi.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Diversifikasi usaha</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Alokasikan modal ke berbagai bidang usaha seperti kuliner, ritel, dan jasa untuk menjaga profil risiko.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <svg class="w-8 h-8 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Keamanan akun</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Verifikasi login via kode OTP email resmi dan audit trail aktivitas untuk melindungi data kemitraan.
                </p>
            </div>
        </div>
    </section>

    <!-- 3. CARA MEMULAI INVESTASI -->
    <section class="hero-card space-y-8 scroll-mt-[100px]" data-reveal>
        <div class="text-left space-y-2" data-reveal-item>
            <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight">
                Tahapan berinvestasi
            </h2>
            <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]">
                Proses terstruktur mulai dari registrasi hingga penerimaan bagi hasil.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 1</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Daftar akun investor</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Buka formulir online khusus investor dan verifikasi email Anda lewat kode OTP 6-digit.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 2</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Pilih UMKM potensial</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Pelajari rincian profil usaha, kebutuhan modal kerja, dan estimasi bagi hasil yang ditawarkan.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 3</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Konfirmasi permodalan</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Kirim pengajuan investasi Anda. Permodalan akan diverifikasi dan diaudit langsung oleh admin.
                </p>
            </div>

            <div class="p-6 rounded-[10px] bg-[#f7f6f1] border border-[#e2e1d8] space-y-3 text-left" data-reveal-item>
                <span class="inline-block text-[14px] font-bold text-[#0b5a4a]">Tahap 4</span>
                <h3 class="font-bold text-[16px] text-[#161d1a]">Terima bagi hasil</h3>
                <p class="text-[14px] text-[#4b5551] leading-[1.6]">
                    Pantau kinerja usaha dari dashboard dan terima pembagian hasil berkala sesuai perjanjian.
                </p>
            </div>
        </div>
    </section>

    <!-- 4. BOTTOM ACTION CARD -->
    <section class="hero-card space-y-6 text-left scroll-mt-[100px]" data-reveal>
        <h2 class="text-[28px] sm:text-[34px] font-bold text-[#161d1a] leading-tight" data-reveal-item>
            Mulai kemitraan investasi Anda sekarang
        </h2>
        <p class="text-[#4b5551] text-[16px] max-w-2xl leading-[1.6]" data-reveal-item>
            Dukung pertumbuhan pelaku usaha lokal dan nikmati bagi hasil terukur bersama ekosistem terpercaya Daya UMKM.
        </p>
        <div data-reveal-item>
            <a href="{{ route('register.investor') }}" class="btn-primary">
                Daftar sebagai investor
            </a>
        </div>
    </section>

</div>
@endsection

