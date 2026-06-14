<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Menu;
use App\Models\StokBahan;

class KasirController extends Controller
{
    public function pos()
    {
        $menus = Menu::orderBy('kategori')->orderBy('nama')->get();
        return view('kasir.pos', compact('menus'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'cart'    => 'required|string',
            'metode'  => 'required|in:tunai,qris',
            'tipe'    => 'required|in:dine_in,take_away',
            'uang'    => 'nullable|numeric',
            'catatan' => 'nullable|string',
        ]);

        $cart      = json_decode($request->cart, true);
        $total     = collect($cart)->sum(fn($i) => $i['harga'] * $i['qty']);
        $uang      = (int)($request->uang ?? $total);
        $kembalian = $request->metode === 'tunai' ? ($uang - $total) : 0;

        $nomorGlobal = Transaksi::count() + 1;
        $nomor       = str_pad($nomorGlobal, 3, '0', STR_PAD_LEFT);

        $transaksi = Transaksi::create([
            'nomor'     => $nomor,
            'items'     => json_encode($cart),
            'total'     => $total,
            'metode'    => $request->metode,
            'tipe'      => $request->tipe,
            'catatan'   => $request->catatan,
            'uang'      => $uang,
            'kembalian' => $kembalian,
            'status'    => 'antrian',
            'is_urgent' => false,
        ]);

        // Simpan item transaksi
        foreach ($cart as $item) {
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'menu_id'      => $item['id'],
                'nama_menu'    => $item['nama'],
                'harga'        => $item['harga'],
                'qty'          => $item['qty'],
                'subtotal'     => $item['harga'] * $item['qty'],
            ]);
        }

        // ✅ Kurangi stok otomatis & nonaktifkan menu jika stok = 0
        foreach ($cart as $item) {
            $menu = Menu::find($item['id']);

            if ($menu && $menu->stokBahan) {
                $stok = $menu->stokBahan;

                // Kurangi stok sejumlah qty dipesan, tidak boleh di bawah 0
                $stok->stok_saat_ini = max(0, $stok->stok_saat_ini - $item['qty']);
                $stok->save();

                // Jika stok = 0, otomatis nonaktifkan menu
                if ($stok->stok_saat_ini == 0) {
                    $menu->update(['tersedia' => false]);
                }
            }
        }

        return redirect()->route('kasir.pos')->with('struk', [
            'nomor'     => $nomor,
            'waktu'     => now()->format('H.i'),
            'tipe'      => $request->tipe === 'dine_in' ? 'Dine in' : 'Take Away',
            'catatan'   => $request->catatan,
            'items'     => $cart,
            'total'     => $total,
            'metode'    => $request->metode,
            'uang'      => $uang,
            'kembalian' => $kembalian,
        ]);
    }

    public function antrian()
    {
        $antrian = Transaksi::with('orderItems')
            ->where('status', 'antrian')
            ->whereDate('created_at', today())
            ->orderBy('created_at')
            ->get();

        $selesai = Transaksi::with('orderItems')
            ->where('status', 'selesai')
            ->whereDate('created_at', today())
            ->orderBy('updated_at', 'desc')
            ->get();

        $urgent = $antrian->where('is_urgent', true)->count();

        return view('kasir.antrian', compact('antrian', 'selesai', 'urgent'));
    }

    public function tandaiSelesai(Request $request, $id)
    {
        Transaksi::findOrFail($id)->update(['status' => 'selesai']);
        return back();
    }

    public function hapusRiwayat()
    {
        Transaksi::where('status', 'selesai')
            ->whereDate('created_at', today())
            ->update(['status' => 'arsip']);
        return back();
    }
}