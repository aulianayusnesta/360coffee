<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role'     => 'required|in:admin,kasir',
        ]);

        // Coba login pakai email atau username
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $request->username,
            'password' => $request->password,
        ];

        if (! Auth::attempt($credentials)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username/email atau password salah.']);
        }

        $user = Auth::user();

        // Cek role cocok
        if ($user->role !== $request->role) {
            Auth::logout();
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Akun ini bukan ' . ucfirst($request->role) . '.']);
        }

        // Blokir role selain admin/kasir
        if (! in_array($user->role, ['admin', 'kasir'])) {
            Auth::logout();
            return back()->withErrors(['username' => 'Akses ditolak.']);
        }

        $request->session()->regenerate();

        return $user->role === 'admin'
            ? redirect()->intended(route('admin.dashboard'))
            : redirect()->intended(route('kasir.pos'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}