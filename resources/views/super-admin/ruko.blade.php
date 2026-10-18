@extends('layouts.super-admin')

@section('title', 'Kurasi & Katalog Ruko Komersial - DAYA UMKM')

@section('content')
<div class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-teal-100 text-[#0F433C]">
                    Pilar Properti Komersial
                </span>
                <span class="text-xs text-gray-400 font-bold">&bull; Crowdsourcing & Kurasi Kelayakan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C] mt-1">KURASI & KATALOG RUKO</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Pusat kendali peninjauan kelayakan usulan tempat usaha dari investor, pelaku UMKM, dan masyarakat umum sebelum resmi diterbitkan.
            </p>
        </div>

        <div class="flex items-center gap-2.5 self-start sm:self-auto">
            <a href="{{ route('ruko.usulkan.public') }}" target="_blank"
               class="px-5 py-2.5 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold transition shadow-sm inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>+ Buka Form Publik</span>
            </a>
        </div>
    </div>

    <!-- TAB NAVIGASI KURASI VS KATALOG AKTIF -->
    <div class="flex flex-wrap items-center gap-2 p-1.5 bg-white rounded-2xl border border-[#E8E6DF] w-fit shadow-sm">
        <a href="{{ route('superadmin.ruko', ['tab' => 'kurasi']) }}"
           class="px-5 py-2.5 rounded-xl text-xs font-black tracking-wider uppercase transition flex items-center gap-2 {{ ($activeTab ?? 'kurasi') === 'kurasi' ? 'bg-[#0F433C] text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
            <span>KURASI USULAN MASUK</span>
            @if(isset($pendingRukoCount) && $pendingRukoCount > 0)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ ($activeTab ?? 'kurasi') === 'kurasi' ? 'bg-amber-400 text-amber-950' : 'bg-amber-100 text-amber-800' }}">
                    {{ $pendingRukoCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('superadmin.ruko', ['tab' => 'katalog']) }}"
           class="px-5 py-2.5 rounded-xl text-xs font-black tracking-wider uppercase transition flex items-center gap-2 {{ ($activeTab ?? '') === 'katalog' ? 'bg-[#0F433C] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
            <span>KATALOG RUKO AKTIF</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ ($activeTab ?? '') === 'katalog' ? 'bg-teal-300 text-teal-950' : 'bg-gray-100 text-gray-600' }}">
                {{ $rukos->total() ?? $rukos->count() }}
            </span>
        </a>
    </div>

    {{-- ========================================================================= --}}
    {{-- TAB 1: KURASI USULAN MASUK DARI CROWDSOURCING (INVESTOR, UMKM, PUBLIK)      --}}
    {{-- ========================================================================= --}}
    @if(($activeTab ?? 'kurasi') === 'kurasi')

        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-black text-[#1A202C]">Daftar Usulan Tempat Usaha</h2>
                    <p class="text-xs text-gray-400">Verifikasi kelayakan harga, akses jalan, dan potensi pasar ruko sebelum disetujui (ACC).</p>
                </div>
                <div class="text-xs font-bold text-gray-500">
                    Total Usulan: <span class="text-[#0F433C] font-black">{{ $rekomendasiRukos->count() }} Lokasi</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($rekomendasiRukos as $item)
                    <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <!-- Header Kartu: Status & Pengusul -->
                            <div class="flex items-start justify-between gap-2 mb-3">
                                <div>
                                    @if($item->tipe_pengusul === 'investor')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            🟢 Mitra Investor
                                        </span>
                                    @elseif($item->tipe_pengusul === 'umkm')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-sky-100 text-sky-800 border border-sky-200">
                                            🔵 Pelaku UMKM
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-amber-100 text-amber-900 border border-amber-200">
                                            🟡 Publik / Warga
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    @if($item->status === 'disetujui')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-500 text-white shadow-sm">
                                            ✓ Terbit di Katalog
                                        </span>
                                    @elseif($item->status === 'ditolak')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-rose-100 text-rose-700 border border-rose-200">
                                            ✕ Ditolak
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase bg-amber-400 text-amber-950 animate-pulse">
                                            ● Menunggu ACC
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- FOTO RUKO / ILUSTRASI FISIK -->
                            <div class="w-full h-44 rounded-2xl bg-gray-100 mb-4 overflow-hidden relative shadow-inner border border-gray-100 group">
                                @if(!empty($item->foto_ruko))
                                    <img src="{{ asset($item->foto_ruko) }}" alt="{{ $item->nama_ruko }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <a href="{{ asset($item->foto_ruko) }}" target="_blank" class="absolute bottom-2 right-2 px-2.5 py-1 rounded-lg bg-black/60 backdrop-blur-sm text-white text-[10px] font-bold hover:bg-black/80 transition">
                                        🔍 Lihat Foto Penuh
                                    </a>
                                @else
                                    <div class="w-full h-full bg-[#6B9E8A] text-white flex items-center justify-center font-black text-xl">
                                        <div class="text-center p-4">
                                            <svg class="w-10 h-10 mx-auto opacity-80 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <span class="text-xs font-bold uppercase tracking-wider block">Foto Belum Diunggah</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-base font-black text-[#1A202C] leading-snug">
                                {{ $item->nama_ruko }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-1 flex items-start gap-1.5">
                                <svg class="w-3.5 h-3.5 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="line-clamp-2">{{ $item->lokasi }}</span>
                            </p>

                            <!-- RINCIAN FINANSIAL & PENGUSUL -->
                            <div class="mt-4 p-3.5 rounded-2xl bg-[#F9F8F3] border border-[#E8E6DF] space-y-2 text-xs">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-medium">Usulan Harga Sewa:</span>
                                    <span class="font-black text-[#0F433C] text-sm">
                                        Rp {{ number_format($item->harga_sewa_per_bulan, 0, ',', '.') }} / bln
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-medium">Diajukan Oleh:</span>
                                    <span class="font-bold text-gray-800 truncate max-w-[170px]" title="{{ $item->label_pengusul }}">
                                        {{ $item->label_pengusul }}
                                    </span>
                                </div>
                                @if(!empty($item->kontak_pemilik) || !empty($item->kontak_pengusul))
                                    <div class="flex justify-between items-center pt-2 border-t border-gray-200/60">
                                        <span class="text-gray-500 font-medium">Kontak HP/WA:</span>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->kontak_pemilik ?: $item->kontak_pengusul) }}" target="_blank" class="font-bold text-emerald-700 hover:underline">
                                            {{ $item->kontak_pemilik ?: $item->kontak_pengusul }} ↗
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- ANALISIS POTENSI USAHA -->
                            @if(!empty($item->potensi_usaha))
                                <div class="mt-3 p-3 rounded-xl bg-teal-50/70 border border-teal-200/70 text-[11px] text-teal-950">
                                    <strong class="block text-[10px] uppercase font-black text-teal-800 mb-0.5">Analisis Potensi Pasar:</strong>
                                    <p class="italic line-clamp-3">"{{ $item->potensi_usaha }}"</p>
                                </div>
                            @endif

                            @if(!empty($item->catatan_admin))
                                <div class="mt-3 p-3 rounded-xl bg-gray-50 border border-gray-200 text-[11px] text-gray-700">
                                    <strong class="block text-[10px] uppercase font-black text-gray-500 mb-0.5">Catatan Kurasi Admin:</strong>
                                    <p>{{ $item->catatan_admin }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- TOMBOL AKSI KURASI ADMIN -->
                        <div class="mt-5 pt-4 border-t border-gray-100">
                            @if($item->status === 'menunggu_verifikasi')
                                <div class="grid grid-cols-2 gap-2">
                                    <!-- FORM ACC / APPROVE -->
                                    <form id="form-approve-ruko-{{ $item->id_rekomendasi }}" action="{{ route('superadmin.ruko.rekomendasi.approve', $item->id_rekomendasi) }}" method="POST">
                                        @csrf
                                        <button type="button"
                                                onclick="openAppConfirmModal({
                                                    title: 'ACC & Terbitkan Ruko',
                                                    message: 'Apakah Anda yakin ruko <strong>{{ addslashes($item->nama_ruko) }}</strong> LAYAK dan ingin menerbitkannya ke Katalog Ruko Resmi DAYA UMKM?',
                                                    badge: 'Rp {{ number_format($item->harga_sewa_per_bulan, 0, ',', '.') }}/bln &bull; {{ addslashes($item->nama_ruko) }}',
                                                    confirmText: '✓ Ya, ACC & Terbitkan',
                                                    confirmClass: 'bg-[#0F433C] hover:bg-[#19584F] text-white',
                                                    icon: 'check',
                                                    form: document.getElementById('form-approve-ruko-{{ $item->id_rekomendasi }}')
                                                })"
                                                class="w-full py-2.5 px-3 rounded-xl bg-[#0F433C] hover:bg-[#19584F] text-white text-xs font-bold text-center transition shadow-sm flex items-center justify-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>✓ ACC (Terbitkan)</span>
                                        </button>
                                    </form>

                                    <!-- FORM REJECT / TOLAK -->
                                    <button type="button"
                                            onclick="openRejectRukoModal('{{ $item->id_rekomendasi }}', '{{ addslashes($item->nama_ruko) }}')"
                                            class="w-full py-2.5 px-3 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 text-xs font-bold text-center transition">
                                        ✕ Tidak Layak
                                    </button>
                                </div>
                            @elseif($item->status === 'disetujui')
                                <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold text-center flex items-center justify-center gap-1.5">
                                    <span>🟢 Ruko Aktif & Tayang di Katalog</span>
                                </div>
                            @else
                                <div class="p-2.5 rounded-xl bg-gray-100 border border-gray-200 text-gray-500 text-xs font-bold text-center">
                                    <span>Usulan Telah Ditolak</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-[#E8E6DF]">
                        <div class="w-16 h-16 rounded-full bg-teal-50 text-[#0F433C] mx-auto flex items-center justify-center mb-4">
                            📍
                        </div>
                        <h3 class="text-base font-black text-gray-800">Belum ada usulan ruko yang masuk</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-md mx-auto">
                            Usulan tempat usaha yang diajukan oleh masyarakat, agen properti, UMKM, atau investor akan tampil di sini untuk Anda kurasi.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- TAB 2: KATALOG RUKO RESMI YANG SEDANG TAYANG DI PLATFORM                  --}}
    {{-- ========================================================================= --}}
    @elseif(($activeTab ?? '') === 'katalog')

        <div class="space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-black text-[#1A202C]">Katalog Ruko Resmi Aktif</h2>
                    <p class="text-xs text-gray-400">Seluruh unit ruko komersial yang telah lolos kurasi dan siap disewa oleh UMKM binaan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($rukos as $ruko)
                    <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-4">
                                <span class="text-xs font-mono font-bold text-gray-400">#RUKO-{{ $ruko->id_ruko }}</span>
                                @if($ruko->status_ketersediaan === 'tersedia')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-amber-100 text-amber-800 border border-amber-200">
                                        Disewa
                                    </span>
                                @endif
                            </div>

                            <div class="w-full h-40 rounded-2xl bg-gray-100 mb-4 overflow-hidden shadow-inner border border-gray-100">
                                @if(!empty($ruko->foto_ruko))
                                    <img src="{{ asset($ruko->foto_ruko) }}" alt="{{ $ruko->nama_ruko }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-[#6B9E8A] text-white flex items-center justify-center font-black text-xl">
                                        <div class="text-center">
                                            <svg class="w-10 h-10 mx-auto opacity-80 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <span class="text-xs font-bold uppercase tracking-wider">Unit Ruko Komersial</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-base font-black text-[#1A202C]">{{ $ruko->nama_ruko }}</h3>
                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="truncate">{{ $ruko->lokasi }}</span>
                            </p>

                            @if(!empty($ruko->deskripsi_potensi))
                                <p class="text-[11px] text-gray-600 mt-2 line-clamp-2 italic">
                                    "{{ $ruko->deskripsi_potensi }}"
                                </p>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-gray-400 block">Sewa Bulanan</span>
                                <span class="text-sm font-black text-[#0F433C]">
                                    Rp {{ number_format($ruko->harga_sewa_per_bulan, 0, ',', '.') }} / bln
                                </span>
                            </div>
                            <div class="text-[11px] font-semibold text-gray-500">
                                {{ $ruko->penyedia->nama_perusahaan ?? 'Mitra Komunitas' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-[#E8E6DF]">
                        <p class="text-sm font-bold text-gray-500">Belum ada data unit ruko yang terdaftar.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $rukos->links() }}
            </div>
        </div>

    @endif

</div>

<!-- MODAL KHUSUS TOLAK USULAN RUKO DENGAN ALASAN -->
<div id="modal-reject-ruko" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm" onclick="closeRejectRukoModal()"></div>
    <div class="relative w-full max-w-md bg-white rounded-3xl p-6 sm:p-7 shadow-2xl border border-gray-100 z-10 animate-fadeIn">
        <div class="flex items-start gap-3.5 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-black text-gray-900">Tolak Usulan Ruko</h3>
                <p id="reject-ruko-subtitle" class="text-xs text-gray-500 mt-0.5">Tandai lokasi ruko sebagai tidak layak untuk tempat usaha UMKM.</p>
            </div>
        </div>

        <form id="form-reject-ruko-submit" method="POST" action="">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Alasan Kurasi Penolakan *</label>
                <textarea name="catatan_admin" required rows="3" placeholder="Contoh: Harga sewa di atas batas wajar permodalan UMKM, atau akses jalan sempit dan rawan genangan air."
                          class="w-full p-3.5 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-rose-500 focus:outline-none"></textarea>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="closeRejectRukoModal()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-100 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-black shadow-md bg-rose-600 hover:bg-rose-700 text-white transition">
                    ✕ Ya, Tolak Usulan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectRukoModal(id, nama) {
        const modal = document.getElementById('modal-reject-ruko');
        const form = document.getElementById('form-reject-ruko-submit');
        const subtitle = document.getElementById('reject-ruko-subtitle');
        
        form.action = '/super-admin/ruko/rekomendasi/' + id + '/reject';
        subtitle.innerText = 'Ruko: ' + nama;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeRejectRukoModal() {
        const modal = document.getElementById('modal-reject-ruko');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
