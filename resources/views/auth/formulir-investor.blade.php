@extends('layouts.auth')

@section('title', 'Formulir Pendaftaran Investor - DAYA UMKM')

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
                <span class="text-xs font-bold text-[#075B50] block">Langkah 2: Formulir Investor</span>
                <span class="text-[10px] text-[#706F6C]">Lengkapi identitas & preferensi minat</span>
            </div>
        </div>

        <div class="hidden sm:block w-12 h-px bg-gray-200"></div>

        <div class="flex items-center gap-3 opacity-60">
            <span class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-bold text-xs">
                3
            </span>
            <div>
                <span class="text-xs font-bold text-[#1B1B18] block">Langkah 3: Dashboard & Mulai Danai</span>
                <span class="text-[10px] text-[#706F6C]">Katalog siap diakses</span>
            </div>
        </div>
    </div>

    <!-- Title Header Sesuai Mockup Wireframe -->
    <div class="flex items-start sm:items-center justify-between flex-wrap gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#1B1B18] tracking-tight">
                Formulir Pendaftaran Investor
            </h1>
            <p class="text-xs sm:text-sm text-[#5E6E69] mt-1">
                Lengkapi data profil pemodal dan preferensi sektor UMKM yang ingin Anda biayai.
            </p>
        </div>

        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-[#075B50] text-xs font-bold border border-emerald-200">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
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

    <form action="{{ route('formulir.investor.post') }}" method="POST" class="space-y-6">
        @csrf

        <!-- CARD 1: ALUR VERIFIKASI INVESTOR (Sesuai Mockup) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm">
            <h2 class="text-sm font-extrabold text-[#1B1B18] mb-3">
                Alur Verifikasi Investor
            </h2>
            <ol class="space-y-1.5 text-xs text-[#5E6E69] leading-relaxed">
                <li class="flex items-start gap-2">
                    <span class="font-bold text-[#075B50]">1.</span>
                    <span>Isi formulir identitas penanggung jawab & preferensi investasi di bawah ini.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-bold text-[#075B50]">2.</span>
                    <span>Admin akan mengonfirmasi profil preferensi akun Anda.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="font-bold text-[#075B50]">3.</span>
                    <span>Setelah selesai, Anda dapat langsung mulai mendanai UMKM produktif pilihan di katalog.</span>
                </li>
            </ol>
        </div>

        <!-- CARD 2: BAGIAN 1 - IDENTITAS PENDAFTAR INVESTOR -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3">
                <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 1</span>
                <h3 class="text-base font-extrabold text-[#1B1B18]">Identitas Pendaftar Investor</h3>
            </div>

            <!-- Nama Lengkap Investor -->
            <div>
                <label for="nama" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                    Nama Lengkap Investor <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama', $user->name) }}" 
                       required
                       placeholder="Contoh : WICIGO SHAWTY" 
                       class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
            </div>

            <!-- Nomor WhatsApp & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nomor_telepon" class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Nomor WhatsApp Aktif <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nomor_telepon" 
                           name="nomor_telepon" 
                           value="{{ old('nomor_telepon', $user->phone_number) }}" 
                           required
                           placeholder="0812xxxxxxxx" 
                           class="w-full px-4 py-3 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] focus:ring-2 focus:ring-[#075B50]/20 rounded-xl text-xs text-[#1B1B18] transition outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#1B1B18] mb-1.5">
                        Alamat Email Akun
                    </label>
                    <input type="email" 
                           value="{{ $user->email }}" 
                           disabled
                           class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-xs text-gray-600 outline-none cursor-not-allowed">
                    <span class="text-[10px] text-emerald-600 font-bold mt-1 block">✓ Email telah terverifikasi via OTP</span>
                </div>
            </div>

            <!-- Wilayah Domisili (Provinsi/Kota, Kecamatan, Kelurahan) Sesuai Mockup -->
            <div>
                <label class="block text-xs font-semibold text-[#1B1B18] mb-2">
                    Wilayah Domisili / Kantor
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <input type="text" 
                           name="provinsi_kota" 
                           value="{{ old('provinsi_kota', $user->provinsi_kota) }}" 
                           placeholder="Provinsi / Kota" 
                           class="px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                    
                    <input type="text" 
                           name="kecamatan" 
                           value="{{ old('kecamatan', $user->kecamatan) }}" 
                           placeholder="Kecamatan" 
                           class="px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                    
                    <input type="text" 
                           name="kelurahan" 
                           value="{{ old('kelurahan', $user->kelurahan) }}" 
                           placeholder="Kelurahan" 
                           class="px-4 py-2.5 bg-[#F8F7F2]/60 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
                </div>
            </div>
        </div>

        <!-- CARD 3: BAGIAN 2 - INFORMASI UMKM / MINAT INVESTASI (Sesuai Mockup) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#E5E3DC] shadow-sm space-y-5">
            <div class="border-b border-[#E5E3DC] pb-3 flex items-center justify-between flex-wrap gap-2">
                <div>
                    <span class="text-[11px] font-bold text-[#075B50] uppercase tracking-wider">Bagian 2</span>
                    <h3 class="text-base font-extrabold text-[#1B1B18]">Informasi UMKM (Minat Pendanaan)</h3>
                </div>
                <span class="text-[11px] text-[#706F6C] italic">*Pilih kategori sektor yang ingin Anda danai</span>
            </div>

            <!-- Kategori Filter Tabs (Makanan, Jasa, Fashion, Agribisnis) Sesuai Mockup -->
            <input type="hidden" name="kategori_diminati" id="kategori_diminati" value="{{ old('kategori_diminati', $user->kategori_diminati ?? 'Semua') }}">
            <div class="flex items-center gap-2 flex-wrap">
                <button type="button" 
                        onclick="selectCategory('Semua', this)"
                        class="cat-filter-btn px-4 py-2 rounded-xl text-xs font-bold bg-[#075B50] text-white transition shadow-sm">
                    Semua
                </button>
                <button type="button" 
                        onclick="selectCategory('Makanan', this)"
                        class="cat-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-[#F8F7F2] text-[#5E6E69] hover:bg-emerald-50 hover:text-[#075B50] border border-[#E5E3DC] transition">
                    Makanan & Minuman
                </button>
                <button type="button" 
                        onclick="selectCategory('Jasa', this)"
                        class="cat-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-[#F8F7F2] text-[#5E6E69] hover:bg-emerald-50 hover:text-[#075B50] border border-[#E5E3DC] transition">
                    Jasa Layanan
                </button>
                <button type="button" 
                        onclick="selectCategory('Fashion', this)"
                        class="cat-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-[#F8F7F2] text-[#5E6E69] hover:bg-emerald-50 hover:text-[#075B50] border border-[#E5E3DC] transition">
                    Fashion
                </button>
                <button type="button" 
                        onclick="selectCategory('Agribisnis', this)"
                        class="cat-filter-btn px-4 py-2 rounded-xl text-xs font-semibold bg-[#F8F7F2] text-[#5E6E69] hover:bg-emerald-50 hover:text-[#075B50] border border-[#E5E3DC] transition">
                    Agribisnis
                </button>
            </div>

            <!-- Search Bar UMKM (Sesuai Mockup) -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" 
                       id="umkm-search" 
                       onkeyup="filterUmkmCards()"
                       placeholder="Telusuri UMKM berdasarkan nama atau bidang..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-[#F8F7F2]/80 border border-[#D0CFC7] focus:border-[#075B50] rounded-xl text-xs text-[#1B1B18] outline-none">
            </div>

            <!-- Color Palette Card Grid UMKM Sesuai Mockup Wireframe -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-1" id="umkm-grid">
                @php
                    $colors = [
                        ['bg' => 'bg-[#A85858]'],
                        ['bg' => 'bg-[#A9DFD8]'],
                        ['bg' => 'bg-[#C59BCC]'],
                        ['bg' => 'bg-[#C5C88F]'],
                    ];
                @endphp

                @forelse ($umkms as $index => $umkm)
                    @php $colorScheme = $colors[$index % count($colors)]; @endphp
                    <div class="umkm-card block group cursor-pointer" data-category="{{ $umkm->jenis_usaha }}">
                        <div class="rounded-2xl border border-gray-100 bg-white p-3 shadow-sm hover:shadow-md transition-all flex flex-col">
                            <!-- Pastel Color Block Seperti di Mockup -->
                            <div class="w-full aspect-[4/3] rounded-xl {{ $colorScheme['bg'] }} flex flex-col items-center justify-center p-3 text-white text-center shadow-inner relative group-hover:scale-[1.02] transition-transform">
                                <svg class="w-7 h-7 text-white/90 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span class="font-bold text-[11px] leading-tight text-white drop-shadow">{{ $umkm->nama_usaha }}</span>
                            </div>

                            <!-- Detail UMKM -->
                            <div class="mt-2.5 text-left space-y-1">
                                <div class="text-[11px] font-bold text-[#1B1B18] line-clamp-1 umkm-title">{{ $umkm->nama_usaha }}</div>
                                <div class="flex items-center gap-1.5">
                                    <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-[#075B50] umkm-cat">
                                        {{ $umkm->jenis_usaha }}
                                    </span>
                                </div>
                                <div class="text-[10px] text-gray-500 line-clamp-1">Pemilik: {{ $umkm->pemilik }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 p-6 text-center text-xs text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        Belum ada data UMKM terdaftar.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-4 bg-[#075B50] hover:bg-[#26734D] text-white font-extrabold text-sm uppercase tracking-wider rounded-xl shadow-lg hover:shadow-xl transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                <span>Simpan Formulir Investor & Buka Dashboard</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>

    </form>

</div>

<script>
    let currentSelectedCategory = 'Semua';

    function selectCategory(category, btnElement) {
        currentSelectedCategory = category;
        document.getElementById('kategori_diminati').value = category;

        document.querySelectorAll('.cat-filter-btn').forEach(btn => {
            btn.classList.remove('bg-[#075B50]', 'text-white', 'shadow-sm');
            btn.classList.add('bg-[#F8F7F2]', 'text-[#5E6E69]', 'border', 'border-[#E5E3DC]');
        });

        btnElement.classList.remove('bg-[#F8F7F2]', 'text-[#5E6E69]', 'border', 'border-[#E5E3DC]');
        btnElement.classList.add('bg-[#075B50]', 'text-white', 'shadow-sm');

        filterUmkmCards();
    }

    function filterUmkmCards() {
        const query = document.getElementById('umkm-search').value.toLowerCase();
        const cards = document.querySelectorAll('.umkm-card');

        cards.forEach(card => {
            const title = card.querySelector('.umkm-title').innerText.toLowerCase();
            const cat = card.getAttribute('data-category');
            
            const matchesQuery = title.includes(query);
            const matchesCat = (currentSelectedCategory === 'Semua' || cat.toLowerCase() === currentSelectedCategory.toLowerCase());

            if (matchesQuery && matchesCat) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection
