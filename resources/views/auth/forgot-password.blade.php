@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi')

@section('content')
<div class="w-full max-w-md mx-auto my-8 px-4">
    <div class="bg-white rounded-[12px] border border-[#e2e1d8] p-7 sm:p-9 text-left space-y-6">
        
        <div class="space-y-1">
            <h1 class="text-[24px] font-bold text-[#161d1a] leading-tight">
                Lupa kata sandi
            </h1>
            <p class="text-[14px] text-[#4b5551]">
                Masukkan alamat email akun Anda. Kami akan mengirimkan kode verifikasi OTP untuk menyetel ulang kata sandi.
            </p>
        </div>

        @if (session('error'))
            <div class="p-3.5 rounded-[6px] bg-[#fee2e2] border border-[#fca5a5] text-[#991b1b] text-[14px]">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-[14px] font-semibold text-[#161d1a] mb-1.5">
                    Alamat email terdaftar
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

            <div class="p-3 bg-[#d8ebe5]/60 border border-[#b2d5cc] rounded-[6px] text-[13px] text-[#084539]">
                Kode verifikasi OTP 6-digit akan dikirimkan ke email untuk memastikan kepemilikan akun Anda.
            </div>

            <button type="submit" class="btn-primary w-full py-[12px] text-[15px]">
                Kirim kode pemulihan
            </button>
        </form>

        <div class="text-center text-[14px] text-[#4b5551] pt-2">
            Ingat kata sandi Anda?
            <a href="{{ route('login') }}" class="font-semibold text-[#0b5a4a] hover:underline ml-1">
                Kembali masuk
            </a>
        </div>

    </div>
</div>
@endsection

