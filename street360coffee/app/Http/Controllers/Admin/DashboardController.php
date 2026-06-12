<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokBahan;
use App\Models\Transaksi;
use App\Models\TransaksiItem;

class DashboardController extends Controller
{
    public function index()
    {
        $bahans          = StokBahan::orderBy('nama')->get();
        $stokKritis      = $bahans->filter(fn($b) => $b->getStatus() === 'kritis')->values();
        $stokKritisCount = $stokKritis->count();

        // ✅ Hitung hanya yang sudah selesai atau arsip (bukan antrian)
        $statusSelesai = ['selesai', 'arsip'];

        $transaksiHariIni  = Transaksi::whereDate('created_at', today())
            ->whereIn('status', $statusSelesai)
            ->count();

        $pendapatanHariIni = Transaksi::whereDate('created_at', today())
            ->whereIn('status', $statusSelesai)
            ->sum('total');

        $itemTerjual = TransaksiItem::whereHas('transaksi', function ($q) use ($statusSelesai) {
            $q->whereDate('created_at', today())
              ->whereIn('status', $statusSelesai);
        })->sum('qty');

        // Data chart harian (7 hari terakhir)
        $harian = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl      = now()->subDays($i);
            $harian[] = [
                'label' => $tgl->locale('id')->isoFormat('ddd'),
                'total' => Transaksi::whereDate('created_at', $tgl->toDateString())
                    ->whereIn('status', $statusSelesai)
                    ->sum('total'),
            ];
        }

        // Data chart mingguan (4 minggu terakhir)
        $mingguan = [];
        for ($i = 3; $i >= 0; $i--) {
            $start      = now()->startOfWeek()->subWeeks($i);
            $end        = (clone $start)->endOfWeek();
            $mingguan[] = [
                'label' => 'Mgg ' . (4 - $i),
                'total' => Transaksi::whereBetween('created_at', [$start, $end])
                    ->whereIn('status', $statusSelesai)
                    ->sum('total'),
            ];
        }

        // Menu terlaris hari ini
        $menuTerlaris = TransaksiItem::selectRaw('menu_id, nama_menu, SUM(qty) as total_terjual')
            ->whereHas('transaksi', fn($q) => $q
                ->whereDate('created_at', today())
                ->whereIn('status', $statusSelesai)
            )
            ->groupBy('menu_id', 'nama_menu')
            ->orderByDesc('total_terjual')
            ->limit(3)
            ->with('menu')
            ->get();

        // Transaksi terbaru
        $transaksiTerbaru = Transaksi::whereIn('status', $statusSelesai)
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'bahans',
            'stokKritis',
            'stokKritisCount',
            'pendapatanHariIni',
            'transaksiHariIni',
            'itemTerjual',
            'harian',
            'mingguan',
            'menuTerlaris',
            'transaksiTerbaru'
        ));
    }
}