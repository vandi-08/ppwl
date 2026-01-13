<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // ✅ Validasi data
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // ✅ Simpan user baru tanpa login otomatis
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'membership' => 'free',
            'role' => 'user', // default user
        ]);

        // ✅ Redirect ke login dengan notifikasi sukses
        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        // ✅ Cek admin manual (admin hardcoded)
        if ($user && $user->email === 'admin@email.com' && $request->password === 'admin123') {
            Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        // ✅ Cek user biasa
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Jika tabel users punya kolom 'role', arahkan sesuai role-nya
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // ❌ Jika gagal login
        return back()->with('error', 'Email atau password salah');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
