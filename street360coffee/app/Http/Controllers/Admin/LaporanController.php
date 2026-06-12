<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', 'hari');

        $query = Transaksi::whereIn('status', ['selesai', 'arsip']);

        if ($periode === 'hari') {
            $tanggal = $request->get('tanggal', now()->toDateString());
            $query->whereDate('created_at', $tanggal);
        } elseif ($periode === 'bulan') {
            $bulan = $request->get('bulan', now()->format('Y-m'));
            [$tahun, $bln] = explode('-', $bulan);
            $query->whereYear('created_at', $tahun)
                  ->whereMonth('created_at', $bln);
        } elseif ($periode === 'tahun') {
            $tahun = $request->get('tahun', now()->year);
            $query->whereYear('created_at', $tahun);
        }

        // ✅ FIX: selalu urutkan dari terbaru dulu, pakai nomor asli DB
        $transaksis = $query->orderBy('id', 'desc')->get();

        $totalPendapatan = $transaksis->sum('total');
        $totalTransaksi  = $transaksis->count();
        $rataRata        = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        $ids = $transaksis->pluck('id');

        $penjualanPerMenu = TransaksiItem::selectRaw('nama_menu, SUM(qty) as total_terjual, SUM(subtotal) as total_pendapatan, MIN(created_at) as pertama_terjual, MAX(created_at) as terakhir_terjual')
            ->whereIn('transaksi_id', $ids)
            ->groupBy('nama_menu')
            ->orderByDesc('total_terjual') // ✅ FIX: urutkan terlaris by qty bukan pendapatan
            ->get();

        $maxPendapatan = $penjualanPerMenu->max('total_pendapatan') ?: 1;
        $penjualanPerMenu->each(function ($item) use ($maxPendapatan) {
            $item->persen = round(($item->total_pendapatan / $maxPendapatan) * 100);
        });

        $menuTerlaris = $penjualanPerMenu->first();

        // ✅ FIX: sudah diurutkan dari query, tidak perlu sortBy lagi
        $transaksiDenganWaktu = $transaksis;

        return view('admin.laporan', compact(
            'periode',
            'totalPendapatan',
            'totalTransaksi',
            'rataRata',
            'penjualanPerMenu',
            'menuTerlaris',
            'transaksiDenganWaktu',
        ));
    }
}