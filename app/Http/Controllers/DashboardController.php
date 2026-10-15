<?php

namespace App\Http\Controllers;

use App\Models\CatatanKeuangan;
use App\Models\Investasi;
use App\Models\Produk;
use App\Models\Ruko;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Tampilkan Halaman Dashboard Berdasarkan Peran Pengguna
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // 1. Khusus Super Admin & Admin Sistem
        if (in_array($user->role, ['admin', 'super_admin'])) {
            return redirect()->route('superadmin.dashboard');
        }

        // 2. Jika pendaftar investor baru belum mengisi preferensi, arahkan ke Formulir Investor
        if ($user->role === 'investor' && empty($user->kategori_diminati)) {
            return redirect()->route('formulir.investor')->with('info', 'Selamat datang! Silakan lengkapi Formulir Pendaftaran Investor Anda di bawah ini.');
        }

        // 3. DASHBOARD PELAKU UMKM (Sesuai Gambar 2 Mockup)
        if ($user->role === 'umkm') {
            $umkm = Umkm::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_usaha' => 'Usaha ' . $user->name,
                    'jenis_usaha' => 'Makanan',
                    'pemilik' => $user->name,
                    'nomor_whatsapp' => $user->phone_number,
                    'provinsi_kota' => $user->provinsi_kota,
                    'kecamatan' => $user->kecamatan,
                    'kelurahan' => $user->kelurahan,
                    'status_pengajuan' => 'draf',
                ]
            );

            // Jika masih draf kosong awal, arahkan ke formulir
            if ($umkm->status_pengajuan === 'draf' && empty($umkm->deskripsi) && empty($umkm->foto_produk) && empty($umkm->modal_dibutuhkan)) {
                return redirect()->route('formulir.umkm')->with('info', 'Selamat datang! Silakan lengkapi formulir pendaftaran profil usaha UMKM Anda.');
            }

            // Inisialisasi data sample produk jika UMKM belum punya produk (agar presisi dengan Gambar 2)
            if ($umkm->produks()->count() === 0) {
                Produk::create([
                    'id_umkm' => $umkm->id_umkm,
                    'nama_produk' => 'Produk 1 - Olahan Keripik Renyah',
                    'harga' => 30000,
                    'stok' => 8,
                    'status' => 'tersedia',
                    'terjual' => 20,
                    'deskripsi' => 'Keripik gurih renyah dibuat dari bahan organik pilihan kualitas super.',
                ]);
                Produk::create([
                    'id_umkm' => $umkm->id_umkm,
                    'nama_produk' => 'Produk 2 - Paket Bumbu Rempah Alami',
                    'harga' => 70000,
                    'stok' => 4,
                    'status' => 'tersedia',
                    'terjual' => 11,
                    'deskripsi' => 'Rempah tradisional siap pakai untuk sajian keluarga berkualitas.',
                ]);
                Produk::create([
                    'id_umkm' => $umkm->id_umkm,
                    'nama_produk' => 'Produk 3 - Minuman Herbal Jahe Segar',
                    'harga' => 20000,
                    'stok' => 9,
                    'status' => 'tersedia',
                    'terjual' => 8,
                    'deskripsi' => 'Minuman sehat herbal menyegarkan dan menghangatkan tubuh sepanjang hari.',
                ]);
            }

            $activeTab = $request->query('tab', 'beranda');

            // Metrik KPI Dashboard UMKM (Sesuai Gambar 2)
            $salesToday = 200000;
            $totalOrders = 80;
            $produksCount = $umkm->produks()->count();
            $totalRevenue = 1930000;

            // Data grafik 7 hari
            $days = [
                'Sen' => 45, 'Sel' => 65, 'Rab' => 30, 'Kam' => 75, 'Jum' => 20, 'Sab' => 90, 'Min' => 55
            ];

            // Produk Terlaris
            $topProducts = $umkm->produks()->orderByDesc('terjual')->take(3)->get();

            // Produk untuk Tab Produk (dengan filter & search)
            $queryProduk = $umkm->produks();
            if ($request->query('status') && $request->query('status') !== 'semua') {
                $queryProduk->where('status', $request->query('status'));
            }
            if ($request->filled('q')) {
                $queryProduk->where('nama_produk', 'like', '%' . $request->q . '%');
            }
            $allProduks = $queryProduk->latest('id_produk')->get();

            // NOTIFIKASI MINAT INVESTASI MASUK DARI INVESTOR
            $notifikasiInvestasi = Investasi::with('pengguna')
                ->where('id_umkm', $umkm->id_umkm)
                ->latest('tanggal_investasi')
                ->get();
            $unreadInvestasiCount = $notifikasiInvestasi->where('dibaca', false)->count();

            // CATATAN & ANALISIS KEUANGAN (Form Input, Perhitungan Laba/Rugi, Upload Gambar)
            $catatanKeuangan = $umkm->catatanKeuangan()->latest('id_keuangan')->get();
            $latestKeuangan = $catatanKeuangan->first();

            // Total Akumulasi Finansial (Periode Aktif & Keseluruhan Catatan)
            $bulanAktif = $latestKeuangan ? $latestKeuangan->bulan_tahun : date('F Y');
            $catatanBulanAktif = $catatanKeuangan->where('bulan_tahun', $bulanAktif);
            $jumlahCatatanBulanAktif = $catatanBulanAktif->count();

            $totalOmzetBulanAktif = (float) $catatanBulanAktif->sum('pendapatan');
            $totalHppBulanAktif = (float) $catatanBulanAktif->sum('hpp');
            $totalOpsBulanAktif = (float) $catatanBulanAktif->sum('beban_operasional');
            $totalLainBulanAktif = (float) $catatanBulanAktif->sum('beban_lain');
            $totalBebanBulanAktif = $totalHppBulanAktif + $totalOpsBulanAktif + $totalLainBulanAktif;
            $totalLabaBersihBulanAktif = $totalOmzetBulanAktif - $totalBebanBulanAktif;
            $marginLabaBulanAktif = $totalOmzetBulanAktif > 0 ? round(($totalLabaBersihBulanAktif / $totalOmzetBulanAktif) * 100, 2) : 0;
            $statusLabaBulanAktif = $totalLabaBersihBulanAktif > 0 ? 'untung' : ($totalLabaBersihBulanAktif < 0 ? 'rugi' : 'impas');

            $rukos = Ruko::where('status_ketersediaan', 'tersedia')->latest('id_ruko')->get();

            return view('dashboard.umkm', compact(
                'user',
                'umkm',
                'activeTab',
                'salesToday',
                'totalOrders',
                'produksCount',
                'totalRevenue',
                'days',
                'topProducts',
                'allProduks',
                'notifikasiInvestasi',
                'unreadInvestasiCount',
                'catatanKeuangan',
                'latestKeuangan',
                'bulanAktif',
                'jumlahCatatanBulanAktif',
                'totalOmzetBulanAktif',
                'totalHppBulanAktif',
                'totalOpsBulanAktif',
                'totalBebanBulanAktif',
                'totalLabaBersihBulanAktif',
                'marginLabaBulanAktif',
                'statusLabaBulanAktif',
                'rukos'
            ));
        }

        // 4. DASHBOARD MITRA INVESTOR (Sesuai Gambar 3 Mockup)
        if ($user->role === 'investor') {
            // JIKA AKUN BELUM DI-ACC / BELUM AKTIF OLEH ADMIN:
            // Tampilkan halaman antrean verifikasi admin (pending)
            if ($user->status !== 'aktif') {
                return view('dashboard.investor-pending', compact('user'));
            }

            $activeTab = $request->query('tab', 'beranda');

            // Riwayat investasi investor saat ini
            $investasiSaya = Investasi::with('umkm.user')
                ->where('id_pengguna', $user->id)
                ->latest('tanggal_investasi')
                ->get();

            $totalModalDiinvestasikan = $investasiSaya->sum('jumlah_modal');
            if ($totalModalDiinvestasikan == 0) {
                $totalModalDiinvestasikan = 50000000; // Baseline portofolio
            }
            $umkmDidanaiCount = max($investasiSaya->pluck('id_umkm')->unique()->count(), 3);

            // DAFTAR PROPOSAL UMKM (PROPOSAL LIST)
            $queryProposal = Umkm::with('user', 'ruko', 'produks')
                ->whereIn('status_pengajuan', ['terverifikasi', 'menunggu_verifikasi']);

            if ($request->filled('q')) {
                $search = '%' . $request->q . '%';
                $queryProposal->where(function ($q) use ($search) {
                    $q->where('nama_usaha', 'like', $search)
                      ->orWhere('jenis_usaha', 'like', $search)
                      ->orWhere('pemilik', 'like', $search);
                });
            }

            if ($request->filled('kategori') && $request->kategori !== 'semua') {
                $queryProposal->where('jenis_usaha', $request->kategori);
            }

            $availableProposals = $queryProposal->latest('updated_at')->get();
            $availableProposalsCount = $availableProposals->count();

            $rukos = Ruko::where('status_ketersediaan', 'tersedia')
                ->latest('id_ruko')
                ->take(6)
                ->get();

            return view('dashboard.investor', compact(
                'user',
                'activeTab',
                'investasiSaya',
                'totalModalDiinvestasikan',
                'umkmDidanaiCount',
                'availableProposals',
                'availableProposalsCount',
                'rukos'
            ));
        }

        // Fallback
        return view('dashboard', compact('user'));
    }

    /**
     * Tambah Produk Baru oleh Pelaku UMKM
     */
    public function storeProduk(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') {
            abort(403);
        }

        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,habis',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $validated['id_umkm'] = $umkm->id_umkm;
        $validated['terjual'] = 0;

        Produk::create($validated);

        return redirect()->route('dashboard', ['tab' => 'produk'])->with('success', 'Produk "' . $validated['nama_produk'] . '" berhasil ditambahkan!');
    }

    /**
     * Update Produk oleh Pelaku UMKM
     */
    public function updateProduk(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') {
            abort(403);
        }

        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        $produk = Produk::where('id_produk', $id)->where('id_umkm', $umkm->id_umkm)->firstOrFail();

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,habis',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()->route('dashboard', ['tab' => 'produk'])->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus Produk oleh Pelaku UMKM
     */
    public function deleteProduk($id)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') {
            abort(403);
        }

        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        $produk = Produk::where('id_produk', $id)->where('id_umkm', $umkm->id_umkm)->firstOrFail();

        $produk->delete();

        return redirect()->route('dashboard', ['tab' => 'produk'])->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Simpan Catatan Keuangan Bulanan UMKM & Hitung Analisis Laba/Rugi Otomatis
     */
    public function storeKeuangan(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') {
            abort(403);
        }

        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'bulan_tahun' => 'required|string|max:50',
            'pendapatan' => 'nullable|numeric|min:0',
            'hpp' => 'nullable|numeric|min:0',
            'beban_operasional' => 'nullable|numeric|min:0',
            'beban_lain' => 'nullable|numeric|min:0',
            'foto_bukti' => 'nullable|file|mimes:xlsx,xls,csv,pdf,doc,docx,jpg,jpeg,png,webp|max:10240',
            'catatan' => 'nullable|string|max:1000',
        ], [
            'bulan_tahun.required' => 'Pilih periode bulan dan tahun pelaporan.',
            'foto_bukti.file' => 'File lampiran harus berupa berkas yang valid.',
            'foto_bukti.mimes' => 'Format file yang didukung: Excel (.xlsx, .xls, .csv), PDF (.pdf), Word (.doc, .docx), atau Gambar (JPG, PNG, WEBP).',
            'foto_bukti.max' => 'Ukuran file lampiran maksimal 10MB.',
        ]);

        $pendapatan = !empty($validated['pendapatan']) ? (float) $validated['pendapatan'] : 0.0;
        $hpp = (float) ($validated['hpp'] ?? 0);
        $bebanOperasional = (float) ($validated['beban_operasional'] ?? 0);
        $bebanLain = (float) ($validated['beban_lain'] ?? 0);

        $fotoBuktiPath = null;
        $excelDetectionNote = '';

        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $ext = strtolower($file->getClientOriginalExtension());
            $fotoBuktiPath = $file->store('keuangan', 'public');

            // DETEKSI OTOMATIS PEMASUKAN & PENGELUARAN DARI EXCEL / CSV
            if (in_array($ext, ['xlsx', 'xls', 'csv'])) {
                $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($fotoBuktiPath);
                if (!file_exists($fullPath) && $file->getRealPath() && file_exists($file->getRealPath())) {
                    $fullPath = $file->getRealPath();
                }
                $parseResult = \App\Services\ExcelFinancialParser::parse($fullPath, $ext);

                if ($parseResult['success']) {
                    if ($pendapatan <= 0 && $parseResult['pendapatan'] > 0) {
                        $pendapatan = $parseResult['pendapatan'];
                    }
                    if ($hpp <= 0 && $parseResult['hpp'] > 0) {
                        $hpp = $parseResult['hpp'];
                    }
                    if ($bebanOperasional <= 0 && $parseResult['beban_operasional'] > 0) {
                        $bebanOperasional = $parseResult['beban_operasional'];
                    }
                    if ($bebanLain <= 0 && $parseResult['beban_lain'] > 0) {
                        $bebanLain = $parseResult['beban_lain'];
                    }

                    $excelDetectionNote = ' (Terdeteksi Otomatis dari Excel: ' . $parseResult['message'] . ')';
                }
            }
        }

        if ($pendapatan <= 0 && !$request->hasFile('foto_bukti')) {
            return back()->withInput()->withErrors([
                'pendapatan' => 'Nominal pendapatan / omzet wajib diisi, atau lampirkan berkas Excel (.xlsx / .csv) untuk dianalisis otomatis.'
            ]);
        }

        $totalBeban = $hpp + $bebanOperasional + $bebanLain;
        $labaBersih = $pendapatan - $totalBeban;
        $marginLaba = $pendapatan > 0 ? round(($labaBersih / $pendapatan) * 100, 2) : 0;

        if ($labaBersih > 0) {
            $statusLaba = 'untung';
        } elseif ($labaBersih < 0) {
            $statusLaba = 'rugi';
        } else {
            $statusLaba = 'impas';
        }

        // KASUS 1: Edit Catatan Keuangan Spesifik (Jika ada id_keuangan)
        if ($request->filled('id_keuangan')) {
            $keuangan = CatatanKeuangan::where('id_keuangan', $request->id_keuangan)
                ->where('id_umkm', $umkm->id_umkm)
                ->firstOrFail();

            $keuangan->bulan_tahun = $validated['bulan_tahun'];
            $keuangan->pendapatan = $pendapatan;
            $keuangan->hpp = $hpp;
            $keuangan->beban_operasional = $bebanOperasional;
            $keuangan->beban_lain = $bebanLain;
            $keuangan->laba_bersih = $labaBersih;
            $keuangan->margin_laba = $marginLaba;
            $keuangan->status_laba = $statusLaba;
            if ($fotoBuktiPath) {
                $keuangan->foto_bukti = $fotoBuktiPath;
            }
            $keuangan->catatan = ($validated['catatan'] ?? '') . $excelDetectionNote;
            $keuangan->save();

            return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('success', 'Catatan keuangan periode ' . $validated['bulan_tahun'] . ' berhasil diperbarui!');
        }

        // KASUS 2: Cek apakah periode bulan ini sudah pernah diinput sebelumnya
        $existing = CatatanKeuangan::where('id_umkm', $umkm->id_umkm)
            ->where('bulan_tahun', $validated['bulan_tahun'])
            ->latest('id_keuangan')
            ->first();

        $modeAksi = $request->input('mode_aksi', 'akumulasi'); // Default: akumulasikan / totalkan

        // Jika data sebelumnya sudah ada dan mode aksi adalah 'akumulasi' (Menotalkan)
        if ($existing && $modeAksi === 'akumulasi') {
            $existing->pendapatan += $pendapatan;
            $existing->hpp += $hpp;
            $existing->beban_operasional += $bebanOperasional;
            $existing->beban_lain += $bebanLain;

            $newTotalBeban = $existing->hpp + $existing->beban_operasional + $existing->beban_lain;
            $newLabaBersih = $existing->pendapatan - $newTotalBeban;
            $newMarginLaba = $existing->pendapatan > 0 ? round(($newLabaBersih / $existing->pendapatan) * 100, 2) : 0;

            $existing->laba_bersih = $newLabaBersih;
            $existing->margin_laba = $newMarginLaba;
            $existing->status_laba = $newLabaBersih > 0 ? 'untung' : ($newLabaBersih < 0 ? 'rugi' : 'impas');

            if ($fotoBuktiPath) {
                $existing->foto_bukti = $fotoBuktiPath;
            }
            $additionalNote = ($validated['catatan'] ?? '') . $excelDetectionNote;
            if (!empty($additionalNote)) {
                $existing->catatan = trim(($existing->catatan ? $existing->catatan . ' | ' : '') . $additionalNote);
            }
            $existing->save();

            return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('success', 'Transaksi baru berhasil ditotalkan & diakumulasikan ke periode ' . $validated['bulan_tahun'] . '! Total Omzet saat ini: Rp ' . number_format($existing->pendapatan, 0, ',', '.') . ' (Laba Bersih: Rp ' . number_format($existing->laba_bersih, 0, ',', '.') . ').');
        }

        // Jika data sebelumnya ada dan mode aksi adalah 'ganti' (Menimpa total periode)
        if ($existing && $modeAksi === 'ganti') {
            $existing->pendapatan = $pendapatan;
            $existing->hpp = $hpp;
            $existing->beban_operasional = $bebanOperasional;
            $existing->beban_lain = $bebanLain;
            $existing->laba_bersih = $labaBersih;
            $existing->margin_laba = $marginLaba;
            $existing->status_laba = $statusLaba;
            if ($fotoBuktiPath) {
                $existing->foto_bukti = $fotoBuktiPath;
            }
            $existing->catatan = ($validated['catatan'] ?? '') . $excelDetectionNote;
            $existing->save();

            return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('success', 'Catatan keuangan periode ' . $validated['bulan_tahun'] . ' berhasil diperbarui (diganti)!');
        }

        // KASUS 3: Buat Catatan Baru
        CatatanKeuangan::create([
            'id_umkm' => $umkm->id_umkm,
            'bulan_tahun' => $validated['bulan_tahun'],
            'pendapatan' => $pendapatan,
            'hpp' => $hpp,
            'beban_operasional' => $bebanOperasional,
            'beban_lain' => $bebanLain,
            'laba_bersih' => $labaBersih,
            'margin_laba' => $marginLaba,
            'status_laba' => $statusLaba,
            'foto_bukti' => $fotoBuktiPath,
            'catatan' => ($validated['catatan'] ?? '') . $excelDetectionNote,
        ]);

        $statusMsg = $statusLaba === 'untung' 
            ? 'Hasil Analisis: USAHA MENGALAMI KEUNTUNGAN (Laba Bersih Rp ' . number_format($labaBersih, 0, ',', '.') . ' / Margin +' . $marginLaba . '%).'
            : ($statusLaba === 'rugi' ? 'Hasil Analisis: USAHA MENGALAMI DEFISIT/RUGI (Rugi Rp ' . number_format(abs($labaBersih), 0, ',', '.') . '). Evaluasi pengeluaran operasional Anda.' : 'Hasil Analisis: IMPAS (Break Even Point).');

        return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('success', 'Catatan keuangan periode ' . $validated['bulan_tahun'] . ' berhasil disimpan! ' . $statusMsg);
    }

    /**
     * Menggabungkan seluruh catatan transaksi dalam satu periode menjadi 1 total kumulatif
     */
    public function gabungKeuanganPeriode(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') abort(403);
        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        $bulanTahun = $request->input('bulan_tahun');

        $records = CatatanKeuangan::where('id_umkm', $umkm->id_umkm)
            ->where('bulan_tahun', $bulanTahun)
            ->get();

        if ($records->count() > 1) {
            $first = $records->first();
            $totalPendapatan = (float) $records->sum('pendapatan');
            $totalHpp = (float) $records->sum('hpp');
            $totalOps = (float) $records->sum('beban_operasional');
            $totalLain = (float) $records->sum('beban_lain');
            $totalBeban = $totalHpp + $totalOps + $totalLain;
            $labaBersih = $totalPendapatan - $totalBeban;
            $margin = $totalPendapatan > 0 ? round(($labaBersih / $totalPendapatan) * 100, 2) : 0;
            $statusLaba = $labaBersih > 0 ? 'untung' : ($labaBersih < 0 ? 'rugi' : 'impas');

            $fileBukti = $records->pluck('foto_bukti')->filter()->first();

            $first->update([
                'pendapatan' => $totalPendapatan,
                'hpp' => $totalHpp,
                'beban_operasional' => $totalOps,
                'beban_lain' => $totalLain,
                'laba_bersih' => $labaBersih,
                'margin_laba' => $margin,
                'status_laba' => $statusLaba,
                'foto_bukti' => $fileBukti,
                'catatan' => 'Hasil penggabungan total akumulasi dari ' . $records->count() . ' catatan transaksi.',
            ]);

            CatatanKeuangan::where('id_umkm', $umkm->id_umkm)
                ->where('bulan_tahun', $bulanTahun)
                ->where('id_keuangan', '!=', $first->id_keuangan)
                ->delete();

            return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('success', 'Berhasil menggabungkan dan menotalkan seluruh ' . $records->count() . ' catatan transaksi periode ' . $bulanTahun . ' menjadi satu akumulasi total!');
        }

        return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('info', 'Catatan periode ini sudah menjadi satu.');
    }

    /**
     * Hapus Catatan Keuangan UMKM
     */
    public function deleteKeuangan($id)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') {
            abort(403);
        }

        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        $keuangan = CatatanKeuangan::where('id_keuangan', $id)->where('id_umkm', $umkm->id_umkm)->firstOrFail();

        $keuangan->delete();

        return redirect()->route('dashboard', ['tab' => 'keuangan'])->with('success', 'Data catatan keuangan berhasil dihapus.');
    }

    /**
     * Investor mengajukan Minat Investasi pada Proposal UMKM
     * Menghasilkan Notifikasi untuk Pelaku UMKM
     */
    public function investProposal(Request $request, $id_umkm)
    {
        $user = Auth::user();
        if ($user->role !== 'investor') {
            abort(403, 'Hanya mitra investor yang dapat mengajukan investasi.');
        }

        $umkm = Umkm::with('user')->findOrFail($id_umkm);

        $validated = $request->validate([
            'jumlah_modal' => 'required|numeric|min:100000',
            'periode_pembagian' => 'required|string|max:30',
            'persentase_bagi_hasil' => 'nullable|numeric|min:1|max:99',
            'catatan' => 'nullable|string|max:500',
        ]);

        Investasi::create([
            'id_pengguna' => $user->id,
            'id_umkm' => $umkm->id_umkm,
            'jumlah_modal' => $validated['jumlah_modal'],
            'persentase_bagi_hasil' => $validated['persentase_bagi_hasil'] ?? ($umkm->persentase_bagi_hasil ?: 15.00),
            'periode_pembagian' => $validated['periode_pembagian'],
            'status' => 'pending',
            'catatan' => $validated['catatan'] ?? 'Saya sangat tertarik dengan proposal usaha Anda dan siap berdiskusi untuk menyalurkan modal pendanaan.',
            'dibaca' => false,
            'tanggal_investasi' => now(),
        ]);

        return back()->with('success', 'Selamat! Pengajuan minat investasi sebesar Rp ' . number_format($validated['jumlah_modal'], 0, ',', '.') . ' pada usaha "' . $umkm->nama_usaha . '" BERHASIL DIKIRIMKAN! Pelaku UMKM telah menerima notifikasi resmi Anda.');
    }

    /**
     * Tandai Notifikasi Minat Investasi telah dibaca oleh Pelaku UMKM
     */
    public function markInvestasiRead($id_investasi)
    {
        $user = Auth::user();
        if ($user->role !== 'umkm') {
            abort(403);
        }

        $umkm = Umkm::where('user_id', $user->id)->firstOrFail();
        $inv = Investasi::where('id_investasi', $id_investasi)->where('id_umkm', $umkm->id_umkm)->firstOrFail();

        $inv->update(['dibaca' => true]);

        return back()->with('success', 'Notifikasi telah ditandai dibaca.');
    }

    /**
     * Tampilkan Formulir Pendaftaran Investor (Tahap 2)
     */
    public function showInvestorForm(Request $request)
    {
        $user = Auth::user();
        $umkms = Umkm::latest('id_umkm')->take(8)->get();
        return view('auth.formulir-investor', compact('user', 'umkms'));
    }

    /**
     * Simpan Formulir Pendaftaran Investor (Harus Menunggu ACC Admin)
     */
    public function saveInvestorForm(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nomor_telepon' => ['required', 'string', 'max:25'],
            'provinsi_kota' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kelurahan' => ['nullable', 'string', 'max:100'],
            'kategori_diminati' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update([
            'name' => $validated['nama'],
            'phone_number' => $validated['nomor_telepon'],
            'provinsi_kota' => $validated['provinsi_kota'] ?? $user->provinsi_kota,
            'kecamatan' => $validated['kecamatan'] ?? $user->kecamatan,
            'kelurahan' => $validated['kelurahan'] ?? $user->kelurahan,
            'kategori_diminati' => $validated['kategori_diminati'] ?? 'Semua',
            'status' => 'menunggu_verifikasi',
        ]);

        return redirect()->route('dashboard')->with('success', 'Formulir preferensi investor berhasil disimpan! Akun Anda sedang dalam antrean verifikasi & persetujuan (ACC) dari Admin.');
    }

    /**
     * Tampilkan Formulir Pendaftaran UMKM (Tahap 2)
     */
    public function showUmkmForm(Request $request)
    {
        $user = Auth::user();
        $umkm = Umkm::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_usaha' => 'Usaha ' . $user->name,
                'jenis_usaha' => 'Makanan',
                'pemilik' => $user->name,
                'nomor_whatsapp' => $user->phone_number,
                'provinsi_kota' => $user->provinsi_kota,
                'kecamatan' => $user->kecamatan,
                'kelurahan' => $user->kelurahan,
                'status_pengajuan' => 'draf',
            ]
        );

        $rukos = Ruko::where('status_ketersediaan', 'tersedia')
            ->latest('id_ruko')
            ->get();

        return view('auth.formulir-umkm', compact('user', 'umkm', 'rukos'));
    }

    /**
     * Simpan Draf atau Kirim Pengajuan Usaha UMKM
     */
    public function updatePengajuanUmkm(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'umkm') {
            abort(403, 'Akses khusus pelaku UMKM.');
        }

        $aksi = $request->input('aksi', 'simpan_draf');

        $rules = [
            'nama_usaha' => [$aksi === 'kirim_pengajuan' ? 'required' : 'nullable', 'string', 'max:150'],
            'jenis_usaha' => [$aksi === 'kirim_pengajuan' ? 'required' : 'nullable', 'string', 'max:100'],
            'pemilik' => ['required', 'string', 'max:100'],
            'nik_penanggung_jawab' => ['nullable', 'string', 'max:30'],
            'nomor_whatsapp' => ['required', 'string', 'max:25'],
            'provinsi_kota' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kelurahan' => ['nullable', 'string', 'max:100'],
            'modal_dibutuhkan' => ['nullable', 'numeric', 'min:0'],
            'estimasi_bagi_hasil' => ['nullable', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string'],
            'foto_produk' => ['nullable', 'file', 'image', 'max:5120'],
            'file_proposal' => ['nullable', 'file', 'mimes:pdf,doc,docx,zip', 'max:10240'],
            'id_ruko_diminati' => ['nullable', 'exists:ruko,id_ruko'],
        ];

        $validated = $request->validate($rules, [
            'nama_usaha.required' => 'Nama usaha wajib diisi sebelum mengirimkan pengajuan.',
            'jenis_usaha.required' => 'Kategori usaha wajib dipilih.',
            'pemilik.required' => 'Nama pemilik usaha wajib diisi.',
            'nomor_whatsapp.required' => 'Nomor kontak WhatsApp wajib diisi.',
            'foto_produk.image' => 'Foto produk harus berupa file gambar (JPG, PNG, WEBP).',
            'foto_produk.max' => 'Ukuran foto produk maksimal 5MB.',
            'file_proposal.mimes' => 'File proposal harus berformat PDF, DOC, DOCX, atau ZIP.',
            'file_proposal.max' => 'Ukuran file proposal maksimal 10MB.',
        ]);

        $umkm = Umkm::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_usaha' => $validated['nama_usaha'] ?? ('Usaha ' . $user->name),
                'jenis_usaha' => $validated['jenis_usaha'] ?? 'Makanan',
                'pemilik' => $validated['pemilik'] ?? $user->name,
                'nomor_whatsapp' => $validated['nomor_whatsapp'] ?? $user->phone_number,
                'status_pengajuan' => 'draf',
            ]
        );

        if ($request->hasFile('foto_produk')) {
            $validated['foto_produk'] = $request->file('foto_produk')->store('umkm/produk', 'public');
        }

        if ($request->hasFile('file_proposal')) {
            $validated['file_proposal'] = $request->file('file_proposal')->store('umkm/proposal', 'public');
        }

        if ($aksi === 'kirim_pengajuan') {
            $validated['status_pengajuan'] = 'menunggu_verifikasi';
            $message = 'Pengajuan usaha Anda berhasil dikirimkan! Tim Admin DAYA UMKM akan meninjau berkas Anda dalam 1x24 jam.';
        } else {
            $validated['status_pengajuan'] = 'draf';
            $message = 'Draf formulir usaha Anda berhasil disimpan. Anda dapat melanjutkannya kapan saja.';
        }

        $umkm->update($validated);

        $user->update([
            'phone_number' => $validated['nomor_whatsapp'],
            'provinsi_kota' => $validated['provinsi_kota'] ?? $user->provinsi_kota,
            'kecamatan' => $validated['kecamatan'] ?? $user->kecamatan,
            'kelurahan' => $validated['kelurahan'] ?? $user->kelurahan,
        ]);

        return redirect()->route('dashboard')->with('success', $message);
    }
}
