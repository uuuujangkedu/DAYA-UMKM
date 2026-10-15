@extends('layouts.auth')

@section('title', 'Gabung Jadi Investor - DAYA UMKM')

@section('content')
<div class="w-full max-w-6xl space-y-16 py-4">

    <!-- HERO SECTION (Sesuai Gaya Desain PaDi UMKM) -->
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#172E2B] via-[#0F4B41] to-[#075B50] text-white shadow-xl border border-emerald-900/40 p-8 sm:p-12 lg:p-16">
        <!-- Dekorasi Background Circles -->
        <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-emerald-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-80 h-80 rounded-full bg-[#F5B800]/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Kolom Teks & Aksi -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-emerald-200 text-xs font-bold border border-white/15 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-[#F5B800] animate-pulse"></span>
                    <span>Peluang Permodalan Usaha Terkurasi</span>
                </div>

                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                    Gabung Jadi <br>
                    <span class="text-[#F5B800]">Investor DAYA UMKM</span>
                </h1>

                <p class="text-emerald-100/90 text-sm sm:text-base leading-relaxed max-w-xl">
                    Temukan berbagai kesempatan berinvestasi dengan menyalurkan permodalan produktif kepada pelaku UMKM terverifikasi di ekosistem DAYA UMKM. Dapatkan imbal hasil kompetitif, berkala, dan transparan.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('register.investor') }}" 
                       class="px-7 py-3.5 bg-[#00A389] hover:bg-[#008F78] text-white font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-lg hover:shadow-xl transition-all duration-150 transform hover:-translate-y-0.5 flex items-center gap-2">
                        <span>GABUNG SEKARANG</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="#kenapa-investor" 
                       class="px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-wider rounded-xl border border-white/20 backdrop-blur-sm transition">
                        Pelajari Manfaat
                    </a>
                </div>

                <div class="pt-4 flex items-center gap-6 text-xs text-emerald-200/80">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#F5B800]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Sistem Bagi Hasil Adil</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#F5B800]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Keamanan 2FA OTP</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Visual Showcase Card -->
            <div class="lg:col-span-5">
                <div class="relative bg-white/10 backdrop-blur-md rounded-2xl p-6 sm:p-8 border border-white/20 shadow-2xl space-y-5">
                    
                    <div class="flex items-center justify-between border-b border-white/15 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-[#F5B800] text-[#075B50] flex items-center justify-center font-black text-lg shadow-md">
                                Rp
                            </div>
                            <div>
                                <div class="text-[11px] text-emerald-200 uppercase font-semibold">Simulasi Portofolio</div>
                                <div class="text-base font-extrabold text-white">Mitra Investor DAYA</div>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-emerald-400/20 text-emerald-300 text-[10px] font-bold border border-emerald-400/30">Aktif</span>
                    </div>

                    <!-- Highlight Metrics -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-black/20 rounded-xl p-3.5 border border-white/10">
                            <div class="text-[10px] text-emerald-200">Rata-rata Bagi Hasil</div>
                            <div class="text-xl font-black text-[#F5B800] mt-0.5">12% - 18%</div>
                            <div class="text-[9px] text-emerald-300/80 mt-1">Per tahun (proyeksian)</div>
                        </div>
                        <div class="bg-black/20 rounded-xl p-3.5 border border-white/10">
                            <div class="text-[10px] text-emerald-200">Periode Dividen</div>
                            <div class="text-xl font-black text-white mt-0.5">Bulanan</div>
                            <div class="text-[9px] text-emerald-300/80 mt-1">Langsung via transfer</div>
                        </div>
                    </div>

                    <div class="bg-emerald-950/40 rounded-xl p-3.5 border border-emerald-600/30 text-xs text-emerald-100 flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#F5B800] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Setiap transaksi investasi diaudit ketat oleh admin dan didukung bukti transfer log bagi hasil yang transparan.</span>
                    </div>

                    <a href="{{ route('register.investor') }}" class="block text-center w-full py-3 bg-white hover:bg-emerald-50 text-[#075B50] font-extrabold text-xs uppercase tracking-wider rounded-xl transition shadow">
                        MULAI REGISTRASI INVESTOR &rarr;
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: KENAPA GABUNG MENJADI INVESTOR (Sesuai Referensi PaDi UMKM) -->
    <section id="kenapa-investor" class="text-center space-y-4 pt-4">
        <h2 class="text-2xl sm:text-4xl font-extrabold text-[#1B1B18] tracking-tight">
            Kenapa Gabung Menjadi Investor di DAYA UMKM
        </h2>
        <!-- Garis Penegas Aksen Hijau/Teal Khas Screenshot PaDi -->
        <div class="w-16 h-1 bg-[#00A389] mx-auto rounded-full"></div>
        <p class="text-[#5E6E69] text-xs sm:text-sm max-w-2xl mx-auto">
            Kami menghadirkan jembatan investasi inklusif yang aman, terstandarisasi, dan mengedepankan prinsip transparansi operasional.
        </p>

        <!-- Grid 4 Keunggulan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-6 text-left">
            
            <!-- Keunggulan 1 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#075B50] flex items-center justify-center mb-4 group-hover:bg-[#075B50] group-hover:text-white transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    UMKM Terkurasi & Sah
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Setiap unit usaha telah melewati verifikasi kelayakan profil, legalitas dasar, rekam jejak omzet, dan kejelasan pemilik usaha.
                </p>
            </div>

            <!-- Keunggulan 2 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-[#C68D00] flex items-center justify-center mb-4 group-hover:bg-[#F5B800] group-hover:text-[#075B50] transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    Bagi Hasil Nyata & Rutin
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Distribusi pembagian keuntungan dicatat terperinci dalam riwayat log dengan bukti transfer resmi yang dapat diunduh kapan saja.
                </p>
            </div>

            <!-- Keunggulan 3 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-teal-50 text-[#075B50] flex items-center justify-center mb-4 group-hover:bg-[#075B50] group-hover:text-white transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    Diversifikasi Portofolio
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Alokasikan modal ke berbagai bidang usaha seperti F&B, ritel, jasa, dan perdagangan guna meminimalkan risiko investasi.
                </p>
            </div>

            <!-- Keunggulan 4 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#245DA8] flex items-center justify-center mb-4 group-hover:bg-[#245DA8] group-hover:text-white transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    Keamanan Akun Terlindungi
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Dilengkapi verifikasi OTP email/SMS, Google OAuth resmi, dan audit log pelacakan aktivitas untuk proteksi dana Anda.
                </p>
            </div>

        </div>
    </section>

    <!-- SECTION 3: 4 LANGKAH MUDAH BERINVESTASI -->
    <section class="bg-white rounded-3xl p-8 sm:p-12 border border-[#E5E3DC] shadow-sm">
        <div class="text-center max-w-xl mx-auto space-y-3 mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-[#075B50]">Langkah Mudah</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1B1B18]">Cara Memulai Investasi Bersama Kami</h2>
            <div class="w-12 h-1 bg-[#00A389] mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
            
            <!-- Langkah 1 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#075B50] text-white flex items-center justify-center font-extrabold text-sm shadow">
                    1
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Daftar Akun Investor</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Buka formulir online khusus investor, lalu verifikasi email menggunakan kode OTP 6-digit.
                </p>
            </div>

            <!-- Langkah 2 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#075B50] text-white flex items-center justify-center font-extrabold text-sm shadow">
                    2
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Pilih UMKM Potensial</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Pelajari rincian profil usaha, kebutuhan modal kerja, serta skema estimasi persentase bagi hasil yang ditawarkan.
                </p>
            </div>

            <!-- Langkah 3 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#075B50] text-white flex items-center justify-center font-extrabold text-sm shadow">
                    3
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Konfirmasi Permodalan</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Kirim pengajuan investasi Anda. Permodalan akan disetujui dan diaudit langsung oleh admin operasional platform.
                </p>
            </div>

            <!-- Langkah 4 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#F5B800] text-[#075B50] flex items-center justify-center font-extrabold text-sm shadow">
                    4
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Terima Bagi Hasil</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Pantau kinerja usaha dari dashboard investor dan terima dividen bagi hasil berkala langsung ke rekening Anda.
                </p>
            </div>

        </div>
    </section>

    <!-- SECTION 4: CALL TO ACTION BOTTOM BANNER -->
    <section class="rounded-3xl bg-gradient-to-r from-[#075B50] to-[#26734D] p-8 sm:p-12 text-white text-center space-y-6 shadow-lg">
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
            Siap Menjadi Bagian Kemajuan UMKM Indonesia?
        </h2>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Mulai langkah investasi berdampak sosial dan finansial nyata. Buka formulir investor Anda sekarang.
        </p>
        <div class="pt-2">
            <a href="{{ route('register.investor') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-[#F5B800] hover:bg-[#E2A700] text-[#075B50] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-0.5">
                <span>Buka Formulir Pendaftaran Investor</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>

</div>
@endsection
