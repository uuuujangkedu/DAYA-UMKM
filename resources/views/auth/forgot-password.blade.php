@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi - DAYA UMKM')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-xl border border-[#E5E3DC] overflow-hidden">
        
        <div class="bg-gradient-to-r from-[#075B50] to-[#26734D] p-6 text-white text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-sm mb-3">
                <svg class="w-7 h-7 text-[#F5B800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Lupa Kata Sandi?</h1>
            <p class="text-xs text-emerald-100 mt-1">Kami akan mengirimkan kode OTP untuk mereset sandi Anda</p>
        </div>

        <div class="p-6 sm:p-8">
            @if (session('error'))
                <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Alamat Email Terdaftar
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="nama@email.com"
                               class="w-full pl-10 pr-3.5 py-2.5 bg-[#F8F7F2]/50 border @error('email') border-red-500 @else border-[#D0CFC7] @enderror rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                    </div>
                    @error('email')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="p-3 bg-emerald-50/70 border border-emerald-200/70 rounded-xl flex items-start gap-2.5 text-[11px] text-[#075B50]">
                    <svg class="w-4 h-4 text-[#075B50] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Kode OTP 6 digit akan dikirimkan ke email untuk memastikan kepemilikan akun sebelum mengatur kata sandi baru.</span>
                </div>

                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#075B50] hover:bg-[#26734D] text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition duration-150 flex items-center justify-center gap-2">
                    <span>Kirim Kode OTP Pemulihan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-[#706F6C]">
                Ingat kata sandi Anda?
                <a href="{{ route('login') }}" class="font-bold text-[#075B50] hover:text-[#26734D] hover:underline ml-1">
                    Kembali Masuk
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
