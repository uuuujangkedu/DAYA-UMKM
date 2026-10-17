@extends('layouts.auth')

@section('title', 'Beranda')

@section('content')
<div class="relative w-full overflow-hidden bg-gradient-to-b from-[#E8F5EF] via-[#F4F7F5] via-40% to-[#F0F7F4]">

    <!-- ========================================================
         SISTEM LATAR BELAKANG LAPISAN DEKORATIF (new-design.jpg)
         ======================================================== -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        
        <!-- 1. Soft Glow Bokeh Blobs -->
        <div class="absolute -top-24 -left-24 w-[480px] h-[480px] rounded-full bg-[#1A7A5E]/12 blur-[100px]"></div>
        <div class="absolute top-28 right-0 sm:-right-12 w-[400px] h-[400px] rounded-full bg-[#F5C842]/20 blur-[90px]"></div>
        <div class="absolute top-[880px] -left-20 w-[420px] h-[420px] rounded-full bg-[#1A7A5E]/10 blur-[100px]"></div>
        <div class="absolute top-[1100px] right-2 sm:right-10 w-[340px] h-[340px] rounded-full bg-[#F5C842]/18 blur-[85px]"></div>
        <div class="absolute top-[1750px] left-10 w-[450px] h-[450px] rounded-full bg-[#1A7A5E]/10 blur-[110px]"></div>

        <!-- 2. Dot Matrix Grid Pattern (Top Right & Mid Left) -->
        <!-- Dot Grid 1: Top Right Hero -->
        <svg class="absolute top-12 right-6 sm:right-16 w-44 h-28 text-[#1A7A5E]/20" fill="currentColor" viewBox="0 0 160 100">
            <defs>
                <pattern id="dot-pattern-hero" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
                    <circle cx="3" cy="3" r="2.2" />
                </pattern>
            </defs>
            <rect width="160" height="100" fill="url(#dot-pattern-hero)" />
        </svg>

        <!-- Dot Grid 2: Left Side Tentang Kami -->
        <svg class="absolute top-[820px] left-6 sm:left-14 w-36 h-28 text-[#1A7A5E]/20" fill="currentColor" viewBox="0 0 140 100">
            <defs>
                <pattern id="dot-pattern-about" x="0" y="0" width="16" height="16" patternUnits="userSpaceOnUse">
                    <circle cx="3" cy="3" r="2.2" />
                </pattern>
            </defs>
            <rect width="140" height="100" fill="url(#dot-pattern-about)" />
        </svg>

        <!-- 3. Curved SVG Contour Wave Lines (Sesuai new-design.jpg) -->
        <svg class="absolute top-20 right-0 w-[800px] lg:w-[1050px] h-[1100px] opacity-70" viewBox="0 0 1000 1100" fill="none">
            <!-- Parallel Sweeping Splines -->
            <path d="M 980 60 C 720 180, 560 380, 680 580 C 780 740, 520 900, 260 980" stroke="rgba(15,90,71,0.08)" stroke-width="1.2" />
            <path d="M 1020 90 C 760 210, 600 410, 720 610 C 820 770, 560 930, 300 1010" stroke="rgba(15,90,71,0.08)" stroke-width="1.2" />
            <path d="M 1060 120 C 800 240, 640 440, 760 640 C 860 800, 600 960, 340 1040" stroke="rgba(15,90,71,0.08)" stroke-width="1.2" />
            <path d="M 1100 150 C 840 270, 680 470, 800 670 C 900 830, 640 990, 380 1070" stroke="rgba(15,90,71,0.08)" stroke-width="1.2" />
            <path d="M 940 30 C 680 150, 520 350, 640 550 C 740 710, 480 870, 220 950" stroke="rgba(15,90,71,0.06)" stroke-width="1.2" />
            
            <!-- Diagonal Wave in Tutorial Section -->
            <path d="M 1000 1100 C 750 1200, 450 1350, 100 1480" stroke="rgba(15,90,71,0.07)" stroke-width="1.2" />
            <path d="M 1040 1140 C 790 1240, 490 1390, 140 1520" stroke="rgba(15,90,71,0.07)" stroke-width="1.2" />
        </svg>

    </div>

    <!-- Konten Utama Terpusat -->
    <div class="max-w-[1200px] w-full mx-auto px-5 sm:px-8 relative z-10 space-y-16 sm:space-y-24 pt-6 sm:pt-10 pb-16">

        <!-- ========================================================
             1. HERO SECTION (Wadah Permodalan Produktif)
             ======================================================== -->
        <section id="beranda" class="scroll-mt-[100px] pt-4 sm:pt-6" data-reveal>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                
                <!-- Kolom Kiri: Teks & CTA -->
                <div class="lg:col-span-7 space-y-6 text-left py-2 sm:py-6">
                    <h1 class="text-[#1A1A1A] font-bold text-[36px] sm:text-[46px] lg:text-[50px] leading-[1.14] tracking-[-0.025em]" data-reveal-item>
                        Wadah permodalan produktif dan sewa ruko bagi pelaku usaha
                    </h1>

                    <p class="text-[#4A5E57] text-[16px] sm:text-[17px] leading-[1.7] max-w-[520px]" data-reveal-item>
                        Platform terintegrasi bagi investor untuk menyalurkan modal usaha dan memfasilitasi pelaku UMKM memperoleh sewa ruko strategis secara transparan.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2" data-reveal-item>
                        <a href="{{ route('gabung.investor') }}" 
                           class="inline-flex items-center justify-center bg-[#0F5A47] hover:bg-[#0A4738] text-white font-semibold text-[15px] px-6 py-3.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            Daftar jadi Investor
                        </a>
                        <a href="{{ route('gabung.umkm') }}" 
                           class="inline-flex items-center justify-center border-2 border-[#0F5A47] text-[#0F5A47] hover:bg-[#0F5A47] hover:text-white bg-white/80 backdrop-blur-sm font-semibold text-[15px] px-6 py-3.5 rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                            Daftar jadi UMKM
                        </a>
                    </div>
                </div>

                <!-- Kolom Kanan: Karakter 3D & Floating Micro-Assets (new-design.jpg) -->
                <div class="lg:col-span-5 relative flex justify-center items-center min-h-[460px] sm:min-h-[500px]" data-reveal-item>
                    
                    <!-- Circular Halo Glow & Rings behind character -->
                    <div class="absolute w-[360px] sm:w-[420px] h-[360px] sm:h-[420px] rounded-full bg-gradient-to-tr from-[#C8E6DC]/40 via-[#F5C842]/20 to-transparent blur-xl -z-10 animate-pulse-halo"></div>
                    
                    <!-- Concentric Circles Background SVG behind Character -->
                    <svg class="absolute w-[380px] sm:w-[440px] h-[380px] sm:h-[440px] -z-10 pointer-events-none opacity-60" viewBox="0 0 400 400" fill="none">
                        <circle cx="200" cy="200" r="190" stroke="rgba(15,90,71,0.12)" stroke-width="1.5" stroke-dasharray="4 4" />
                        <circle cx="200" cy="200" r="160" stroke="rgba(15,90,71,0.14)" stroke-width="1" />
                        <circle cx="200" cy="200" r="130" stroke="rgba(245,200,66,0.25)" stroke-width="1.5" />
                    </svg>

                    <!-- Karakter 3D Utama Pria Berkaos Hijau -->
                    <img src="{{ asset('images/hero-character.png') }}" 
                         alt="Karakter Pelaku Usaha Daya UMKM" 
                         class="w-full max-w-[340px] sm:max-w-[390px] lg:max-w-[430px] h-auto object-contain select-none pointer-events-none drop-shadow-[0_16px_32px_rgba(0,0,0,0.12)] relative z-10">

                    <!-- ==============================================
                         FLOATING MICRO-ASSETS DENGAN ANIMASI
                         ============================================== -->

                    <!-- 1. Koin Emas 1 (Kiri Atas) -->
                    <div class="absolute top-[8%] -left-[4%] sm:-left-[8%] w-12 h-12 sm:w-14 sm:h-14 z-20 animate-float" title="Investasi Emas UMKM">
                        <svg viewBox="0 0 100 100" class="w-full h-full drop-shadow-md select-none pointer-events-none">
                            <defs>
                                <radialGradient id="coinGrad1" cx="35%" cy="35%" r="65%">
                                    <stop offset="0%" stop-color="#FFF3B3"/>
                                    <stop offset="40%" stop-color="#F5C842"/>
                                    <stop offset="85%" stop-color="#D99B14"/>
                                    <stop offset="100%" stop-color="#B27807"/>
                                </radialGradient>
                                <linearGradient id="rimGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#FFF8D6"/>
                                    <stop offset="50%" stop-color="#E5AA1D"/>
                                    <stop offset="100%" stop-color="#8F5E03"/>
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="48" fill="url(#rimGrad1)"/>
                            <circle cx="50" cy="50" r="41" fill="url(#coinGrad1)"/>
                            <circle cx="50" cy="50" r="35" fill="none" stroke="rgba(255,255,255,0.45)" stroke-width="2"/>
                            <text x="50" y="63" font-family="'Plus Jakarta Sans', sans-serif" font-size="36" font-weight="800" text-anchor="middle" fill="#8F5E03" opacity="0.35">$</text>
                            <text x="49" y="62" font-family="'Plus Jakarta Sans', sans-serif" font-size="36" font-weight="800" text-anchor="middle" fill="#FFFFFF">$</text>
                        </svg>
                    </div>

                    <!-- 2. Koin Emas 2 (Kiri Tengah Kecil) -->
                    <div class="absolute top-[36%] -left-[10%] sm:-left-[14%] w-8 h-8 sm:w-9 sm:h-9 z-20 animate-float-delayed" title="Dividen Teratur">
                        <svg viewBox="0 0 100 100" class="w-full h-full drop-shadow-sm select-none pointer-events-none">
                            <circle cx="50" cy="50" r="48" fill="#E5AA1D"/>
                            <circle cx="50" cy="50" r="42" fill="#F5C842"/>
                            <circle cx="50" cy="50" r="36" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2"/>
                            <text x="49" y="62" font-family="'Plus Jakarta Sans', sans-serif" font-size="34" font-weight="800" text-anchor="middle" fill="#FFFFFF">$</text>
                        </svg>
                    </div>

                    <!-- 3. Koin Emas 3 (Kiri Bawah Besar) -->
                    <div class="absolute bottom-[10%] -left-[2%] sm:-left-[6%] w-14 h-14 sm:w-16 sm:h-16 z-20 animate-float-slow" title="Permodalan Berkelanjutan">
                        <svg viewBox="0 0 100 100" class="w-full h-full drop-shadow-lg select-none pointer-events-none">
                            <defs>
                                <radialGradient id="coinGrad3" cx="30%" cy="30%" r="70%">
                                    <stop offset="0%" stop-color="#FFF8D6"/>
                                    <stop offset="35%" stop-color="#F5C842"/>
                                    <stop offset="80%" stop-color="#D99B14"/>
                                    <stop offset="100%" stop-color="#9C6500"/>
                                </radialGradient>
                            </defs>
                            <circle cx="50" cy="50" r="48" fill="#B27807"/>
                            <circle cx="50" cy="50" r="42" fill="url(#coinGrad3)"/>
                            <circle cx="50" cy="50" r="36" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2.5"/>
                            <text x="50" y="64" font-family="'Plus Jakarta Sans', sans-serif" font-size="38" font-weight="800" text-anchor="middle" fill="#8F5E03" opacity="0.3">$</text>
                            <text x="49" y="63" font-family="'Plus Jakarta Sans', sans-serif" font-size="38" font-weight="800" text-anchor="middle" fill="#FFFFFF">$</text>
                        </svg>
                    </div>

                    <!-- 4. Koin Emas 4 (Kanan Tengah Kecil) -->
                    <div class="absolute top-[40%] -right-[4%] sm:-right-[8%] w-7 h-7 sm:w-8 sm:h-8 z-20 animate-float" title="Keuntungan Bersama">
                        <svg viewBox="0 0 100 100" class="w-full h-full drop-shadow-sm select-none pointer-events-none">
                            <circle cx="50" cy="50" r="48" fill="#E5AA1D"/>
                            <circle cx="50" cy="50" r="42" fill="#F5C842"/>
                            <text x="49" y="63" font-family="'Plus Jakarta Sans', sans-serif" font-size="36" font-weight="800" text-anchor="middle" fill="#FFFFFF">$</text>
                        </svg>
                    </div>

                    <!-- 5. Mini 3D Growth Chart Card (Kanan Atas) -->
                    <div class="absolute top-[6%] -right-[2%] sm:-right-[8%] w-[100px] sm:w-[115px] h-[75px] sm:h-[85px] z-20 animate-float-slow" title="Grafik Pertumbuhan Usaha">
                        <svg viewBox="0 0 140 100" class="w-full h-full drop-shadow-[0_12px_24px_rgba(0,0,0,0.12)] select-none pointer-events-none">
                            <defs>
                                <linearGradient id="chartCardBg" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#FFFFFF"/>
                                    <stop offset="100%" stop-color="#F2F9F5"/>
                                </linearGradient>
                                <linearGradient id="bar1" x1="0%" y1="100%" x2="0%" y2="0%">
                                    <stop offset="0%" stop-color="#FF9F43"/>
                                    <stop offset="100%" stop-color="#FFC048"/>
                                </linearGradient>
                                <linearGradient id="bar2" x1="0%" y1="100%" x2="0%" y2="0%">
                                    <stop offset="0%" stop-color="#20BF6B"/>
                                    <stop offset="100%" stop-color="#26DE81"/>
                                </linearGradient>
                                <linearGradient id="bar3" x1="0%" y1="100%" x2="0%" y2="0%">
                                    <stop offset="0%" stop-color="#0F5A47"/>
                                    <stop offset="100%" stop-color="#1A7A5E"/>
                                </linearGradient>
                            </defs>
                            <!-- Card Container -->
                            <rect x="4" y="4" width="132" height="92" rx="16" fill="url(#chartCardBg)" stroke="rgba(15,90,71,0.12)" stroke-width="1.5"/>
                            <!-- Bar Charts -->
                            <rect x="24" y="52" width="18" height="30" rx="4" fill="url(#bar1)"/>
                            <rect x="50" y="38" width="18" height="44" rx="4" fill="url(#bar2)"/>
                            <rect x="76" y="24" width="18" height="58" rx="4" fill="url(#bar3)"/>
                            <!-- Trend Line & Arrow -->
                            <path d="M 22 55 Q 56 32 102 18" fill="none" stroke="#FF5252" stroke-width="3.5" stroke-linecap="round"/>
                            <polygon points="106,12 112,23 100,21" fill="#FF5252"/>
                        </svg>
                    </div>

                    <!-- 6. Mini 3D Isometric Shophouse / Ruko (Kanan Bawah) -->
                    <div class="absolute bottom-[10%] -right-[4%] sm:-right-[10%] w-[110px] sm:w-[125px] h-[95px] sm:h-[105px] z-20 animate-float-delayed" title="Sewa Ruko Strategis">
                        <svg viewBox="0 0 130 110" class="w-full h-full drop-shadow-[0_16px_28px_rgba(0,0,0,0.15)] select-none pointer-events-none">
                            <defs>
                                <linearGradient id="roofGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#1A7A5E"/>
                                    <stop offset="100%" stop-color="#0F5A47"/>
                                </linearGradient>
                                <linearGradient id="wallGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#FFFFFF"/>
                                    <stop offset="100%" stop-color="#F0ECE4"/>
                                </linearGradient>
                                <linearGradient id="glassGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#DFF3EC"/>
                                    <stop offset="100%" stop-color="#A8DEC9"/>
                                </linearGradient>
                                <linearGradient id="doorGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#B87333"/>
                                    <stop offset="100%" stop-color="#804A1A"/>
                                </linearGradient>
                            </defs>
                            <!-- Building Wall -->
                            <rect x="22" y="38" width="86" height="58" rx="6" fill="url(#wallGrad)" stroke="rgba(15,90,71,0.15)" stroke-width="1.5"/>
                            <!-- Striped Canopy Roof -->
                            <path d="M 16 38 L 114 38 L 108 18 L 22 18 Z" fill="url(#roofGrad)"/>
                            <path d="M 22 18 L 38 18 L 32 38 L 16 38 Z" fill="#0A4738"/>
                            <path d="M 52 18 L 68 18 L 62 38 L 46 38 Z" fill="#0A4738"/>
                            <path d="M 82 18 L 98 18 L 92 38 L 76 38 Z" fill="#0A4738"/>
                            <!-- Canopy Trim / Scallop -->
                            <path d="M 16 38 Q 24 43 32 38 Q 40 43 48 38 Q 56 43 64 38 Q 72 43 80 38 Q 88 43 96 38 Q 105 43 114 38" fill="none" stroke="#F5C842" stroke-width="2.5"/>
                            <!-- Store Display Window -->
                            <rect x="30" y="48" width="36" height="32" rx="4" fill="url(#glassGrad)" stroke="#0F5A47" stroke-width="1.2"/>
                            <line x1="48" y1="48" x2="48" y2="80" stroke="rgba(255,255,255,0.7)" stroke-width="1.5"/>
                            <line x1="30" y1="64" x2="66" y2="64" stroke="rgba(255,255,255,0.7)" stroke-width="1.5"/>
                            <!-- Store Door -->
                            <rect x="74" y="48" width="24" height="48" rx="3" fill="url(#doorGrad)"/>
                            <circle cx="92" cy="73" r="2.2" fill="#F5C842"/>
                            <!-- Base Threshold -->
                            <rect x="18" y="96" width="94" height="6" rx="3" fill="#D3C7B5"/>
                        </svg>
                    </div>

                </div>

            </div>
        </section>

        <!-- ========================================================
             2. SECTION TENTANG KAMI (Dengan 3 Lingkaran Konsentris)
             ======================================================== -->
        <section id="tentang-kami" class="scroll-mt-[100px] py-6 sm:py-10" data-reveal>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                
                <!-- Kolom Kiri: Karakter Melambai + 3 Lingkaran Konsentris (new-design.jpg) -->
                <div class="lg:col-span-5 relative flex justify-center items-center min-h-[380px] sm:min-h-[420px]" data-reveal-item>
                    
                    <!-- Lingkaran 1 (Terluar: Garis Putus-putus Hijau, diameter ~340px) -->
                    <div class="absolute w-[320px] sm:w-[350px] h-[320px] sm:h-[350px] rounded-full border-2 border-dashed border-[#0F5A47]/20 z-0"></div>

                    <!-- Lingkaran 2 (Tengah: Soft Mint Green Fill, diameter ~270px) -->
                    <div class="absolute w-[260px] sm:w-[285px] h-[260px] sm:h-[285px] rounded-full bg-gradient-to-tr from-[#C8E6DC]/60 to-[#E8F5EF]/30 z-0"></div>

                    <!-- Lingkaran 3 (Terdalam: Soft Warm Yellow Glow, diameter ~200px) -->
                    <div class="absolute w-[190px] sm:w-[215px] h-[190px] sm:h-[215px] rounded-full bg-gradient-to-tr from-[#F5C842]/35 to-[#F5C842]/10 blur-[1px] z-0"></div>

                    <!-- Karakter 3D Melambai (Waving) -->
                    <img src="{{ asset('images/about-character.png') }}" 
                         alt="Karakter Tentang Kami Daya UMKM" 
                         class="relative z-10 w-full max-w-[310px] sm:max-w-[360px] h-auto object-contain select-none pointer-events-none drop-shadow-[0_16px_32px_rgba(0,0,0,0.1)]">
                </div>

                <!-- Kolom Kanan: Judul & Paragraf Penjelasan -->
                <div class="lg:col-span-7 space-y-5 text-left">
                    <h2 class="text-[28px] sm:text-[34px] font-bold text-[#1A1A1A] leading-tight" data-reveal-item>
                        Tentang kami
                    </h2>
                    
                    <p class="text-[#4A5E57] text-[15px] sm:text-[16px] leading-[1.75] max-w-[540px]" data-reveal-item>
                        Daya UMKM hadir untuk menjembatani kesenjangan akses permodalan bagi pemilik usaha kecil dan menengah di Indonesia. Melalui sistem verifikasi berlapis dan audit aktivitas yang terpercaya, kami memastikan setiap dana investasi tersalurkan secara optimal dan memberi manfaat timbal balik yang sehat bagi investor maupun pengusaha.
                    </p>

                    <p class="text-[#4A5E57] text-[15px] sm:text-[16px] leading-[1.75] max-w-[540px]" data-reveal-item>
                        Keamanan data dan transaksi diprioritaskan lewat mekanisme autentikasi terverifikasi dan pembagian hasil usaha yang tercatat rapi di sistem.
                    </p>
                </div>

            </div>
        </section>

        <!-- ========================================================
             3. SECTION PANDUAN DAN ALUR KERJA (3 Elevated Cards)
             ======================================================== -->
        <section id="tutorial" class="scroll-mt-[100px] space-y-8" data-reveal>
            <!-- Header Section -->
            <div class="text-left space-y-2">
                <h2 class="text-[28px] sm:text-[34px] font-bold text-[#1A1A1A] leading-tight" data-reveal-item>
                    Panduan dan alur kerja
                </h2>
                <p class="text-[#4A5E57] text-[15px] sm:text-[16px] max-w-2xl leading-[1.6]" data-reveal-item>
                    Langkah terstruktur menghubungkan pendanaan investor dan pelaku UMKM di dalam platform.
                </p>
            </div>

            <!-- Grid 3 Kartu Tahap (Elevated White Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-7">
                
                <!-- Kartu 1: Tahap 1 -->
                <div class="bg-white rounded-[20px] border border-[#0F5A47]/10 p-7 sm:p-8 shadow-[0_8px_30px_rgba(15,90,71,0.06)] hover:shadow-[0_18px_40px_rgba(15,90,71,0.12)] hover:-translate-y-1.5 transition-all duration-300 space-y-4" data-reveal-item>
                    <span class="inline-block bg-[#0F5A47] text-white text-[12px] font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                        Tahap 1
                    </span>
                    <h3 class="font-bold text-[18px] sm:text-[19px] text-[#1A1A1A]">
                        Pendaftaran akun
                    </h3>
                    <p class="text-[14px] sm:text-[15px] text-[#4A5E57] leading-[1.7]">
                        Pilih peran sebagai mitra investor atau pelaku UMKM, lalu lengkapi verifikasi email OTP resmi.
                    </p>
                </div>

                <!-- Kartu 2: Tahap 2 -->
                <div class="bg-white rounded-[20px] border border-[#0F5A47]/10 p-7 sm:p-8 shadow-[0_8px_30px_rgba(15,90,71,0.06)] hover:shadow-[0_18px_40px_rgba(15,90,71,0.12)] hover:-translate-y-1.5 transition-all duration-300 space-y-4" data-reveal-item>
                    <span class="inline-block bg-[#0F5A47] text-white text-[12px] font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                        Tahap 2
                    </span>
                    <h3 class="font-bold text-[18px] sm:text-[19px] text-[#1A1A1A]">
                        Verifikasi dan penyesuaian
                    </h3>
                    <p class="text-[14px] sm:text-[15px] text-[#4A5E57] leading-[1.7]">
                        Pelaku usaha mengajukan kebutuhan sewa atau modal, sedangkan investor meninjau katalog peluang terkurasi.
                    </p>
                </div>

                <!-- Kartu 3: Tahap 3 -->
                <div class="bg-white rounded-[20px] border border-[#0F5A47]/10 p-7 sm:p-8 shadow-[0_8px_30px_rgba(15,90,71,0.06)] hover:shadow-[0_18px_40px_rgba(15,90,71,0.12)] hover:-translate-y-1.5 transition-all duration-300 space-y-4" data-reveal-item>
                    <span class="inline-block bg-[#1A7A5E] text-white text-[12px] font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                        Tahap 3
                    </span>
                    <h3 class="font-bold text-[18px] sm:text-[19px] text-[#1A1A1A]">
                        Realisasi dan bagi hasil
                    </h3>
                    <p class="text-[14px] sm:text-[15px] text-[#4A5E57] leading-[1.7]">
                        Penyaluran modal dilakukan dengan transparansi penuh, dividen bagi hasil dicatat berkala di dashboard.
                    </p>
                </div>

            </div>
        </section>

        <!-- ========================================================
             4. SECTION PUSAT BANTUAN & KONTAK RESMI (2 Cards)
             ======================================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-8 pt-4">
            
            <!-- Kartu Kiri: Pusat Bantuan -->
            <section id="bantuan" class="bg-white rounded-[24px] border border-[#0F5A47]/10 p-8 sm:p-10 shadow-[0_8px_30px_rgba(15,90,71,0.06)] hover:shadow-[0_16px_40px_rgba(15,90,71,0.1)] transition-all duration-300 relative text-left scroll-mt-[100px]" data-reveal>
                <!-- Floating Icon Badge Top-Left -->
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1A7A5E] to-[#0F5A47] shadow-lg shadow-[#0F5A47]/25 flex items-center justify-center -mt-14 mb-5 border-2 border-white" data-reveal-item>
                    <svg class="w-7 h-7 text-[#F5C842]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 10H6v-2h12v2zm0-3H6V7h12v2z"/>
                    </svg>
                </div>

                <h2 class="text-[22px] sm:text-[24px] font-bold text-[#1A1A1A] leading-tight mb-3" data-reveal-item>
                    Pusat bantuan
                </h2>
                
                <p class="text-[#4A5E57] text-[14px] sm:text-[15px] leading-[1.7] mb-6" data-reveal-item>
                    Butuh panduan mengenai tata cara pendaftaran, syarat pengajuan sewa ruko, atau mekanisme bagi hasil? Tim dukungan kami siap melayani Anda.
                </p>

                <div data-reveal-item>
                    <a href="mailto:bantuan@daya-umkm.id" 
                       class="inline-flex items-center justify-center border-2 border-[#0F5A47] text-[#0F5A47] hover:bg-[#0F5A47] hover:text-white font-semibold text-[14px] px-6 py-2.5 rounded-xl transition-all duration-200">
                        Kirim pesan ke tim bantuan
                    </a>
                </div>
            </section>

            <!-- Kartu Kanan: Kontak Resmi -->
            <section id="kontak" class="bg-white rounded-[24px] border border-[#0F5A47]/10 p-8 sm:p-10 shadow-[0_8px_30px_rgba(15,90,71,0.06)] hover:shadow-[0_16px_40px_rgba(15,90,71,0.1)] transition-all duration-300 relative text-left scroll-mt-[100px]" data-reveal>
                <!-- Floating Icon Badge Top-Left -->
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1A7A5E] to-[#0F5A47] shadow-lg shadow-[#0F5A47]/25 flex items-center justify-center -mt-14 mb-5 border-2 border-white" data-reveal-item>
                    <svg class="w-7 h-7 text-[#F5C842]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10h5v-2h-5c-4.34 0-8-3.66-8-8s3.66-8 8-8 8 3.66 8 8v1.43c0 .79-.71 1.57-1.5 1.57s-1.5-.78-1.5-1.57V12c0-2.76-2.24-5-5-5s-5 2.24-5 5 2.24 5 5 5c1.38 0 2.64-.56 3.54-1.47.65.89 1.77 1.47 2.96 1.47 1.97 0 3.5-1.6 3.5-3.57V12c0-5.52-4.48-10-10-10zm0 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/>
                    </svg>
                </div>

                <h2 class="text-[22px] sm:text-[24px] font-bold text-[#1A1A1A] leading-tight mb-3" data-reveal-item>
                    Kontak resmi
                </h2>

                <p class="text-[#4A5E57] text-[14px] sm:text-[15px] leading-[1.7] mb-5" data-reveal-item>
                    Hubungi sekretariat operasional Daya UMKM untuk keperluan kemitraan ruko, konsultasi kelembagaan, dan verifikasi profil usaha.
                </p>

                <div class="text-[14px] text-[#4A5E57] space-y-2.5 pt-1" data-reveal-item>
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-full bg-[#C8E6DC] flex items-center justify-center text-[#0F5A47] shrink-0 text-xs font-bold">
                            ✉
                        </span>
                        <span>Email: <a href="mailto:kontak@daya-umkm.id" class="text-[#1A1A1A] font-semibold hover:text-[#0F5A47] transition">kontak@daya-umkm.id</a></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="w-6 h-6 rounded-full bg-[#C8E6DC] flex items-center justify-center text-[#0F5A47] shrink-0 text-xs font-bold">
                            🕐
                        </span>
                        <span>Jam operasional: <span class="text-[#1A1A1A] font-semibold">Senin – Jumat, 08:00 – 17.00 WIB</span></span>
                    </div>
                </div>
            </section>

        </div>

    </div>

</div>
@endsection
