<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\StokBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus  = Menu::orderBy('kategori')->orderBy('nama')->get();
        $bahans = StokBahan::orderBy('nama')->get(); // ← tambah ini
        return view('admin.menu', compact('menus', 'bahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'harga'         => 'required|numeric',
            'kategori'      => 'required|in:kopi,non-kopi,snack',
            'gambar'        => 'nullable|image|max:2048',
            'stok_bahan_id' => 'nullable|exists:stok_bahan,id',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi', 'kategori', 'badge', 'stok_bahan_id']);
        $data['tersedia'] = true;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'harga'         => 'required|numeric',
            'kategori'      => 'required|in:kopi,non-kopi,snack',
            'gambar'        => 'nullable|image|max:2048',
            'stok_bahan_id' => 'nullable|exists:stok_bahan,id',
        ]);

        $data = $request->only(['nama', 'harga', 'deskripsi', 'kategori', 'badge', 'stok_bahan_id']);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus.');
    }
}