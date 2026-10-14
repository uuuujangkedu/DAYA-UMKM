@extends('layouts.auth')

@section('title', 'Beranda - DAYA UMKM')

@section('content')
<div class="w-full max-w-6xl space-y-16 py-6">

    <!-- HERO SECTION (Sesuai Mockup HOME) -->
    <section class="bg-white rounded-2xl p-8 sm:p-12 border border-[#E5E3DC] shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-[#075B50] text-xs font-bold border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-[#075B50]"></span>
                    Platform Ekosistem Terpadu UMKM & Ruko
                </div>
                
                <h1 class="text-3xl sm:text-5xl font-extrabold text-[#1B1B18] tracking-tight leading-tight uppercase">
                    SELAMAT DATANG DI <br>
                    <span class="text-[#075B50]">DAYA UMKM</span>
                </h1>

                <p class="text-[#5E6E69] text-sm sm:text-base leading-relaxed max-w-xl">
                    Wadah terintegrasi bagi investor untuk menyalurkan permodalan produktif dan memfasilitasi pelaku UMKM mendapatkan sewa ruko strategis dengan tata kelola transparan & akuntabel.
                </p>

                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ route('register') }}" class="px-6 py-3.5 bg-[#075B50] hover:bg-[#26734D] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition">
                        Daftar Jadi Mitra
                    </a>
                    <a href="{{ route('login') }}" class="px-6 py-3.5 bg-[#F5B800] hover:bg-[#E2A700] text-[#1B1B18] font-bold text-xs uppercase tracking-wider rounded-xl shadow transition">
                        Masuk Akun
                    </a>
                </div>
            </div>

            <!-- Placeholder Box Teal Pastel (Sesuai Mockup) -->
            <div class="lg:col-span-5">
                <div class="w-full aspect-[4/3] rounded-2xl bg-[#A9DFD8] border border-teal-200 shadow-inner flex flex-col items-center justify-center p-6 text-center text-[#075B50]">
                    <div class="w-16 h-16 rounded-2xl bg-white/70 flex items-center justify-center mb-3 shadow-sm">
                        <svg class="w-8 h-8 text-[#075B50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-extrabold text-sm uppercase tracking-wide">Peluang Investasi & Ruko</span>
                    <span class="text-xs text-[#05453D] mt-1 opacity-80">Tersebar di berbagai lokasi potensial</span>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION TENTANG KAMI (Sesuai Mockup TENTANG KAMI) -->
    <section id="tentang-kami" class="bg-white rounded-2xl p-8 sm:p-12 border border-[#E5E3DC] shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Placeholder Box Dusty Red (Sesuai Mockup) -->
            <div class="lg:col-span-4">
                <div class="w-full aspect-square rounded-2xl bg-[#A85858] shadow-inner flex flex-col items-center justify-center p-6 text-white text-center">
                    <svg class="w-12 h-12 text-white/90 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="font-extrabold text-sm uppercase tracking-wider">Mitra Kolaboratif</span>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-4">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1B1B18] tracking-tight uppercase">
                    TENTANG KAMI
                </h2>
                <p class="text-[#5E6E69] text-sm sm:text-base leading-relaxed">
                    DAYA UMKM hadir untuk menjembatani kesenjangan akses permodalan bagi pemilik usaha kecil dan menengah di Indonesia. Melalui sistem verifikasi berlapis dan audit aktivitas yang terpercaya, kami memastikan setiap dana investasi tersalurkan optimal dan memberi manfaat timbal balik bagi investor maupun pengusaha.
                </p>
                <div class="pt-2 flex items-center gap-3 text-xs font-bold text-[#075B50]">
                    <span class="inline-block w-2 h-2 rounded-full bg-[#075B50]"></span>
                    <span>Keamanan data terjaga dengan verifikasi OAuth Google dan OTP email resmi</span>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection
