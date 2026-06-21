<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokBahan;
use App\Models\Menu;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /* ─────────────────────────────────────────────
     │  INDEX — tampilkan semua bahan + stat cards
     ───────────────────────────────────────────── */
    public function index()
    {
        $bahans      = StokBahan::orderBy('nama')->get();
        $aman        = $bahans->filter(fn($b) => $b->getStatus() === 'aman')->count();
        $hampirHabis = $bahans->filter(fn($b) => $b->getStatus() === 'hampir_habis')->count();
        $kritis      = $bahans->filter(fn($b) => $b->getStatus() === 'kritis')->count();

        return view('admin.stok', compact('bahans', 'aman', 'hampirHabis', 'kritis'));
    }

    /* ─────────────────────────────────────────────
     │  STORE — tambah bahan baru
     ───────────────────────────────────────────── */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'stok_saat_ini' => 'required|numeric|min:0',
            'stok_maks'     => 'required|numeric|min:1|gte:stok_saat_ini',
            'satuan'        => 'required|string|max:20',
        ]);

        StokBahan::create($request->only('nama', 'stok_saat_ini', 'stok_maks', 'satuan'));

        return redirect()->route('admin.stok')->with('success', 'Bahan berhasil ditambahkan.');
    }

    /* ─────────────────────────────────────────────
     │  EDIT STOK — update stok_saat_ini & stok_maks
     │  ✅ FIX: aktifkan/nonaktifkan menu otomatis
     ───────────────────────────────────────────── */
    public function editStok(Request $request, $id)
    {
        $request->validate([
            'stok_saat_ini' => 'required|numeric|min:0|lte:stok_maks',
            'stok_maks'     => 'required|numeric|min:1|gte:stok_saat_ini',
        ]);

        $bahan = StokBahan::findOrFail($id);
        $bahan->update($request->only('stok_saat_ini', 'stok_maks'));

        // ✅ Aktifkan menu jika stok > 0, nonaktifkan jika stok = 0
        if ($bahan->stok_saat_ini > 0) {
            Menu::where('stok_bahan_id', $bahan->id)->update(['tersedia' => true]);
        } else {
            Menu::where('stok_bahan_id', $bahan->id)->update(['tersedia' => false]);
        }

        return redirect()->route('admin.stok')->with('success', 'Stok berhasil diperbarui.');
    }

    /* ─────────────────────────────────────────────
     │  ADJUST — tambah/kurang stok ±1 via AJAX
     │  ✅ FIX: aktifkan/nonaktifkan menu otomatis
     ───────────────────────────────────────────── */
    public function adjust(Request $request, $id)
    {
        $request->validate(['delta' => 'required|integer|in:-1,1']);

        $bahan = StokBahan::findOrFail($id);

        // Clamp: tidak boleh < 0 dan tidak boleh > stok_maks
        $bahan->stok_saat_ini = max(0, min($bahan->stok_maks, $bahan->stok_saat_ini + $request->delta));
        $bahan->save();

        // ✅ Aktifkan menu jika stok > 0, nonaktifkan jika stok = 0
        if ($bahan->stok_saat_ini > 0) {
            Menu::where('stok_bahan_id', $bahan->id)->update(['tersedia' => true]);
        } else {
            Menu::where('stok_bahan_id', $bahan->id)->update(['tersedia' => false]);
        }

        return response()->json([
            'success'   => true,
            'stok'      => $bahan->stok_saat_ini,
            'maks'      => $bahan->stok_maks,
            'satuan'    => $bahan->satuan,
            'persen'    => $bahan->getPersen(),
            'bar_class' => $bahan->getBarClass(),
            'status'    => $bahan->getStatus(),
        ]);
    }

    /* ─────────────────────────────────────────────
     │  RESTOK — isi penuh ke stok_maks
     │  ✅ FIX: aktifkan menu kembali setelah restok
     ───────────────────────────────────────────── */
    public function restok($id)
    {
        $bahan = StokBahan::findOrFail($id);
        $bahan->update(['stok_saat_ini' => $bahan->stok_maks]);

        // ✅ Aktifkan kembali semua menu yang pakai bahan ini
        Menu::where('stok_bahan_id', $bahan->id)->update(['tersedia' => true]);

        return redirect()->route('admin.stok')->with('success', "{$bahan->nama} berhasil direstok.");
    }

    /* ─────────────────────────────────────────────
     │  DESTROY — hapus bahan
     ───────────────────────────────────────────── */
    public function destroy($id)
    {
        $bahan = StokBahan::findOrFail($id);
        $nama  = $bahan->nama;
        $bahan->delete();

        return redirect()->route('admin.stok')->with('success', "{$nama} berhasil dihapus.");
    }
}