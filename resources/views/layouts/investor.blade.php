<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Mitra Investor') - DAYA UMKM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #0F433C;
            --sidebar-active: #20675D;
            --main-bg: #F9F8F3;
            --text-dark: #1A202C;
            --card-border: #E8E6DF;
        }
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, -apple-system, sans-serif;
            background-color: var(--main-bg);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
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
                        'brand-dark': '#0F433C',
                        'brand-pill': '#20675D',
                        'brand-sage': '#6B9E8A',
                        'brand-bg': '#F9F8F3',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F9F8F3] min-h-screen text-[#1A202C] flex">

    <!-- SIDEBAR INVESTOR (Sesuai Gambar 3: Mockup Dashboard Investor) -->
    <aside id="sidebar-investor" class="fixed inset-y-0 left-0 z-40 w-72 bg-[#0F433C] text-white flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:static md:h-screen md:shrink-0 shadow-2xl md:shadow-none">
        
        <div>
            <!-- Profil Investor Top Left -->
            <div class="p-6 sm:p-7 border-b border-white/10">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-full bg-[#D1D5DB] text-[#0F433C] font-black text-lg flex items-center justify-center shrink-0 shadow-inner border-2 border-white/20">
                        @if(!empty($user->avatar))
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
                        @else
                            {{ strtoupper(substr($user->name ?? 'I', 0, 2)) }}
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <h2 class="text-sm font-extrabold tracking-wide uppercase text-white truncate leading-tight">
                            {{ $user->name ?? 'MITRA INVESTOR' }}
                        </h2>
                        <p class="text-[11px] text-teal-200/70 truncate mt-0.5 font-medium">
                            {{ $user->phone_number ?? $user->email }}
                        </p>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase bg-blue-500/20 text-blue-300 border border-blue-400/30">
                            Mitra Investor
                        </span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links Investor (Sesuai Gambar 3: BERANDA, KOMUNITAS, PROPOSAL LIST, LAPORAN KEUANGAN) -->
            <nav class="mt-8 px-4 space-y-2.5">
                <!-- 1. BERANDA -->
                <a href="{{ route('dashboard', ['tab' => 'beranda']) }}" 
                   class="group flex items-center justify-between px-4 py-3.5 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? 'beranda') === 'beranda' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? 'beranda') === 'beranda' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>BERANDA</span>
                    </div>
                </a>

                <!-- 2. KOMUNITAS -->
                <a href="{{ route('dashboard', ['tab' => 'komunitas']) }}" 
                   class="group flex items-center justify-between px-4 py-3.5 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'komunitas' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'komunitas' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>KOMUNITAS</span>
                    </div>
                </a>

                <!-- 3. PROPOSAL LIST (Fitur Inti) -->
                <a href="{{ route('dashboard', ['tab' => 'proposal']) }}" 
                   class="group flex items-center justify-between px-4 py-3.5 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'proposal' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'proposal' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>PROPOSAL LIST</span>
                    </div>
                    @if(isset($availableProposalsCount) && $availableProposalsCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-emerald-400 text-emerald-950">
                            {{ $availableProposalsCount }}
                        </span>
                    @endif
                </a>

                <!-- 4. LAPORAN KEUANGAN -->
                <a href="{{ route('dashboard', ['tab' => 'keuangan']) }}" 
                   class="group flex items-center justify-between px-4 py-3.5 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'keuangan' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'keuangan' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>LAPORAN KEUANGAN</span>
                    </div>
                </a>
            </nav>
        </div>

        <!-- Bagian Bawah: Tautan Web & Keluar -->
        <div class="p-4 border-t border-white/10 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold text-teal-200/80 hover:bg-white/10 hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>Halaman Utama</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold text-rose-300 hover:bg-rose-500/20 hover:text-rose-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span>KELUAR</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay Mobile -->
    <div id="sidebar-overlay-investor" onclick="toggleSidebarInvestor()" class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm hidden md:hidden"></div>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden">
        
        <!-- Mobile Header Top Bar -->
        <header class="md:hidden bg-[#0F433C] text-white px-4 py-3 flex items-center justify-between shadow-sm sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebarInvestor()" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="font-extrabold text-sm tracking-wider uppercase">DAYA UMKM INVESTOR</span>
            </div>
            <div class="text-xs text-teal-200">
                {{ $user->name }}
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-5 sm:p-8 md:p-10 max-w-7xl w-full mx-auto">
            
            <!-- Alert Flash Notifications -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm font-semibold flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">
                            ✓
                        </div>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-300 text-rose-900 text-xs sm:text-sm font-semibold flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-rose-500 text-white flex items-center justify-center shrink-0">
                            !
                        </div>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900">&times;</button>
                </div>
            @endif

            <!-- Konten Halaman Spesifik Investor -->
            @yield('content')

        </main>
    </div>

    <script>
        function toggleSidebarInvestor() {
            const sidebar = document.getElementById('sidebar-investor');
            const overlay = document.getElementById('sidebar-overlay-investor');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>

    <!-- Komponen Aksesibilitas Disabilitas -->
    @include('components.accessibility-widget')
</body>
</html>
