@extends('layouts.auth')

@section('title', 'Gabung Jadi Pelaku UMKM - DAYA UMKM')

@section('content')
<div class="w-full max-w-6xl space-y-16 py-4">

    <!-- HERO SECTION (Sesuai Gaya Desain PaDi UMKM) -->
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#112F2B] via-[#093D36] to-[#075B50] text-white shadow-xl border border-emerald-900/40 p-8 sm:p-12 lg:p-16">
        <!-- Dekorasi Background Circles -->
        <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-teal-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-80 h-80 rounded-full bg-[#F5B800]/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Kolom Teks & Aksi -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md text-emerald-200 text-xs font-bold border border-white/15 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Solusi Terpadu Modal & Sewa Ruko</span>
                </div>

                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                    Gabung Jadi <br>
                    <span class="text-[#F5B800]">Pelaku UMKM DAYA</span>
                </h1>

                <p class="text-emerald-100/90 text-sm sm:text-base leading-relaxed max-w-xl">
                    Kembangkan bisnis Anda ke tingkat berikutnya dengan kemudahan akses permodalan produktif dan fasilitas sewa ruko komersial di lokasi strategis. Bebas beban agunan memberatkan, tumbuh bersama mitra investor.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('register.umkm') }}" 
                       class="px-7 py-3.5 bg-[#00A389] hover:bg-[#008F78] text-white font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-lg hover:shadow-xl transition-all duration-150 transform hover:-translate-y-0.5 flex items-center gap-2">
                        <span>GABUNG SEKARANG</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <a href="#kenapa-umkm" 
                       class="px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-xs uppercase tracking-wider rounded-xl border border-white/20 backdrop-blur-sm transition">
                        Pelajari Manfaat
                    </a>
                </div>

                <div class="pt-4 flex items-center gap-6 text-xs text-emerald-200/80">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Akses Permodalan Fleksibel</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Pilihan Lokasi Ruko Terbaik</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Visual Showcase Card -->
            <div class="lg:col-span-5">
                <div class="relative bg-white/10 backdrop-blur-md rounded-2xl p-6 sm:p-8 border border-white/20 shadow-2xl space-y-5">
                    
                    <div class="flex items-center justify-between border-b border-white/15 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-xl bg-white text-[#075B50] flex items-center justify-center font-black text-lg shadow-md">
                                <svg class="w-6 h-6 text-[#075B50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-[11px] text-emerald-200 uppercase font-semibold">Fasilitas Bisnis</div>
                                <div class="text-base font-extrabold text-white">Mitra Pelaku UMKM</div>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-[#F5B800]/20 text-[#F5B800] text-[10px] font-bold border border-[#F5B800]/30">Peluang Emas</span>
                    </div>

                    <!-- Highlight Metrics -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-black/20 rounded-xl p-3.5 border border-white/10">
                            <div class="text-[10px] text-emerald-200">Kebutuhan Modal</div>
                            <div class="text-xl font-black text-[#F5B800] mt-0.5">Sesuai Usaha</div>
                            <div class="text-[9px] text-emerald-300/80 mt-1">Skema bagi hasil fleksibel</div>
                        </div>
                        <div class="bg-black/20 rounded-xl p-3.5 border border-white/10">
                            <div class="text-[10px] text-emerald-200">Ketersediaan Ruko</div>
                            <div class="text-xl font-black text-white mt-0.5">Lokasi Utama</div>
                            <div class="text-[9px] text-emerald-300/80 mt-1">Dekat pusat keramaian</div>
                        </div>
                    </div>

                    <div class="bg-teal-950/40 rounded-xl p-3.5 border border-teal-600/30 text-xs text-emerald-100 flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-[#F5B800] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Bergabung bersama ratusan pengusaha mikro dan kecil yang telah meningkatkan kapasitas produksinya melalui jejaring DAYA UMKM.</span>
                    </div>

                    <a href="{{ route('register.umkm') }}" class="block text-center w-full py-3 bg-[#F5B800] hover:bg-[#E2A700] text-[#075B50] font-extrabold text-xs uppercase tracking-wider rounded-xl transition shadow">
                        MULAI REGISTRASI PELAKU UMKM &rarr;
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: KENAPA GABUNG MENJADI PELAKU UMKM (Sesuai Referensi PaDi UMKM) -->
    <section id="kenapa-umkm" class="text-center space-y-4 pt-4">
        <h2 class="text-2xl sm:text-4xl font-extrabold text-[#1B1B18] tracking-tight">
            Kenapa Gabung Menjadi Pelaku UMKM di DAYA UMKM
        </h2>
        <!-- Garis Penegas Aksen Hijau/Teal Khas Screenshot PaDi -->
        <div class="w-16 h-1 bg-[#00A389] mx-auto rounded-full"></div>
        <p class="text-[#5E6E69] text-xs sm:text-sm max-w-2xl mx-auto">
            Dapatkan dukungan fasilitas menyeluruh dari permodalan produktif hingga kemudahan mencari tempat usaha strategis.
        </p>

        <!-- Grid 4 Keunggulan -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-6 text-left">
            
            <!-- Keunggulan 1 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-teal-50 text-[#075B50] flex items-center justify-center mb-4 group-hover:bg-[#075B50] group-hover:text-white transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    Akses Modal Produktif
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Dapatkan pendanaan dari investor terverifikasi dengan mekanisme bagi hasil murni yang ramah bagi kelangsungan arus kas usaha Anda.
                </p>
            </div>

            <!-- Keunggulan 2 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#075B50] flex items-center justify-center mb-4 group-hover:bg-[#075B50] group-hover:text-white transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    Sewa Ruko Strategis
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Akses direktori ruko komersial dari penyedia terpercaya dengan spesifikasi lengkap, harga transparan, dan jadwal bebas tumpang tindih.
                </p>
            </div>

            <!-- Keunggulan 3 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-[#C68D00] flex items-center justify-center mb-4 group-hover:bg-[#F5B800] group-hover:text-[#075B50] transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#075B50] transition">
                    Tata Kelola & Bukti Transparan
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Semua transaksi sewa ruko dan penyaluran bagi hasil tercatat rapi di sistem sehingga meningkatkan kredibilitas bisnis Anda.
                </p>
            </div>

            <!-- Keunggulan 4 -->
            <div class="bg-white rounded-2xl p-6 border border-[#E5E3DC] shadow-sm hover:shadow-md hover:border-[#075B50] transition group">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-[#4338CA] flex items-center justify-center mb-4 group-hover:bg-[#4338CA] group-hover:text-white transition shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1B1B18] mb-2 group-hover:text-[#4338CA] transition">
                    Peluang Bisnis Naik Kelas
                </h3>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Dukungan ekspansi lokasi gerai dan kapasitas produksi membantu UMKM Anda berkembang menjadi bisnis skala menengah dan besar.
                </p>
            </div>

        </div>
    </section>

    <!-- SECTION 3: 4 LANGKAH MUDAH BERGABUNG SEBAGAI UMKM -->
    <section class="bg-white rounded-3xl p-8 sm:p-12 border border-[#E5E3DC] shadow-sm">
        <div class="text-center max-w-xl mx-auto space-y-3 mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-[#075B50]">Langkah Mudah</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1B1B18]">Cara Memulai Perjalanan Usaha Anda</h2>
            <div class="w-12 h-1 bg-[#00A389] mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
            
            <!-- Langkah 1 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#075B50] text-white flex items-center justify-center font-extrabold text-sm shadow">
                    1
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Daftar Akun UMKM</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Isi formulir pendaftaran UMKM, data identitas, dan verifikasi alamat email via kode OTP resmi.
                </p>
            </div>

            <!-- Langkah 2 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#075B50] text-white flex items-center justify-center font-extrabold text-sm shadow">
                    2
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Lengkapi Profil Usaha</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Masukkan nama usaha, jenis industri dagang/jasa, kontak aktif, dan deskripsi kebutuhan pengembangan bisnis Anda.
                </p>
            </div>

            <!-- Langkah 3 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#075B50] text-white flex items-center justify-center font-extrabold text-sm shadow">
                    3
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Pilih Ruko atau Ajukan Modal</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Jelajahi ruko yang tersedia atau ajukan kebutuhan modal kerja agar dapat ditinjau dan didanai oleh investor.
                </p>
            </div>

            <!-- Langkah 4 -->
            <div class="p-6 rounded-2xl bg-[#F8F7F2] border border-[#E5E3DC] space-y-3 relative group hover:border-[#075B50] transition">
                <div class="w-10 h-10 rounded-xl bg-[#F5B800] text-[#075B50] flex items-center justify-center font-extrabold text-sm shadow">
                    4
                </div>
                <h4 class="font-bold text-sm text-[#1B1B18]">Operasional & Bertumbuh</h4>
                <p class="text-xs text-[#5E6E69] leading-relaxed">
                    Mulai operasikan gerai usaha Anda, catat perkembangan omzet, dan jalin kolaborasi berkelanjutan dalam ekosistem.
                </p>
            </div>

        </div>
    </section>

    <!-- SECTION 4: CALL TO ACTION BOTTOM BANNER -->
    <section class="rounded-3xl bg-gradient-to-r from-[#075B50] to-[#1E5C3D] p-8 sm:p-12 text-white text-center space-y-6 shadow-lg">
        <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
            Saatnya Membawa Usaha Anda Menuju Tingkat Selanjutnya
        </h2>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Daftarkan usaha Anda sekarang juga dan nikmati berbagai kemudahan permodalan serta lokasi ruko usaha terbaik di Indonesia.
        </p>
        <div class="pt-2">
            <a href="{{ route('register.umkm') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-[#F5B800] hover:bg-[#E2A700] text-[#075B50] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-0.5">
                <span>Buka Formulir Pendaftaran UMKM</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>

</div>
@endsection
