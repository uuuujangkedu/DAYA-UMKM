@extends('layouts.auth')

@section('title', 'Atur Kata Sandi Baru - Daya UMKM')

@section('content')
<div class="w-full max-w-md mx-auto my-8 px-4">
    <div class="bg-white rounded-[12px] border border-[#e2e1d8] p-7 sm:p-9 text-left space-y-6">
        
        <div class="space-y-1">
            <h1 class="text-[24px] font-bold text-[#161d1a] leading-tight">
                Atur kata sandi baru
            </h1>
            <p class="text-[14px] text-[#4b5551]">
                Buat kata sandi baru yang aman untuk akun Anda.
            </p>
        </div>

        @if (session('success'))
            <div class="p-3.5 rounded-[6px] bg-[#d8ebe5]/60 border border-[#b2d5cc] text-[#084539] text-[14px]">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="reset-password" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                    Kata sandi baru
                </label>
                <div class="relative">
                    <input type="password" 
                           name="password" 
                           id="reset-password" 
                           required 
                           placeholder="Minimal 8 karakter"
                           oninput="checkResetRequirements(this.value)"
                           class="w-full px-3.5 pr-10 py-2.5 bg-white border @error('password') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                    <button type="button" 
                            onclick="togglePasswordVisibility('reset-password', 'eye-icon-reset')" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#4b5551] hover:text-[#0b5a4a] transition">
                        <svg id="eye-icon-reset" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
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
                <label for="reset-confirm" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                    Konfirmasi kata sandi baru
                </label>
                <div class="relative">
                    <input type="password" 
                           name="password_confirmation" 
                           id="reset-confirm" 
                           required 
                           placeholder="Ulangi kata sandi baru"
                           class="w-full px-3.5 pr-10 py-2.5 bg-white border border-[#e2e1d8] rounded-[6px] text-[14px] text-[#161d1a] focus:outline-none focus:border-[#0b5a4a] transition">
                    <button type="button" 
                            onclick="togglePasswordVisibility('reset-confirm', 'eye-icon-confirm-reset')" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#4b5551] hover:text-[#0b5a4a] transition">
                        <svg id="eye-icon-confirm-reset" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Persyaratan Kata Sandi -->
            <div class="p-3 bg-[#f7f6f1] border border-[#e2e1d8] rounded-[6px] text-[12px] text-[#4b5551] space-y-1.5">
                <div class="font-semibold text-[#161d1a] mb-1">Persyaratan kata sandi:</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
                    <div id="reset-rule-length" class="flex items-center gap-1.5 text-[#4b5551]">
                        <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-[#4b5551] flex items-center justify-center text-[9px] font-bold">&bull;</span>
                        <span>Minimal 8 karakter</span>
                    </div>
                    <div id="reset-rule-case" class="flex items-center gap-1.5 text-[#4b5551]">
                        <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-[#4b5551] flex items-center justify-center text-[9px] font-bold">&bull;</span>
                        <span>Huruf besar & kecil (A-z)</span>
                    </div>
                    <div id="reset-rule-number" class="flex items-center gap-1.5 text-[#4b5551]">
                        <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-[#4b5551] flex items-center justify-center text-[9px] font-bold">&bull;</span>
                        <span>Mengandung angka (0-9)</span>
                    </div>
                    <div id="reset-rule-symbol" class="flex items-center gap-1.5 text-[#4b5551]">
                        <span class="indicator-icon w-3.5 h-3.5 rounded-full border border-[#4b5551] flex items-center justify-center text-[9px] font-bold">&bull;</span>
                        <span>Karakter khusus (!@#$%)</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-primary w-full py-[12px] text-[15px]">
                Simpan kata sandi baru
            </button>
        </form>

        <div class="text-center text-[14px] text-[#4b5551] pt-2">
            Sudah selesai atau ingin login?
            <a href="{{ route('login') }}" class="font-semibold text-[#0b5a4a] hover:underline ml-1">
                Kembali masuk
            </a>
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
                el.classList.remove('text-[#4b5551]');
                el.classList.add('text-[#0b5a4a]', 'font-semibold');
                icon.className = 'indicator-icon w-3.5 h-3.5 rounded-full bg-[#0b5a4a] text-white flex items-center justify-center text-[9px] font-bold';
                icon.textContent = '✓';
            } else {
                el.classList.add('text-[#4b5551]');
                el.classList.remove('text-[#0b5a4a]', 'font-semibold');
                icon.className = 'indicator-icon w-3.5 h-3.5 rounded-full border border-[#4b5551] flex items-center justify-center text-[9px] font-bold';
                icon.textContent = '•';
            }
        }
    }
</script>
@endsection
