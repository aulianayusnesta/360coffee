<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokBahan;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $bahans      = StokBahan::orderBy('nama')->get();
        $aman        = $bahans->filter(fn($b) => $b->getStatus() === 'aman')->count();
        $hampirHabis = $bahans->filter(fn($b) => $b->getStatus() === 'hampir_habis')->count();
        $kritis      = $bahans->filter(fn($b) => $b->getStatus() === 'kritis')->count();

        return view('admin.stok', compact('bahans', 'aman', 'hampirHabis', 'kritis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'stok_saat_ini' => 'required|numeric|min:0',
            'stok_maks'     => 'required|numeric|min:1',
            'satuan'        => 'required|string|max:20',
        ]);

        StokBahan::create($request->only('nama', 'stok_saat_ini', 'stok_maks', 'satuan'));

        return redirect()->route('admin.stok')->with('success', 'Bahan berhasil ditambahkan.');
    }

    public function editStok(Request $request, $id)
    {
        $request->validate([
            'stok_saat_ini' => 'required|numeric|min:0',
            'stok_maks'     => 'required|numeric|min:1',
        ]);

        StokBahan::findOrFail($id)->update($request->only('stok_saat_ini', 'stok_maks'));

        return redirect()->route('admin.stok')->with('success', 'Stok berhasil diperbarui.');
    }

    public function adjust(Request $request, $id)
    {
        $request->validate(['delta' => 'required|integer|in:-1,1']);

        $bahan = StokBahan::findOrFail($id);
        $bahan->stok_saat_ini = max(0, min($bahan->stok_maks, $bahan->stok_saat_ini + $request->delta));
        $bahan->save();

        return response()->json([
            'success'   => true,
            'stok'      => $bahan->stok_saat_ini,
            'maks'      => $bahan->stok_maks,
            'satuan'    => $bahan->satuan,
            'persen'    => $bahan->getPersen(),
            'bar_class' => $bahan->getBarClass(),
        ]);
    }

    public function restok($id)
    {
        $bahan = StokBahan::findOrFail($id);
        $bahan->update(['stok_saat_ini' => $bahan->stok_maks]);

        return redirect()->route('admin.stok')->with('success', "{$bahan->nama} berhasil direstok.");
    }

    public function destroy($id)
    {
        $bahan = StokBahan::findOrFail($id);
        $nama  = $bahan->nama;
        $bahan->delete();

        return redirect()->route('admin.stok')->with('success', "{$nama} berhasil dihapus.");
    }
}