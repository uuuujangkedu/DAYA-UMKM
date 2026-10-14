@extends('layouts.auth')

@section('title', 'Atur Kata Sandi Baru - DAYA UMKM')

@section('content')
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-xl border border-[#E5E3DC] overflow-hidden">
        
        <div class="bg-gradient-to-r from-[#075B50] to-[#26734D] p-6 text-white text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-sm mb-3">
                <svg class="w-7 h-7 text-[#F5B800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Atur Kata Sandi Baru</h1>
            <p class="text-xs text-emerald-100 mt-1">Buat kata sandi yang kuat dan aman untuk akun Anda</p>
        </div>

        <div class="p-6 sm:p-8">
            @if (session('success'))
                <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="password" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="reset-password" 
                               required 
                               placeholder="••••••••"
                               oninput="checkResetRequirements(this.value)"
                               class="w-full pl-10 pr-10 py-2.5 bg-[#F8F7F2]/50 border @error('password') border-red-500 @else border-[#D0CFC7] @enderror rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                        <button type="button" 
                                onclick="togglePasswordVisibility('reset-password', 'eye-icon-reset')" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#075B50] transition">
                            <svg id="eye-icon-reset" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <input type="password" 
                               name="password_confirmation" 
                               id="reset-confirm" 
                               required 
                               placeholder="••••••••"
                               class="w-full pl-10 pr-10 py-2.5 bg-[#F8F7F2]/50 border border-[#D0CFC7] rounded-xl text-xs text-[#1B1B18] focus:outline-none focus:ring-2 focus:ring-[#075B50] focus:border-transparent transition">
                        <button type="button" 
                                onclick="togglePasswordVisibility('reset-confirm', 'eye-icon-confirm-reset')" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-[#075B50] transition">
                            <svg id="eye-icon-confirm-reset" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Persyaratan Kata Sandi (Live Checklist) -->
                <div class="p-3 bg-[#F8F7F2] border border-[#E5E3DC] rounded-xl text-[11px] text-[#5E6E69] space-y-1.5">
                    <div class="font-bold text-[#1B1B18] mb-1">Persyaratan Kata Sandi:</div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
                        <div id="reset-rule-length" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Minimal 8 karakter</span>
                        </div>
                        <div id="reset-rule-case" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Huruf besar & kecil (A-z)</span>
                        </div>
                        <div id="reset-rule-number" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Mengandung angka (0-9)</span>
                        </div>
                        <div id="reset-rule-symbol" class="flex items-center gap-1.5 text-gray-500">
                            <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-gray-400 flex items-center justify-center text-[9px] font-bold">&bull;</span>
                            <span>Karakter khusus (!@#$%)</span>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#075B50] hover:bg-[#26734D] text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition duration-150 flex items-center justify-center gap-2">
                    <span>Simpan Kata Sandi Baru</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
            </form>

        </div>
    </div>
</div>

<script>
    function checkResetRequirements(value) {
        const rules = {
            'reset-rule-length': value.length >= 8,
            'reset-rule-case': /[a-z]/.test(value) && /[A-Z]/.test(value),
            'reset-rule-number': /[0-9]/.test(value),
            'reset-rule-symbol': /[^A-Za-z0-9]/.test(value)
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
