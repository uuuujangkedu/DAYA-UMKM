@extends('layouts.auth')

@section('title', 'Masuk ke Akun Anda - DAYA UMKM')

@section('content')
<div class="w-full max-w-md">
    <!-- Card Container -->
    <div class="bg-white rounded-2xl shadow-xl border border-[#E5E3DC] overflow-hidden">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-[#075B50] to-[#26734D] p-6 text-white text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-sm mb-3">
                <svg class="w-7 h-7 text-[#F5B800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Selamat Datang Kembali</h1>
            <p class="text-xs text-emerald-100 mt-1">Masuk ke akun DAYA UMKM Anda</p>
        </div>

        <div class="p-6 sm:p-8">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- 1. Tombol Sign In With Google -->
            <a href="{{ route('google.redirect') }}" 
               class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-[#D0CFC7] hover:border-[#075B50] rounded-xl text-xs font-semibold text-[#1B1B18] bg-white hover:bg-[#F8F7F2] transition duration-150 shadow-sm group">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Masuk dengan Google</span>
            </a>

            <!-- Divider -->
            <div class="relative my-6 text-center">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-[#E5E3DC]"></div>
                </div>
                <div class="relative inline-block bg-white px-3 text-[11px] uppercase tracking-wider text-[#706F6C] font-medium">
                    Atau dengan Email & OTP
                </div>
            </div>

            <!-- 2. Form Login Email -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Alamat Email
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

                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-[#1B1B18]">
                            Kata Sandi
                        </label>
                        <a href="{{ route('password.request') }}" class="text-[11px] text-[#075B50] hover:text-[#26734D] font-medium">
                            Lupa sandi?
                        </a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required 
                               placeholder="••••••••"
                               class="w-full pl-10 pr-10 py-2.5 bg-[#F8F7F2]/50 border @error('password') border-red-500 @else border-[#D0CFC7] @enderror rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                        <button type="button" 
                                onclick="togglePasswordVisibility('password', 'eye-icon-login')" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#075B50] transition">
                            <svg id="eye-icon-login" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info OTP Notice -->
                <div class="p-3 bg-emerald-50/70 border border-emerald-200/70 rounded-xl flex items-start gap-2.5 text-[11px] text-[#075B50]">
                    <svg class="w-4 h-4 text-[#075B50] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Setelah menekan tombol Masuk, kode <strong>OTP 6 digit</strong> akan dikirimkan ke email Anda untuk konfirmasi keamanan.</span>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center">
                    <input id="remember" 
                           name="remember" 
                           type="checkbox" 
                           class="w-4 h-4 text-[#075B50] border-[#D0CFC7] rounded focus:ring-[#075B50]">
                    <label for="remember" class="ml-2 block text-xs text-[#5E6E69]">
                        Ingat sesi saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#075B50] hover:bg-[#26734D] text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition duration-150 flex items-center justify-center gap-2">
                    <span>Masuk & Kirim OTP</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Bottom Link -->
            <div class="mt-6 text-center text-xs text-[#706F6C]">
                Belum memiliki akun DAYA UMKM?
                <a href="{{ route('register') }}" class="font-bold text-[#075B50] hover:text-[#26734D] hover:underline ml-1">
                    Daftar Sekarang
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
