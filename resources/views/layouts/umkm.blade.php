<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Pelaku UMKM') - DAYA UMKM</title>

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

    <!-- SIDEBAR UMKM (Sesuai Gambar 2: Mockup Dashboard UMKM) -->
    <aside id="sidebar-umkm" class="fixed inset-y-0 left-0 z-40 w-72 bg-[#0F433C] text-white flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:static md:h-screen md:shrink-0 shadow-2xl md:shadow-none">
        
        <div>
            <!-- Profil UMKM Top Left (Sesuai Gambar 2) -->
            <div class="p-6 sm:p-7 border-b border-white/10">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-full bg-[#D1D5DB] text-[#0F433C] font-black text-lg flex items-center justify-center shrink-0 shadow-inner border-2 border-white/20">
                        @if(!empty($user->avatar))
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
                        @else
                            {{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <h2 class="text-sm font-extrabold tracking-wide uppercase text-white truncate leading-tight">
                            {{ $user->name ?? 'PELAKU UMKM' }}
                        </h2>
                        <p class="text-[11px] text-teal-200/70 truncate mt-0.5 font-medium">
                            {{ $user->phone_number ?? '08123456789' }}
                        </p>
                        <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase bg-teal-500/20 text-teal-300 border border-teal-400/30">
                            {{ $umkm->nama_usaha ?? 'Pelaku UMKM' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links UMKM Sesuai Mockup Gambar 2 -->
            <nav class="mt-6 px-4 space-y-2">
                <!-- 1. BERANDA -->
                <a href="{{ route('dashboard', ['tab' => 'beranda']) }}" 
                   class="group flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? 'beranda') === 'beranda' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? 'beranda') === 'beranda' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>BERANDA</span>
                    </div>
                    @if(isset($unreadInvestasiCount) && $unreadInvestasiCount > 0)
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                        </span>
                    @endif
                </a>

                <!-- 2. PRODUK -->
                <a href="{{ route('dashboard', ['tab' => 'produk']) }}" 
                   class="group flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'produk' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'produk' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>PRODUK</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/10 text-teal-200">
                        {{ $produksCount ?? 0 }}
                    </span>
                </a>

                <!-- 3. ANALISIS KEUANGAN -->
                <a href="{{ route('dashboard', ['tab' => 'keuangan']) }}" 
                   class="group flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'keuangan' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'keuangan' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>ANALISIS KEUANGAN</span>
                    </div>
                </a>

                <!-- 4. BANTUAN -->
                <a href="{{ route('dashboard', ['tab' => 'bantuan']) }}" 
                   class="group flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'bantuan' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'bantuan' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>BANTUAN</span>
                    </div>
                </a>

                <!-- 5. INFORMASI RUKO -->
                <a href="{{ route('dashboard', ['tab' => 'ruko']) }}" 
                   class="group flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 {{ ($activeTab ?? '') === 'ruko' ? 'bg-[#20675D] text-white shadow-md' : 'text-teal-100/80 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 {{ ($activeTab ?? '') === 'ruko' ? 'text-teal-300' : 'text-teal-400/70 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>INFORMASI RUKO</span>
                    </div>
                </a>

                <!-- 6. PROFIL & FORMULIR PENGAJUAN -->
                <a href="{{ route('formulir.umkm') }}" 
                   class="group flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-black tracking-wider uppercase transition-all duration-200 text-teal-100/70 hover:bg-white/10 hover:text-white">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-teal-400/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>EDIT PROFIL & PROPOSAL</span>
                    </div>
                </a>
            </nav>
        </div>

        <!-- Bawah Sidebar: Tautan Web & Keluar -->
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
    <div id="sidebar-overlay-umkm" onclick="toggleSidebarUmkm()" class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm hidden md:hidden"></div>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden">
        
        <!-- Mobile Header Top Bar -->
        <header class="md:hidden bg-[#0F433C] text-white px-4 py-3 flex items-center justify-between shadow-sm sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebarUmkm()" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="font-extrabold text-sm tracking-wider uppercase">DAYA UMKM</span>
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

            <!-- Konten Halaman Spesifik UMKM -->
            @yield('content')

        </main>
    </div>

    <script>
        function toggleSidebarUmkm() {
            const sidebar = document.getElementById('sidebar-umkm');
            const overlay = document.getElementById('sidebar-overlay-umkm');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
