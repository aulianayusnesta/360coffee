<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required|in:admin,kasir',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput();
        }

        $user = Auth::user();

        // Cek role sesuai tab yang dipilih di form login
        if ($user->role !== $request->role) {
            Auth::logout();
            return back()->with('error', 'Akun ini bukan role ' . ucfirst($request->role) . '.');
        }

        $request->session()->regenerate();

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('kasir.pos');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}