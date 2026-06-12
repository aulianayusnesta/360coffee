<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('auth.lupa-password');
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)
                    ->whereIn('role', ['admin', 'kasir'])
                    ->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan atau bukan akun Admin/Kasir.'
            ]);
        }

        return redirect()
            ->route('password.forgot')
            ->with('email_verified', $request->email);
    }

    public function savePassword(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'name'      => 'required|string|max:100',
            'new_email' => 'required|email',
            'password'  => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->whereIn('role', ['admin', 'kasir'])
                    ->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $emailTaken = User::where('email', $request->new_email)
                          ->where('id', '!=', $user->id)
                          ->exists();

        if ($emailTaken) {
            return back()->withErrors(['new_email' => 'Email sudah digunakan akun lain.']);
        }

        $newUsername = strtolower(str_replace(' ', '', $request->name));

        $usernameTaken = User::where('username', $newUsername)
                             ->where('id', '!=', $user->id)
                             ->exists();

        if ($usernameTaken) {
            return back()->withErrors(['name' => 'Nama ini menghasilkan username yang sudah dipakai akun lain.']);
        }

        $user->update([
            'name'     => $request->name,
            'username' => $newUsername,
            'email'    => $request->new_email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('password.forgot')
            ->with('password_changed', true)
            ->with('new_username', $newUsername)
            ->with('new_email', $request->new_email);
    }
}