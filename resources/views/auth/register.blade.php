@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')
<div class="w-full max-w-lg mx-auto my-8 px-4">
    <div class="bg-white rounded-[12px] border border-[#e2e1d8] p-7 sm:p-9 text-left space-y-6">
        
        <!-- Header -->
        <div class="space-y-1">
            <h1 class="text-[24px] font-bold text-[#161d1a] leading-tight">
                @if (request('role') === 'investor')
                    Daftar sebagai mitra investor
                @elseif (request('role') === 'umkm')
                    Daftar sebagai pelaku UMKM
                @else
                    Daftar akun baru
                @endif
            </h1>
            <p class="text-[14px] text-[#4b5551]">
                @if (request('role') === 'investor')
                    Salurkan permodalan produktif dan pantau bagi hasil secara berkala.
                @elseif (request('role') === 'umkm')
                    Dapatkan akses modal usaha dan direktori sewa ruko strategis.
                @else
                    Pilih peran dan lengkapi data untuk mulai bergabung di Daya UMKM.
                @endif
            </p>
        </div>

        <!-- Alert Messages -->
        @if (session('error'))
            <div class="p-3.5 rounded-[6px] bg-[#fee2e2] border border-[#fca5a5] text-[#991b1b] text-[14px]">
                {{ session('error') }}
            </div>
        @endif

        <!-- 1. Tombol Sign Up With Google -->
        <a href="{{ route('google.redirect') }}" 
           class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-[#e2e1d8] hover:border-[#0b5a4a] rounded-[6px] text-[14px] font-medium text-[#161d1a] bg-white hover:bg-[#f7f6f1] transition duration-150">
            <svg class="w-4 h-4" viewBox="0 0 24 24" aria-hidden="true">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Daftar dengan Google</span>
        </a>

        <!-- Divider -->
        <div class="relative text-center">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-[#e2e1d8]"></div>
            </div>
            <div class="relative inline-block bg-white px-3 text-[13px] text-[#4b5551]">
                atau formulir pendaftaran email
            </div>
        </div>

        <!-- 2. Form Register Manual -->
        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Pilihan Role (Investor vs Pelaku UMKM) -->
            <div>
                <label class="block text-[14px] font-semibold text-[#161d1a] mb-2">
                    Daftar sebagai
                </label>
                <div class="grid grid-cols-2 gap-3">
                    @php
                        $defaultRole = request('role', 'investor');
                        if (!in_array($defaultRole, ['investor', 'umkm'])) {
                            $defaultRole = 'investor';
                        }
                        $selectedRole = old('role', $defaultRole);
                    @endphp
                    <label class="relative flex items-center p-3 rounded-[6px] border {{ $selectedRole === 'investor' ? 'border-[#0b5a4a] bg-[#d8ebe5]/40' : 'border-[#e2e1d8] bg-white' }} hover:border-[#0b5a4a] cursor-pointer transition">
                        <input type="radio" name="role" value="investor" class="text-[#0b5a4a] focus:ring-[#0b5a4a]" {{ $selectedRole === 'investor' ? 'checked' : '' }}>
                        <div class="ml-2.5">
                            <span class="block text-[14px] font-semibold text-[#161d1a]">Investor</span>
                            <span class="block text-[12px] text-[#4b5551]">Pemodal usaha</span>
                        </div>
                    </label>
                    <label class="relative flex items-center p-3 rounded-[6px] border {{ $selectedRole === 'umkm' ? 'border-[#0b5a4a] bg-[#d8ebe5]/40' : 'border-[#e2e1d8] bg-white' }} hover:border-[#0b5a4a] cursor-pointer transition">
                        <input type="radio" name="role" value="umkm" class="text-[#0b5a4a] focus:ring-[#0b5a4a]" {{ $selectedRole === 'umkm' ? 'checked' : '' }}>
                        <div class="ml-2.5">
                            <span class="block text-[14px] font-semibold text-[#161d1a]">Pelaku UMKM</span>
                            <span class="block text-[12px] text-[#4b5551]">Pencari modal & sewa</span>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                    Nama lengkap
                </label>
                <input type="text" 
                       name="nama" 
                       id="nama" 
                       value="{{ old('nama') }}" 
                       required 
                       placeholder="Nama lengkap Anda"
                       class="w-full px-3.5 py-2.5 bg-white border @error('nama') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                @error('nama')
                    <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email & Nomor Telepon (2 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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

                <div>
                    <label for="nomor_telepon" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                        Nomor WhatsApp / HP
                    </label>
                    <input type="text" 
                           name="nomor_telepon" 
                           id="nomor_telepon" 
                           value="{{ old('nomor_telepon') }}" 
                           placeholder="0812xxxxxxxx"
                           class="w-full px-3.5 py-2.5 bg-white border @error('nomor_telepon') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                    @error('nomor_telepon')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kata Sandi & Konfirmasi (2 Kolom) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="password" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                        Kata sandi
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="reg-password" 
                               required 
                               placeholder="••••••••"
                               oninput="checkPasswordRequirements(this.value)"
                               class="w-full px-3.5 pr-10 py-2.5 bg-white border @error('password') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                        <button type="button" 
                                onclick="togglePasswordVisibility('reg-password', 'eye-icon-reg-pwd')" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#4b5551] hover:text-[#0b5a4a] transition"
                                aria-label="Lihat kata sandi">
                            <svg id="eye-icon-reg-pwd" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-[12px] text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                        Konfirmasi kata sandi
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_confirmation" 
                               id="reg-confirm-password" 
                               required 
                               placeholder="••••••••"
                               class="w-full px-3.5 pr-10 py-2.5 bg-white border border-[#e2e1d8] rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                        <button type="button" 
                                onclick="togglePasswordVisibility('reg-confirm-password', 'eye-icon-reg-confirm')" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#4b5551] hover:text-[#0b5a4a] transition"
                                aria-label="Lihat kata sandi konfirmasi">
                            <svg id="eye-icon-reg-confirm" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Persyaratan Kata Sandi -->
            <div class="p-3 bg-[#f7f6f1] border border-[#e2e1d8] rounded-[6px] text-[12px] text-[#4b5551] space-y-1.5">
                <div class="font-semibold text-[#161d1a]">Persyaratan kata sandi:</div>
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
            <div class="p-3 bg-[#d8ebe5]/60 border border-[#b2d5cc] rounded-[6px] text-[13px] text-[#084539]">
                Kode verifikasi OTP 6-digit akan dikirimkan ke alamat email terdaftar untuk aktivasi akun resmi Anda.
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full py-[12px] text-[15px]">
                Daftar dan kirim kode OTP
            </button>
        </form>

        <!-- Bottom Link -->
        <div class="text-center text-[14px] text-[#4b5551] pt-2">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-semibold text-[#0b5a4a] hover:underline ml-1">
                Masuk sekarang
            </a>
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
                el.classList.add('text-[#0b5a4a]', 'font-semibold');
                icon.className = 'indicator-icon w-3.5 h-3.5 rounded-full bg-[#0b5a4a] text-white flex items-center justify-center text-[9px] font-bold';
                icon.textContent = '✓';
            } else {
                el.classList.add('text-gray-500');
                el.classList.remove('text-[#0b5a4a]', 'font-semibold');
                icon.className = 'indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold';
                icon.textContent = '•';
            }
        }
    }
</script>
@endsection

