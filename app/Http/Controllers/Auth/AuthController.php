<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\ThirdPartyAuthentication;
use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman Login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Tampilkan halaman Register
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Tampilkan halaman Verifikasi OTP
     */
    public function showVerifyOtp(Request $request)
    {
        $email = Session::get('otp_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Sesi verifikasi tidak ditemukan. Silakan login atau daftar ulang.');
        }

        $action = Session::get('otp_action', 'verifikasi');
        return view('auth.verify-otp', compact('email', 'action'));
    }

    /**
     * Proses Registrasi Manual
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:investor,umkm'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan masuk.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.mixed' => 'Kata sandi harus mengandung huruf besar dan kecil.',
            'password.numbers' => 'Kata sandi harus mengandung angka.',
            'password.symbols' => 'Kata sandi harus mengandung simbol/karakter khusus.',
            'role.required' => 'Pilih peran Anda.',
        ]);

        // Simpan data pengguna dengan status menunggu_verifikasi
        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'phone_number' => $validated['nomor_telepon'] ?? null,
            'role' => $validated['role'],
            'password' => $validated['password'],
            'status' => 'menunggu_verifikasi',
        ]);

        // Kirim OTP verifikasi email
        $this->generateAndSendOtp($user, 'daftar');

        Session::put('otp_user_id', $user->id);
        Session::put('otp_email', $user->email);
        Session::put('otp_action', 'daftar');

        return redirect()->route('otp.verify.show')->with('success', 'Kode OTP 6-digit telah dikirim ke email Anda. Silakan verifikasi.');
    }

    /**
     * Proses Login Manual (Memerlukan verifikasi OTP Email)
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Kombinasi email dan kata sandi tidak sesuai.',
            ]);
        }

        if ($user->status === 'ditangguhkan') {
            return back()->with('error', 'Akun Anda sedang ditangguhkan. Hubungi admin DAYA UMKM.');
        }

        // Kirim OTP verifikasi login
        $this->generateAndSendOtp($user, 'masuk');

        Session::put('otp_user_id', $user->id);
        Session::put('otp_email', $user->email);
        Session::put('otp_action', 'masuk');
        Session::put('remember', $request->boolean('remember'));

        return redirect()->route('otp.verify.show')->with('success', 'Kode OTP keamanan telah dikirim ke email Anda.');
    }

    /**
     * Tampilkan halaman Lupa Kata Sandi
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim OTP untuk Reset Kata Sandi
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Alamat email tidak terdaftar di sistem.',
        ]);

        $user = User::where('email', $request->email)->first();

        $this->generateAndSendOtp($user, 'reset_password');

        Session::put('otp_user_id', $user->id);
        Session::put('otp_email', $user->email);
        Session::put('otp_action', 'reset_password');

        return redirect()->route('otp.verify.show')->with('success', 'Kode OTP pemulihan kata sandi telah dikirim ke email Anda.');
    }

    /**
     * Tampilkan Form Reset Kata Sandi Baru
     */
    public function showResetPassword()
    {
        if (!Session::get('can_reset_password') || !Session::get('reset_user_id')) {
            return redirect()->route('password.request')->with('error', 'Sesi reset kata sandi tidak valid atau telah kedaluwarsa.');
        }

        return view('auth.reset-password');
    }

    /**
     * Simpan Kata Sandi Baru
     */
    public function resetPassword(Request $request)
    {
        $userId = Session::get('reset_user_id');
        if (!Session::get('can_reset_password') || !$userId) {
            return redirect()->route('password.request')->with('error', 'Sesi reset kata sandi telah kedaluwarsa.');
        }

        $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
        ], [
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.mixed' => 'Kata sandi harus mengandung huruf besar dan kecil.',
            'password.numbers' => 'Kata sandi harus mengandung angka.',
            'password.symbols' => 'Kata sandi harus mengandung simbol/karakter khusus.',
        ]);

        $user = User::findOrFail($userId);
        $user->password = $request->password;
        $user->save();

        Session::forget(['can_reset_password', 'reset_user_id']);

        return redirect()->route('login')->with('success', 'Kata sandi Anda berhasil diperbarui. Silakan masuk.');
    }

    /**
     * Verifikasi kode OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ], [
            'otp.required' => 'Kode OTP 6-digit wajib diisi.',
            'otp.size' => 'Kode OTP harus berupa 6 digit angka.',
        ]);

        $userId = Session::get('otp_user_id');
        $email = Session::get('otp_email');

        if (!$userId || !$email) {
            return redirect()->route('login')->with('error', 'Sesi telah kedaluwarsa. Silakan ulangi.');
        }

        $user = User::findOrFail($userId);

        // Cari kode verifikasi yang cocok dan masih aktif (< 5 menit)
        $code = VerificationCode::where('user_id', $user->id)
            ->where('verification_type', 'otp_email')
            ->where('secret_code', $request->otp)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest('id_verification')
            ->first();

        if (!$code) {
            return back()->withErrors([
                'otp' => 'Kode OTP salah atau sudah kedaluwarsa. Silakan klik kirim ulang.',
            ]);
        }

        // Tandai kode sudah digunakan
        $code->update(['is_used' => true]);

        // ponytail: alur reset password diverifikasi OTP lalu diarahkan ke form input sandi baru. upgrade: rate-limit reset per user jika ada brute-force.
        $action = Session::get('otp_action');
        if ($action === 'reset_password') {
            Session::put('can_reset_password', true);
            Session::put('reset_user_id', $user->id);
            Session::forget(['otp_user_id', 'otp_email', 'otp_action']);

            return redirect()->route('password.reset.show')->with('success', 'Kode OTP terverifikasi. Silakan masukkan kata sandi baru Anda.');
        }

        // Update status user jika belum terverifikasi
        if (!$user->email_verified_at) {
            $user->email_verified_at = Carbon::now();
        }
        if ($user->status === 'menunggu_verifikasi') {
            $user->status = 'aktif';
        }
        $user->save();

        // Login user
        $remember = Session::get('remember', false);
        Auth::login($user, $remember);

        // Bersihkan session OTP
        Session::forget(['otp_user_id', 'otp_email', 'otp_action', 'remember']);

        return redirect()->intended(route('dashboard'))->with('success', 'Selamat datang kembali, ' . $user->name . '!');
    }

    /**
     * Kirim Ulang Kode OTP
     */
    public function resendOtp()
    {
        $userId = Session::get('otp_user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi tidak ditemukan.');
        }

        $user = User::findOrFail($userId);
        $action = Session::get('otp_action', 'verifikasi');

        $this->generateAndSendOtp($user, $action);

        return back()->with('success', 'Kode OTP baru telah berhasil dikirimkan ke email Anda.');
    }

    /**
     * Redirect ke Google OAuth
     */
    public function googleRedirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Throwable $e) {
            return redirect()->route('login')->with('error', 'Gagal menghubungkan ke Google: ' . $e->getMessage() . '. Pastikan Client ID dan Secret sudah diisi.');
        }
    }

    /**
     * Callback dari Google OAuth
     */
    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect()->route('login')->with('error', 'Autentikasi Google gagal atau dibatalkan: ' . $e->getMessage());
        }

        // Cari atau buat pengguna
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Pengguna baru mendaftar via Google -> otomatis terverifikasi & aktif sesuai ERD
            $user = User::create([
                'name' => $googleUser->getName() ?? 'Pengguna Google',
                'email' => $googleUser->getEmail(),
                'role' => 'investor', // default role
                'email_verified_at' => Carbon::now(),
                'status' => 'aktif',
                'avatar_url' => $googleUser->getAvatar(),
            ]);
        } else {
            // Update email_verified_at jika belum
            if (!$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
            }
            if ($user->status === 'menunggu_verifikasi') {
                $user->status = 'aktif';
            }
            if (!$user->avatar_url) {
                $user->avatar_url = $googleUser->getAvatar();
            }
            $user->save();
        }

        // Simpan ke tabel autentikasi_pihak_ketiga
        ThirdPartyAuthentication::updateOrCreate(
            [
                'provider_name' => 'google',
                'provider_user_id' => $googleUser->getId(),
            ],
            [
                'user_id' => $user->id,
                'avatar_url' => $googleUser->getAvatar(),
                'connected_at' => Carbon::now(),
            ]
        );

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'))->with('success', 'Berhasil masuk dengan akun Google.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Helper membuat & mengirim kode OTP
     */
    protected function generateAndSendOtp(User $user, string $action): string
    {
        // Generate random 6-digit number
        $otp = (string) random_int(100000, 999999);

        // Batalkan kode sebelumnya yang belum terpakai untuk user ini
        VerificationCode::where('user_id', $user->id)
            ->where('verification_type', 'otp_email')
            ->where('is_used', false)
            ->update(['is_used' => true]);

        // Simpan kode baru (valid 5 menit)
        VerificationCode::create([
            'user_id' => $user->id,
            'verification_type' => 'otp_email',
            'secret_code' => $otp,
            'sent_to' => $user->email,
            'is_used' => false,
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);

        $actionText = match ($action) {
            'daftar' => 'verifikasi pendaftaran akun baru',
            'reset_password' => 'pemulihan kata sandi',
            default => 'keamanan masuk akun',
        };

        // Kirim email
        try {
            Mail::to($user->email)->send(new SendOtpMail(
                otp: $otp,
                userName: $user->name,
                action: $actionText
            ));
        } catch (Throwable $e) {
            // Log jika mail belum terkonfigurasi (misal mailer log)
            report($e);
        }

        return $otp;
    }
}
