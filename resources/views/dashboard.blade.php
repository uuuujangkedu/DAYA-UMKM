@extends('layouts.auth')

@section('title', 'Dashboard - DAYA UMKM')

@section('content')
<div class="w-full max-w-4xl">
    <div class="bg-white rounded-2xl shadow-xl border border-[#E5E3DC] p-8">
        
        <!-- Welcome Banner -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-6 border-b border-[#E5E3DC] gap-4">
            <div class="flex items-center gap-4">
                @if (Auth::user()->avatar_url)
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-16 h-16 rounded-full border-2 border-[#075B50] shadow">
                @else
                    <div class="w-16 h-16 rounded-full bg-[#075B50] text-white flex items-center justify-center font-bold text-2xl shadow">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h1 class="text-2xl font-bold text-[#1B1B18]">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-xs text-[#706F6C] mt-0.5">
                        {{ Auth::user()->email }} &bull; Peran: <span class="capitalize font-semibold text-[#075B50]">{{ Auth::user()->role }}</span>
                    </p>
                </div>
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 border border-red-200 text-red-600 hover:bg-red-50 text-xs font-bold rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

        <!-- Status Badges -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 my-6">
            <div class="p-4 rounded-xl bg-[#F8F7F2] border border-[#E5E3DC]">
                <div class="text-[11px] uppercase font-bold text-[#706F6C]">Status Akun</div>
                <div class="text-base font-extrabold text-[#075B50] mt-1 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span class="capitalize">{{ Auth::user()->status }}</span>
                </div>
            </div>

            <div class="p-4 rounded-xl bg-[#F8F7F2] border border-[#E5E3DC]">
                <div class="text-[11px] uppercase font-bold text-[#706F6C]">Verifikasi Email</div>
                <div class="text-base font-extrabold text-[#075B50] mt-1 flex items-center gap-1.5">
                    @if (Auth::user()->email_verified_at)
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Terverifikasi</span>
                    @else
                        <span class="text-amber-600">Belum Verifikasi</span>
                    @endif
                </div>
            </div>

            <div class="p-4 rounded-xl bg-[#F8F7F2] border border-[#E5E3DC]">
                <div class="text-[11px] uppercase font-bold text-[#706F6C]">Tipe Akun</div>
                <div class="text-base font-extrabold text-[#245DA8] mt-1 capitalize">
                    {{ Auth::user()->role === 'investor' ? 'Investor Mitra' : 'Pengelola UMKM' }}
                </div>
            </div>
        </div>

        <!-- Banner Info ERD -->
        <div class="p-5 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl text-xs text-[#075B50] leading-relaxed">
            <h3 class="font-bold text-sm mb-1 text-[#075B50]">Akun Anda telah aktif di ekosistem DAYA UMKM</h3>
            <p>Anda dapat mulai menjelajahi penawaran UMKM produktif untuk didanai atau mendaftarkan ruko usaha Anda.</p>
        </div>

    </div>
</div>
@endsection
