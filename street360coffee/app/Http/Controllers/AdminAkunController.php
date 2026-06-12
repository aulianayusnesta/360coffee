<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAkunController extends Controller
{
    /**
     * Halaman kelola akun / tampilkan daftar akun
     */
    public function index()
    {
        return view('admin.akun');
    }

    /**
     * Halaman reset password untuk akun yang sedang login
     */
    public function resetPasswordForm()
    {
        return view('auth.reset-password');
    }

    /**
     * Proses simpan reset password
     */
    public function resetPasswordSave(Request $request)
    {
        $request->validate([
            'nama'                  => 'nullable|string|max:100',
            'email'                 => 'nullable|email|max:100',
            'password'              => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable',
        ]);

        $user = auth()->user();

        $data = [];
        if ($request->filled('nama'))     $data['name']  = $request->nama;
        if ($request->filled('email'))    $data['email'] = $request->email;
        if ($request->filled('password')) $data['password'] = Hash::make($request->password);

        if (!empty($data)) {
            $user->update($data);
        }

        return back()->with('success', 'Data berhasil disimpan!');
    }
}