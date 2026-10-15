@extends('layouts.auth')

@section('title', 'Formulir Pendaftaran UMKM - DAYA UMKM')

@section('content')
<div class="w-full max-w-4xl py-6 space-y-8">

    <!-- Top Role Tab Switcher -->
    <div class="flex items-center justify-between flex-wrap gap-4 bg-white p-3 rounded-2xl border border-[#E5E3DC] shadow-sm">
        <span class="text-xs font-bold text-[#706F6C] px-2">Pilih Jenis Pendaftaran:</span>
        <div class="flex items-center gap-2">
            <a href="{{ route('register.umkm') }}" 
               class="px-5 py-2.5 rounded-xl text-xs font-extrabold bg-[#075B50] text-white shadow-md flex items-center gap-2 transition">
                <span class="w-2 h-2 rounded-full bg-[#F5B800]"></span>
                <span>Pelaku UMKM</span>
            </a>
            <a href="{{ route('register.investor') }}" 
               class="px-5 py-2.5 rounded-xl text-xs font-semibold bg-[#F8F7F2] text-[#706F6C] hover:text-[#075B50] hover:bg-emerald-50 transition border border-[#E5E3DC] flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                <span>Investor</span>
            </a>
        </div>
    </div>

    <!-- Title Header Sesuai Mockup -->
    <div class="flex items-start sm:items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1B1B18] tracking-tight">
                Formulir Pendaftaran UMKM
            </h1>
            <p class="text-xs sm:text-sm text-[#5E6E69] mt-1">
                Lengkapi data diri, profil usaha, dan preferensi lokasi ruko untuk diverifikasi oleh tim DAYA UMKM.
            </p>
        </div>

        <a href="{{ route('google.redirect') }}" 
           class="inline-flex items-center gap-2.5 px-4 py-2.5 border border-[#D0CFC7] hover:border-[#075B50] rounded-xl text-xs font-semibold text-[#1B1B18] bg-white hover:bg-[#F8F7F2] transition shadow-sm">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Daftar Cepat dengan Google</span>
        </a>
    </div>

    <!-- Alert Errors -->
    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs space-y-1">
            <div class="font-bold flex items-center gap-2">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>Mohon periksa kembali formulir Anda:</span>
            </div>
            <ul class="list-disc list-inside pl-1 text-[11px] space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="role" value="umkm">

        <!-- CARD 1: ALUR VERIFIKASI UMKM (Sesuai Mockup) -->
        <div class="bg-white rounded-2xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm">
            <h2 class="text-sm font-extrabold text-[#1B1B18] mb-3">
                Alur Verifikasi UMKM
            </h2>
            <ol class="space-y-1.5 text-xs text-[#5E6E69] leading-relaxed">
                <li class="flex items-start gap-2">
                    <span class="font-bold text-[#075B50]">1.</span>
                    <span>Isi formulir identitas penanggung jawab & detail produk di bawah ini.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-bold text-[#075B50]">2.</span>
                    <span>Admin akan mengonfirmasi data & verifikasi keabsahan profil usaha.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-bold text-[#075B50]">3.</span>
                    <span>Setelah verifikasi selesai, profil usaha Anda otomatis tayang di katalog investor dan siap menerima modal / sewa ruko.</span>
                </li>
            </ol>
        </div>

        <!-- CARD 2: BAGIAN 1 - IDENTITAS PENGAJU UMKM (Sesuai Mockup) -->
        <div class="bg-white rounded-2xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3">
                <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 1</span>
                <h3 class="text-base font-extrabold text-[#1B1B18]">Identitas Pengaju UMKM</h3>
            </div>

            <!-- Nama Lengkap Pemilik / Pengelola Usaha -->
            <div>
                <label for="nama" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                    Nama Lengkap Pemilik / Pengelola Usaha <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama') }}" 
                       required
                       placeholder="Contoh : WICIGO SHAWTY" 
                       class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
            </div>

            <!-- Nomor WhatsApp & Provinsi/Kota (2 Kolom Sesuai Mockup) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nomor_telepon" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Nomor WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nomor_telepon" 
                           name="nomor_telepon" 
                           value="{{ old('nomor_telepon') }}" 
                           required
                           placeholder="Contoh : 081234123" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>

                <div>
                    <label for="provinsi_kota" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Provinsi / Kota <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="provinsi_kota" 
                           name="provinsi_kota" 
                           value="{{ old('provinsi_kota') }}" 
                           required
                           placeholder="Contoh : DKI Jakarta / Jakarta Timur" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>
            </div>

            <!-- Kelurahan & Kecamatan (2 Kolom Sesuai Mockup) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="kelurahan" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Kelurahan
                    </label>
                    <input type="text" 
                           id="kelurahan" 
                           name="kelurahan" 
                           value="{{ old('kelurahan') }}" 
                           placeholder="Contoh : Cijantung" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>

                <div>
                    <label for="kecamatan" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Kecamatan
                    </label>
                    <input type="text" 
                           id="kecamatan" 
                           name="kecamatan" 
                           value="{{ old('kecamatan') }}" 
                           placeholder="Contoh : Pasar Rebo" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>
            </div>

            <!-- Kredensial Akun (Email & Password untuk Login) -->
            <div class="pt-3 border-t border-gray-100 space-y-4">
                <div>
                    <label for="email" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Alamat Email Akun <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           placeholder="email-usaha@gmail.com (Digunakan untuk login & menerima OTP)" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                            Kata Sandi Akun <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="Minimal 8 karakter (Huruf, Angka, Simbol)" 
                               class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                            Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               placeholder="Ulangi kata sandi Anda" 
                               class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 3: BAGIAN 2 - INFORMASI USAHA & PRODUK (Sesuai Mockup) -->
        <div class="bg-white rounded-2xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3">
                <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 2</span>
                <h3 class="text-base font-extrabold text-[#1B1B18]">Informasi Usaha & Produk</h3>
            </div>

            <!-- Nama Usaha -->
            <div>
                <label for="nama_usaha" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                    Nama Usaha <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama_usaha" 
                       name="nama_usaha" 
                       value="{{ old('nama_usaha') }}" 
                       required
                       placeholder="Contoh : Raka Wibian Coffee & Snack" 
                       class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
            </div>

            <!-- Kategori Usaha & Foto Produk (2 Kolom Sesuai Mockup) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                <div>
                    <label for="kategori_usaha" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Kategori Usaha <span class="text-red-500">*</span>
                    </label>
                    <select id="kategori_usaha" 
                            name="kategori_usaha" 
                            required
                            class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                        <option value="">Pilih Kategori Usaha</option>
                        <option value="Makanan" {{ old('kategori_usaha') === 'Makanan' ? 'selected' : '' }}>Makanan & Minuman (F&B)</option>
                        <option value="Jasa" {{ old('kategori_usaha') === 'Jasa' ? 'selected' : '' }}>Jasa Layanan</option>
                        <option value="Fashion" {{ old('kategori_usaha') === 'Fashion' ? 'selected' : '' }}>Fashion & Pakaian</option>
                        <option value="Agribisnis" {{ old('kategori_usaha') === 'Agribisnis' ? 'selected' : '' }}>Agribisnis & Pertanian</option>
                        <option value="Retail" {{ old('kategori_usaha') === 'Retail' ? 'selected' : '' }}>Retail & Toko Kelontong</option>
                        <option value="Kreatif" {{ old('kategori_usaha') === 'Kreatif' ? 'selected' : '' }}>Industri Kreatif & Kerajinan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Foto Produk / Banner Usaha
                    </label>
                    <div class="relative flex items-center">
                        <input type="file" 
                               id="foto_produk" 
                               name="foto_produk" 
                               accept="image/*"
                               class="hidden" 
                               onchange="updateFileName(this, 'foto_produk_label')">
                        <label for="foto_produk" 
                               id="foto_produk_label"
                               class="w-full px-4 py-2.5 bg-[#F8F7F2] hover:bg-emerald-50 text-[#075B50] border border-dashed border-[#075B50]/50 rounded-xl text-xs font-bold text-center cursor-pointer transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Upload File</span>
                        </label>
                    </div>
                    <span class="text-[10px] text-gray-500 mt-1 block">Format: JPG, PNG, WEBP (Maks. 5MB)</span>
                </div>
            </div>

            <!-- Deskripsi Usaha & File Proposal (2 Kolom Sesuai Mockup) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                <div>
                    <label for="deskripsi" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Deskripsi Singkat Usaha
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="3" 
                              placeholder="Jelaskan jenis produk, keunikan usaha, dan target pasar Anda..."
                              class="w-full px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">{{ old('deskripsi') }}</textarea>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-semibold text-[#1B1B18]">
                            File Proposal Usaha
                        </label>
                        <a href="#" onclick="alert('Format proposal meliputi profil usaha, rencana penggunaan modal, dan estimasi bagi hasil bulanan.'); return false;" class="text-[11px] text-[#245DA8] hover:underline font-semibold">
                            Contoh Format Proposal
                        </a>
                    </div>
                    <div class="relative flex items-center">
                        <input type="file" 
                               id="file_proposal" 
                               name="file_proposal" 
                               accept=".pdf,.doc,.docx,.zip"
                               class="hidden" 
                               onchange="updateFileName(this, 'file_proposal_label')">
                        <label for="file_proposal" 
                               id="file_proposal_label"
                               class="w-full px-4 py-2.5 bg-[#F8F7F2] hover:bg-emerald-50 text-[#075B50] border border-dashed border-[#075B50]/50 rounded-xl text-xs font-bold text-center cursor-pointer transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <span>Upload File</span>
                        </label>
                    </div>
                    <span class="text-[10px] text-gray-500 mt-1 block">Format: PDF, DOC, DOCX, ZIP (Maks. 10MB)</span>
                </div>
            </div>
        </div>

        <!-- CARD 4: BAGIAN 3 - LOKASI RUKO (Sesuai Mockup) -->
        <div class="bg-white rounded-2xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3 flex items-center justify-between flex-wrap gap-2">
                <div>
                    <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 3</span>
                    <h3 class="text-base font-extrabold text-[#1B1B18]">Lokasi Ruko (Pilihan Minat Sewa)</h3>
                </div>
                <span class="text-[11px] text-[#706F6C] italic">*Opsional: Pilih jika Anda membutuhkan tempat ruko</span>
            </div>

            <!-- Search Bar Ruko (Sesuai Mockup) -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" 
                       id="ruko-search" 
                       onkeyup="filterRukoCards()"
                       placeholder="Telusuri ruko berdasarkan nama atau lokasi..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-[#F8F7F2]/80 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
            </div>

            <!-- Color Palette Card Grid Ruko Sesuai Mockup -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-1" id="ruko-grid">
                @php
                    $colors = [
                        ['bg' => 'bg-[#A85858]', 'border' => 'border-rose-300', 'badge' => 'bg-rose-100 text-rose-800'],
                        ['bg' => 'bg-[#A9DFD8]', 'border' => 'border-teal-300', 'badge' => 'bg-teal-100 text-teal-800'],
                        ['bg' => 'bg-[#C59BCC]', 'border' => 'border-purple-300', 'badge' => 'bg-purple-100 text-purple-800'],
                        ['bg' => 'bg-[#C5C88F]', 'border' => 'border-yellow-300', 'badge' => 'bg-amber-100 text-amber-800'],
                    ];
                @endphp

                @forelse ($rukos as $index => $ruko)
                    @php
                        $colorScheme = $colors[$index % count($colors)];
                    @endphp
                    <label class="ruko-card cursor-pointer block group">
                        <input type="radio" 
                               name="id_ruko" 
                               value="{{ $ruko->id_ruko }}" 
                               class="hidden peer"
                               {{ old('id_ruko') == $ruko->id_ruko ? 'checked' : '' }}>
                        
                        <div class="rounded-2xl border-2 border-transparent peer-checked:border-[#075B50] peer-checked:ring-4 peer-checked:ring-emerald-500/20 bg-white p-3 shadow-sm hover:shadow-md transition-all flex flex-col">
                            <!-- Pastel Color Block Seperti di Mockup -->
                            <div class="w-full aspect-[4/3] rounded-xl {{ $colorScheme['bg'] }} flex flex-col items-center justify-center p-3 text-white text-center shadow-inner relative group-hover:scale-[1.02] transition-transform">
                                <svg class="w-7 h-7 text-white/90 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="font-bold text-[11px] leading-tight text-white drop-shadow">{{ $ruko->nama_ruko }}</span>
                            </div>

                            <!-- Detail Ruko -->
                            <div class="mt-2.5 text-left space-y-1">
                                <div class="text-[11px] font-bold text-[#1B1B18] line-clamp-1 ruko-title">{{ $ruko->nama_ruko }}</div>
                                <div class="text-[10px] text-gray-500 line-clamp-1 ruko-loc">{{ $ruko->lokasi }}</div>
                                <div class="text-[11px] font-extrabold text-[#075B50]">
                                    Rp {{ number_format($ruko->harga_sewa_per_bulan, 0, ',', '.') }}/bln
                                </div>
                            </div>
                        </div>
                    </label>
                @empty
                    <div class="col-span-4 p-6 text-center text-xs text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        Belum ada unit ruko yang terdaftar saat ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Submit Button & OTP Notice -->
        <div class="pt-2 space-y-4">
            <button type="submit" 
                    class="w-full py-4 bg-[#075B50] hover:bg-[#26734D] text-white font-extrabold text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                <span>Daftar Pelaku UMKM & Kirim Kode OTP</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>

            <div class="text-center text-xs text-[#706F6C]">
                Sudah memiliki akun DAYA UMKM? 
                <a href="{{ route('login') }}" class="font-bold text-[#075B50] hover:underline">Masuk ke sini</a>
            </div>
        </div>

    </form>

</div>

<script>
    function updateFileName(input, labelId) {
        const label = document.getElementById(labelId);
        if (input.files && input.files.length > 0) {
            label.innerHTML = `
                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="truncate max-w-[200px] text-emerald-700">${input.files[0].name}</span>
            `;
            label.classList.add('bg-emerald-50', 'border-emerald-500');
        }
    }

    function filterRukoCards() {
        const query = document.getElementById('ruko-search').value.toLowerCase();
        const cards = document.querySelectorAll('.ruko-card');
        cards.forEach(card => {
            const title = card.querySelector('.ruko-title').innerText.toLowerCase();
            const loc = card.querySelector('.ruko-loc').innerText.toLowerCase();
            if (title.includes(query) || loc.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
