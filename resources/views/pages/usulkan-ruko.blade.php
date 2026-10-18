@extends('layouts.auth')

@section('title', 'Usulkan Lokasi Ruko & Tempat Usaha UMKM')

@section('content')
<main class="w-full flex-1 pt-28 sm:pt-32 pb-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- HEADER & HERO USULKAN RUKO -->
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-teal-100 text-[#0F433C] border border-teal-200 mb-4">
                <span>📍</span>
                <span>KEMITRAAN TEMPAT USAHA & CROWDSOURCING</span>
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#15241C] tracking-tight leading-tight">
                Punya Info Ruko Kosong? <br class="hidden sm:inline">
                <span class="text-[#0F433C]">Daftarkan Lokasi Usaha di TIKUM</span>
            </h1>

            <p class="text-sm sm:text-base text-gray-600 mt-3 sm:mt-4 leading-relaxed font-medium">
                Bantu UMKM binaan menemukan tempat usaha komersial yang strategis. Siapa pun dapat mengusulkan lokasi ruko (pemilik, agen properti, maupun warga sekitar). Usulan yang lolos kurasi berpeluang <strong>didanai penuh sewa tahunannya</strong> oleh Mitra Investor ekosistem.
            </p>
        </div>

        <!-- 3 NILAI KEUNTUNGAN MENDAFTARKAN RUKO -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
            <div class="bg-white rounded-2xl p-5 border border-[#E8E6DF] shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#0F433C] flex items-center justify-center font-bold text-lg shrink-0">
                    🏢
                </div>
                <div>
                    <h2 class="text-xs font-black uppercase tracking-wider text-gray-900">Penyewa UMKM Terkurasi</h2>
                    <p class="text-[11px] text-gray-500 mt-0.5">Ruko diisi oleh UMKM yang telah diverifikasi profil bisnis & legalitasnya.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-[#E8E6DF] shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center font-bold text-lg shrink-0">
                    💰
                </div>
                <div>
                    <h2 class="text-xs font-black uppercase tracking-wider text-gray-900">Peluang Sponsor Investor</h2>
                    <p class="text-[11px] text-gray-500 mt-0.5">Investor platform siap membayarkan dana sewa ruko bagi UMKM yang terpilih.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-[#E8E6DF] shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-800 flex items-center justify-center font-bold text-lg shrink-0">
                    ✓
                </div>
                <div>
                    <h2 class="text-xs font-black uppercase tracking-wider text-gray-900">Kurasi & Publikasi Gratis</h2>
                    <p class="text-[11px] text-gray-500 mt-0.5">Peninjauan kelayakan lokasi dan penayangan di katalog tanpa biaya.</p>
                </div>
            </div>
        </div>

        <!-- NOTIFIKASI BERHASIL -->
        @if(session('success'))
            <div class="mb-8 p-6 rounded-3xl bg-emerald-50 border-2 border-emerald-300 text-emerald-950 shadow-md">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-500 text-white flex items-center justify-center font-black text-xl shrink-0">
                        ✓
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold text-emerald-900 leading-snug">Usulan Ruko Berhasil Dikirim!</h2>
                        <p class="text-xs sm:text-sm text-emerald-800 mt-1 font-medium leading-relaxed">
                            {{ session('success') }}
                        </p>
                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl bg-[#0F433C] text-white text-xs font-bold hover:bg-[#19584F] transition">
                                Kembali ke Beranda
                            </a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl border border-emerald-300 text-emerald-900 text-xs font-bold hover:bg-emerald-100 transition">
                                    Buka Dashboard Saya
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- KARTU FORMULIR PENGUSULAN RUKO -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-[#E8E6DF]">
            <form action="{{ route('ruko.usulkan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- SEKSI 1: IDENTITAS PENGUSUL -->
                <div class="space-y-4">
                    <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-teal-700 block">Langkah 1 dari 3</span>
                            <h2 class="text-base sm:text-lg font-black text-gray-900">Identitas Pengusul</h2>
                        </div>
                        @auth
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-teal-50 text-[#0F433C] border border-teal-200">
                                Akun Terdaftar: {{ Auth::user()->name }}
                            </span>
                        @endauth
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                Nama Lengkap Pengusul *
                            </label>
                            <input type="text" name="nama_pengusul" required 
                                   value="{{ old('nama_pengusul', Auth::user()->name ?? '') }}"
                                   placeholder="Contoh: Bpk. Bambang Sutrisno"
                                   class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-[#0F433C] outline-none">
                            @error('nama_pengusul')
                                <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                Nomor WhatsApp / Telepon *
                            </label>
                            <input type="text" name="kontak_pengusul" required 
                                   value="{{ old('kontak_pengusul', Auth::user()->phone_number ?? '') }}"
                                   placeholder="Contoh: 081234567890"
                                   class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-[#0F433C] outline-none">
                            <span class="text-[10px] text-gray-400 mt-1 block">Nomor ini digunakan tim kurator untuk konfirmasi detail lokasi.</span>
                            @error('kontak_pengusul')
                                <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEKSI 2: DETAIL RUKO & LOKASI -->
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <div class="border-b border-gray-100 pb-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-teal-700 block">Langkah 2 dari 3</span>
                        <h2 class="text-base sm:text-lg font-black text-gray-900">Spesifikasi & Lokasi Ruko</h2>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                            Nama Ruko / Kompleks Komersial *
                        </label>
                        <input type="text" name="nama_ruko" required 
                               value="{{ old('nama_ruko') }}"
                               placeholder="Contoh: Ruko Boulevard Gading Serpong Blok AA No. 12"
                               class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-[#0F433C] outline-none">
                        @error('nama_ruko')
                            <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                            Alamat Lengkap, Kota & Patokan *
                        </label>
                        <textarea name="lokasi" required rows="3" 
                                  placeholder="Contoh: Jl. Boulevard Raya Barat No. 12, Kelapa Dua, Tangerang, Banten (Dekat Kampus UMN, Seberang SPBU Pertamina)"
                                  class="w-full p-4 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-[#0F433C] outline-none">{{ old('lokasi') }}</textarea>
                        @error('lokasi')
                            <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- UPLOAD FOTO RUKO -->
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                            Foto Fisik Ruko / Lokasi (Tampak Depan & Jalan)
                        </label>
                        <div class="p-4 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 text-center hover:bg-teal-50/50 hover:border-teal-300 transition">
                            <input type="file" name="foto_ruko" id="foto_ruko" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0F433C] file:text-white hover:file:bg-[#19584F] cursor-pointer">
                            <p class="text-[11px] text-gray-400 mt-2">Mendukung format JPG, PNG, atau WebP (Maksimal 5MB). Foto tampak depan jalan sangat membantu kurasi.</p>
                        </div>
                        @error('foto_ruko')
                            <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- SEKSI 3: FINANSIAL & POTENSI USAHA -->
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <div class="border-b border-gray-100 pb-3">
                        <span class="text-[10px] font-black uppercase tracking-widest text-teal-700 block">Langkah 3 dari 3</span>
                        <h2 class="text-base sm:text-lg font-black text-gray-900">Perkiraan Biaya Sewa & Potensi Usaha</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                Perkiraan Harga Sewa per Bulan (Rp) *
                            </label>
                            <input type="number" name="harga_sewa_per_bulan" required min="100000" step="100000"
                                   value="{{ old('harga_sewa_per_bulan') }}"
                                   placeholder="Contoh: 4500000"
                                   class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-xs font-black text-[#0F433C] focus:ring-2 focus:ring-[#0F433C] outline-none">
                            <span class="text-[10px] text-gray-400 mt-1 block">Jika sewa tahunan, bagi 12 bulan (misal Rp 60 jt/thn = Rp 5.000.000/bln).</span>
                            @error('harga_sewa_per_bulan')
                                <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                                Kontak Pemilik Ruko / Agen Pemasar
                            </label>
                            <input type="text" name="kontak_pemilik" 
                                   value="{{ old('kontak_pemilik') }}"
                                   placeholder="Contoh: 081987654321 (Pak Haji Ahmad)"
                                   class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-[#0F433C] outline-none">
                            <span class="text-[10px] text-gray-400 mt-1 block">Boleh dikosongkan jika pengusul adalah pemilik langsung.</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                            Potensi Usaha & Mengapa Tempat Ini Cocok untuk UMKM
                        </label>
                        <textarea name="potensi_usaha" rows="3" 
                                  placeholder="Contoh: Kawasan sangat ramai lalu-lintas pekerja dan mahasiswa. Dekat perkantoran, parkiran luas, cocok untuk gerai kuliner, kopi kekinian, laundry, atau apotek."
                                  class="w-full p-4 rounded-2xl border border-gray-200 text-xs font-medium focus:ring-2 focus:ring-[#0F433C] outline-none">{{ old('potensi_usaha') }}</textarea>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-[11px] text-gray-400 max-w-md">
                        Dengan menekan tombol di bawah, Anda mengonfirmasi bahwa data lokasi yang diusulkan adalah akurat untuk ditinjau oleh kurator TIKUM.
                    </p>

                    <button type="submit" 
                            class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-[#0F433C] hover:bg-[#19584F] text-white text-sm font-extrabold shadow-lg hover:shadow-xl transition transform active:scale-95 flex items-center justify-center gap-2">
                        <span>Kirim Rekomendasi Ruko</span>
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>

            </form>
        </div>

    </div>
</main>
@endsection
