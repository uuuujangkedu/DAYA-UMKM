@extends('layouts.auth')

@section('title', 'Formulir Pendaftaran Pelaku UMKM - DAYA UMKM')

@section('content')
<div class="w-full max-w-4xl py-6 space-y-8">

    <!-- Progress Indicator Stepper -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 border border-[#E5E3DC] shadow-sm flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-emerald-100 text-[#075B50] flex items-center justify-center font-bold text-xs">
                ✓
            </span>
            <div>
                <span class="text-xs font-bold text-[#1B1B18] block">Langkah 1: Akun & Verifikasi Email</span>
                <span class="text-[10px] text-emerald-600 font-semibold">Selesai Terverifikasi</span>
            </div>
        </div>

        <div class="hidden sm:block w-12 h-px bg-emerald-300"></div>

        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-full bg-[#075B50] text-white flex items-center justify-center font-bold text-xs shadow">
                2
            </span>
            <div>
                <span class="text-xs font-bold text-[#075B50] block">Langkah 2: Formulir UMKM & Ruko</span>
                <span class="text-[10px] text-[#706F6C]">Lengkapi profil usaha & dokumen</span>
            </div>
        </div>

        <div class="hidden sm:block w-12 h-px bg-gray-200"></div>

        <div class="flex items-center gap-3 opacity-60">
            <span class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-xs">
                3
            </span>
            <div>
                <span class="text-xs font-bold text-[#1B1B18] block">Langkah 3: Verifikasi Admin & Tayang</span>
                <span class="text-[10px] text-[#706F6C]">Siap menerima modal investor</span>
            </div>
        </div>
    </div>

    <!-- Title Header Sesuai Mockup Wireframe -->
    <div class="flex items-start sm:items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1B1B18] tracking-tight">
                Formulir Pendaftaran Pelaku UMKM
            </h1>
            <p class="text-xs sm:text-sm text-[#5E6E69] mt-1">
                Lengkapi data diri, profil usaha, dan preferensi lokasi ruko untuk diverifikasi oleh tim DAYA UMKM.
            </p>
        </div>

        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-teal-50 text-[#075B50] text-xs font-bold border border-teal-200">
            <span class="w-2 h-2 rounded-full bg-teal-500"></span>
            <span>Akun {{ $user->email }} (Aktif)</span>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs font-bold flex items-center gap-2">
            <span>✓</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 text-xs space-y-1">
            <div class="font-bold">Mohon periksa kembali formulir Anda:</div>
            <ul class="list-disc list-inside text-[11px]">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('formulir.umkm.post') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- CARD 1: ALUR VERIFIKASI UMKM (Sesuai Mockup) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm">
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

        <!-- CARD 2: BAGIAN 1 - IDENTITAS PENGAJU UMKM -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3">
                <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 1</span>
                <h3 class="text-base font-extrabold text-[#1B1B18]">Identitas Pengaju UMKM</h3>
            </div>

            <!-- Nama Lengkap Pemilik -->
            <div>
                <label for="pemilik" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                    Nama Lengkap Pemilik / Pengelola Usaha <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="pemilik" 
                       name="pemilik" 
                       value="{{ old('pemilik', $umkm->pemilik ?? $user->name) }}" 
                       required
                       placeholder="Contoh : Rian Hidayat" 
                       class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
            </div>

            <!-- NIK KTP & Nomor WhatsApp Usaha -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nik_penanggung_jawab" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        NIK KTP Penanggung Jawab
                    </label>
                    <input type="text" 
                           id="nik_penanggung_jawab" 
                           name="nik_penanggung_jawab" 
                           value="{{ old('nik_penanggung_jawab', $umkm->nik_penanggung_jawab) }}" 
                           placeholder="16 digit NIK KTP" 
                           maxlength="20"
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>

                <div>
                    <label for="nomor_whatsapp" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Nomor WhatsApp Usaha Aktif <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nomor_whatsapp" 
                           name="nomor_whatsapp" 
                           value="{{ old('nomor_whatsapp', $umkm->nomor_whatsapp ?? $user->phone_number) }}" 
                           required
                           placeholder="0812xxxxxxxx" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>
            </div>

            <!-- Wilayah Usaha Sesuai Mockup -->
            <div>
                <label class="block text-xs font-semibold text-[#1B1B18] mb-2">
                    Wilayah Domisili Usaha
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <input type="text" 
                           name="provinsi_kota" 
                           value="{{ old('provinsi_kota', $umkm->provinsi_kota ?? $user->provinsi_kota) }}" 
                           placeholder="Provinsi / Kota" 
                           class="px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                    
                    <input type="text" 
                           name="kecamatan" 
                           value="{{ old('kecamatan', $umkm->kecamatan ?? $user->kecamatan) }}" 
                           placeholder="Kecamatan" 
                           class="px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                    
                    <input type="text" 
                           name="kelurahan" 
                           value="{{ old('kelurahan', $umkm->kelurahan ?? $user->kelurahan) }}" 
                           placeholder="Kelurahan" 
                           class="px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                </div>
            </div>
        </div>

        <!-- CARD 3: BAGIAN 2 - INFORMASI USAHA & PRODUK -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3">
                <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 2</span>
                <h3 class="text-base font-extrabold text-[#1B1B18]">Informasi Usaha & Produk</h3>
            </div>

            <!-- Nama Usaha & Jenis Usaha -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nama_usaha" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Nama Usaha / Merk Dagang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama_usaha" 
                           name="nama_usaha" 
                           value="{{ old('nama_usaha', $umkm->nama_usaha) }}" 
                           placeholder="Contoh : Kopi Selaras Nusantara" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>

                <div>
                    <label for="jenis_usaha" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Kategori Sektor Usaha <span class="text-red-500">*</span>
                    </label>
                    @php $kategoriCurrent = old('jenis_usaha', $umkm->jenis_usaha ?? 'Makanan'); @endphp
                    <select id="jenis_usaha" 
                            name="jenis_usaha" 
                            class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                        <option value="Makanan" {{ $kategoriCurrent === 'Makanan' ? 'selected' : '' }}>Makanan & Minuman (F&B)</option>
                        <option value="Jasa" {{ $kategoriCurrent === 'Jasa' ? 'selected' : '' }}>Jasa & Layanan</option>
                        <option value="Fashion" {{ $kategoriCurrent === 'Fashion' ? 'selected' : '' }}>Fashion & Pakaian</option>
                        <option value="Agribisnis" {{ $kategoriCurrent === 'Agribisnis' ? 'selected' : '' }}>Agribisnis & Pertanian</option>
                        <option value="Retail" {{ $kategoriCurrent === 'Retail' ? 'selected' : '' }}>Retail & Toko Kelontong</option>
                        <option value="Kerajinan" {{ $kategoriCurrent === 'Kerajinan' ? 'selected' : '' }}>Kerajinan Tangan / Kriya</option>
                    </select>
                </div>
            </div>

            <!-- Target Modal & Estimasi Bagi Hasil -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="modal_dibutuhkan" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Kebutuhan Permodalan (Rp)
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-xs font-bold text-gray-500 pointer-events-none">Rp</span>
                        <input type="number" 
                               id="modal_dibutuhkan" 
                               name="modal_dibutuhkan" 
                               value="{{ old('modal_dibutuhkan', $umkm->modal_dibutuhkan) }}" 
                               placeholder="Contoh: 25000000" 
                               class="w-full pl-10 pr-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                    </div>
                </div>

                <div>
                    <label for="estimasi_bagi_hasil" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Estimasi Bagi Hasil Bulanan
                    </label>
                    <input type="text" 
                           id="estimasi_bagi_hasil" 
                           name="estimasi_bagi_hasil" 
                           value="{{ old('estimasi_bagi_hasil', $umkm->estimasi_bagi_hasil ?? '15% per bulan') }}" 
                           placeholder="Contoh: 15% dari laba bersih per bulan" 
                           class="w-full px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                </div>
            </div>

            <!-- Upload Foto & Proposal Usaha Sesuai Mockup -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Foto Produk / Usaha
                    </label>
                    @if ($umkm->foto_produk)
                        <div class="mb-2 flex items-center gap-2 p-2 bg-emerald-50 rounded-lg border border-emerald-200">
                            <img src="{{ asset('storage/' . $umkm->foto_produk) }}" class="w-10 h-10 rounded object-cover">
                            <span class="text-[11px] text-emerald-800 font-medium truncate">Foto saat ini terpasang</span>
                        </div>
                    @endif
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
                        <span>{{ $umkm->foto_produk ? 'Ganti Foto Produk' : 'Upload Foto Produk' }}</span>
                    </label>
                    <span class="text-[10px] text-gray-500 mt-1 block">Format: JPG, PNG, WEBP (Maks. 5MB)</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        File Proposal Usaha (.PDF / .DOC)
                    </label>
                    @if ($umkm->file_proposal)
                        <div class="mb-2 flex items-center justify-between p-2 bg-emerald-50 rounded-lg border border-emerald-200 text-[11px] text-emerald-800">
                            <span class="truncate font-medium">📄 Proposal terupload</span>
                            <a href="{{ asset('storage/' . $umkm->file_proposal) }}" target="_blank" class="text-[#075B50] font-bold hover:underline">Unduh</a>
                        </div>
                    @endif
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
                        <span>{{ $umkm->file_proposal ? 'Ganti File Proposal' : 'Upload File Proposal' }}</span>
                    </label>
                    <span class="text-[10px] text-gray-500 mt-1 block">Format: PDF, DOC, DOCX, ZIP (Maks. 10MB)</span>
                </div>
            </div>

            <!-- Deskripsi Singkat Usaha -->
            <div>
                <label for="deskripsi" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                    Deskripsi Singkat Usaha
                </label>
                <textarea id="deskripsi" 
                          name="deskripsi" 
                          rows="3" 
                          placeholder="Jelaskan jenis produk, keunikan usaha, dan target pasar Anda.."
                          class="w-full px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
            </div>
        </div>

        <!-- CARD 4: BAGIAN 3 - LOKASI RUKO (PILIHAN MINAT SEWA) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3 flex items-center justify-between flex-wrap gap-2">
                <div>
                    <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 3</span>
                    <h3 class="text-base font-extrabold text-[#1B1B18]">Lokasi Ruko (Pilihan Minat Sewa)</h3>
                </div>
                <span class="text-[11px] text-[#706F6C] italic">*Opsional: Pilih jika Anda membutuhkan tempat ruko</span>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" 
                       id="ruko-search" 
                       onkeyup="filterRukoCards()"
                       placeholder="Telusuri ruko berdasarkan nama atau lokasi.." 
                       class="w-full pl-10 pr-4 py-2.5 bg-[#F8F7F2]/80 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
            </div>

            <!-- Grid Ruko -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-1" id="ruko-grid">
                @php
                    $palette = [
                        ['bg' => 'bg-[#98817B]'],
                        ['bg' => 'bg-[#7E8B92]'],
                        ['bg' => 'bg-[#8A9A86]'],
                        ['bg' => 'bg-[#8F8275]'],
                    ];
                    $selectedRukoId = old('id_ruko_diminati', $umkm->id_ruko_diminati);
                @endphp

                @forelse ($rukos as $index => $ruko)
                    @php $color = $palette[$index % count($palette)]; @endphp
                    <label class="ruko-card block rounded-2xl border-2 {{ $selectedRukoId == $ruko->id_ruko ? 'border-[#075B50] ring-2 ring-[#075B50]/30 shadow-md' : 'border-[#E5E3DC] hover:border-gray-400' }} p-3.5 cursor-pointer transition bg-white relative group">
                        <input type="radio" 
                               name="id_ruko_diminati" 
                               value="{{ $ruko->id_ruko }}" 
                               {{ $selectedRukoId == $ruko->id_ruko ? 'checked' : '' }}
                               class="absolute top-3 right-3 text-[#075B50] focus:ring-[#075B50]">
                        
                        <div class="w-full h-24 rounded-xl {{ $color['bg'] }} flex flex-col items-center justify-center text-white mb-3 shadow-inner">
                            <span class="text-xs font-black tracking-wider uppercase">DAYA RUKO</span>
                            <span class="text-[10px] opacity-80">{{ $ruko->nama_ruko }}</span>
                        </div>

                        <div class="space-y-1">
                            <h4 class="ruko-title text-xs font-extrabold text-[#1B1B18] truncate group-hover:text-[#075B50] transition">
                                {{ $ruko->nama_ruko }}
                            </h4>
                            <p class="ruko-loc text-[10px] text-[#706F6C] line-clamp-2">
                                📍 {{ $ruko->lokasi }}
                            </p>
                            <div class="pt-1 text-[11px] font-bold text-[#075B50]">
                                Rp {{ number_format($ruko->harga_sewa_per_bulan, 0, ',', '.') }} <span class="text-[9px] font-normal text-gray-500">/bln</span>
                            </div>
                        </div>
                    </label>
                @empty
                    <div class="col-span-4 p-6 text-center text-xs text-gray-400 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        Belum ada unit ruko yang terdaftar saat ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Tombol Aksi: Simpan Draf & Kirim Pengajuan -->
        <div class="bg-white rounded-3xl p-6 border border-[#E5E3DC] shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-[#706F6C]">
                Data tersimpan otomatis dalam akun Anda. Anda dapat kembali melengkapinya kapan saja.
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="submit" 
                        name="aksi" 
                        value="simpan_draf"
                        class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-gray-300 hover:border-[#075B50] text-[#1B1B18] hover:text-[#075B50] bg-white hover:bg-gray-50 text-xs font-bold transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    <span>Simpan Draf</span>
                </button>

                <button type="submit" 
                        name="aksi" 
                        value="kirim_pengajuan"
                        class="w-full sm:w-auto px-7 py-3.5 bg-[#075B50] hover:bg-[#26734D] text-white text-xs font-extrabold uppercase tracking-wider rounded-xl shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                    <span>Kirim Pengajuan ke Admin</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
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
