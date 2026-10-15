@extends('layouts.auth')

@section('title', 'Verifikasi Kode OTP')

@section('content')
<div class="w-full max-w-md mx-auto my-8 px-4">
    <div class="bg-white rounded-[12px] border border-[#e2e1d8] p-7 sm:p-9 text-left space-y-6">
        
        <!-- Header -->
        <div class="space-y-1">
            <h1 class="text-[24px] font-bold text-[#161d1a] leading-tight">
                Verifikasi email Anda
            </h1>
            <p class="text-[14px] text-[#4b5551]">
                Masukkan 6 digit kode OTP yang telah dikirimkan ke alamat email terdaftar.
            </p>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="p-3.5 rounded-[6px] bg-[#d8ebe5] border border-[#b2d5cc] text-[#084539] text-[14px]">
                {{ session('success') }}
            </div>
        @endif

        <!-- Info Email Tujuan -->
        <div class="p-3.5 bg-[#f7f6f1] border border-[#e2e1d8] rounded-[6px] text-[13px] text-[#4b5551]">
            <span>Kode dikirimkan ke:</span>
            <div class="font-bold text-[#0b5a4a] text-[14px] mt-0.5 break-all">
                {{ $email }}
            </div>
        </div>

        <!-- Form Verifikasi OTP -->
        <form action="{{ route('otp.verify.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="otp" class="block text-[14px] font-semibold text-center text-[#161d1a] mb-2">
                    Kode verifikasi 6 digit
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
                           class="w-48 text-center tracking-[10px] text-[24px] font-bold py-2.5 bg-white border @error('otp') border-red-500 @else border-[#e2e1d8] @enderror rounded-[6px] text-[#0b5a4a] focus:outline-none focus:border-[#0b5a4a] transition">
                </div>
                @error('otp')
                    <p class="mt-2 text-center text-[12px] text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Timer Expired Display -->
            <div class="text-center text-[13px] text-[#4b5551]">
                Kode kedaluwarsa dalam: <span id="countdown" class="font-bold text-[#0b5a4a]">05:00</span>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-full py-[12px] text-[15px]">
                Verifikasi dan masuk
            </button>
        </form>

        <!-- Kirim Ulang OTP -->
        <div class="pt-4 border-t border-[#e2e1d8] text-center text-[14px] text-[#4b5551]">
            Belum menerima kode OTP? 
            <form action="{{ route('otp.resend') }}" method="POST" class="inline">
                @csrf
                <button type="submit" id="resend-btn" class="font-semibold text-[#0b5a4a] hover:underline ml-1">
                    Kirim ulang kode
                </button>
            </form>
        </div>

        <!-- Ganti Akun -->
        <div class="text-center text-[13px]">
            <a href="{{ route('login') }}" class="text-[#4b5551] hover:text-[#0b5a4a] hover:underline transition">
                Gunakan akun atau email lain
            </a>
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
            if (countdownEl) {
                countdownEl.textContent = 'Kedaluwarsa';
                countdownEl.classList.add('text-red-600');
            }
        } else {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            if (countdownEl) {
                countdownEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }
            timeLeft--;
        }
    }, 1000);
</script>
@endsection

