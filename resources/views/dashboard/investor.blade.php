@extends('layouts.investor')

@section('title', 'Dashboard Mitra Investor - DAYA UMKM')

@section('content')
<div class="space-y-8">

    {{-- ========================================================================= --}}
    {{-- TAB 1: BERANDA INVESTOR (Sesuai Gambar 3)                                  --}}
    {{-- ========================================================================= --}}
    @if(($activeTab ?? 'beranda') === 'beranda')

        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">BERANDA</h1>
                <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                    Halo, <span class="font-bold text-[#0F433C]">{{ $user->name }}</span>. Ringkasan portofolio pendanaan UMKM Anda.
                </p>
            </div>
            
            <a href="{{ route('dashboard', ['tab' => 'proposal']) }}" 
               class="px-5 py-2.5 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm inline-flex items-center gap-2 self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Jelajahi Proposal UMKM</span>
            </a>
        </div>

        <!-- 4 KARTU METRIK KPI INVESTOR -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            
            <!-- KARTU 1: Total Modal Disalurkan -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-[#E0F7F6] text-[#00A389] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Total Modal Disalurkan</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    Rp {{ number_format($totalModalDiinvestasikan, 0, ',', '.') }}
                </h3>
                <span class="text-[11px] text-gray-400 font-medium">Portofolio aktif</span>
            </div>

            <!-- KARTU 2: Jumlah UMKM Didanai -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-[#FEF9E7] text-[#F1C40F] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Mitra UMKM Didanai</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    {{ $umkmDidanaiCount }} Usaha
                </h3>
                <span class="text-[11px] text-gray-400 font-medium">Bermitra produktif</span>
            </div>

            <!-- KARTU 3: Proposal Tersedia -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-[#EDF2FE] text-[#4F73D9] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Proposal Siap Didanai</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    {{ $availableProposalsCount }}
                </h3>
                <a href="{{ route('dashboard', ['tab' => 'proposal']) }}" class="text-[11px] font-bold text-blue-600 hover:underline">
                    Buka katalog &rarr;
                </a>
            </div>

            <!-- KARTU 4: Rata-Rata Dividen / Bagi Hasil -->
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-2xl bg-[#FDECEB] text-[#E74C3C] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <p class="text-xs font-bold text-gray-500">Estimasi Bagi Hasil</p>
                <h3 class="text-2xl sm:text-3xl font-black text-[#1A202C] mt-1 tracking-tight">
                    15.2% <span class="text-sm font-bold text-gray-400">p.a.</span>
                </h3>
                <span class="text-[11px] text-emerald-600 font-bold">Imbal hasil kompetitif</span>
            </div>

        </div>

        <!-- TABEL RIWAYAT PENDANAAN SAYA -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#E8E6DF] shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-black text-[#1A202C]">Riwayat Komitmen & Portofolio Investasi</h2>
                    <p class="text-xs text-gray-400 font-medium">Usaha UMKM yang telah Anda ajukan pendanaan</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#F9F8F3] border-b border-[#E8E6DF] text-[11px] font-black uppercase tracking-wider text-gray-500">
                            <th class="py-3.5 px-5">Mitra UMKM</th>
                            <th class="py-3.5 px-5">Nominal Modal</th>
                            <th class="py-3.5 px-5">Bagi Hasil</th>
                            <th class="py-3.5 px-5">Periode</th>
                            <th class="py-3.5 px-5">Status</th>
                            <th class="py-3.5 px-5">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs font-medium">
                        @forelse($investasiSaya as $inv)
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="py-3.5 px-5">
                                    <div class="font-extrabold text-[#1A202C]">{{ $inv->umkm->nama_usaha ?? 'Usaha UMKM' }}</div>
                                    <div class="text-[11px] text-gray-400">{{ $inv->umkm->pemilik ?? '-' }} &bull; {{ $inv->umkm->jenis_usaha ?? '-' }}</div>
                                </td>
                                <td class="py-3.5 px-5 font-black text-emerald-700">
                                    Rp {{ number_format($inv->jumlah_modal, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-5 font-bold text-gray-800">
                                    {{ $inv->persentase_bagi_hasil }}%
                                </td>
                                <td class="py-3.5 px-5 text-gray-600">
                                    {{ $inv->periode_pembagian }}
                                </td>
                                <td class="py-3.5 px-5">
                                    @if($inv->status === 'aktif' || $inv->status === 'disetujui')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Aktif Didanai
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            Terkirim ke UMKM
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-5 text-gray-500">
                                    {{ $inv->tanggal_investasi ? $inv->tanggal_investasi->format('d M Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400 text-xs">
                                    Anda belum memiliki riwayat pengajuan investasi. Jelajahi menu <a href="{{ route('dashboard', ['tab' => 'proposal']) }}" class="text-[#0F433C] font-bold underline">PROPOSAL LIST</a> untuk mulai mendanai UMKM.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SEKSI KATALOG PELUANG INVESTASI (Preview Proposal Pilihan) -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-[#1A202C]">Katalog Peluang Investasi</h2>
                    <p class="text-xs text-gray-400 font-medium">Proposal usaha pilihan yang siap menerima pendanaan</p>
                </div>
                <a href="{{ route('dashboard', ['tab' => 'proposal']) }}" class="text-xs font-bold text-[#0F433C] hover:underline">
                    Buka PROPOSAL LIST Lengkap &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @forelse($availableProposals->take(3) as $umkm)
                    <div class="bg-white rounded-3xl p-5 border border-[#E8E6DF] shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded-full bg-teal-50 text-teal-800 border border-teal-200">
                                    {{ $umkm->jenis_usaha }}
                                </span>
                                <span class="text-xs font-black text-emerald-700">
                                    {{ $umkm->persentase_bagi_hasil ?: ($umkm->estimasi_bagi_hasil ?: '15% p.a.') }}
                                </span>
                            </div>
                            <h3 class="text-sm font-black text-[#1A202C] truncate">{{ $umkm->nama_usaha }}</h3>
                            <p class="text-[11px] text-gray-500 mt-0.5">Pemilik: {{ $umkm->pemilik }} &bull; {{ $umkm->provinsi_kota ?? '-' }}</p>
                            <p class="text-xs font-extrabold text-[#0F433C] mt-2">
                                Target: Rp {{ number_format($umkm->target_pendanaan ?: ($umkm->modal_dibutuhkan ?: 25000000), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-gray-100">
                            <button onclick="openInvestModal('{{ $umkm->id_umkm }}', '{{ addslashes($umkm->nama_usaha) }}', '{{ $umkm->target_pendanaan ?: ($umkm->modal_dibutuhkan ?: 25000000) }}', '{{ $umkm->persentase_bagi_hasil ?: 15 }}')"
                                    class="w-full py-2 px-3 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition">
                                Investasi Sekarang
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-6 text-center text-xs text-gray-400 bg-white rounded-3xl border border-[#E8E6DF]">
                        Belum ada proposal UMKM terverifikasi.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- SEKSI RUKO STRATEGIS SIAP DITEMPATI UMKM -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-[#1A202C]">Ruko Strategis Siap Ditempati UMKM</h2>
                    <p class="text-xs text-gray-400 font-medium">Titik lokasi komersial untuk ekspansi gerai UMKM mitra</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @forelse($rukos->take(3) as $ruko)
                    <div class="bg-white rounded-3xl p-5 border border-[#E8E6DF] shadow-sm">
                        <div class="w-full h-28 rounded-xl bg-[#6B9E8A] text-white flex items-center justify-center font-bold text-xs mb-3">
                            Unit Ruko Komersial
                        </div>
                        <h3 class="text-sm font-black text-[#1A202C] truncate">{{ $ruko->nama_ruko }}</h3>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $ruko->lokasi }}</p>
                        <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between items-center text-xs">
                            <span class="font-black text-[#0F433C]">Rp {{ number_format($ruko->harga_sewa_per_bulan, 0, ',', '.') }} / bln</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-emerald-100 text-emerald-800">Tersedia</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-6 text-center text-xs text-gray-400 bg-white rounded-3xl border border-[#E8E6DF]">
                        Belum ada unit ruko terdaftar.
                    </div>
                @endforelse
            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 2: PROPOSAL LIST (Fitur Inti Permintaan User)                         --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'proposal')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">PROPOSAL LIST</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Pilih proposal usaha UMKM terverifikasi dan ajukan komitmen investasi untuk mendorong pertumbuhan bisnis mereka.
            </p>
        </div>

        <!-- SEARCH BAR & FILTER KATEGORI -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <input type="hidden" name="tab" value="proposal">

                <!-- Search -->
                <div class="relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari usaha / pemilik..."
                           class="w-56 sm:w-72 px-4 py-2.5 rounded-2xl bg-white border border-[#E8E6DF] text-xs font-semibold placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>

                <!-- Kategori Buttons -->
                <a href="{{ route('dashboard', ['tab' => 'proposal', 'kategori' => 'semua']) }}" 
                   class="px-4 py-2 rounded-2xl text-xs font-bold transition {{ (request('kategori') === 'semua' || !request('kategori')) ? 'bg-[#0F433C] text-white shadow-sm' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Semua
                </a>
                <a href="{{ route('dashboard', ['tab' => 'proposal', 'kategori' => 'Makanan']) }}" 
                   class="px-4 py-2 rounded-2xl text-xs font-bold transition {{ request('kategori') === 'Makanan' ? 'bg-[#0F433C] text-white shadow-sm' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Kuliner & Makanan
                </a>
                <a href="{{ route('dashboard', ['tab' => 'proposal', 'kategori' => 'Fashion']) }}" 
                   class="px-4 py-2 rounded-2xl text-xs font-bold transition {{ request('kategori') === 'Fashion' ? 'bg-[#0F433C] text-white shadow-sm' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Fashion & Busana
                </a>
                <a href="{{ route('dashboard', ['tab' => 'proposal', 'kategori' => 'Jasa']) }}" 
                   class="px-4 py-2 rounded-2xl text-xs font-bold transition {{ request('kategori') === 'Jasa' ? 'bg-[#0F433C] text-white shadow-sm' : 'bg-white border border-[#E8E6DF] text-gray-600 hover:bg-gray-50' }}">
                    Jasa
                </a>
            </form>
        </div>

        <!-- GRID DAFTAR PROPOSAL UMKM -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7">
            @forelse($availableProposals as $umkm)
                <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <!-- Header Kartu -->
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-teal-50 text-teal-800 border border-teal-200">
                                {{ $umkm->jenis_usaha }}
                            </span>
                            @if($umkm->status_pengajuan === 'terverifikasi')
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800">
                                    ✓ Terverifikasi
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800">
                                    Ditinjau
                                </span>
                            @endif
                        </div>

                        <!-- Foto & Nama Usaha -->
                        <div class="w-full h-44 rounded-2xl bg-[#6B9E8A] text-white flex items-center justify-center font-black text-xl mb-4 overflow-hidden shadow-inner">
                            @if(!empty($umkm->foto_produk))
                                <img src="{{ asset('storage/' . $umkm->foto_produk) }}" alt="{{ $umkm->nama_usaha }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center">
                                    <svg class="w-10 h-10 mx-auto opacity-80 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    <span class="text-xs font-bold uppercase">{{ $umkm->nama_usaha }}</span>
                                </div>
                            @endif
                        </div>

                        <h3 class="text-base font-black text-[#1A202C] leading-snug">
                            {{ $umkm->nama_usaha }}
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Pemilik: <span class="font-bold text-gray-700">{{ $umkm->pemilik }}</span> &bull; {{ $umkm->provinsi_kota ?? 'Lokasi belum diisi' }}
                        </p>

                        <!-- Nilai Pendanaan & Bagi Hasil -->
                        <div class="mt-4 p-4 rounded-2xl bg-[#F9F8F3] border border-[#E8E6DF] space-y-2 text-xs">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Target Pendanaan:</span>
                                <span class="font-extrabold text-[#0F433C] text-sm">
                                    Rp {{ number_format($umkm->target_pendanaan ?: ($umkm->modal_dibutuhkan ?: 25000000), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500 font-medium">Bagi Hasil Ditawarkan:</span>
                                <span class="font-bold text-emerald-700">
                                    {{ $umkm->persentase_bagi_hasil ?: ($umkm->estimasi_bagi_hasil ?: '15% p.a.') }}
                                </span>
                            </div>
                            @if($umkm->ruko)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-medium">Pilihan Ruko:</span>
                                    <span class="font-semibold text-gray-800 truncate max-w-[130px]">
                                        {{ $umkm->ruko->nama_ruko }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Tautan Dokumen Proposal PDF -->
                        @if(!empty($umkm->dokumen_proposal) || !empty($umkm->file_proposal))
                            @php
                                $propPath = $umkm->dokumen_proposal ?? $umkm->file_proposal;
                            @endphp
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $propPath) }}" target="_blank" 
                                   class="flex items-center gap-2 p-2.5 rounded-xl bg-teal-50 hover:bg-teal-100 text-teal-900 border border-teal-200 text-xs font-bold transition">
                                    <svg class="w-4 h-4 text-teal-700 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="truncate">Baca Berkas Proposal Lengkap (PDF)</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- TOMBOL INVESTASI SEKARANG (Fitur Inti Permintaan User) -->
                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <button onclick="openInvestModal('{{ $umkm->id_umkm }}', '{{ addslashes($umkm->nama_usaha) }}', '{{ $umkm->target_pendanaan ?: ($umkm->modal_dibutuhkan ?: 25000000) }}', '{{ $umkm->persentase_bagi_hasil ?: 15 }}')"
                                class="w-full py-3 px-4 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-black shadow-md transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-amber-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span>Investasi Sekarang</span>
                        </button>
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-[#E8E6DF]">
                    <div class="w-16 h-16 rounded-full bg-gray-100 text-gray-400 mx-auto flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800">Tidak ada proposal UMKM yang cocok</h3>
                    <p class="text-xs text-gray-500 mt-1">Coba ubah kata kunci atau pilih kategori lain.</p>
                </div>
            @endforelse
        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 3: KOMUNITAS INVESTOR & UMKM (Sesuai Gambar 3)                        --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'komunitas')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">KOMUNITAS</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Jejaring kemitraan, forum diskusi, dan berbagi pengalaman investasi UMKM.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-[#E8E6DF] shadow-sm max-w-2xl">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 text-[#0F433C] flex items-center justify-center font-bold">
                    👥
                </div>
                <div>
                    <h3 class="text-base font-black text-[#1A202C]">Forum Investor Daya UMKM</h3>
                    <p class="text-xs text-gray-500">Beranggotakan 240+ mitra investor dan kurator bisnis.</p>
                </div>
            </div>
            <p class="text-xs text-gray-600 leading-relaxed mb-6">
                Terhubung dengan sesama investor untuk berdiskusi mengenai skema sindikasi pendanaan, evaluasi kinerja UMKM, dan peluang pembukaan gerai ruko baru.
            </p>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bergabung%20dengan%20Grup%20Komunitas%20Investor%20DAYA%20UMKM." target="_blank"
               class="px-5 py-2.5 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm inline-flex items-center gap-2">
                <span>Gabung Grup WhatsApp Komunitas</span> &rarr;
            </a>
        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 4: LAPORAN KEUANGAN                                                   --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'keuangan')

        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">LAPORAN KEUANGAN</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Pencatatan dividen, pembagian keuntungan, dan rekonsiliasi dana investasi.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-[#E8E6DF] shadow-sm">
            <h3 class="text-base font-black text-[#1A202C] mb-2">Ringkasan Pembagian Dividen Terjadwal</h3>
            <p class="text-xs text-gray-500 mb-6">Jadwal pembagian dividen bagi hasil dari UMKM mitra Anda:</p>

            <div class="space-y-3">
                <div class="p-4 rounded-2xl bg-[#F9F8F3] border border-[#E8E6DF] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="text-xs font-bold text-gray-800">Periode Dividen Bulan Berjalan</span>
                        <p class="text-[11px] text-gray-500">Estimasi pencairan pada akhir bulan</p>
                    </div>
                    <span class="text-sm font-black text-emerald-700">Rp 3.750.000 (Proyeksi)</span>
                </div>
            </div>
        </div>

    @endif

</div>

<!-- MODAL PENGAJUAN MINAT INVESTASI (Fitur Kunci) -->
<div id="invest-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-gray-100 animate-scale-up">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center font-black text-xl shrink-0">
                💰
            </div>
            <div>
                <h3 class="text-lg sm:text-xl font-black text-[#1A202C]">Ajukan Minat Investasi</h3>
                <p class="text-xs text-gray-500">Mendanai usaha <span id="invest-modal-nama-usaha" class="font-bold text-[#0F433C]"></span></p>
            </div>
        </div>

        <p class="text-xs text-gray-600 mb-5 bg-amber-50 p-3 rounded-2xl border border-amber-200">
            Setelah Anda mengirim formulir ini, <strong>Pelaku UMKM akan langsung menerima notifikasi resmi di dashboard mereka</strong> beserta kontak Anda untuk memulai koordinasi pendanaan.
        </p>

        <form id="form-invest-proposal" action="" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nominal Komitmen Modal (Rp) *</label>
                <input type="number" id="invest-modal-nominal" name="jumlah_modal" required min="500000" step="50000"
                       class="w-full px-4 py-3 rounded-2xl border border-[#E8E6DF] text-sm font-bold text-[#0F433C] focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                <span class="text-[10px] text-gray-400 mt-1 block">Minimal investasi Rp 500.000</span>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Periode Pembagian</label>
                    <select name="periode_pembagian" class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                        <option value="Bulanan">Setiap Bulan</option>
                        <option value="Triwulan">Setiap 3 Bulan (Triwulan)</option>
                        <option value="Semesteran">Setiap 6 Bulan (Semesteran)</option>
                        <option value="Tahunan">Tahunan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Bagi Hasil (%)</label>
                    <input type="number" id="invest-modal-persen" name="persentase_bagi_hasil" min="1" max="99" step="0.5"
                           class="w-full px-4 py-2.5 rounded-2xl border border-[#E8E6DF] text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-[#0F433C]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Pesan / Catatan untuk Pelaku UMKM</label>
                <textarea name="catatan" rows="3" placeholder="Contoh: Halo, saya tertarik dengan prospek produk Anda. Kapan kita bisa mendiskusikan rencana penggunaan modal dan pencairan?"
                          class="w-full p-3 rounded-2xl border border-[#E8E6DF] text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[#0F433C]"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-3">
                <button type="button" onclick="closeInvestModal()" class="py-2.5 px-4 rounded-xl border border-gray-300 text-gray-700 text-xs font-bold hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="py-2.5 px-4 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm">
                    Kirim Minat Investasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openInvestModal(idUmkm, namaUsaha, target, persen) {
        document.getElementById('invest-modal-nama-usaha').innerText = namaUsaha;
        document.getElementById('invest-modal-nominal').value = target ? Math.min(target, 10000000) : 5000000;
        document.getElementById('invest-modal-persen').value = persen ? persen : 15;
        document.getElementById('form-invest-proposal').action = '/dashboard/investor/invest/' + idUmkm;
        document.getElementById('invest-modal').classList.remove('hidden');
    }
    function closeInvestModal() {
        document.getElementById('invest-modal').classList.add('hidden');
    }
</script>
@endsection
