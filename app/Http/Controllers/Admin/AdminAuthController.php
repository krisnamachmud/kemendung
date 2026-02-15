<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Halaman login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek admin dari database (by email)
        $user = User::where('email', $request->username)->first();

        if ($user && $user->password && Hash::check($request->password, $user->password)) {
            // Cek apakah user bisa akses admin (administrator atau kartar)
            if (!$user->canAccessAdmin()) {
                return back()->withErrors(['login' => 'Akun Anda tidak memiliki akses ke halaman admin.']);
            }
            
            session([
                'admin' => true, 
                'admin_name' => $user->name, 
                'admin_id' => $user->id, 
                'admin_avatar' => $user->avatar,
                'admin_role' => $user->role
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Email atau password salah']);
    }

    // Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }

        // Cek apakah email terdaftar sebagai admin
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Akun Google Anda belum terdaftar sebagai admin. Hubungi administrator.']);
        }

        if (!$user->is_admin) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Akun Anda tidak memiliki akses admin.']);
        }

        // Update Google ID & avatar
        $user->update([
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
        ]);

        // Cek apakah user bisa akses admin
        if (!$user->canAccessAdmin()) {
            return redirect()->route('admin.login')
                ->withErrors(['login' => 'Akun Anda tidak memiliki akses ke halaman admin.']);
        }

        session([
            'admin' => true,
            'admin_name' => $user->name,
            'admin_id' => $user->id,
            'admin_avatar' => $user->avatar,
            'admin_role' => $user->role,
        ]);

        return redirect()->route('admin.dashboard');
    }

    // Logout
    public function logout()
    {
        session()->forget(['admin', 'admin_name', 'admin_id', 'admin_avatar', 'admin_role']);
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('home');
    }
}
