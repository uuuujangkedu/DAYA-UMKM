@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="w-full max-w-md mx-auto my-8 px-4">
    <div class="bg-white rounded-[12px] border border-[#e2e1d8] p-7 sm:p-9 text-left space-y-6">
        
        <!-- Header -->
        <div class="space-y-1">
            <h1 class="text-[24px] font-bold text-[#161d1a] leading-tight">
                Masuk ke akun
            </h1>
            <p class="text-[14px] text-[#4b5551]">
                Gunakan kredensial akun Daya UMKM Anda untuk melanjutkan.
            </p>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="p-3.5 rounded-[6px] bg-[#d8ebe5] border border-[#b2d5cc] text-[#084539] text-[14px]">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-3.5 rounded-[6px] bg-[#fee2e2] border border-[#fca5a5] text-[#991b1b] text-[14px]">
                {{ session('error') }}
            </div>
        @endif

        <!-- 1. Tombol Sign In With Google -->
        <a href="{{ route('google.redirect') }}" 
           class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-[#e2e1d8] hover:border-[#0b5a4a] rounded-[6px] text-[14px] font-medium text-[#161d1a] bg-white hover:bg-[#f7f6f1] transition duration-150">
            <svg class="w-4 h-4" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Masuk dengan Google</span>
        </a>

        <!-- Divider -->
        <div class="relative text-center">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-[#e2e1d8]"></div>
            </div>
            <div class="relative inline-block bg-white px-3 text-[13px] text-[#4b5551]">
                atau masuk dengan email
            </div>
        </div>

        <!-- 2. Form Login Email -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                    Alamat email
                </label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}" 
                       required 
                       placeholder="nama@email.com"
                       class="w-full px-3.5 py-2.5 bg-white border @error('email') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                @error('email')
                    <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-[14px] font-semibold text-[#161d1a]">
                        Kata sandi
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[13px] text-[#0b5a4a] hover:underline font-medium">
                        Lupa sandi?
                    </a>
                </div>
                <div class="relative">
                    <input type="password" 
                           name="password" 
                           id="password" 
                           required 
                           placeholder="••••••••"
                           class="w-full px-3.5 pr-10 py-2.5 bg-white border @error('password') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                    <button type="button" 
                            onclick="togglePasswordVisibility('password', 'eye-icon-login')" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#4b5551] hover:text-[#0b5a4a] transition"
                            aria-label="Lihat kata sandi">
                        <svg id="eye-icon-login" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember" 
                       name="remember" 
                       type="checkbox" 
                       class="w-4 h-4 text-[#0b5a4a] border-[#e2e1d8] rounded-[4px] focus:ring-[#0b5a4a]">
                <label for="remember" class="ml-2 block text-[13px] text-[#4b5551]">
                    Ingat sesi saya
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full py-[12px] text-[15px]">
                Masuk ke akun
            </button>
        </form>

        <!-- Bottom Link -->
        <div class="text-center text-[14px] text-[#4b5551] pt-2">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-semibold text-[#0b5a4a] hover:underline ml-1">
                Daftar sekarang
            </a>
        </div>

    </div>
</div>
@endsection

