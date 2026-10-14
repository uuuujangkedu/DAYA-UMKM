@extends('layouts.auth')

@section('title', 'Daftar Akun Baru - DAYA UMKM')

@section('content')
<div class="w-full max-w-lg">
    <!-- Card Container -->
    <div class="bg-white rounded-2xl shadow-xl border border-[#E5E3DC] overflow-hidden">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-[#075B50] to-[#26734D] p-6 text-white text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-sm mb-3">
                <svg class="w-7 h-7 text-[#F5B800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Bergabung dengan DAYA UMKM</h1>
            <p class="text-xs text-emerald-100 mt-1">Platform sinergi investasi modal usaha & sewa ruko strategis</p>
        </div>

        <div class="p-6 sm:p-8">
            <!-- Alert Messages -->
            @if (session('error'))
                <div class="mb-5 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- 1. Tombol Sign Up With Google -->
            <a href="{{ route('google.redirect') }}" 
               class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-[#D0CFC7] hover:border-[#075B50] rounded-xl text-xs font-semibold text-[#1B1B18] bg-white hover:bg-[#F8F7F2] transition duration-150 shadow-sm group">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Daftar Cepat dengan Google</span>
            </a>

            <!-- Divider -->
            <div class="relative my-6 text-center">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-[#E5E3DC]"></div>
                </div>
                <div class="relative inline-block bg-white px-3 text-[11px] uppercase tracking-wider text-[#706F6C] font-medium">
                    Atau Formulir Pendaftaran Email
                </div>
            </div>

            <!-- 2. Form Register Manual -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Pilihan Role (Investor vs Pelaku UMKM) -->
                <div>
                    <label class="block text-xs font-semibold text-[#1B1B18] mb-2">
                        Daftar Sebagai:
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative flex items-center p-3 rounded-xl border border-[#D0CFC7] hover:border-[#075B50] cursor-pointer bg-[#F8F7F2]/40 transition group">
                            <input type="radio" name="role" value="investor" class="text-[#075B50] focus:ring-[#075B50]" {{ old('role', 'investor') === 'investor' ? 'checked' : '' }}>
                            <div class="ml-2.5">
                                <span class="block text-xs font-bold text-[#1B1B18] group-hover:text-[#075B50]">Investor</span>
                                <span class="block text-[10px] text-[#706F6C]">Pemodal UMKM</span>
                            </div>
                        </label>
                        <label class="relative flex items-center p-3 rounded-xl border border-[#D0CFC7] hover:border-[#075B50] cursor-pointer bg-[#F8F7F2]/40 transition group">
                            <input type="radio" name="role" value="umkm" class="text-[#075B50] focus:ring-[#075B50]" {{ old('role') === 'umkm' ? 'checked' : '' }}>
                            <div class="ml-2.5">
                                <span class="block text-xs font-bold text-[#1B1B18] group-hover:text-[#075B50]">Pelaku UMKM</span>
                                <span class="block text-[10px] text-[#706F6C]">Pencari Modal / Sewa</span>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" 
                               name="nama" 
                               id="nama" 
                               value="{{ old('nama') }}" 
                               required 
                               placeholder="Nama lengkap Anda"
                               class="w-full pl-10 pr-3.5 py-2.5 bg-[#F8F7F2]/50 border @error('nama') border-red-500 @else border-[#D0CFC7] @enderror rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                    </div>
                    @error('nama')
                        <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email & Nomor Telepon (2 Kolom) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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

                    <div>
                        <label for="nomor_telepon" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                            Nomor WhatsApp / HP
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input type="text" 
                                   name="nomor_telepon" 
                                   id="nomor_telepon" 
                                   value="{{ old('nomor_telepon') }}" 
                                   placeholder="0812xxxxxxxx"
                                   class="w-full pl-10 pr-3.5 py-2.5 bg-[#F8F7F2]/50 border @error('nomor_telepon') border-red-500 @else border-[#D0CFC7] @enderror rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                        </div>
                        @error('nomor_telepon')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kata Sandi & Konfirmasi (2 Kolom) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" 
                                   name="password" 
                                   id="reg-password" 
                                   required 
                                   placeholder="••••••••"
                                   oninput="checkPasswordRequirements(this.value)"
                                   class="w-full pl-10 pr-10 py-2.5 bg-[#F8F7F2]/50 border @error('password') border-red-500 @else border-[#D0CFC7] @enderror rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('reg-password', 'eye-icon-reg-pwd')" 
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#075B50] transition">
                                <svg id="eye-icon-reg-pwd" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                            Konfirmasi Kata Sandi
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="reg-confirm-password" 
                                   required 
                                   placeholder="••••••••"
                                   class="w-full pl-10 pr-10 py-2.5 bg-[#F8F7F2]/50 border border-[#D0CFC7] rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('reg-confirm-password', 'eye-icon-reg-confirm')" 
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#075B50] transition">
                                <svg id="eye-icon-reg-confirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Persyaratan Kata Sandi (Live Checklist) -->
                <div class="p-3 bg-[#F8F7F2] border border-[#E5E3DC] rounded-xl text-[11px] text-[#5E6E69] space-y-1.5">
                    <div class="font-bold text-[#1B1B18] mb-1">Persyaratan Kata Sandi:</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
                        <div id="rule-length" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Minimal 8 karakter</span>
                        </div>
                        <div id="rule-case" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Huruf besar & kecil (A-z)</span>
                        </div>
                        <div id="rule-number" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Mengandung angka (0-9)</span>
                        </div>
                        <div id="rule-symbol" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Karakter khusus (!@#$%)</span>
                        </div>
                    </div>
                </div>

                <!-- OTP Verification Info Card -->
                <div class="p-3 bg-emerald-50/70 border border-emerald-200/70 rounded-xl flex items-start gap-2.5 text-[11px] text-[#075B50]">
                    <svg class="w-4 h-4 text-[#075B50] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Untuk menjaga keamanan ekosistem, <strong>kode OTP 6-digit</strong> akan dikirimkan ke email terdaftar untuk aktivasi akun.</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#075B50] hover:bg-[#26734D] text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition duration-150 flex items-center justify-center gap-2">
                    <span>Daftar & Kirim Kode OTP</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <!-- Bottom Link -->
            <div class="mt-6 text-center text-xs text-[#706F6C]">
                Sudah memiliki akun DAYA UMKM?
                <a href="{{ route('login') }}" class="font-bold text-[#075B50] hover:text-[#26734D] hover:underline ml-1">
                    Masuk Sekarang
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    function checkPasswordRequirements(value) {
        const rules = {
            'rule-length': value.length >= 8,
            'rule-case': /[a-z]/.test(value) && /[A-Z]/.test(value),
            'rule-number': /[0-9]/.test(value),
            'rule-symbol': /[^A-Za-z0-9]/.test(value)
        };

        for (const [id, valid] of Object.entries(rules)) {
            const el = document.getElementById(id);
            if (!el) continue;
            const icon = el.querySelector('.indicator-icon');

            if (valid) {
                el.classList.remove('text-gray-500');
                el.classList.add('text-[#075B50]', 'font-semibold');
                icon.className = 'indicator-icon w-3.5 h-3.5 rounded-full bg-[#075B50] text-white flex items-center justify-center text-[9px] font-bold';
                icon.textContent = '✓';
            } else {
                el.classList.add('text-gray-500');
                el.classList.remove('text-[#075B50]', 'font-semibold');
                icon.className = 'indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold';
                icon.textContent = '•';
            }
        }
    }
</script>
@endsection
