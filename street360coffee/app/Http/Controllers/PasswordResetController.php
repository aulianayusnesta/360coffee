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
            'email'      => 'required|email',
            'name'       => ['required', 'string', 'max:100', 'not_regex:/@/', 'not_regex:/\s*@\s*/'],
            'akun_email' => 'required|email',   // ← diganti dari new_email
            'password'   => 'required|min:6|confirmed',
        ], [
            'name.not_regex'      => 'Nama tidak boleh mengandung karakter email (@). Isi dengan nama biasa, contoh: admin atau John.',
            'akun_email.required' => 'Email wajib diisi.',
            'akun_email.email'    => 'Format email tidak valid.',
        ]);

        $user = User::where('email', $request->email)
                    ->whereIn('role', ['admin', 'kasir'])
                    ->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        $emailTaken = User::where('email', $request->akun_email)  // ← diganti
                          ->where('id', '!=', $user->id)
                          ->exists();

        if ($emailTaken) {
            return back()->withErrors(['akun_email' => 'Email sudah digunakan akun lain.']);  // ← diganti
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
            'email'    => $request->akun_email,   // ← diganti
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('password.forgot')
            ->with('password_changed', true)
            ->with('new_username', $newUsername)
            ->with('new_email', $request->akun_email);  // ← diganti
    }
}