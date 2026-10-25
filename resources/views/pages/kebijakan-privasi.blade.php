@extends('layouts.auth')

@section('title', 'Kebijakan Privasi')

@section('content')
<main class="max-w-4xl mx-auto px-5 sm:px-8 py-12 sm:py-16 text-[#15241C]">
    <a href="{{ route('home') }}" class="inline-block text-sm font-semibold text-[#1A5B36] underline underline-offset-4">Kembali ke beranda</a>
    <h1 class="mt-8 text-3xl sm:text-4xl font-bold">Kebijakan Privasi</h1>
    <p class="mt-4 rounded-lg border border-amber-300 bg-amber-50 p-4 text-sm text-amber-950">Draf demonstrasi. Belum disahkan atau diberlakukan. Lengkapi identitas pengelola, dasar pemrosesan, penerima data, masa simpan, dan prosedur hak privasi. Minta tinjauan hukum sebelum penggunaan operasional.</p>

    <div class="mt-8 space-y-6 leading-7">
        <section>
            <h2 class="text-xl font-bold">Informasi yang diproses</h2>
            <p class="mt-2">Draf ini belum menjadi inventaris pemrosesan terverifikasi. Layanan dapat memproses data pendaftaran dan profil, kontak, data usaha, dokumen unggahan, serta aktivitas akun. Pengelola perlu memastikan kategori, sumber, tujuan, dan dasar pemrosesan sesuai praktik sebenarnya.</p>
        </section>
        <section>
            <h2 class="text-xl font-bold">Penggunaan informasi</h2>
            <p class="mt-2">Informasi digunakan untuk menyediakan dan mengamankan layanan, memverifikasi akun dan pengajuan, menghubungkan investor dengan pelaku UMKM, memenuhi kewajiban hukum, serta menanggapi permintaan dukungan.</p>
        </section>
        <section>
            <h2 class="text-xl font-bold">Pembagian dan penyimpanan</h2>
            <p class="mt-2">Praktik pembagian data belum diverifikasi. Sebelum kebijakan operasional dipublikasikan, pengelola perlu menjelaskan penerima dan pemroses data, masa retensi, pengamanan, prosedur penghapusan, serta penanganan insiden sesuai praktik aktual.</p>
        </section>
        <section>
            <h2 class="text-xl font-bold">Pilihan dan pertanyaan</h2>
            <p class="mt-2">Untuk pertanyaan privasi atau permintaan terkait data, hubungi <a class="font-semibold text-[#1A5B36] underline underline-offset-4" href="mailto:admin@titik-umkm.id">admin@titik-umkm.id</a>. Permintaan dapat dibatasi oleh kewajiban hukum dan kebutuhan operasional yang sah.</p>
        </section>
    </div>
</main>
@endsection
