<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the Admin Login page.
     */
    public function login(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_logged_in', false)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle Admin Login submission with dummy simulation.
     */
    public function submitLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:4',
        ], [
            'username.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
        ]);

        $username = trim($request->input('username'));
        $password = $request->input('password');

        // Simulasi autentikasi: izinkan username admin atau format user apapun dengan password yang sesuai
        // Default login: admin / admin123 (atau kredensial apapun selama valid)
        $userData = [
            'name' => 'Administrator Arpusda',
            'username' => $username,
            'email' => str_contains($username, '@') ? $username : $username.'@arpusda.semarangkota.go.id',
            'role' => 'Super Admin',
            'jabatan' => 'Pranata Komputer Ahli Muda',
            'login_at' => now()->translatedFormat('d F Y, H:i').' WIB',
        ];

        // Khusus jika user memilih role lain untuk pengujian
        if (str_contains(strtolower($username), 'pustakawan')) {
            $userData['name'] = 'Hj. Sri Wahyuni, S.Sos';
            $userData['role'] = 'Pustakawan';
            $userData['jabatan'] = 'Pustakawan Ahli Madya';
        } elseif (str_contains(strtolower($username), 'arsip')) {
            $userData['name'] = 'Rahmat Hidayat, S.S';
            $userData['role'] = 'Arsiparis';
            $userData['jabatan'] = 'Arsiparis Ahli Pertama';
        }

        // Set session
        $request->session()->put('admin_logged_in', true);
        $request->session()->put('admin_user', $userData);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, '.$userData['name'].'! Anda berhasil masuk ke Dashboard Admin Arpusda.');
    }

    /**
     * Handle Admin Logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_logged_in', 'admin_user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('info', 'Anda telah berhasil keluar dari sistem CMS Arpusda.');
    }
}
