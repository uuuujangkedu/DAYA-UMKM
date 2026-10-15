@extends('layouts.super-admin')

@section('title', 'Informasi Ruko Komersial')

@section('content')
<div class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#1A202C]">INFORMASI RUKO</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-1 font-medium">
                Daftar ketersediaan ruko komersial yang dapat disewa oleh pelaku UMKM terverifikasi.
            </p>
        </div>
    </div>

    <!-- RUKO CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rukos as $ruko)
            <div class="bg-white rounded-3xl p-6 border border-[#E8E6DF] shadow-sm hover:shadow-md transition">
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

                <div class="w-full h-36 rounded-2xl bg-[#6B9E8A] text-white flex items-center justify-center font-black text-xl mb-4 overflow-hidden shadow-inner">
                    <div class="text-center">
                        <svg class="w-10 h-10 mx-auto opacity-80 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider">Unit Ruko Komersial</span>
                    </div>
                </div>

                <h3 class="text-base font-black text-[#1A202C]">{{ $ruko->nama_ruko }}</h3>
                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $ruko->lokasi }}</span>
                </p>

                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-gray-400 block">Sewa Bulanan</span>
                        <span class="text-sm font-black text-[#0F433C]">
                            Rp {{ number_format($ruko->harga_sewa_per_bulan, 0, ',', '.') }} / bln
                        </span>
                    </div>
                    <div class="text-[11px] font-semibold text-gray-500">
                        {{ $ruko->penyedia->nama_penyedia ?? 'Mitra Penyedia' }}
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
@endsection
