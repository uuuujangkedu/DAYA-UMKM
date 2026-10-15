@extends('layouts.umkm')

@section('title', 'Dashboard Pelaku UMKM - DAYA UMKM')

@section('content')
<div class="space-y-8">

    {{-- ========================================================================= --}}
    {{-- TAB 1: BERANDA UMKM (Sesuai Mockup Gambar 2 Atas)                         --}}
    {{-- ========================================================================= --}}
    @if(($activeTab ?? 'beranda') === 'beranda')

        <!-- NOTIFIKASI MINAT INVESTASI MASUK DARI INVESTOR (Fitur Inti Permintaan User) -->
        @if(isset($notifikasiInvestasi) && $notifikasiInvestasi->count() > 0)
            <div class="bg-gradient-to-r from-amber-50 via-yellow-50 to-emerald-50 rounded-3xl p-6 sm:p-7 border-2 border-amber-300 shadow-sm animate-fade-in">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-amber-400 text-amber-950 flex items-center justify-center font-black text-xl shadow-sm shrink-0 animate-bounce">
                            🎉
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base sm:text-lg font-black text-[#1A202C]">
                                    Kabar Baik! Ada Investor Tertarik Mendanai Usaha Anda!
                                </h3>
                                @if(isset($unreadInvestasiCount) && $unreadInvestasiCount > 0)
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-rose-500 text-white animate-pulse">
                                        {{ $unreadInvestasiCount }} Baru
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 mt-0.5 font-medium">
                                Calon investor berikut telah meninjau proposal Anda dan menyatakan komitmen pendanaan:
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Daftar Notifikasi Investor -->
                <div class="space-y-3 mt-4">
                    @foreach($notifikasiInvestasi as $notif)
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-amber-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-black text-sm shrink-0 border border-blue-200">
                                    {{ strtoupper(substr($notif->pengguna->name ?? 'I', 0, 2)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-extrabold text-[#1A202C]">
                                            {{ $notif->pengguna->name ?? 'Investor' }}
                                        </h4>
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase bg-blue-100 text-blue-800">
                                            Calon Investor
                                        </span>
                                        @if(!$notif->dibaca)
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-700 mt-1">
                                        Komitmen Modal: <span class="font-extrabold text-emerald-700 text-sm">Rp {{ number_format($notif->jumlah_modal, 0, ',', '.') }}</span>
                                        &bull; Bagi Hasil: <span class="font-bold text-gray-800">{{ $notif->persentase_bagi_hasil }}% ({{ $notif->periode_pembagian }})</span>
                                    </p>
                                    @if(!empty($notif->catatan))
                                        <p class="text-xs text-gray-500 italic mt-1 bg-gray-50 p-2 rounded-xl border border-gray-100">
                                            "{{ $notif->catatan }}"
                                        </p>
                                    @endif
                                    <span class="text-[10px] text-gray-400 mt-1 block font-medium">
                                        {{ $notif->tanggal_investasi ? $notif->tanggal_investasi->diffForHumans() : '-' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Tombol Tindak Lanjut UMKM -->
                            <div class="flex items-center gap-2 shrink-0 self-end md:self-center">
                                @if(!empty($notif->pengguna->phone_number))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $notif->pengguna->phone_number) }}?text=Halo%20{{ urlencode($notif->pengguna->name) }},%20terima%20kasih%20atas%20minat%20investasi%20Anda%20di%20usaha%20{{ urlencode($umkm->nama_usaha) }}%20melalui%20DAYA%20UMKM." 
                                       target="_blank"
                                       class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.99.54 2.012.85 2.796.85 3.177 0 5.766-2.587 5.766-5.766 0-3.18-2.586-5.767-5.766-5.767zm7.55 5.766c0 4.164-3.393 7.552-7.55 7.552-1.312 0-2.539-.344-3.61-.951l-4.043 1.059 1.082-3.947c-.707-1.144-1.116-2.483-1.116-3.713 0-4.165 3.39-7.553 7.55-7.553 4.163 0 7.687 3.388 7.687 7.552z"/>
                                        </svg>
                                        <span>Hubungi Investor via WA</span>
                                    </a>
                                @endif

                                @if(!$notif->dibaca)
                                    <form action="{{ route('dashboard.umkm.notifikasi.read', $notif->id_investasi) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl border border-gray-300 hover:bg-gray-100 text-gray-700 text-xs font-bold transition">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- PAGE HEADER (Presisi Sesuai Mockup Gambar 2) -->
        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">BERANDA</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Halo, <span class="font-bold text-[#0F433C]">{{ $user->name }}</span>. Ini ringkasan usahamu.
            </p>
        </div>

        <!-- 4 KARTU METRIK KPI (Presisi Sesuai Mockup Gambar 2) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            
            <!-- KARTU 1: Cyan/Teal (Penjualan Hari Ini) -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-[#E0F7F6] text-[#00A389] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Penjualan Hari Ini</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    Rp. {{ number_format($salesToday, 0, ',', '.') }}
                </h3>
            </div>

            <!-- KARTU 2: Yellow/Gold (Total Pesanan) -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-[#FEF9E7] text-[#F1C40F] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Total Pesanan</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    {{ $totalOrders }}
                </h3>
            </div>

            <!-- KARTU 3: Blue/Purple (Total Produk) -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-[#EDF2FE] text-[#4F73D9] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Total Produk</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    {{ $produksCount }}
                </h3>
            </div>

            <!-- KARTU 4: Red/Coral (Total Pendapatan) -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-2xl bg-[#FDECEB] text-[#E74C3C] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Total Pendapatan</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    Rp. {{ number_format($totalRevenue, 0, ',', '.') }}
                </h3>
            </div>

        </div>

        <!-- BAGIAN GRAFIK 7 HARI & PRODUK TERLARIS (Presisi Sesuai Mockup Gambar 2) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
            
            <!-- KOLOM KIRI: Grafik Penjualan 7 Hari -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-[#E8E6DF] shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-black text-[#1A202C] tracking-tight">Grafik Penjualan 7 Hari</h2>
                        <p class="text-xs text-gray-400 font-medium">Tren transaksi harian tokomu</p>
                    </div>
                </div>

                <!-- Bar Chart Presisi Sesuai Gambar 2 -->
                <div class="h-64 sm:h-72 flex items-end justify-between gap-3 sm:gap-6 pt-6 px-2 sm:px-6 border-b border-gray-100 pb-2">
                    @foreach($days as $label => $height)
                        <div class="flex-1 flex flex-col items-center h-full justify-end group">
                            <!-- Tooltip -->
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity bg-[#0F433C] text-white text-[10px] font-bold px-2 py-0.5 rounded-md mb-2 pointer-events-none shadow">
                                {{ $height }}%
                            </div>
                            
                            <!-- Batang Warna Sage Green Sesuai Mockup (#6B9E8A) -->
                            <div class="w-full max-w-[42px] bg-[#6B9E8A] hover:bg-[#528773] transition-all rounded-t-xl rounded-b-md shadow-sm"
                                 style="height: {{ $height }}%;">
                            </div>

                            <!-- Label Hari -->
                            <span class="text-xs font-bold text-gray-600 mt-3 group-hover:text-[#0F433C] transition-colors">
                                {{ $label }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- KOLOM KANAN: Produk Terlaris (Presisi Sesuai Mockup Gambar 2) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-[#E8E6DF] shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-black text-[#1A202C] tracking-tight">Produk Terlaris</h2>
                        <p class="text-xs text-gray-400 font-medium">Item paling diminati pembeli</p>
                    </div>
                    <a href="{{ route('dashboard', ['tab' => 'produk']) }}" class="text-xs font-bold text-[#0F433C] hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($topProducts as $tp)
                        <div class="p-3.5 rounded-2xl bg-[#F9F8F3] border border-[#E8E6DF] flex items-center gap-3.5">
                            <!-- Thumbnail Kotak Hijau Sesuai Mockup (#6B9E8A) -->
                            <div class="w-12 h-12 rounded-xl bg-[#6B9E8A] text-white flex items-center justify-center shrink-0 font-bold text-xs shadow-sm overflow-hidden">
                                @if(!empty($tp->foto))
                                    <img src="{{ asset('storage/' . $tp->foto) }}" alt="{{ $tp->nama_produk }}" class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($tp->nama_produk, 0, 2)) }}
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-xs sm:text-sm font-extrabold text-[#1A202C] truncate">
                                    {{ $tp->nama_produk }}
                                </h4>
                                <p class="text-[11px] text-gray-500 font-medium mt-0.5">
                                    {{ $tp->terjual ?? 15 }} Terjual &bull; Rp {{ number_format($tp->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400 text-xs">
                            Belum ada riwayat penjualan produk.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 2: PRODUK UMKM (Sesuai Mockup Gambar 2 Bawah)                          --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'produk')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">Produk</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Kelola semua produk jualanmu di satu tempat.
            </p>
        </div>

        <!-- SEARCH BAR & FILTER TABS & TOMBOL + TAMBAH PRODUK (Sesuai Gambar 2 Bawah) -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            
            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <input type="hidden" name="tab" value="produk">
                
                <!-- Search Box -->
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
                           class="w-48 sm:w-64 px-4 py-2 rounded-2xl bg-white border border-[#E8E6DF] text-xs font-semibold placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>

                <!-- Filter Pills: Semua, Tersedia, Habis -->
                <a href="{{ route('dashboard', ['tab' => 'produk', 'status' => 'semua', 'q' => request('q')]) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition {{ (request('status') === 'semua' || !request('status')) ? 'bg-[#0F433C] text-white' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Semua
                </a>
                <a href="{{ route('dashboard', ['tab' => 'produk', 'status' => 'tersedia', 'q' => request('q')]) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition {{ request('status') === 'tersedia' ? 'bg-[#0F433C] text-white' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Tersedia
                </a>
                <a href="{{ route('dashboard', ['tab' => 'produk', 'status' => 'habis', 'q' => request('q')]) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition {{ request('status') === 'habis' ? 'bg-[#0F433C] text-white' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Habis
                </a>
            </form>

            <!-- Tombol Kuning + Tambah Produk (Sesuai Gambar 2) -->
            <button onclick="openAddProductModal()" class="px-5 py-2.5 rounded-full bg-[#F1C40F] hover:bg-[#E2A700] text-gray-950 text-xs font-extrabold shadow-sm transition flex items-center gap-2 self-start sm:self-auto">
                <span>+ Tambah Produk</span>
            </button>
        </div>

        <!-- GRID KARTU PRODUK (Sesuai Gambar 2 Bawah) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse($allProduks as $p)
                <div class="bg-white rounded-3xl p-5 border border-[#E8E6DF] shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <!-- Box Gambar Produk (Soft Teal Placeholder seperti Mockup Gambar 2) -->
                        <div class="w-full h-44 rounded-2xl bg-[#98D8D8] text-white flex items-center justify-center font-black text-xl mb-4 overflow-hidden shadow-inner">
                            @if(!empty($p->foto))
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama_produk }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center text-teal-800">
                                    <svg class="w-12 h-12 mx-auto opacity-70 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Foto Produk</span>
                                </div>
                            @endif
                        </div>

                        <!-- Info Produk -->
                        <h3 class="text-sm sm:text-base font-extrabold text-[#1A202C] truncate">
                            {{ $p->nama_produk }}
                        </h3>
                        <p class="text-sm font-black text-gray-900 mt-1">
                            Rp. {{ number_format($p->harga, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Footer Kartu: Badge Stok & Tombol Edit (Sesuai Mockup Gambar 2) -->
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <!-- Pill Stok Hijau Muda Sesuai Gambar 2 -->
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold bg-[#E2F0EA] text-[#26734D] border border-[#C5E4D7]">
                            Stok {{ $p->stok }}
                        </span>

                        <div class="flex items-center gap-2">
                            <!-- Tombol Edit Berbentuk Kapsul Outlined Sesuai Gambar 2 -->
                            <button onclick="openEditProductModal('{{ $p->id_produk }}', '{{ addslashes($p->nama_produk) }}', '{{ $p->harga }}', '{{ $p->stok }}', '{{ $p->status }}', '{{ addslashes($p->deskripsi ?? '') }}')"
                                    class="px-3.5 py-1 rounded-full border border-gray-400 hover:border-gray-700 text-gray-700 hover:text-black text-xs font-bold transition">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('dashboard.umkm.produk.delete', $p->id_produk) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $p->nama_produk }}?');">
                                @csrf
                                <button type="submit" class="p-1 rounded-full text-rose-500 hover:bg-rose-50 transition" title="Hapus Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-[#E8E6DF]">
                    <div class="w-16 h-16 rounded-full bg-[#E0F7F6] text-[#00A389] mx-auto flex items-center justify-center mb-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800">Belum ada produk jualan yang terdaftar</h3>
                    <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">
                        Mulai tambahkan produk jualanmu agar pembeli dan investor dapat melihat katalog bisnismu.
                    </p>
                    <button onclick="openAddProductModal()" class="mt-4 px-5 py-2.5 rounded-full bg-[#F1C40F] text-gray-950 text-xs font-black hover:bg-[#E2A700] transition">
                        + Tambah Produk Sekarang
                    </button>
                </div>
            @endforelse
        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 3: ANALISIS KEUANGAN                                                  --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'keuangan')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">Analisis Keuangan</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Pencatatan arus kas, omzet, dan laporan bagi hasil usaha.
            </p>
        </div>

        <!-- 3 KARTU METRIK RINGKASAN KEUANGAN -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-[#E8E6DF] shadow-sm">
                <span class="text-xs font-bold text-gray-500">Estimasi Omzet Bulanan</span>
                <h3 class="text-2xl font-black text-emerald-800 mt-1">
                    {{ isset($totalOmzetBulanAktif) && $totalOmzetBulanAktif > 0 ? 'Rp ' . number_format($totalOmzetBulanAktif, 0, ',', '.') : (isset($latestKeuangan) ? 'Rp ' . number_format($latestKeuangan->pendapatan, 0, ',', '.') : 'Rp 12.500.000') }}
                </h3>
                <span class="text-[11px] text-gray-400 font-medium">
                    @if(isset($jumlahCatatanBulanAktif) && $jumlahCatatanBulanAktif > 1)
                        Total akumulasi dari {{ $jumlahCatatanBulanAktif }} catatan di {{ $bulanAktif }}
                    @else
                        Berdasarkan periode {{ $bulanAktif ?? 'berjalan' }}
                    @endif
                </span>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-[#E8E6DF] shadow-sm">
                <span class="text-xs font-bold text-gray-500">Kebutuhan Modal Pendanaan</span>
                <h3 class="text-2xl font-black text-[#0F433C] mt-1">
                    {{ $umkm->modal_dibutuhkan ? 'Rp ' . number_format($umkm->modal_dibutuhkan, 0, ',', '.') : 'Rp 1.000.000' }}
                </h3>
                <span class="text-[11px] text-gray-400 font-medium">Target ekspansi bisnis</span>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-[#E8E6DF] shadow-sm">
                <span class="text-xs font-bold text-gray-500">Persentase Bagi Hasil</span>
                <h3 class="text-2xl font-black text-amber-600 mt-1">
                    {{ $umkm->persentase_bagi_hasil ? $umkm->persentase_bagi_hasil . '%' : ($umkm->estimasi_bagi_hasil ?: '15% p.a.') }}
                </h3>
                <span class="text-[11px] text-gray-400 font-medium">Ditawarkan ke mitra investor</span>
            </div>
        </div>

        <!-- KARTU HASIL ANALISIS LABA / RUGI TERKINI (Ditotalkan Secara Akumulatif) -->
        @if(isset($latestKeuangan))
            @php
                $statusCard = $statusLabaBulanAktif ?? $latestKeuangan->status_laba;
                $labaCard = $totalLabaBersihBulanAktif ?? $latestKeuangan->laba_bersih;
                $marginCard = $marginLabaBulanAktif ?? $latestKeuangan->margin_laba;
                $omzetCard = $totalOmzetBulanAktif ?? $latestKeuangan->pendapatan;
                $hppCard = $totalHppBulanAktif ?? $latestKeuangan->hpp;
                $opsCard = isset($totalBebanBulanAktif) ? ($totalBebanBulanAktif - ($totalHppBulanAktif ?? 0)) : ($latestKeuangan->beban_operasional + $latestKeuangan->beban_lain);
            @endphp
            <div class="p-6 sm:p-7 rounded-3xl border-2 {{ $statusCard === 'untung' ? 'bg-emerald-50/80 border-emerald-300' : ($statusCard === 'rugi' ? 'bg-rose-50/80 border-rose-300' : 'bg-blue-50/80 border-blue-300') }} shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl {{ $statusCard === 'untung' ? 'bg-emerald-500 text-white' : ($statusCard === 'rugi' ? 'bg-rose-500 text-white' : 'bg-blue-500 text-white') }} flex items-center justify-center font-black text-2xl shrink-0 shadow-sm">
                            {{ $statusCard === 'untung' ? '📈' : ($statusCard === 'rugi' ? '📉' : '⚖️') }}
                        </div>
                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase {{ $statusCard === 'untung' ? 'bg-emerald-200 text-emerald-900' : ($statusCard === 'rugi' ? 'bg-rose-200 text-rose-900' : 'bg-blue-200 text-blue-900') }}">
                                    Status: {{ strtoupper($statusCard) }}
                                </span>
                                <span class="text-xs font-bold text-gray-600">Periode {{ $bulanAktif ?? $latestKeuangan->bulan_tahun }}</span>
                                @if(isset($jumlahCatatanBulanAktif) && $jumlahCatatanBulanAktif > 1)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-900 border border-amber-300">
                                        Total Akumulasi dari {{ $jumlahCatatanBulanAktif }} Transaksi
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-xl sm:text-2xl font-black text-[#1A202C] mt-1">
                                {{ $statusCard === 'untung' ? 'Total Laba Bersih: Rp ' . number_format($labaCard, 0, ',', '.') : ($statusCard === 'rugi' ? 'Total Defisit Rugi: Rp ' . number_format(abs($labaCard), 0, ',', '.') : 'Impas (BEP)') }}
                            </h3>
                            <p class="text-xs font-semibold {{ $statusCard === 'untung' ? 'text-emerald-800' : 'text-rose-800' }} mt-0.5">
                                Margin Laba: {{ $marginCard > 0 ? '+' : '' }}{{ $marginCard }}% dari Total Omzet Penjualan
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/90 p-4 rounded-2xl border border-gray-200/60 max-w-sm text-xs space-y-1.5 shadow-xs">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Omzet Pendapatan:</span>
                            <span class="font-black text-gray-900">Rp {{ number_format($omzetCard, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Harga Pokok (HPP):</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($hppCard, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Beban Operasional Usaha:</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($opsCard, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                @if(isset($jumlahCatatanBulanAktif) && $jumlahCatatanBulanAktif > 1)
                    <div class="mt-4 pt-3 border-t border-gray-200/60 flex flex-wrap items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-2 text-gray-700">
                            <span>ℹ️</span>
                            <span>
                                Anda memiliki <strong>{{ $jumlahCatatanBulanAktif }} transaksi</strong> terpisah di periode <strong>{{ $bulanAktif }}</strong> yang otomatis <strong>ditotalkan secara kumulatif</strong>.
                            </span>
                        </div>
                        <form action="{{ route('dashboard.umkm.keuangan.gabung') }}" method="POST" onsubmit="return confirm('Satukan seluruh {{ $jumlahCatatanBulanAktif }} transaksi pada periode {{ $bulanAktif }} menjadi 1 catatan kumulatif?')">
                            @csrf
                            <input type="hidden" name="bulan_tahun" value="{{ $bulanAktif }}">
                            <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-[11px] font-black shadow-sm transition flex items-center gap-1.5">
                                <span>⚡ Satukan Menjadi 1 Catatan Kumulatif</span>
                            </button>
                        </form>
                    </div>
                @endif

                <div class="mt-3 pt-2 text-xs {{ $statusCard === 'untung' ? 'text-emerald-900' : 'text-rose-900' }}">
                    <strong>Analisis Sistem:</strong>
                    @if($statusCard === 'untung')
                        Usaha Anda berjalan sehat dengan arus kas positif. Performa ini sangat meyakinkan bagi calon mitra investor untuk menyalurkan modal ekspansi.
                    @elseif($statusCard === 'rugi')
                        Total beban operasional dan HPP melebihi omzet pemasukan. Evaluasi kembali harga bahan baku dan efisiensi pengeluaran harian.
                    @else
                        Pendapatan seimbang dengan beban operasional (Break Even Point).
                    @endif
                </div>
            </div>
        @endif

        <!-- FORMULIR INPUT PENDAPATAN & BEBAN KEUANGAN BESERTA UPLOAD BUKTI (Sesuai Permintaan User) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#E8E6DF] shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-black text-[#1A202C]">Form Input Analisis Pendapatan & Pengeluaran</h2>
                    <p class="text-xs text-gray-400 font-medium">
                        Masukkan data omzet dan pengeluaran atau lampirkan foto buku kas / nota untuk dianalisis otomatis.
                    </p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                    Kalkulator Laba Rugi
                </span>
             <form id="form-keuangan" action="{{ route('dashboard.umkm.keuangan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <input type="hidden" id="form-id-keuangan" name="id_keuangan" value="">

                <!-- BANNER MODE EDIT (MUNCUL JIKA USER KLIK TOMBOL EDIT DI TABEL) -->
                <div id="edit-mode-banner" class="hidden p-3.5 rounded-2xl bg-amber-50 border border-amber-300 text-amber-900 text-xs flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <span class="text-lg">✏️</span>
                        <div>
                            <strong class="font-bold block">Mode Edit Catatan Keuangan</strong>
                            <span class="text-[11px] text-amber-800">Anda sedang mengubah data catatan periode <span id="edit-periode-text" class="font-bold underline"></span>.</span>
                        </div>
                    </div>
                    <button type="button" onclick="cancelEditKeuangan()" class="px-3 py-1.5 rounded-xl bg-amber-200 hover:bg-amber-300 text-amber-900 font-bold text-xs transition">
                        ✕ Batal Edit
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Periode Laporan -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Periode Bulan & Tahun *</label>
                        <input type="text" id="input-bulan-tahun" name="bulan_tahun" required value="{{ date('F Y') }}" placeholder="Contoh: Oktober 2026"
                               class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                    </div>

                    <!-- Omzet Pendapatan -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                            <span>Total Pendapatan / Omzet Penjualan (Rp) *</span>
                            <span class="text-[10px] text-emerald-700 font-bold normal-case bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">⚡ Otomatis terisi jika unggah Excel / Foto Nota</span>
                        </label>
                        <input type="number" id="input-pendapatan" name="pendapatan" min="0" step="any" placeholder="15000000" oninput="calculateLiveProfit()"
                               class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-bold text-[#0F433C] focus:outline-none focus:ring-2 focus:ring-[#0F433C] transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- HPP -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Harga Pokok (HPP / Bahan Baku)</label>
                        <input type="number" id="input-hpp" name="hpp" min="0" step="any" placeholder="6000000" oninput="calculateLiveProfit()"
                               class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                        <span class="text-[10px] text-gray-400 mt-1 block">Biaya bahan pokok produksi</span>
                    </div>

                    <!-- Beban Operasional -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Beban Operasional Usaha</label>
                        <input type="number" id="input-operasional" name="beban_operasional" min="0" step="any" placeholder="3500000" oninput="calculateLiveProfit()"
                               class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                        <span class="text-[10px] text-gray-400 mt-1 block">Gaji, listrik, sewa, kemasan</span>
                    </div>

                    <!-- Beban Lain -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Beban Lain-lain</label>
                        <input type="number" id="input-lain" name="beban_lain" min="0" step="any" placeholder="500000" oninput="calculateLiveProfit()"
                               class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                        <span class="text-[10px] text-gray-400 mt-1 block">Transportasi, perawatan, tak terduga</span>
                    </div>
                </div>

                <!-- Preview Real-time Laba Rugi -->
                <div id="live-profit-box" class="p-4 rounded-2xl bg-[#F9F8F3] border border-[#E8E6DF] flex items-center justify-between">
                    <div>
                        <span class="text-xs text-gray-500 font-medium block">Simulasi Estimasi Laba Bersih:</span>
                        <h4 id="live-profit-text" class="text-lg font-black text-gray-700 mt-0.5">Rp 0</h4>
                    </div>
                    <span id="live-profit-badge" class="px-3 py-1 rounded-full text-xs font-black bg-gray-200 text-gray-700">
                        Belum Diisi
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Upload Foto Bukti / File Excel / PDF Laporan -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                            <span>Lampirkan Berkas Laporan Keuangan / Bukti</span>
                            <span class="text-[10px] text-emerald-800 font-bold bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                Auto-Detect: Excel & Foto Nota
                            </span>
                        </label>
                        <input type="file" id="input-berkas-keuangan" name="foto_bukti" accept=".xlsx,.xls,.csv,.pdf,.doc,.docx,image/*" onchange="handleFileSelected(event)"
                               class="w-full px-3 py-2 rounded-2xl border border-[#E8E6DF] text-xs text-gray-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0F433C] file:text-white hover:file:bg-[#19584F]">
                        <div class="flex flex-wrap items-center gap-1.5 mt-2 text-[10px]">
                            <span class="text-gray-400 font-medium">Format:</span>
                            <span class="px-1.5 py-0.5 rounded-md bg-emerald-100 text-emerald-800 font-bold">📊 Excel (.xlsx, .xls, .csv)</span>
                            <span class="px-1.5 py-0.5 rounded-md bg-teal-100 text-teal-800 font-bold">🖼️ Foto Nota / Kuitansi (Auto OCR)</span>
                            <span class="px-1.5 py-0.5 rounded-md bg-rose-100 text-rose-800 font-bold">📄 PDF (.pdf)</span>
                            <span class="px-1.5 py-0.5 rounded-md bg-blue-100 text-blue-800 font-bold">📝 Word (.doc, .docx)</span>
                        </div>
                        <div id="file-info-badge" class="hidden mt-2 p-2.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs items-center gap-2.5">
                            <span id="file-icon" class="text-xl">📊</span>
                            <div class="min-w-0 flex-1">
                                <span id="file-name" class="font-bold truncate block"></span>
                                <span id="file-hint" class="text-[10px] text-emerald-700 block mt-0.5"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Tambahan -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Keterangan / Catatan Tambahan</label>
                        <input type="text" id="input-catatan" name="catatan" placeholder="Contoh: Lampiran Excel rekapitulasi penjualan harian."
                               class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                        <span class="text-[10px] text-gray-400 mt-1 block">Catatan singkat mengenai sumber data laporan keuangan</span>
                    </div>
                </div>

                <!-- OPSI PENANGANAN TRANSAKSI PERIODE INI (Menotalkan vs Mengganti) -->
                <div id="mode-aksi-container" class="p-4 rounded-2xl bg-[#F9F8F3] border border-[#E8E6DF] space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="block text-[11px] font-black uppercase text-gray-700 tracking-wider">
                            Pilihan Penanganan Input:
                        </span>
                        <span class="text-[10px] text-gray-400 font-medium">Tentukan aksi jika periode bulan sudah memiliki catatan</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                        <label class="flex items-start gap-2.5 p-3 rounded-xl border-2 border-emerald-400 bg-emerald-50/80 cursor-pointer hover:bg-emerald-50 transition">
                            <input type="radio" name="mode_aksi" value="akumulasi" checked class="mt-0.5 text-emerald-700 focus:ring-emerald-600">
                            <div>
                                <strong class="text-emerald-950 font-bold block text-xs">➕ Totalkan / Akumulasikan (Default)</strong>
                                <span class="text-[10px] text-emerald-800 leading-tight block mt-1">Nominal baru otomatis dijumlahkan/ditotalkan dengan catatan bulan ini yang sudah ada.</span>
                            </div>
                        </label>
                        <label class="flex items-start gap-2.5 p-3 rounded-xl border border-gray-200 bg-white cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="mode_aksi" value="ganti" class="mt-0.5 text-[#0F433C] focus:ring-[#0F433C]">
                            <div>
                                <strong class="text-gray-900 font-bold block text-xs">🔄 Perbarui / Ganti Total</strong>
                                <span class="text-[10px] text-gray-500 leading-tight block mt-1">Mengganti total periode bulan ini secara langsung dengan nominal baru.</span>
                            </div>
                        </label>
                        <label class="flex items-start gap-2.5 p-3 rounded-xl border border-gray-200 bg-white cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="mode_aksi" value="baru" class="mt-0.5 text-[#0F433C] focus:ring-[#0F433C]">
                            <div>
                                <strong class="text-gray-900 font-bold block text-xs">📑 Catat Sebagai Baris Baru</strong>
                                <span class="text-[10px] text-gray-500 leading-tight block mt-1">Simpan sebagai transaksi/nota terpisah di tabel riwayat.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-3 flex justify-end gap-3">
                    <button type="button" id="btn-cancel-edit" onclick="cancelEditKeuangan()" class="hidden px-5 py-3 rounded-2xl border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs font-bold transition">
                        Batal Edit
                    </button>
                    <button type="submit" id="btn-submit-keuangan" class="px-6 py-3 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-black transition shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span id="btn-submit-keuangan-text">Simpan & Hitung Analisis Laba Rugi</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- TABEL RIWAYAT CATATAN KEUANGAN & BERKAS LAMPIRAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#E8E6DF] shadow-sm">
            <h2 class="text-lg font-black text-[#1A202C] mb-4">Riwayat Catatan Keuangan Bulanan</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#F9F8F3] border-b border-[#E8E6DF] text-[11px] font-black uppercase tracking-wider text-gray-500">
                            <th class="py-3.5 px-5">Periode</th>
                            <th class="py-3.5 px-5">Omzet Penjualan</th>
                            <th class="py-3.5 px-5">Total Beban (HPP + Ops)</th>
                            <th class="py-3.5 px-5">Laba Bersih</th>
                            <th class="py-3.5 px-5">Margin</th>
                            <th class="py-3.5 px-5">Status Laba/Rugi</th>
                            <th class="py-3.5 px-5">Lampiran Berkas / Bukti</th>
                            <th class="py-3.5 px-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs font-medium">
                        @forelse($catatanKeuangan ?? [] as $ck)
                            @php
                                $totalBeban = $ck->hpp + $ck->beban_operasional + $ck->beban_lain;
                                $ext = strtolower(pathinfo($ck->foto_bukti ?? '', PATHINFO_EXTENSION));
                                $isExcel = in_array($ext, ['xlsx', 'xls', 'csv']);
                                $isPdf = $ext === 'pdf';
                                $isWord = in_array($ext, ['doc', 'docx']);
                            @endphp
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="py-3.5 px-5 font-extrabold text-[#1A202C]">
                                    {{ $ck->bulan_tahun }}
                                </td>
                                <td class="py-3.5 px-5 font-bold text-gray-900">
                                    Rp {{ number_format($ck->pendapatan, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 text-gray-600">
                                    Rp {{ number_format($totalBeban, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 font-black {{ $ck->status_laba === 'untung' ? 'text-emerald-700' : 'text-rose-600' }}">
                                    {{ $ck->status_laba === 'untung' ? '+' : '' }}Rp {{ number_format($ck->laba_bersih, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 font-bold {{ $ck->margin_laba > 0 ? 'text-emerald-700' : 'text-rose-600' }}">
                                    {{ $ck->margin_laba }}%
                                </td>
                                <td class="py-3.5 px-5">
                                    @if($ck->status_laba === 'untung')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-800">
                                            🟢 Untung
                                        </span>
                                    @elseif($ck->status_laba === 'rugi')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-rose-100 text-rose-800">
                                            🔴 Rugi
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-gray-100 text-gray-800">
                                            ⚪ Impas
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-5">
                                    @if(!empty($ck->foto_bukti))
                                        @if($isExcel)
                                            <a href="{{ asset('storage/' . $ck->foto_bukti) }}" download target="_blank" 
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-[11px] font-extrabold border border-emerald-300 transition shadow-sm">
                                                <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm2 14h-8v-2h8v2zm0-4h-8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                                </svg>
                                                <span>Unduh Excel (.{{ strtoupper($ext) }})</span>
                                            </a>
                                        @elseif($isPdf)
                                            <a href="{{ asset('storage/' . $ck->foto_bukti) }}" target="_blank" 
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-800 text-[11px] font-extrabold border border-rose-300 transition shadow-sm">
                                                <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-9.5 8.5h-2v3H6V7.5h3.5c1.1 0 2 .9 2 2s-.9 2-2 2zm8 0h-2v3h-1.5V7.5H16c1.1 0 2 .9 2 2s-.9 2-2 2zm-4-2H12v6h-1.5V7.5h3c.83 0 1.5.67 1.5 1.5v1c0 .83-.67 1.5-1.5 1.5z"/>
                                                </svg>
                                                <span>Buka PDF</span>
                                            </a>
                                        @elseif($isWord)
                                            <a href="{{ asset('storage/' . $ck->foto_bukti) }}" download target="_blank" 
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-800 text-[11px] font-extrabold border border-blue-300 transition shadow-sm">
                                                <svg class="w-3.5 h-3.5 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm2 14h-8v-2h8v2zm0-4h-8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                                </svg>
                                                <span>Unduh Word (.{{ strtoupper($ext) }})</span>
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $ck->foto_bukti) }}" target="_blank" 
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-50 hover:bg-teal-100 text-teal-800 text-[11px] font-extrabold border border-teal-200 transition shadow-sm">
                                                <svg class="w-3.5 h-3.5 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Lihat Foto Bukti</span>
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-[11px] text-gray-400 italic">Tidak ada berkas</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-5 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <button type="button" 
                                                onclick="editKeuangan('{{ $ck->id_keuangan }}', '{{ $ck->bulan_tahun }}', '{{ $ck->pendapatan }}', '{{ $ck->hpp }}', '{{ $ck->beban_operasional }}', '{{ $ck->beban_lain }}', '{{ addslashes($ck->catatan ?? '') }}')" 
                                                class="p-1.5 rounded-lg text-emerald-700 hover:bg-emerald-50 transition" 
                                                title="Edit Catatan Ini">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('dashboard.umkm.keuangan.delete', $ck->id_keuangan) }}" method="POST" onsubmit="return confirm('Hapus catatan keuangan periode {{ $ck->bulan_tahun }}?');">
                                            @csrf
                                            <button type="submit" class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 transition" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-gray-400 text-xs">
                                    Belum ada data catatan keuangan. Gunakan formulir di atas untuk mulai mencatat omzet & pengeluaran Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if(isset($jumlahCatatanBulanAktif) && $jumlahCatatanBulanAktif > 1)
                        <tfoot class="bg-[#F9F8F3] border-t-2 border-[#E8E6DF] font-black text-xs">
                            <tr>
                                <td class="py-3.5 px-5 text-[#0F433C]">
                                    TOTAL AKUMULASI ({{ $bulanAktif }})
                                </td>
                                <td class="py-3.5 px-5 text-gray-900">
                                    Rp {{ number_format($totalOmzetBulanAktif, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 text-gray-700">
                                    Rp {{ number_format($totalBebanBulanAktif, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 {{ $statusLabaBulanAktif === 'untung' ? 'text-emerald-700' : 'text-rose-600' }}">
                                    {{ $statusLabaBulanAktif === 'untung' ? '+' : '' }}Rp {{ number_format($totalLabaBersihBulanAktif, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 {{ $statusLabaBulanAktif === 'untung' ? 'text-emerald-700' : 'text-rose-600' }}">
                                    {{ $marginLabaBulanAktif }}%
                                </td>
                                <td class="py-3.5 px-5">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase {{ $statusLabaBulanAktif === 'untung' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                        {{ strtoupper($statusLabaBulanAktif) }}
                                    </span>
                                </td>
                                <td colspan="2" class="py-3.5 px-5 text-right">
                                    <form action="{{ route('dashboard.umkm.keuangan.gabung') }}" method="POST" onsubmit="return confirm('Satukan seluruh catatan di periode {{ $bulanAktif }}?')">
                                        @csrf
                                        <input type="hidden" name="bulan_tahun" value="{{ $bulanAktif }}">
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-[11px] font-bold shadow-sm transition">
                                            ⚡ Satukan Jadi 1 Catatan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

        <!-- SheetJS Library untuk Membaca Excel (.xlsx, .xls) di Sisi Browser -->
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <!-- Tesseract.js Library untuk OCR Deteksi Teks & Angka Otomatis dari Foto Nota / Struk -->
        <script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>

        <script>
            // Helper membersihkan format mata uang / angka (contoh: "Rp 15.000.000,00" -> 15000000)
            function parseCellNumber(val) {
                if (typeof val === 'number') return val;
                if (!val) return 0;
                let str = String(val).trim().replace(/[^\d,\.\-]/g, '');
                if (!str || str === '-') return 0;
                if (str.includes('.') && str.includes(',')) {
                    if (str.lastIndexOf(',') > str.lastIndexOf('.')) {
                        str = str.replace(/\./g, '').replace(',', '.');
                    } else {
                        str = str.replace(/,/g, '');
                    }
                } else if (str.includes('.') && !str.includes(',')) {
                    if (/\.\d{3}/.test(str)) str = str.replace(/\./g, '');
                } else if (str.includes(',') && !str.includes('.')) {
                    if (/,\d{3}/.test(str)) str = str.replace(/,/g, '');
                    else str = str.replace(',', '.');
                }
                const n = parseFloat(str);
                return isNaN(n) ? 0 : n;
            }

            function containsKeywords(txt, keywords) {
                const lower = String(txt || '').toLowerCase();
                return keywords.some(k => lower.includes(k));
            }

            // Fungsi cerdas menganalisis baris spreadsheet dan mengisi formulir otomatis
            function processParsedSpreadsheet(rows, fileName) {
                if (!rows || rows.length === 0) return;

                let detectedPendapatan = 0;
                let detectedHpp = 0;
                let detectedOps = 0;
                let isDetected = false;

                // 1. Periksa format Ringkasan Baris per Baris (TOTAL, GRAND TOTAL, SUBTOTAL, TOTAL PENJUALAN, dsb.)
                let grandTotal = 0;
                let totalFound = 0;
                let subtotal = 0;

                rows.forEach(row => {
                    if (!Array.isArray(row)) return;
                    let textCombined = '';
                    let numbers = [];

                    row.forEach(cell => {
                        const str = String(cell || '').trim();
                        const num = parseCellNumber(str);
                        if (num > 0) {
                            numbers.push(num);
                        } else if (/[a-zA-Z]/.test(str)) {
                            textCombined += ' ' + str.toLowerCase();
                        }
                    });
                    textCombined = textCombined.trim();

                    if (numbers.length > 0) {
                        const lastNumber = numbers[numbers.length - 1]; // Angka terakhir di baris summary (misal di kolom Jumlah/Total)

                        if (containsKeywords(textCombined, ['grand total', 'total tagihan', 'sisa tagihan', 'total bayar', 'total penjualan', 'total omzet', 'total pendapatan', 'total pemasukan', 'jumlah total'])) {
                            grandTotal = lastNumber;
                        } else if (/\b(total)\b/i.test(textCombined) && !containsKeywords(textCombined, ['pengeluaran', 'beban', 'biaya'])) {
                            totalFound = lastNumber;
                        } else if (containsKeywords(textCombined, ['subtotal', 'sub total'])) {
                            subtotal = lastNumber;
                        } else if (containsKeywords(textCombined, ['total hpp', 'harga pokok', 'bahan baku', 'hpp'])) {
                            detectedHpp = lastNumber;
                            isDetected = true;
                        } else if (containsKeywords(textCombined, ['biaya operasional', 'beban operasional', 'total pengeluaran', 'total beban', 'total biaya', 'total operasional', 'jumlah pengeluaran', 'jumlah beban'])) {
                            detectedOps = lastNumber;
                            isDetected = true;
                        }
                    }
                });

                if (grandTotal > 0) {
                    detectedPendapatan = grandTotal;
                    isDetected = true;
                } else if (totalFound > 0) {
                    detectedPendapatan = totalFound;
                    isDetected = true;
                } else if (subtotal > 0) {
                    detectedPendapatan = subtotal;
                    isDetected = true;
                }

                // 2. Jika bukan format ringkasan, periksa format Kolom Tabel (Header: No | Nama Barang | Qty | Harga | Jumlah)
                const ignoreColHeaders = ['no', 'no.', 'nomor', 'kode', 'id', 'item', 'nama barang', 'nama jasa', 'barang', 'deskripsi', 'qty', 'kuantitas', 'satuan', 'unit', 'harga satuan', 'diskon', 'diskon (%)', 'tanggal', 'tgl', 'keterangan'];

                let colIncome = null;
                let colExpense = null;
                let colHpp = null;
                let headerIdx = null;

                // Hanya periksa baris yang memiliki minimal 3 kolom terisi agar tidak tertipu judul banner "NOTA PENJUALAN"
                for (let r = 0; r < Math.min(15, rows.length); r++) {
                    const row = rows[r];
                    if (!Array.isArray(row)) continue;

                    let nonEmptyCount = 0;
                    row.forEach(cell => {
                        if (String(cell || '').trim() !== '') nonEmptyCount++;
                    });
                    if (nonEmptyCount < 3) continue;

                    row.forEach((cell, cIdx) => {
                        const text = String(cell || '').toLowerCase().trim();
                        if (!text) return;

                        // Abaikan kolom non-nominal seperti No, Qty, Satuan, Diskon
                        if (ignoreColHeaders.includes(text) || /^(no|nomor|kode|qty|satuan|diskon)\b/.test(text)) {
                            return;
                        }

                        if (colIncome === null && containsKeywords(text, ['jumlah (rp)', 'jumlah rp', 'total (rp)', 'total rp', 'subtotal', 'total harga', 'harga total', 'pemasukan', 'pendapatan', 'omzet', 'penjualan', 'kredit', 'masuk', 'nominal'])) {
                            colIncome = cIdx;
                            headerIdx = r;
                        }
                        if (colExpense === null && containsKeywords(text, ['pengeluaran', 'beban', 'biaya', 'operasional', 'debit', 'keluar', 'belanja', 'pembelian'])) {
                            colExpense = cIdx;
                            headerIdx = r;
                        }
                        if (colHpp === null && containsKeywords(text, ['hpp', 'harga pokok', 'bahan baku', 'modal', 'kulakan'])) {
                            colHpp = cIdx;
                            headerIdx = r;
                        }
                    });

                    if (colIncome !== null || colExpense !== null) break;
                }

                // Jika kolom ditemukan, jumlahkan item baris di bawah header
                if (colIncome !== null || colExpense !== null || colHpp !== null) {
                    const start = (headerIdx !== null) ? headerIdx + 1 : 0;
                    let itemPendapatan = 0;
                    let itemHpp = 0;
                    let itemExpense = 0;

                    for (let i = start; i < rows.length; i++) {
                        const row = rows[i];
                        if (!Array.isArray(row)) continue;
                        const rowText = row.join(' ').toLowerCase();

                        // Abaikan baris total bawaan spreadsheet agar tidak dihitung ganda
                        if (containsKeywords(rowText, ['total', 'subtotal', 'grand total', 'sisa', 'catatan', 'penerima', 'hormat', 'petunjuk'])) {
                            continue;
                        }

                        if (colIncome !== null && row[colIncome] !== undefined) {
                            const val = parseCellNumber(row[colIncome]);
                            if (val > 0) {
                                itemPendapatan += val;
                            }
                        }
                        if (colHpp !== null && row[colHpp] !== undefined) {
                            const val = parseCellNumber(row[colHpp]);
                            if (val > 0) itemHpp += val;
                        }
                        if (colExpense !== null && row[colExpense] !== undefined) {
                            const val = parseCellNumber(row[colExpense]);
                            if (val > 0) {
                                itemExpense += val;
                            }
                        }
                    }

                    if (detectedPendapatan === 0 && itemPendapatan > 0) {
                        detectedPendapatan = itemPendapatan;
                        isDetected = true;
                    }
                    if (detectedHpp === 0 && itemHpp > 0) {
                        detectedHpp = itemHpp;
                        isDetected = true;
                    }
                    if (detectedOps === 0 && itemExpense > 0) {
                        detectedOps = itemExpense;
                        isDetected = true;
                    }
                }

                // Terapkan hasil otomatis ke field formulir jika ditemukan
                if (isDetected && (detectedPendapatan > 0 || (detectedHpp + detectedOps) > 0)) {
                    const inputPendapatan = document.getElementById('input-pendapatan');
                    const inputHpp = document.getElementById('input-hpp');
                    const inputOps = document.getElementById('input-operasional');
                    const hintEl = document.getElementById('file-hint');
                    const badgeEl = document.getElementById('file-info-badge');

                    if (detectedPendapatan > 0) {
                        inputPendapatan.value = Math.round(detectedPendapatan);
                        inputPendapatan.classList.add('ring-2', 'ring-emerald-500', 'bg-emerald-50/50');
                    }
                    if (detectedHpp > 0) {
                        inputHpp.value = Math.round(detectedHpp);
                        inputHpp.classList.add('ring-2', 'ring-emerald-500', 'bg-emerald-50/50');
                    }
                    if (detectedOps > 0) {
                        inputOps.value = Math.round(detectedOps);
                        inputOps.classList.add('ring-2', 'ring-emerald-500', 'bg-emerald-50/50');
                    }

                    // Jalankan simulasi laba rugi real-time
                    calculateLiveProfit();

                    // Tampilkan notifikasi keberhasilan deteksi
                    badgeEl.className = 'mt-2 p-3.5 rounded-2xl bg-emerald-50 border-2 border-emerald-400 text-emerald-950 text-xs flex items-center gap-3 shadow-sm';
                    hintEl.innerHTML = `
                        <strong class="text-emerald-900 text-xs block">
                            ✓ Berhasil Mendeteksi Data dari Berkas Excel!
                        </strong>
                        <span class="text-[11px] text-emerald-800 block mt-0.5">
                            Pemasukan: <strong>Rp ${Math.round(detectedPendapatan).toLocaleString('id-ID')}</strong> &bull; Total Pengeluaran: <strong>Rp ${Math.round(detectedHpp + detectedOps).toLocaleString('id-ID')}</strong>
                        </span>
                        <span class="text-[10px] text-emerald-700 block mt-0.5 italic">
                            Formulir telah terisi otomatis dan siap dihitung. Anda dapat menyesuaikan nominal sebelum menyimpan.
                        </span>
                    `;
                }
            }

            function handleFileSelected(event) {
                const file = event.target.files[0];
                const badge = document.getElementById('file-info-badge');
                const icon = document.getElementById('file-icon');
                const name = document.getElementById('file-name');
                const hint = document.getElementById('file-hint');

                if (!file) {
                    badge.classList.add('hidden');
                    return;
                }

                badge.classList.remove('hidden');
                badge.classList.add('flex');
                badge.className = 'mt-2 p-2.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-2.5';
                name.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';

                const ext = file.name.split('.').pop().toLowerCase();

                if (['xlsx', 'xls'].includes(ext)) {
                    icon.textContent = '📊';
                    hint.innerHTML = '<span class="text-emerald-700 animate-pulse">🔄 Membaca dan mendeteksi pemasukan & pengeluaran dari Excel...</span>';

                    // Parse dengan SheetJS di sisi browser
                    if (typeof XLSX !== 'undefined') {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            try {
                                const data = new Uint8Array(e.target.result);
                                const workbook = XLSX.read(data, { type: 'array' });
                                const firstSheetName = workbook.SheetNames[0];
                                const worksheet = workbook.Sheets[firstSheetName];
                                const rows = XLSX.utils.sheet_to_json(worksheet, { header: 1, defval: '' });
                                processParsedSpreadsheet(rows, file.name);
                            } catch (err) {
                                console.warn('Gagal membaca sheet Excel:', err);
                                hint.textContent = 'File Excel terlampir. Sistem di server akan memproses isi laporan saat disimpan.';
                            }
                        };
                        reader.readAsArrayBuffer(file);
                    } else {
                        hint.textContent = 'File Excel terlampir. Sistem di server akan otomatis mendeteksi omzet dan pengeluaran saat Anda klik Simpan.';
                    }
                } else if (ext === 'csv') {
                    icon.textContent = '📊';
                    hint.innerHTML = '<span class="text-emerald-700 animate-pulse">🔄 Membaca dan mendeteksi data CSV...</span>';

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        try {
                            const text = e.target.result;
                            const lines = text.split(/\r\n|\n/);
                            const delimiter = (text.indexOf(';') > text.indexOf(',')) ? ';' : ',';
                            const rows = lines.map(line => line.split(delimiter).map(c => c.trim().replace(/^["']|["']$/g, '')));
                            processParsedSpreadsheet(rows, file.name);
                        } catch (err) {
                            console.warn('Gagal membaca CSV:', err);
                            hint.textContent = 'File CSV terlampir.';
                        }
                    };
                    reader.readAsText(file);
                } else if (ext === 'pdf') {
                    icon.textContent = '📄';
                    hint.textContent = 'Dokumen PDF laporan keuangan siap dilampirkan.';
                } else if (['doc', 'docx'].includes(ext)) {
                    icon.textContent = '📝';
                    hint.textContent = 'Dokumen Word laporan keuangan siap dilampirkan.';
                } else if (['png', 'jpg', 'jpeg', 'webp', 'bmp'].includes(ext)) {
                    icon.textContent = '🖼️';
                    processImageOcr(file);
                } else {
                    icon.textContent = '📎';
                    hint.textContent = 'Berkas terlampir siap diunggah.';
                }
            }

            // =========================================================================
            // OCR (OPTICAL CHARACTER RECOGNITION) PEMINDAI FOTO NOTA / STRUK / KUITANSI
            // =========================================================================
            function preprocessImageForOcr(file) {
                return new Promise((resolve) => {
                    const img = new Image();
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.onload = function() {
                            try {
                                const canvas = document.createElement('canvas');
                                const scale = Math.max(1.5, Math.min(3, 2000 / Math.max(img.width, img.height)));
                                canvas.width = Math.round(img.width * scale);
                                canvas.height = Math.round(img.height * scale);
                                const ctx = canvas.getContext('2d');
                                ctx.imageSmoothingEnabled = true;
                                ctx.imageSmoothingQuality = 'high';
                                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                                const imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                                const d = imgData.data;
                                for (let i = 0; i < d.length; i += 4) {
                                    const gray = 0.299 * d[i] + 0.587 * d[i + 1] + 0.114 * d[i + 2];
                                    // Peningkatan kontras agar teks lebih tajam & angka terbaca sempurna
                                    const contrastVal = gray > 175 ? 255 : (gray < 95 ? 0 : gray);
                                    d[i] = contrastVal;
                                    d[i + 1] = contrastVal;
                                    d[i + 2] = contrastVal;
                                }
                                ctx.putImageData(imgData, 0, 0);
                                resolve(canvas.toDataURL('image/png'));
                            } catch (err) {
                                resolve(file); // fallback file mentah jika canvas gagal
                            }
                        };
                        img.onerror = function() { resolve(file); };
                        img.src = e.target.result;
                    };
                    reader.onerror = function() { resolve(file); };
                    reader.readAsDataURL(file);
                });
            }

            async function processImageOcr(file) {
                const hint = document.getElementById('file-hint');
                const icon = document.getElementById('file-icon');
                const submitBtn = document.getElementById('btn-submit-keuangan');
                const submitText = document.getElementById('btn-submit-keuangan-text');

                icon.textContent = '🔍';
                hint.innerHTML = '<span class="text-emerald-700 animate-pulse font-bold">🔄 Sedang mengoptimalkan & membaca teks dari foto nota (OCR)... <span id="ocr-progress">0%</span></span>';
                
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                }
                if (submitText) {
                    submitText.innerText = 'Memindai Foto Nota...';
                }

                if (typeof Tesseract === 'undefined') {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }
                    if (submitText) {
                        submitText.innerText = 'Simpan & Hitung Analisis Laba Rugi';
                    }
                    hint.textContent = 'Foto nota siap diunggah. Silakan lengkapi nominal pendapatan/beban di atas.';
                    return;
                }

                try {
                    // Pra-proses gambar (upscale & kontras) agar angka dan teks tabel tidak buram
                    const processedSource = await preprocessImageForOcr(file);

                    const result = await Tesseract.recognize(
                        processedSource,
                        'eng',
                        {
                            logger: m => {
                                if (m.status === 'recognizing text') {
                                    const progEl = document.getElementById('ocr-progress');
                                    if (progEl) {
                                        progEl.textContent = Math.round((m.progress || 0) * 100) + '%';
                                    }
                                }
                            }
                        }
                    );

                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }
                    if (submitText) {
                        submitText.innerText = 'Simpan & Hitung Analisis Laba Rugi';
                    }

                    const fullText = (result && result.data && result.data.text) ? result.data.text : '';
                    parseOcrExtractedText(fullText, file.name);
                } catch (err) {
                    console.warn('Gagal OCR Tesseract:', err);
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }
                    if (submitText) {
                        submitText.innerText = 'Simpan & Hitung Analisis Laba Rugi';
                    }
                    hint.textContent = 'Foto nota terlampir. Anda dapat mengisi nominal omzet di formulir.';
                }
            }

            function parseIndonesianCurrency(str) {
                if (!str) return 0;
                let s = String(str).trim().replace(/[^\d,\.]/g, '');
                if (!s) return 0;
                // Format 335,000 atau 335.000
                if (/^\d{1,3}[,\.]\d{3}$/.test(s)) {
                    return parseInt(s.replace(/[,\.]/g, ''), 10);
                }
                // Multi ribuan 1.000.000 atau 1,000,000
                if (/^\d{1,3}([,\.]\d{3})+$/.test(s)) {
                    return parseInt(s.replace(/[,\.]/g, ''), 10);
                }
                // Format digit murni 335000
                if (/^\d+$/.test(s)) {
                    return parseInt(s, 10);
                }
                s = s.replace(/,/g, '');
                const n = parseFloat(s);
                return isNaN(n) ? 0 : n;
            }

            function parseOcrExtractedText(text, fileName) {
                const hint = document.getElementById('file-hint');
                const icon = document.getElementById('file-icon');

                if (!text || text.trim().length === 0) {
                    hint.textContent = 'Foto terlampir. Teks angka belum terdeteksi jelas, silakan isi formulir secara manual.';
                    return;
                }

                const lines = text.split(/\r?\n/).map(l => l.trim()).filter(Boolean);
                const lowerText = text.toLowerCase();

                // Deteksi konteks nota penjualan vs belanja/pengeluaran
                const isPenjualan = /nota\s*penjualan|faktur\s*penjualan|invoice|penjualan|sales|omzet|pelanggan|customer|pembeli|terima\s*dari|kasir/i.test(lowerText);
                const isPengeluaran = /nota\s*pembelian|faktur\s*pembelian|pengeluaran|biaya|beban|kulakan|belanja|supplier|toko\s*bahan|kasbon/i.test(lowerText);

                // Regex mencari nominal angka utuh (dengan ribuan atau >= 4 digit)
                const numRegex = /(?:rp\.?\s*)?(\b\d{1,3}(?:[.,]\d{3})+(?:[.,]\d{2})?\b|\b\d{4,}\b|\b\d+\b)/gi;

                const candidateNumbers = [];

                for (let i = 0; i < lines.length; i++) {
                    const line = lines[i];
                    const lineLower = line.toLowerCase();

                    // Abaikan baris metadata dokumen (tanggal, no nota, metode bayar) agar tidak keliru mengambil nomor baris/tanggal
                    if (lineLower.includes('tanggal') || lineLower.includes('no.nota') || lineLower.includes('pembayaran') || lineLower.includes('metode')) {
                        continue;
                    }

                    const matches = line.matchAll(numRegex);
                    for (const m of matches) {
                        const val = parseIndonesianCurrency(m[1]);
                        if (val > 0) {
                            // Indikasi baris total, grand total, subtotal, jumlah, tagihan, sisa (termasuk variasi typo OCR)
                            const isTotalLine = /total|grand|subtotal|swtoal|tora|tota|jumlah|tagihan|netto|sisa/i.test(lineLower);
                            candidateNumbers.push({ val, line, isTotalLine });
                        }
                    }
                }

                // Saring kandidat nominal: utamakan nominal di baris Total yang merupakan angka ribuan (>= 1.000)
                const totalLineLargeCandidates = candidateNumbers.filter(c => c.isTotalLine && c.val >= 1000);
                const allLargeCandidates = candidateNumbers.filter(c => c.val >= 1000);

                let finalNominal = 0;
                if (totalLineLargeCandidates.length > 0) {
                    finalNominal = Math.max(...totalLineLargeCandidates.map(c => c.val));
                } else if (allLargeCandidates.length > 0) {
                    finalNominal = Math.max(...allLargeCandidates.map(c => c.val));
                } else if (candidateNumbers.length > 0) {
                    finalNominal = Math.max(...candidateNumbers.map(c => c.val));
                }

                if (finalNominal > 0) {
                    icon.textContent = '🧾';

                    let targetInputId = 'input-pendapatan';
                    let targetLabel = 'Total Pendapatan / Omzet';

                    if (isPengeluaran && !isPenjualan) {
                        targetInputId = 'input-operasional';
                        targetLabel = 'Beban Operasional Usaha';
                    }

                    const targetInput = document.getElementById(targetInputId);
                    if (targetInput) {
                        targetInput.value = Math.round(finalNominal);
                        // Efek visual highlight pada input yang terisi otomatis
                        targetInput.classList.add('ring-4', 'ring-emerald-400', 'bg-emerald-50');
                        setTimeout(() => {
                            targetInput.classList.remove('ring-4', 'ring-emerald-400', 'bg-emerald-50');
                        }, 2500);
                    }

                    // Isi catatan otomatis bila masih kosong
                    const catatanInput = document.getElementById('input-catatan');
                    if (catatanInput && (!catatanInput.value || catatanInput.value.includes('Terdeteksi Total'))) {
                        const tipeNota = (isPengeluaran && !isPenjualan) ? 'Pengeluaran/Belanja' : 'Penjualan/Omzet';
                        catatanInput.value = `Nota ${tipeNota} (${fileName}) - Terdeteksi Total Rp ${Math.round(finalNominal).toLocaleString('id-ID')}`;
                    }

                    calculateLiveProfit();

                    hint.innerHTML = `
                        <span class="font-black text-emerald-800 flex items-center gap-1.5">
                            <span class="text-emerald-600">✓</span> Berhasil Memindai Foto Nota: Rp ${Math.round(finalNominal).toLocaleString('id-ID')}
                        </span>
                        <span class="text-[10px] text-emerald-700 block mt-0.5">
                            Nominal otomatis diisikan ke kolom <b>${targetLabel}</b>. Anda dapat mengubah nominal jika diperlukan.
                        </span>
                    `;
                } else {
                    hint.textContent = 'Foto nota terlampir, namun teks total belum terdeteksi. Silakan lengkapi nominal di atas secara manual.';
                }
            }

            function calculateLiveProfit() {
                const pendapatan = parseFloat(document.getElementById('input-pendapatan').value) || 0;
                const hpp = parseFloat(document.getElementById('input-hpp').value) || 0;
                const ops = parseFloat(document.getElementById('input-operasional').value) || 0;
                const lain = parseFloat(document.getElementById('input-lain').value) || 0;

                const totalBeban = hpp + ops + lain;
                const laba = pendapatan - totalBeban;

                const textEl = document.getElementById('live-profit-text');
                const badgeEl = document.getElementById('live-profit-badge');

                if (pendapatan === 0 && totalBeban === 0) {
                    textEl.innerText = 'Rp 0';
                    textEl.className = 'text-lg font-black text-gray-700 mt-0.5';
                    badgeEl.innerText = 'Belum Diisi';
                    badgeEl.className = 'px-3 py-1 rounded-full text-xs font-black bg-gray-200 text-gray-700';
                    return;
                }

                if (laba > 0) {
                    textEl.innerText = '+ Rp ' + laba.toLocaleString('id-ID');
                    textEl.className = 'text-lg font-black text-emerald-700 mt-0.5';
                    badgeEl.innerText = '🟢 Untung (Laba)';
                    badgeEl.className = 'px-3 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800';
                } else if (laba < 0) {
                    textEl.innerText = '- Rp ' + Math.abs(laba).toLocaleString('id-ID');
                    textEl.className = 'text-lg font-black text-rose-600 mt-0.5';
                    badgeEl.innerText = '🔴 Rugi (Defisit)';
                    badgeEl.className = 'px-3 py-1 rounded-full text-xs font-black bg-rose-100 text-rose-800';
                } else {
                    textEl.innerText = 'Rp 0 (Impas)';
                    textEl.className = 'text-lg font-black text-blue-700 mt-0.5';
                    badgeEl.innerText = '⚪ Impas (BEP)';
                    badgeEl.className = 'px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-blue-800';
                }
            }

            function editKeuangan(id, bulan, pendapatan, hpp, ops, lain, catatan) {
                document.getElementById('form-id-keuangan').value = id;
                document.getElementById('input-bulan-tahun').value = bulan;
                document.getElementById('input-pendapatan').value = Math.round(parseFloat(pendapatan) || 0);
                document.getElementById('input-hpp').value = Math.round(parseFloat(hpp) || 0);
                document.getElementById('input-operasional').value = Math.round(parseFloat(ops) || 0);
                document.getElementById('input-lain').value = Math.round(parseFloat(lain) || 0);
                document.getElementById('input-catatan').value = catatan || '';

                document.getElementById('edit-mode-banner').classList.remove('hidden');
                document.getElementById('edit-periode-text').innerText = bulan;
                document.getElementById('mode-aksi-container').classList.add('hidden');
                document.getElementById('btn-cancel-edit').classList.remove('hidden');
                document.getElementById('btn-submit-keuangan-text').innerText = 'Perbarui Catatan Ini';

                calculateLiveProfit();
                document.getElementById('form-keuangan').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            function cancelEditKeuangan() {
                document.getElementById('form-id-keuangan').value = '';
                document.getElementById('edit-mode-banner').classList.add('hidden');
                document.getElementById('mode-aksi-container').classList.remove('hidden');
                document.getElementById('btn-cancel-edit').classList.add('hidden');
                document.getElementById('btn-submit-keuangan-text').innerText = 'Simpan & Hitung Analisis Laba Rugi';
                document.getElementById('input-pendapatan').value = '';
                document.getElementById('input-hpp').value = '';
                document.getElementById('input-operasional').value = '';
                document.getElementById('input-lain').value = '';
                document.getElementById('input-catatan').value = '';
                calculateLiveProfit();
            }
        </script>

    {{-- ========================================================================= --}}
    {{-- TAB 4: BANTUAN                                                            --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'bantuan')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">Pusat Bantuan</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Dukungan dan konsultasi bisnis untuk pelaku UMKM.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-[#E8E6DF] shadow-sm max-w-2xl">
            <h3 class="text-lg font-black text-[#1A202C] mb-2">Butuh Bantuan Operasional atau Sewa Ruko?</h3>
            <p class="text-xs text-gray-600 mb-6 leading-relaxed">
                Tim kurator dan pendamping usaha DAYA UMKM siap membantu proses verifikasi proposal, konsultasi tata kelola keuangan, dan pemilihan ruko strategis.
            </p>
            <a href="https://wa.me/6281234567890?text=Halo%20Tim%20DAYA%20UMKM,%20saya%20butuh%20bantuan%20terkait%20dashboard%20usaha." target="_blank"
               class="px-6 py-3 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm inline-flex items-center gap-2">
                <span>Hubungi CS WhatsApp DAYA UMKM</span> &rarr;
            </a>
        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 5: INFORMASI RUKO                                                     --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'ruko')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">Informasi Ruko Komersial</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Ruko strategis yang dapat Anda sewa setelah pendanaan disetujui.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($rukos as $ruko)
                <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm">
                    <div class="w-full h-36 rounded-2xl bg-[#6B9E8A] text-white flex items-center justify-center font-bold mb-4">
                        Unit Ruko Komersial
                    </div>
                    <h3 class="text-base font-black text-[#1A202C]">{{ $ruko->nama_ruko }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $ruko->lokasi }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-black text-[#0F433C]">
                            Rp {{ number_format($ruko->harga_sewa_per_bulan, 0, ',', '.') }} / bln
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                            {{ ucfirst($ruko->status_ketersediaan) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl p-8 text-center text-xs text-gray-500">
                    Belum ada unit ruko yang terdaftar.
                </div>
            @endforelse
        </div>

    @endif

</div>

<!-- MODAL TAMBAH PRODUK -->
<div id="add-product-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-gray-100 animate-scale-up">
        <h3 class="text-xl font-black text-[#1A202C] mb-1">Tambah Produk Baru</h3>
        <p class="text-xs text-gray-500 mb-4">Masukkan data produk jualan Anda ke katalog toko.</p>

        <form action="{{ route('dashboard.umkm.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Produk *</label>
                <input type="text" name="nama_produk" required placeholder="Contoh: Keripik Singkong Balado"
                       class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Harga (Rp) *</label>
                    <input type="number" name="harga" required placeholder="35000"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Stok Unit *</label>
                    <input type="number" name="stok" required value="10"
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Status Ketersediaan</label>
                <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Foto Produk</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs text-gray-500">
            </div>

            <div class="grid grid-cols-2 gap-3 pt-3">
                <button type="button" onclick="closeAddProductModal()" class="py-2.5 px-4 rounded-xl border border-gray-300 text-gray-700 text-xs font-bold hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="py-2.5 px-4 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT PRODUK -->
<div id="edit-product-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl border border-gray-100 animate-scale-up">
        <h3 class="text-xl font-black text-[#1A202C] mb-1">Perbarui Produk</h3>
        <p class="text-xs text-gray-500 mb-4">Ubah informasi harga, stok, atau nama produk.</p>

        <form id="edit-product-form" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Produk *</label>
                <input type="text" id="edit-nama-produk" name="nama_produk" required
                       class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Harga (Rp) *</label>
                    <input type="number" id="edit-harga" name="harga" required
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Stok Unit *</label>
                    <input type="number" id="edit-stok" name="stok" required
                           class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Status Ketersediaan</label>
                <select id="edit-status" name="status" class="w-full px-4 py-2.5 rounded-xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-3">
                <button type="button" onclick="closeEditProductModal()" class="py-2.5 px-4 rounded-xl border border-gray-300 text-gray-700 text-xs font-bold hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="py-2.5 px-4 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddProductModal() {
        document.getElementById('add-product-modal').classList.remove('hidden');
    }
    function closeAddProductModal() {
        document.getElementById('add-product-modal').classList.add('hidden');
    }

    function openEditProductModal(id, nama, harga, stok, status, deskripsi) {
        document.getElementById('edit-product-form').action = '/dashboard/umkm/produk/' + id + '/update';
        document.getElementById('edit-nama-produk').value = nama;
        document.getElementById('edit-harga').value = Math.round(harga);
        document.getElementById('edit-stok').value = stok;
        document.getElementById('edit-status').value = status;
        document.getElementById('edit-product-modal').classList.remove('hidden');
    }
    function closeEditProductModal() {
        document.getElementById('edit-product-modal').classList.add('hidden');
    }
</script>
@endsection
