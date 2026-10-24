<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - DAYA UMKM
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman Onboarding / Edukasi Gabung (PaDi UMKM Style)
Route::get('/gabung/investor', function () {
    return view('pages.gabung-investor');
})->name('gabung.investor');

Route::get('/gabung/umkm', function () {
    return view('pages.gabung-umkm');
})->name('gabung.umkm');

// Halaman Publik Usulkan Ruko Strategis (Crowdsourcing Tempat Usaha UMKM)
Route::get('/usulkan-ruko', [DashboardController::class, 'showPublicUsulkanRuko'])->name('ruko.usulkan.public');
Route::post('/usulkan-ruko', [DashboardController::class, 'storePublicUsulkanRuko'])->name('ruko.usulkan.store');

// URL Aliases agar tautan lama atau akses langsung tetap berjalan mulus
Route::get('/gabung-investor', function () {
    return redirect()->route('gabung.investor');
});
Route::get('/gabung-umkm', function () {
    return redirect()->route('gabung.umkm');
});

// Alias URL /admin agar langsung diarahkan ke Dashboard Super Admin
Route::get('/admin/{any?}', function () {
    return redirect()->route('superadmin.dashboard');
})->where('any', '.*');

// Chatbot AI Assistant Routes
Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');
Route::post('/chatbot/reset', [ChatbotController::class, 'resetChat'])->name('chatbot.reset');

// Guest Auth Routes
Route::middleware('guest')->group(function () {
    // 1. Sign In
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // 2. Sign Up (UMKM & Investor)
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::get('/register/investor', [AuthController::class, 'showRegisterInvestor'])->name('register.investor');
    Route::get('/register/umkm', [AuthController::class, 'showRegisterUmkm'])->name('register.umkm');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // 3. Verifikasi OTP Email
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('otp.verify.show');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify.post');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('otp.resend');

    // 4. Lupa & Reset Sandi via OTP
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetOtp'])->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset.show');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // 5. Google OAuth
    Route::get('/auth/google', [AuthController::class, 'googleRedirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [AuthController::class, 'googleCallback'])->name('google.callback');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Formulir Pendaftaran Tahap 2 (Setelah Akun & OTP)
    Route::get('/formulir/investor', [DashboardController::class, 'showInvestorForm'])->name('formulir.investor');
    Route::post('/formulir/investor', [DashboardController::class, 'saveInvestorForm'])->name('formulir.investor.post');

    Route::get('/formulir/umkm', [DashboardController::class, 'showUmkmForm'])->name('formulir.umkm');
    Route::post('/formulir/umkm', [DashboardController::class, 'updatePengajuanUmkm'])->name('formulir.umkm.post');

    Route::post('/dashboard/umkm/pengajuan', [DashboardController::class, 'updatePengajuanUmkm'])->name('dashboard.umkm.pengajuan');

    // Manajemen Produk UMKM
    Route::post('/dashboard/umkm/produk', [DashboardController::class, 'storeProduk'])->name('dashboard.umkm.produk.store');
    Route::post('/dashboard/umkm/produk/{id}/update', [DashboardController::class, 'updateProduk'])->name('dashboard.umkm.produk.update');
    Route::post('/dashboard/umkm/produk/{id}/delete', [DashboardController::class, 'deleteProduk'])->name('dashboard.umkm.produk.delete');
    Route::post('/dashboard/umkm/notifikasi/{id}/read', [DashboardController::class, 'markInvestasiRead'])->name('dashboard.umkm.notifikasi.read');
    Route::post('/dashboard/umkm/investasi/{id}/terima', [DashboardController::class, 'terimaInvestasi'])->name('dashboard.umkm.investasi.terima');
    Route::post('/dashboard/umkm/investasi/{id}/tolak', [DashboardController::class, 'tolakInvestasi'])->name('dashboard.umkm.investasi.tolak');
    Route::post('/dashboard/umkm/setor-dividen', [DashboardController::class, 'storeSetorDividen'])->name('dashboard.umkm.dividen.store');
    Route::post('/dashboard/investasi/{id}/pesan', [DashboardController::class, 'kirimPesanInvestasi'])->name('dashboard.investasi.pesan');

    // Analisis Keuangan UMKM (Input Form & Catatan Laba Rugi)
    Route::post('/dashboard/umkm/keuangan', [DashboardController::class, 'storeKeuangan'])->name('dashboard.umkm.keuangan.store');
    Route::post('/dashboard/umkm/keuangan/{id}/delete', [DashboardController::class, 'deleteKeuangan'])->name('dashboard.umkm.keuangan.delete');
    Route::post('/dashboard/umkm/keuangan/gabung', [DashboardController::class, 'gabungKeuanganPeriode'])->name('dashboard.umkm.keuangan.gabung');
    Route::post('/dashboard/umkm/rekomendasi-ruko', [DashboardController::class, 'storeRekomendasiRukoUmkm'])->name('dashboard.umkm.ruko.rekomendasi');

    // Aksi Investasi & Operasional Mitra Investor
    Route::post('/dashboard/investor/invest/{id_umkm}', [DashboardController::class, 'investProposal'])->name('dashboard.investor.invest');
    Route::post('/dashboard/investor/rekening-bank', [DashboardController::class, 'updateRekeningBank'])->name('dashboard.investor.bank');
    Route::post('/dashboard/investor/rekomendasi-ruko', [DashboardController::class, 'storeRekomendasiRuko'])->name('dashboard.investor.ruko.rekomendasi');
    Route::post('/dashboard/investor/sponsor-ruko/{id_ruko}', [DashboardController::class, 'sponsorSewaRuko'])->name('dashboard.investor.ruko.sponsor');

    // Rating & Ulasan Kredibilitas UMKM oleh Investor
    Route::post('/dashboard/investor/ulasan/{id_investasi}', [DashboardController::class, 'storeUlasanUmkm'])->name('dashboard.investor.ulasan.store');
    Route::post('/dashboard/umkm/ulasan/{id_ulasan}/balas', [DashboardController::class, 'storeBalasanUlasanUmkm'])->name('dashboard.umkm.ulasan.balas');

    // Klarifikasi Penundaan Dividen UMKM
    Route::post('/dashboard/umkm/dividen/klarifikasi', [DashboardController::class, 'storeKlarifikasiDividen'])->name('dashboard.umkm.dividen.klarifikasi');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ==========================================
    // SUPER ADMIN MANAGEMENT & AUDIT ROUTES
    // ==========================================
    Route::prefix('super-admin')->name('superadmin.')->group(function () {
        Route::get('/', [SuperAdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/pengajuan', [SuperAdminController::class, 'pengajuan'])->name('pengajuan');
        Route::post('/pengajuan/{id}/approve', [SuperAdminController::class, 'approvePengajuan'])->name('pengajuan.approve');
        Route::post('/pengajuan/{id}/reject', [SuperAdminController::class, 'rejectPengajuan'])->name('pengajuan.reject');

        Route::get('/users', [SuperAdminController::class, 'users'])->name('users');
        Route::post('/users/{id}/approve', [SuperAdminController::class, 'approveUser'])->name('users.approve');
        Route::post('/users/{id}/toggle-status', [SuperAdminController::class, 'toggleUserStatus'])->name('users.toggle');
        Route::post('/users/{id}/change-role', [SuperAdminController::class, 'changeRole'])->name('users.change-role');

        Route::get('/log-aktivitas', [SuperAdminController::class, 'logAktivitas'])->name('logs');
        Route::get('/ruko', [SuperAdminController::class, 'ruko'])->name('ruko');
        Route::post('/ruko/rekomendasi/{id}/approve', [SuperAdminController::class, 'approveRekomendasiRuko'])->name('ruko.rekomendasi.approve');
        Route::post('/ruko/rekomendasi/{id}/reject', [SuperAdminController::class, 'rejectRekomendasiRuko'])->name('ruko.rekomendasi.reject');
        Route::post('/ruko/{id}/update-ketersediaan', [SuperAdminController::class, 'updateRukoKetersediaan'])->name('ruko.update-ketersediaan');

        // Monitoring Kepatuhan Dividen & Penanganan Tunggakan
        Route::get('/dividen', [SuperAdminController::class, 'dividen'])->name('dividen');
        Route::post('/dividen/{id}/teguran', [SuperAdminController::class, 'kirimTeguranDividen'])->name('dividen.teguran');
        Route::post('/dividen/klarifikasi/{id}/verifikasi', [SuperAdminController::class, 'verifikasiKlarifikasiDividen'])->name('dividen.klarifikasi.verifikasi');
        Route::post('/dividen/umkm/{id}/toggle-bekukan', [SuperAdminController::class, 'toggleFreezeUmkm'])->name('dividen.umkm.toggle-freeze');
    });
});

// Akses berkas public storage (foto produk, bukti kuitansi keuangan, dll.)
Route::get('/storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/'.$path);
    if (! file_exists($filePath)) {
        abort(404);
    }

    return response()->file($filePath);
})->where('path', '.*')->name('public.storage');
