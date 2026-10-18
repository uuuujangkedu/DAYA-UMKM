<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daya UMKM') - Solusi Permodalan dan Sewa Ruko</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #F8FAF7;
            --surface: #ffffff;
            --ink: #15241C;
            --ink-2: #435C4E;
            --line: rgba(26, 91, 54, 0.12);
            --green: #1A5B36;
            --green-dark: #134629;
            --green-mid: #277848;
            --green-hover: #103B23;
            --green-light: #D8EED9;
            --teal-glow: rgba(39, 120, 72, 0.12);
            --mint: #EAF5E9;
            --gold: #F4B838;
            --gold-hover: #E5A726;
            --yellow-accent: #F4B838;
            --yellow-soft: rgba(244, 184, 56, 0.18);
        }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--ink);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        :focus-visible {
            outline: 2px solid var(--green);
            outline-offset: 3px;
        }
    </style>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/motion.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bg: '#FAFBF9',
                        surface: '#ffffff',
                        ink: '#15241C',
                        'ink-2': '#3E5445',
                        line: '#C8BFB0',
                        sky: '#79BEE8',
                        'sky-light': '#A8D8F0',
                        'grass-bright': '#6FC142',
                        'grass-mid': '#4A9A2E',
                        'grass-dark': '#2D6B22',
                        'cream-light': '#F7E8C8',
                        cream: '#EDD9A3',
                        'roof-dark': '#1E4A1A',
                        pavement: '#C8BFB0',
                        green: '#2D6B22',
                        'green-dark': '#1E4A1A',
                        'green-mid': '#4A9A2E',
                        'green-hover': '#1E4A1A',
                        'green-light': '#F7E8C8',
                        mint: '#F2F8ED',
                        gold: '#EDD9A3',
                        'gold-hover': '#E2CA8F',
                        'yellow-accent': '#6FC142',
                        // Compatibility aliases
                        primary: '#2D6B22',
                        'primary-dark': '#1E4A1A',
                        secondary: '#4A9A2E',
                        'neutral-bg': '#FAFBF9',
                        accent: '#6FC142',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'IBM Plex Sans', 'Segoe UI', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        'sm-btn': '8px',
                        'md-panel': '12px',
                        'lg-card': '16px',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#FAFBF9] text-[#15241C] antialiased min-h-screen flex flex-col font-sans selection:bg-[#F7E8C8] selection:text-[#1E4A1A]">

    <!-- Header Publik (Tinggi 72px, fixed, transparan di hero, solid di konten) -->
    <header id="site-header" class="header-public fixed top-0 left-0 w-full z-50 h-[72px] sm:h-[76px] flex items-center transition-all duration-300 ease-in-out {{ (request()->is('/') || request()->is('gabung*')) ? 'header-transparent' : 'header-scrolled' }}">
        <div class="max-w-[1200px] w-full mx-auto px-5 sm:px-8 flex items-center justify-between">
            
            <!-- 1. Logo Brand TIKUM -->
            <a href="{{ url('/') }}" class="flex items-center group rounded-[8px] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#2D6B22]" aria-label="TIKUM - Titik UMKM">
                <img src="{{ asset('images/TIKUM-Logo.png') }}" alt="TIKUM - Titik UMKM" class="h-10 sm:h-11 md:h-12 w-auto object-contain drop-shadow-sm transition-transform duration-200 group-hover:scale-[1.03]">
            </a>

            <!-- 2. Menu Navigasi (Urutan: Beranda > Tentang kami > Gabung > Tutorial > Bantuan > Kontak) -->
            <nav class="hidden lg:flex items-center gap-7 text-[14px] font-medium" aria-label="Utama">
                <a href="{{ url('/') }}" id="nav-link-beranda" class="nav-item transition-all py-1 {{ request()->is('/') ? 'active text-[#2D6B22] font-semibold border-b-2 border-[#2D6B22]' : 'text-[#15241C] hover:text-[#2D6B22]' }}" {{ request()->is('/') ? 'aria-current="page"' : '' }} data-i18n="nav.beranda">Beranda</a>
                <a href="{{ url('/#tentang-kami') }}" id="nav-link-tentang-kami" class="nav-item transition-all py-1 text-[#15241C] hover:text-[#2D6B22]" data-i18n="nav.tentang">Tentang kami</a>
                
                <!-- Dropdown Gabung -->
                <div class="relative group" id="gabung-dropdown-wrapper">
                    <button type="button" 
                            id="gabung-dropdown-btn"
                            class="nav-item inline-flex items-center gap-1.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#2D6B22] cursor-pointer py-1 text-[#15241C] hover:text-[#2D6B22] {{ request()->is('gabung*') ? 'active text-[#2D6B22] font-semibold border-b-2 border-[#2D6B22]' : '' }}">
                        <span data-i18n="nav.gabung">Gabung</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180 text-[#3E5445]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <!-- Dropdown Box -->
                    <div class="absolute left-0 top-full pt-3 w-64 hidden group-hover:block hover:block z-50">
                        <div class="bg-[#ffffff] rounded-[12px] border border-[#C8BFB0]/50 p-2 text-left space-y-1 shadow-lg">
                            <a href="{{ route('gabung.investor') }}" 
                               class="block p-3 rounded-[8px] hover:bg-[#F7E8C8]/40 transition group/item">
                                <span class="font-semibold text-[14px] text-[#2D6B22] block" data-i18n="nav.gabung_investor_title">
                                    Daftar mitra investor
                                </span>
                                <span class="text-[12.5px] text-[#3E5445] block mt-0.5" data-i18n="nav.gabung_investor_sub">
                                    Mulai danai dan kembangkan usaha
                                </span>
                            </a>

                            <div class="h-px bg-[#C8BFB0]/40 my-1"></div>

                            <a href="{{ route('gabung.umkm') }}" 
                               class="block p-3 rounded-[8px] hover:bg-[#F7E8C8]/40 transition group/item">
                                <span class="font-semibold text-[14px] text-[#2D6B22] block" data-i18n="nav.gabung_umkm_title">
                                    Daftar pelaku UMKM
                                </span>
                                <span class="text-[12.5px] text-[#3E5445] block mt-0.5" data-i18n="nav.gabung_umkm_sub">
                                    Dapatkan akses modal dan sewa ruko
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/#tutorial') }}" id="nav-link-tutorial" class="nav-item transition-all py-1 text-[#15241C] hover:text-[#2D6B22]" data-i18n="nav.tutorial">Tutorial</a>
                <a href="{{ url('/#bantuan') }}" id="nav-link-bantuan" class="nav-item transition-all py-1 text-[#15241C] hover:text-[#2D6B22]" data-i18n="nav.bantuan">Bantuan</a>
                <a href="{{ url('/#kontak') }}" id="nav-link-kontak" class="nav-item transition-all py-1 text-[#15241C] hover:text-[#2D6B22]" data-i18n="nav.kontak">Kontak</a>
            </nav>

            <!-- 3. Button Translate IDN / ENG & 4. Tombol Masuk (Kuning Asli #F4B838) -->
            <div class="flex items-center gap-4">
                <div class="hidden sm:inline-flex lang-switch-container" aria-label="Pilihan bahasa" id="lang-switch-box">
                    <button type="button" class="lang-btn active" data-lang="id" title="Bahasa Indonesia">
                        IDN
                    </button>
                    <button type="button" class="lang-btn" data-lang="en" title="English">
                        ENG
                    </button>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center bg-[#F4B838] hover:bg-[#E5A726] text-[#15241C] font-semibold text-[14px] px-5 py-2 rounded-lg shadow-sm hover:shadow transition-all duration-150" data-i18n="nav.dashboard">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-[#F4B838] hover:bg-[#E5A726] text-[#15241C] font-semibold text-[14px] px-5 py-2 rounded-lg shadow-sm hover:shadow transition-all duration-150" data-i18n="nav.masuk">
                        Masuk
                    </a>
                @endauth

                <!-- Tombol Menu Mobile -->
                <button type="button" 
                        id="mobile-menu-btn" 
                        class="lg:hidden p-2 rounded-[8px] text-[#15241C] hover:bg-[#4A9A2E]/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#2D6B22]"
                        aria-label="Menu navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Panel Menu Mobile -->
        <div id="mobile-menu" class="hidden lg:hidden absolute top-[80px] left-0 w-full bg-[#ffffff] border-b border-[#C8BFB0]/50 px-5 py-4 space-y-3 text-[15px] font-medium text-[#15241C] shadow-sm">
            <a href="{{ url('/') }}" class="block py-1.5 hover:text-[#2D6B22]" data-i18n="nav.beranda">Beranda</a>
            <a href="{{ url('/#tentang-kami') }}" class="block py-1.5 hover:text-[#2D6B22]" data-i18n="nav.tentang">Tentang kami</a>
            
            <div class="pt-2 pb-2 border-t border-[#C8BFB0]/40">
                <span class="text-[13px] font-semibold text-[#3E5445] block mb-1" data-i18n="nav.gabung_label">Gabung:</span>
                <div class="pl-2 space-y-1">
                    <a href="{{ route('gabung.investor') }}" class="block py-1 hover:text-[#2D6B22]" data-i18n="nav.gabung_investor_title">Daftar mitra investor</a>
                    <a href="{{ route('gabung.umkm') }}" class="block py-1 hover:text-[#2D6B22]" data-i18n="nav.gabung_umkm_title">Daftar pelaku UMKM</a>
                </div>
            </div>

            <a href="{{ url('/#tutorial') }}" class="block py-1.5 hover:text-[#2D6B22]" data-i18n="nav.tutorial">Tutorial</a>
            <a href="{{ url('/#bantuan') }}" class="block py-1.5 hover:text-[#2D6B22]" data-i18n="nav.bantuan">Bantuan</a>
            <a href="{{ url('/#kontak') }}" class="block py-1.5 hover:text-[#2D6B22]" data-i18n="nav.kontak">Kontak</a>

            <div class="pt-3 border-t border-[#C8BFB0]/40 flex items-center justify-between text-[14px]">
                <span class="text-[#3E5445]" data-i18n="nav.bahasa_label">Bahasa:</span>
                <div class="inline-flex lang-switch-container">
                    <button type="button" class="lang-btn active" data-lang="id" title="Bahasa Indonesia">IDN</button>
                    <button type="button" class="lang-btn" data-lang="en" title="English">ENG</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama Halaman (Tengah secara horizontal) -->
    <main class="flex-grow w-full flex flex-col items-center {{ (request()->is('/') || request()->is('gabung*')) ? '' : 'pt-[72px] sm:pt-[76px]' }}">
        @yield('content')
    </main>

    <!-- Footer Publik: Hijau genteng/pohon gelap (#1E4A1A) Sesuai Settingan -->
    <footer class="bg-[#1E4A1A] {{ (request()->is('/') || request()->is('gabung*')) ? 'border-t-0' : 'border-t border-[#2D6B22]' }} text-[#EDD9A3] text-[13px] py-8 sm:py-9 mt-0 w-full">
        <div class="max-w-[1200px] mx-auto px-5 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3 text-[#F7E8C8]">
                <a href="{{ url('/') }}" class="bg-white/95 px-2.5 py-1 rounded-lg inline-flex items-center hover:bg-white transition shadow-sm" aria-label="TIKUM Beranda">
                    <img src="{{ asset('images/TIKUM-Logo.png') }}" alt="TIKUM - Titik UMKM" class="h-6 w-auto object-contain">
                </a>
                <span class="text-[#EDD9A3]/80" data-i18n="footer.copyright">&copy; {{ date('Y') }}. Hak cipta dilindungi.</span>
            </div>
            <div class="flex flex-wrap items-center gap-6 text-[#EDD9A3]">
                <a href="#" class="hover:text-white transition-colors" data-i18n="footer.privacy">Kebijakan privasi</a>
                <a href="#" class="hover:text-white transition-colors" data-i18n="footer.terms">Syarat dan ketentuan</a>
                <a href="{{ url('/#bantuan') }}" class="hover:text-white transition-colors" data-i18n="footer.help">Hubungi bantuan</a>
            </div>
        </div>
    </footer>

    <script>
        (function() {
            const header = document.getElementById('site-header');
            
            // 1. Scroll header state (transparan di posisi teratas, frosted glass saat scroll)
            const onHeaderScroll = () => {
                if (!header) return;
                const isScrolled = window.scrollY > 15;
                if (isScrolled) {
                    header.classList.remove('header-transparent');
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.add('header-transparent');
                    header.classList.remove('header-scrolled');
                }
            };
            window.addEventListener('scroll', onHeaderScroll, { passive: true });
            onHeaderScroll();

            // 2. Active nav link helper
            const navLinks = {
                '#beranda': document.getElementById('nav-link-beranda'),
                '#tentang-kami': document.getElementById('nav-link-tentang-kami'),
                '#tutorial': document.getElementById('nav-link-tutorial'),
                '#bantuan': document.getElementById('nav-link-bantuan'),
                '#kontak': document.getElementById('nav-link-kontak')
            };

            function setActiveNav(targetHash) {
                // Jangan override jika kita di halaman selain landing page
                const isLanding = window.location.pathname === '/' || window.location.pathname === '';
                if (!isLanding) return;

                Object.entries(navLinks).forEach(([hash, link]) => {
                    if (!link) return;
                    if (hash === targetHash) {
                        link.classList.add('active', 'font-semibold');
                        link.setAttribute('aria-current', 'page');
                    } else {
                        link.classList.remove('active', 'font-semibold');
                        link.removeAttribute('aria-current');
                    }
                });
            }

            // 3. ScrollSpy untuk mendeteksi posisi seksi yang sedang dilihat
            function updateScrollSpy() {
                const isLanding = window.location.pathname === '/' || window.location.pathname === '';
                if (!isLanding) return;

                // Threshold batas aktif: tinggi header (76px) + offset visual
                const threshold = 140;

                // Jika scroll sudah di ujung paling bawah halaman, aktifkan #kontak
                if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 60)) {
                    setActiveNav('#kontak');
                    return;
                }

                // Jika berada di area atas halaman / hero visual showcase, selalu aktifkan #beranda
                const berandaSec = document.getElementById('beranda');
                if (window.scrollY < 100 || (berandaSec && berandaSec.getBoundingClientRect().bottom > threshold)) {
                    setActiveNav('#beranda');
                    return;
                }

                // Jika scroll sudah di ujung paling bawah halaman, aktifkan #kontak
                if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 60)) {
                    setActiveNav('#kontak');
                    return;
                }

                const sections = [
                    { id: '#kontak', el: document.querySelector('#kontak') },
                    { id: '#bantuan', el: document.querySelector('#bantuan') },
                    { id: '#tutorial', el: document.querySelector('#tutorial') },
                    { id: '#tentang-kami', el: document.querySelector('#tentang-kami') },
                    { id: '#beranda', el: document.querySelector('#beranda') }
                ];

                let current = '#beranda';
                for (const item of sections) {
                    if (item.el) {
                        const rect = item.el.getBoundingClientRect();
                        if (rect.top <= threshold && rect.bottom > 40) {
                            current = item.id;
                            break;
                        }
                    }
                }

                setActiveNav(current);
            }
            window.updateScrollSpy = updateScrollSpy;

            window.addEventListener('scroll', updateScrollSpy, { passive: true });
            // Initial call
            setTimeout(updateScrollSpy, 100);

            // 4. Smooth scroll dengan offset tepat (96px) saat link anchor diklik
            document.querySelectorAll('a[href*="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (window.lenis) return; // Lenis in motion.js handles smooth scrolling

                    const href = this.getAttribute('href');
                    if (!href) return;
                    const hashIndex = href.indexOf('#');
                    if (hashIndex === -1) return;

                    const hash = href.substring(hashIndex);
                    const targetEl = document.querySelector(hash);

                    const isCurrentPageLanding = window.location.pathname === '/' || window.location.pathname === '';
                    if (isCurrentPageLanding && targetEl) {
                        e.preventDefault();
                        const headerOffset = 96;
                        const elementPosition = targetEl.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        setActiveNav(hash);
                        history.pushState(null, null, hash);

                        // Tutup menu mobile jika terbuka
                        const mobileMenu = document.getElementById('mobile-menu');
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                });
            });

            // Handle klik Beranda link saat di landing page
            const berandaLink = document.getElementById('nav-link-beranda');
            if (berandaLink) {
                berandaLink.addEventListener('click', function(e) {
                    if (window.lenis) return; // Lenis in motion.js handles it
                    if (window.location.pathname === '/' || window.location.pathname === '') {
                        e.preventDefault();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        setActiveNav('#beranda');
                        history.pushState(null, null, ' ');
                    }
                });
            }

            // 5. Multi-Language (i18n) Engine & Language Switcher
            const i18nDict = {
                id: {
                    'brand.subtitle': 'Produksi & sewa ruko',
                    'nav.beranda': 'Beranda',
                    'nav.tentang': 'Tentang kami',
                    'nav.gabung': 'Gabung',
                    'nav.gabung_label': 'Gabung:',
                    'nav.gabung_investor_title': 'Daftar mitra investor',
                    'nav.gabung_investor_sub': 'Mulai danai dan kembangkan usaha',
                    'nav.gabung_umkm_title': 'Daftar pelaku UMKM',
                    'nav.gabung_umkm_sub': 'Dapatkan akses modal dan sewa ruko',
                    'nav.tutorial': 'Tutorial',
                    'nav.bantuan': 'Bantuan',
                    'nav.kontak': 'Kontak',
                    'nav.masuk': 'Masuk',
                    'nav.dashboard': 'Dashboard',
                    'nav.bahasa_label': 'Bahasa:',
                    'footer.copyright': '© {{ date("Y") }}. Hak cipta dilindungi.',
                    'footer.privacy': 'Kebijakan privasi',
                    'footer.terms': 'Syarat dan ketentuan',
                    'footer.help': 'Hubungi bantuan',
                    'hero.title': 'Wadah permodalan produktif dan sewa ruko bagi pelaku usaha',
                    'hero.desc': 'Platform terintegrasi bagi investor untuk menyalurkan modal usaha dan memfasilitasi pelaku UMKM memperoleh sewa ruko strategis secara transparan.',
                    'hero.btn_investor': 'Daftar jadi Investor',
                    'hero.btn_umkm': 'Daftar jadi UMKM',
                    'about.title': 'Tentang kami',
                    'about.p1': 'Daya UMKM hadir untuk menjembatani kesenjangan akses permodalan bagi pemilik usaha kecil dan menengah di Indonesia. Melalui sistem verifikasi berlapis dan audit aktivitas yang terpercaya, kami memastikan setiap dana investasi tersalurkan secara optimal dan memberi manfaat timbal balik yang sehat bagi investor maupun pengusaha.',
                    'about.p2': 'Keamanan data dan transaksi diprioritaskan lewat mekanisme autentikasi terverifikasi dan pembagian hasil usaha yang tercatat rapi di sistem.',
                    'about.btn_tutorial': 'Pelajari Alur Kerja',
                    'about.btn_help': 'Pusat Bantuan',
                    'tutorial.title': 'Panduan dan alur kerja',
                    'tutorial.subtitle': 'Langkah terstruktur menghubungkan pendanaan investor dan pelaku UMKM di dalam platform.',
                    'tutorial.step1_badge': 'Tahap 1',
                    'tutorial.step1_title': 'Pendaftaran akun',
                    'tutorial.step1_desc': 'Pilih peran sebagai mitra investor atau pelaku UMKM, lalu lengkapi verifikasi email OTP resmi.',
                    'tutorial.step2_badge': 'Tahap 2',
                    'tutorial.step2_title': 'Verifikasi dan penyesuaian',
                    'tutorial.step2_desc': 'Pelaku usaha mengajukan kebutuhan sewa atau modal, sedangkan investor meninjau katalog peluang terkurasi.',
                    'tutorial.step3_badge': 'Tahap 3',
                    'tutorial.step3_title': 'Realisasi dan bagi hasil',
                    'tutorial.step3_desc': 'Penyaluran modal dilakukan dengan transparansi penuh, dividen bagi hasil dicatat berkala di dashboard.',
                    'help.title': 'Pusat bantuan',
                    'help.desc': 'Butuh panduan mengenai tata cara pendaftaran, syarat pengajuan sewa ruko, atau mekanisme bagi hasil? Tim dukungan kami siap melayani Anda.',
                    'help.btn': 'Kirim pesan ke tim bantuan',
                    'contact.title': 'Kontak resmi',
                    'contact.desc': 'Hubungi sekretariat operasional Daya UMKM untuk keperluan kemitraan ruko, konsultasi kelembagaan, dan verifikasi profil usaha.',
                    'contact.hours_label': 'Jam operasional:',
                    'contact.hours_val': 'Senin – Jumat, 08:00 – 17.00 WIB'
                },
                en: {
                    'brand.subtitle': 'Production & shop rental',
                    'nav.beranda': 'Home',
                    'nav.tentang': 'About us',
                    'nav.gabung': 'Join',
                    'nav.gabung_label': 'Join:',
                    'nav.gabung_investor_title': 'Register as Investor Partner',
                    'nav.gabung_investor_sub': 'Fund and scale promising businesses',
                    'nav.gabung_umkm_title': 'Register as MSME Entrepreneur',
                    'nav.gabung_umkm_sub': 'Access productive capital and rentals',
                    'nav.tutorial': 'How It Works',
                    'nav.bantuan': 'Support',
                    'nav.kontak': 'Contact',
                    'nav.masuk': 'Sign In',
                    'nav.dashboard': 'Dashboard',
                    'nav.bahasa_label': 'Language:',
                    'footer.copyright': '© {{ date("Y") }}. All rights reserved.',
                    'footer.privacy': 'Privacy Policy',
                    'footer.terms': 'Terms & Conditions',
                    'footer.help': 'Contact Support',
                    'hero.title': 'Productive capital platform and strategic shop rental for businesses',
                    'hero.desc': 'An integrated platform for investors to channel business funding and facilitate MSMEs in securing strategic shop rentals transparently.',
                    'hero.btn_investor': 'Join as Investor',
                    'hero.btn_umkm': 'Join as MSME',
                    'about.title': 'About Us',
                    'about.p1': 'Daya UMKM bridges the capital access gap for small and medium-sized business owners across Indonesia. Through multi-layered verification and trusted activity audits, we ensure every investment fund is channeled optimally, providing healthy mutual benefits for both investors and entrepreneurs.',
                    'about.p2': 'Data and transaction security is prioritized through verified authentication mechanisms and transparent profit-sharing recorded neatly in the system.',
                    'about.btn_tutorial': 'How It Works',
                    'about.btn_help': 'Support Center',
                    'tutorial.title': 'Workflow & Step-by-Step Guide',
                    'tutorial.subtitle': 'A structured journey connecting investor funding with MSME entrepreneurs on the platform.',
                    'tutorial.step1_badge': 'Step 1',
                    'tutorial.step1_title': 'Account Registration',
                    'tutorial.step1_desc': 'Select your role as an investor partner or MSME entrepreneur, then complete official OTP email verification.',
                    'tutorial.step2_badge': 'Step 2',
                    'tutorial.step2_title': 'Verification & Matching',
                    'tutorial.step2_desc': 'Entrepreneurs submit rental or funding requirements, while investors browse the curated catalog of opportunities.',
                    'tutorial.step3_badge': 'Step 3',
                    'tutorial.step3_title': 'Execution & Profit Sharing',
                    'tutorial.step3_desc': 'Capital distribution is carried out with full transparency, and dividend sharing is recorded periodically on the dashboard.',
                    'help.title': 'Help Center',
                    'help.desc': 'Need guidance on registration procedures, shop rental requirements, or profit-sharing mechanisms? Our dedicated support team is ready to assist you.',
                    'help.btn': 'Send message to support team',
                    'contact.title': 'Official Contact',
                    'contact.desc': 'Contact the Daya UMKM operational secretariat for shophouse partnerships, institutional consultations, and business profile verifications.',
                    'contact.hours_label': 'Business hours:',
                    'contact.hours_val': 'Monday – Friday, 08:00 – 17:00 WIB'
                }
            };

            const langButtons = document.querySelectorAll('.lang-btn');
            const savedLang = localStorage.getItem('daya_umkm_lang') || 'id';

            function applyLanguage(lang) {
                const currentDict = i18nDict[lang] || i18nDict['id'];
                document.documentElement.lang = lang;

                // Update text content of all elements with data-i18n
                document.querySelectorAll('[data-i18n]').forEach(el => {
                    const key = el.getAttribute('data-i18n');
                    if (currentDict[key]) {
                        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                            el.placeholder = currentDict[key];
                        } else {
                            el.textContent = currentDict[key];
                        }
                    }
                });

                // Update active state of language buttons
                langButtons.forEach(btn => {
                    const btnLang = btn.getAttribute('data-lang');
                    if (btnLang === lang) {
                        btn.classList.add('active');
                        btn.setAttribute('aria-pressed', 'true');
                    } else {
                        btn.classList.remove('active');
                        btn.setAttribute('aria-pressed', 'false');
                    }
                });
            }

            // Expose globally for instant interaction
            window.applyLanguage = applyLanguage;
            applyLanguage(savedLang);

            langButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lang = this.getAttribute('data-lang');
                    localStorage.setItem('daya_umkm_lang', lang);
                    applyLanguage(lang);
                });
            });

            // 6. Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        })();

        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>

    <!-- Komponen Aksesibilitas Disabilitas -->
    @include('components.accessibility-widget')
</body>
</html>
