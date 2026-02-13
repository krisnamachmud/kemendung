<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserAuthController extends Controller
{
    // Halaman login
    public function showLoginForm()
    {
        if (session('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_avatar' => $user->avatar,
                'user_role' => $user->role,
            ]);

            return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->withErrors(['login' => 'Email atau password salah'])->withInput();
    }

    // Halaman register
    public function showRegisterForm()
    {
        if (session('user_id')) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role user
        ]);

        // Auto login setelah register
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_avatar' => $user->avatar,
            'user_role' => $user->role,
        ]);

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }

    // Login dengan Google
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
            return redirect()->route('user.login')
                ->withErrors(['login' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }

        // Cek apakah user sudah ada
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Buat user baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'role' => 'user',
            ]);
        } else {
            // Update Google ID & avatar
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        }

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_avatar' => $user->avatar,
            'user_role' => $user->role,
        ]);

        return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang, ' . $user->name . '!');
    }

    // Profil user
    public function profile()
    {
        if (!session('user_id')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('user_id'));
        return view('auth.profile', compact('user'));
    }

    // Update profil
    public function updateProfile(Request $request)
    {
        $user = User::find(session('user_id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update session
        session([
            'user_name' => $user->name,
            'user_email' => $user->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Logout
    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email', 'user_avatar', 'user_role']);
        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}
