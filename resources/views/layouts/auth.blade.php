<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DAYA UMKM') - Platform Investasi UMKM & Sewa Ruko</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #075B50;
            --primary-dark: #05453D;
            --secondary: #26734D;
            --tertiary: #245DA8;
            --neutral-bg: #F8F7F2;
            --accent: #F5B800;
            --accent-hover: #E2A700;
        }
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: var(--neutral-bg);
            color: #1B1B18;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
                        primary: '#075B50',
                        'primary-dark': '#05453D',
                        secondary: '#26734D',
                        tertiary: '#245DA8',
                        'neutral-bg': '#F8F7F2',
                        accent: '#F5B800',
                        'accent-hover': '#E2A700',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F8F7F2] text-[#1B1B18] antialiased min-h-screen flex flex-col">

    <!-- Top Navigation Bar sesuai tema mockup -->
    <header class="bg-[#075B50] text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand & Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl bg-[#61BA98] flex items-center justify-center shadow-inner group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6 text-[#075B50]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-lg tracking-wide uppercase text-white leading-tight">DAYA UMKM</span>
                            <span class="text-[10px] text-emerald-200 tracking-wider">INVESTASI & SEWA RUKO</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-7 text-xs font-semibold tracking-wider">
                    <a href="{{ url('/') }}" class="text-white hover:text-emerald-200 uppercase transition-colors {{ request()->is('/') ? 'underline decoration-2 underline-offset-8 font-bold' : '' }}">BERANDA</a>
                    <a href="{{ url('/#tentang-kami') }}" class="text-emerald-100 hover:text-white uppercase transition-colors">TENTANG KAMI</a>
                    
                    <!-- DROPDOWN GABUNG (Sesuai Referensi PaDi UMKM) -->
                    <div class="relative group" id="gabung-dropdown-wrapper">
                        <button type="button" 
                                id="gabung-dropdown-btn"
                                class="inline-flex items-center gap-1.5 text-emerald-100 hover:text-white uppercase transition-colors py-2 focus:outline-none cursor-pointer {{ request()->is('gabung*') ? 'underline decoration-2 underline-offset-8 font-bold text-white' : '' }}">
                            <span>GABUNG</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu Box -->
                        <div class="absolute left-0 top-full pt-2 w-72 hidden group-hover:block hover:block z-50 transition-all duration-200 ease-out">
                            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-2 text-left space-y-1">
                                <!-- Investor Option -->
                                <a href="{{ route('gabung.investor') }}" 
                                   class="flex items-center gap-3 p-3 rounded-xl hover:bg-emerald-50 transition group/item">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-[#075B50] flex items-center justify-center font-bold text-base flex-shrink-0 group-hover/item:bg-[#075B50] group-hover/item:text-white transition shadow-sm">
                                        💼
                                    </div>
                                    <div>
                                        <span class="font-extrabold text-xs text-[#1B1B18] group-hover/item:text-[#075B50] block">
                                            Daftar Mitra Investor
                                        </span>
                                        <span class="text-[11px] text-[#706F6C]">
                                            Mulai danai dan kembangkan UMKM
                                        </span>
                                    </div>
                                </a>

                                <div class="h-px bg-gray-100 mx-2"></div>

                                <!-- UMKM Option -->
                                <a href="{{ route('gabung.umkm') }}" 
                                   class="flex items-center gap-3 p-3 rounded-xl hover:bg-teal-50 transition group/item">
                                    <div class="w-10 h-10 rounded-xl bg-teal-100 text-[#075B50] flex items-center justify-center font-bold text-base flex-shrink-0 group-hover/item:bg-[#075B50] group-hover/item:text-white transition shadow-sm">
                                        🏪
                                    </div>
                                    <div>
                                        <span class="font-extrabold text-xs text-[#1B1B18] group-hover/item:text-[#075B50] block">
                                            Daftar Pelaku UMKM
                                        </span>
                                        <span class="text-[11px] text-[#706F6C]">
                                            Dapatkan akses modal & sewa ruko
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/#bantuan') }}" class="text-emerald-100 hover:text-white uppercase transition-colors">BANTUAN</a>
                    <a href="{{ url('/#kontak') }}" class="text-emerald-100 hover:text-white uppercase transition-colors">KONTAK</a>
                    <a href="{{ url('/#tutorial') }}" class="text-emerald-100 hover:text-white uppercase transition-colors">TUTORIAL</a>
                </nav>

                <!-- Language Switcher & Login CTA & Mobile Hamburger -->
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center bg-[#05453D] text-[11px] font-bold rounded-lg px-2.5 py-1 text-emerald-200 border border-emerald-800/40">
                        <span class="text-white">IDN</span>
                        <span class="mx-1 text-emerald-500">|</span>
                        <span class="text-emerald-400 opacity-75">ENG</span>
                    </div>

                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-[#F5B800] hover:bg-[#E2A700] text-[#075B50] font-extrabold text-xs uppercase px-4 py-2.5 rounded-lg shadow transition duration-150 flex items-center gap-2">
                            <span>DASHBOARD</span>
                        </a>
                    @else
                        @if (request()->routeIs('login'))
                            <a href="{{ route('register') }}" class="bg-[#26734D] hover:bg-[#1E5C3D] text-white font-extrabold text-xs uppercase px-4 py-2.5 rounded-lg shadow transition duration-150 border border-emerald-400/30">
                                DAFTAR
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-[#F5B800] hover:bg-[#E2A700] text-[#1B1B18] font-extrabold text-xs uppercase px-4 py-2.5 rounded-lg shadow transition duration-150">
                                LOGIN
                            </a>
                        @endif
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button type="button" 
                            id="mobile-menu-btn" 
                            class="md:hidden p-2 rounded-lg text-emerald-200 hover:text-white hover:bg-[#05453D] focus:outline-none transition"
                            aria-label="Toggle Navigation">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#05453D] border-t border-emerald-800/60 px-4 pt-3 pb-5 space-y-2 text-xs font-semibold">
            <a href="{{ url('/') }}" class="block py-2 text-white hover:text-emerald-200">BERANDA</a>
            <a href="{{ url('/#tentang-kami') }}" class="block py-2 text-emerald-100 hover:text-white">TENTANG KAMI</a>
            
            <div class="pt-2 pb-1 border-t border-emerald-700/40">
                <span class="text-[10px] uppercase font-bold text-emerald-300 tracking-wider">Pendaftaran Akun:</span>
                <div class="mt-1.5 pl-2 space-y-1">
                    <a href="{{ route('gabung.investor') }}" class="flex items-center gap-2.5 py-1.5 text-white hover:text-emerald-200">
                        <span class="text-xs">💼</span>
                        <span class="font-bold">Daftar Mitra Investor</span>
                    </a>
                    <a href="{{ route('gabung.umkm') }}" class="flex items-center gap-2.5 py-1.5 text-white hover:text-emerald-200">
                        <span class="text-xs">🏪</span>
                        <span class="font-bold">Daftar Pelaku UMKM</span>
                    </a>
                </div>
            </div>

            <a href="{{ url('/#bantuan') }}" class="block py-2 text-emerald-100 hover:text-white">BANTUAN</a>
            <a href="{{ url('/#kontak') }}" class="block py-2 text-emerald-100 hover:text-white">KONTAK</a>
            <a href="{{ url('/#tutorial') }}" class="block py-2 text-emerald-100 hover:text-white">TUTORIAL</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-[#E5E3DC] text-[#706F6C] text-xs py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-bold text-[#075B50]">DAYA UMKM</span>
                <span>&copy; {{ date('Y') }}. Hak Cipta Dilindungi.</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-[#075B50] transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-[#075B50] transition">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-[#075B50] transition">Hubungi Bantuan</a>
            </div>
        </div>
    </footer>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
