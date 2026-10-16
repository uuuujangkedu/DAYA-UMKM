<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daya UMKM') - Solusi Permodalan dan Sewa Ruko</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f7f6f1;
            --surface: #ffffff;
            --ink: #161d1a;
            --ink-2: #4b5551;
            --line: #e2e1d8;
            --green: #0b5a4a;
            --green-hover: #084539;
            --mint: #d8ebe5;
            --gold: #f2b705;
            --gold-hover: #dca704;
        }
        body {
            font-family: 'IBM Plex Sans', "Segoe UI", system-ui, sans-serif;
            background-color: var(--bg);
            color: var(--ink);
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        :focus-visible {
            outline: 2px solid var(--ink);
            outline-offset: 3px;
        }
    </style>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bg: '#f7f6f1',
                        surface: '#ffffff',
                        ink: '#161d1a',
                        'ink-2': '#4b5551',
                        line: '#e2e1d8',
                        green: '#0b5a4a',
                        'green-hover': '#084539',
                        mint: '#d8ebe5',
                        gold: '#f2b705',
                        'gold-hover': '#dca704',
                        // Compatibility aliases
                        primary: '#0b5a4a',
                        'primary-dark': '#084539',
                        secondary: '#0b5a4a',
                        'neutral-bg': '#f7f6f1',
                        accent: '#f2b705',
                    },
                    fontFamily: {
                        sans: ['IBM Plex Sans', 'Segoe UI', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        'sm-btn': '6px',
                        'md-panel': '10px',
                        'lg-card': '12px',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f7f6f1] text-[#161d1a] antialiased min-h-screen flex flex-col font-sans">

    <!-- Header Publik Sesuai DESIGN.md (Tinggi 80px, sticky, scroll transition) -->
    <header id="site-header" class="header-public sticky top-0 z-50 h-[80px] flex items-center transition-all duration-250 ease-in-out">
        <div class="max-w-[1200px] w-full mx-auto px-5 sm:px-8 flex items-center justify-between">
            
            <!-- 1. Logo + Nama Brand + Subjudul -->
            <a href="{{ url('/') }}" class="flex items-center gap-3.5 group rounded-[6px] focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#161d1a]">
                <div class="w-10 h-10 rounded-[6px] bg-[#d8ebe5] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-[#0b5a4a]" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <div class="flex flex-col text-left">
                    <span class="brand-text font-bold text-[18px] leading-tight">Daya UMKM</span>
                    <span class="brand-text text-[13px] opacity-90 leading-tight">Investasi & sewa ruko</span>
                </div>
            </a>

            <!-- 2. Menu Navigasi (Urutan: Beranda > Tentang kami > Gabung > Tutorial > Bantuan > Kontak) -->
            <nav class="hidden lg:flex items-center gap-7 text-[15px] font-medium" aria-label="Utama">
                <a href="{{ url('/') }}" id="nav-link-beranda" class="nav-item transition-colors {{ request()->is('/') ? 'active font-semibold' : '' }}" {{ request()->is('/') ? 'aria-current="page"' : '' }}>Beranda</a>
                <a href="{{ url('/#tentang-kami') }}" id="nav-link-tentang-kami" class="nav-item transition-colors">Tentang kami</a>
                
                <!-- Dropdown Gabung -->
                <div class="relative group" id="gabung-dropdown-wrapper">
                    <button type="button" 
                            id="gabung-dropdown-btn"
                            class="nav-item inline-flex items-center gap-1.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#161d1a] cursor-pointer {{ request()->is('gabung*') ? 'active font-semibold' : '' }}">
                        <span>Gabung</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <!-- Dropdown Box -->
                    <div class="absolute left-0 top-full pt-3 w-64 hidden group-hover:block hover:block z-50">
                        <div class="bg-[#ffffff] rounded-[10px] border border-[#e2e1d8] p-2 text-left space-y-1 shadow-sm">
                            <a href="{{ route('gabung.investor') }}" 
                               class="block p-3 rounded-[6px] hover:bg-[#d8ebe5] transition group/item">
                                <span class="font-semibold text-[14px] text-[#161d1a] block">
                                    Daftar mitra investor
                                </span>
                                <span class="text-[13px] text-[#4b5551] block mt-0.5">
                                    Mulai danai dan kembangkan usaha
                                </span>
                            </a>

                            <div class="h-px bg-[#e2e1d8] my-1"></div>

                            <a href="{{ route('gabung.umkm') }}" 
                               class="block p-3 rounded-[6px] hover:bg-[#d8ebe5] transition group/item">
                                <span class="font-semibold text-[14px] text-[#161d1a] block">
                                    Daftar pelaku UMKM
                                </span>
                                <span class="text-[13px] text-[#4b5551] block mt-0.5">
                                    Dapatkan akses modal dan sewa ruko
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/#tutorial') }}" id="nav-link-tutorial" class="nav-item transition-colors">Tutorial</a>
                <a href="{{ url('/#bantuan') }}" id="nav-link-bantuan" class="nav-item transition-colors">Bantuan</a>
                <a href="{{ url('/#kontak') }}" id="nav-link-kontak" class="nav-item transition-colors">Kontak</a>
            </nav>

            <!-- 3. Button Translate IDN / ENG & 4. Tombol Masuk -->
            <div class="flex items-center gap-5">
                <div class="hidden sm:inline-flex lang-switch-container" aria-label="Pilihan bahasa" id="lang-switch-box">
                    <button type="button" class="lang-btn active" data-lang="id" title="Bahasa Indonesia">
                        IDN
                    </button>
                    <button type="button" class="lang-btn" data-lang="en" title="English">
                        ENG
                    </button>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-header-masuk">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-header-masuk">
                        Masuk
                    </a>
                @endauth

                <!-- Tombol Menu Mobile -->
                <button type="button" 
                        id="mobile-menu-btn" 
                        class="lg:hidden p-2 rounded-[6px] text-current focus-visible:outline focus-visible:outline-2 focus-visible:outline-[#161d1a]"
                        aria-label="Menu navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Panel Menu Mobile -->
        <div id="mobile-menu" class="hidden lg:hidden absolute top-[80px] left-0 w-full bg-[#ffffff] border-b border-[#e2e1d8] px-5 py-4 space-y-3 text-[15px] font-medium text-[#161d1a] shadow-sm">
            <a href="{{ url('/') }}" class="block py-1.5 hover:text-[#0b5a4a]">Beranda</a>
            <a href="{{ url('/#tentang-kami') }}" class="block py-1.5 hover:text-[#0b5a4a]">Tentang kami</a>
            
            <div class="pt-2 pb-2 border-t border-[#e2e1d8]">
                <span class="text-[13px] font-semibold text-[#4b5551] block mb-1">Gabung:</span>
                <div class="pl-2 space-y-1">
                    <a href="{{ route('gabung.investor') }}" class="block py-1 hover:text-[#0b5a4a]">Daftar mitra investor</a>
                    <a href="{{ route('gabung.umkm') }}" class="block py-1 hover:text-[#0b5a4a]">Daftar pelaku UMKM</a>
                </div>
            </div>

            <a href="{{ url('/#tutorial') }}" class="block py-1.5 hover:text-[#0b5a4a]">Tutorial</a>
            <a href="{{ url('/#bantuan') }}" class="block py-1.5 hover:text-[#0b5a4a]">Bantuan</a>
            <a href="{{ url('/#kontak') }}" class="block py-1.5 hover:text-[#0b5a4a]">Kontak</a>

            <div class="pt-3 border-t border-[#e2e1d8] flex items-center justify-between text-[14px]">
                <span class="text-[#4b5551]">Bahasa:</span>
                <div class="inline-flex lang-switch-container">
                    <button type="button" class="lang-btn active" data-lang="id">IDN</button>
                    <button type="button" class="lang-btn" data-lang="en">ENG</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama Halaman (Tengah secara horizontal) -->
    <main class="flex-grow w-full flex flex-col items-center">
        @yield('content')
    </main>

    <!-- Footer Publik Sesuai DESIGN.md -->
    <footer class="bg-[#ffffff] border-t border-[#e2e1d8] text-[#4b5551] text-[14px] py-8 mt-16">
        <div class="max-w-[1200px] mx-auto px-5 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-semibold text-[#0b5a4a]">Daya UMKM</span>
                <span>&copy; {{ date('Y') }}. Hak cipta dilindungi.</span>
            </div>
            <div class="flex flex-wrap items-center gap-6">
                <a href="#" class="hover:text-[#0b5a4a] transition">Kebijakan privasi</a>
                <a href="#" class="hover:text-[#0b5a4a] transition">Syarat dan ketentuan</a>
                <a href="{{ url('/#bantuan') }}" class="hover:text-[#0b5a4a] transition">Hubungi bantuan</a>
            </div>
        </div>
    </footer>

    <script>
        (function() {
            const header = document.getElementById('site-header');
            
            // 1. Scroll header state (scrolled class saat scrollY > 8)
            const onHeaderScroll = () => {
                if (!header) return;
                if (window.scrollY > 8) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
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

                const scrollY = window.scrollY;
                // Threshold 120px untuk memperhitungkan tinggi header (80px) + offset visual
                const checkPos = scrollY + 140;

                const sections = [
                    { id: '#kontak', el: document.querySelector('#kontak') },
                    { id: '#bantuan', el: document.querySelector('#bantuan') },
                    { id: '#tutorial', el: document.querySelector('#tutorial') },
                    { id: '#tentang-kami', el: document.querySelector('#tentang-kami') }
                ];

                let current = null;
                for (const item of sections) {
                    if (item.el && item.el.offsetTop <= checkPos) {
                        current = item.id;
                        break;
                    }
                }

                if (!current) {
                    current = '#beranda';
                }

                setActiveNav(current);
            }

            window.addEventListener('scroll', updateScrollSpy, { passive: true });
            // Initial call
            setTimeout(updateScrollSpy, 100);

            // 4. Smooth scroll dengan offset tepat (96px) saat link anchor diklik
            document.querySelectorAll('a[href*="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
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
                    if (window.location.pathname === '/' || window.location.pathname === '') {
                        e.preventDefault();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        setActiveNav('#beranda');
                        history.pushState(null, null, ' ');
                    }
                });
            }

            // 5. Language Switcher Buttons (IDN / ENG)
            const langButtons = document.querySelectorAll('.lang-btn');
            const savedLang = localStorage.getItem('daya_umkm_lang') || 'id';

            function updateLangButtons(activeLang) {
                langButtons.forEach(btn => {
                    if (btn.getAttribute('data-lang') === activeLang) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }
            updateLangButtons(savedLang);

            langButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const lang = this.getAttribute('data-lang');
                    localStorage.setItem('daya_umkm_lang', lang);
                    updateLangButtons(lang);
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
</body>
</html>
