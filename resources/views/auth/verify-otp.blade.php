@extends('layouts.auth')

@section('title', 'Verifikasi Kode OTP - DAYA UMKM')

@section('content')
<div class="w-full max-w-md">
    <!-- Card Container -->
    <div class="bg-white rounded-2xl shadow-xl border border-[#E5E3DC] overflow-hidden">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-[#075B50] to-[#26734D] p-6 text-white text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/10 backdrop-blur-sm mb-3">
                <svg class="w-7 h-7 text-[#F5B800]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight">Verifikasi Email Anda</h1>
            <p class="text-xs text-emerald-100 mt-1">Masukkan 6 digit kode OTP yang kami kirimkan</p>
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

            <!-- Info Email Tujuan -->
            <div class="text-center mb-6">
                <p class="text-xs text-[#706F6C]">Kode telah dikirimkan ke alamat email:</p>
                <p class="text-sm font-bold text-[#075B50] mt-1 bg-emerald-50 py-1 px-3 rounded-lg inline-block border border-emerald-200">
                    {{ $email }}
                </p>
            </div>

            <!-- Form Verifikasi OTP -->
            <form action="{{ route('otp.verify.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="otp" class="block text-xs font-semibold text-center text-[#1B1B18] mb-2 uppercase tracking-wider">
                        Kode OTP 6 Digit
                    </label>
                    <div class="flex justify-center">
                        <input type="text" 
                               name="otp" 
                               id="otp" 
                               maxlength="6" 
                               pattern="\d*" 
                               inputmode="numeric" 
                               required 
                               autofocus
                               placeholder="123456"
                               autocomplete="one-time-code"
                               class="w-48 text-center tracking-[12px] text-2xl font-black py-3 bg-[#F8F7F2] border-2 @error('otp') border-red-500 @else border-[#075B50] @enderror rounded-xl text-[#075B50] focus:outline-none focus:ring-4 focus:ring-emerald-100 transition shadow-inner font-mono">
                    </div>
                    @error('otp')
                        <p class="mt-2 text-center text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Timer Expired Display -->
                <div class="text-center text-xs text-[#706F6C]">
                    Kode kedaluwarsa dalam: <span id="countdown" class="font-bold text-[#075B50]">05:00</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 px-4 bg-[#075B50] hover:bg-[#26734D] text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition duration-150 flex items-center justify-center gap-2">
                    <span>Verifikasi & Masuk Akun</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
            </form>

            <!-- Kirim Ulang OTP -->
            <div class="mt-6 pt-5 border-t border-[#E5E3DC] text-center text-xs text-[#706F6C]">
                Belum menerima kode OTP? 
                <form action="{{ route('otp.resend') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" id="resend-btn" class="font-bold text-[#075B50] hover:text-[#26734D] hover:underline ml-1">
                        Kirim Ulang Kode
                    </button>
                </form>
            </div>

            <!-- Ganti Akun -->
            <div class="mt-3 text-center text-xs">
                <a href="{{ route('login') }}" class="text-[#706F6C] hover:text-[#075B50] transition">
                    &larr; Gunakan akun atau email lain
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    // Countdown timer 5 menit
    let timeLeft = 300;
    const countdownEl = document.getElementById('countdown');
    const timer = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timer);
            countdownEl.textContent = 'Kedaluwarsa';
            countdownEl.classList.add('text-red-600');
        } else {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            timeLeft--;
        }
    }, 1000);
</script>
@endsection
