<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class KetersediaanController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('kategori')->orderBy('nama')->get();
        return view('admin.ketersediaan', compact('menus'));
    }

    public function toggle(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->tersedia = !$menu->tersedia;
        $menu->save();

        return response()->json([
            'success'  => true,
            'tersedia' => $menu->tersedia,
            'nama'     => $menu->nama,
        ]);
    }

    public function aktifkanSemua(Request $request)
    {
        $query = Menu::query();
        if ($request->kategori && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }
        $query->update(['tersedia' => true]);

        return response()->json(['success' => true]);
    }

    public function nonaktifkanSemua(Request $request)
    {
        $query = Menu::query();
        if ($request->kategori && $request->kategori !== 'semua') {
            $query->where('kategori', $request->kategori);
        }
        $query->update(['tersedia' => false]);

        return response()->json(['success' => true]);
    }
}