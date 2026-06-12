<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::latest();

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('metode') && $request->metode !== 'semua') {
            $query->where('metode', $request->metode);
        }

        // ✅ Default tampilkan selesai+arsip, bukan antrian
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        } else {
            // Kalau tidak ada filter, exclude 'antrian' — kasir belum selesai
            $query->whereIn('status', ['selesai', 'arsip']);
        }

        $transaksis      = $query->get();
        $totalPendapatan = $transaksis->whereIn('status', ['selesai', 'arsip'])->sum('total');

        return view('admin.transaksi', compact('transaksis', 'totalPendapatan'));
    }

    public function exportCsv(Request $request)
    {
        $query = Transaksi::latest();

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('metode') && $request->metode !== 'semua') {
            $query->where('metode', $request->metode);
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        } else {
            $query->whereIn('status', ['selesai', 'arsip']);
        }

        $transaksis = $query->get();
        $filename   = 'transaksi_' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($transaksis) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['#', 'Tanggal', 'Waktu', 'Item', 'Tipe', 'Total', 'Metode Bayar', 'Dibayar', 'Kembalian', 'Status']);

            foreach ($transaksis as $trx) {
                fputcsv($file, [
                    $trx->nomor,
                    $trx->created_at->format('d/m/Y'),
                    $trx->created_at->format('H:i'),
                    $trx->getNamaItems(),
                    $trx->tipe === 'dine_in' ? 'Dine In' : 'Take Away',
                    'Rp ' . number_format($trx->total, 0, ',', '.'),
                    ucfirst($trx->metode),
                    'Rp ' . number_format($trx->uang, 0, ',', '.'),
                    'Rp ' . number_format($trx->kembalian, 0, ',', '.'),
                    // ✅ Tampilkan 'Selesai' untuk status arsip juga
                    $trx->status === 'arsip' ? 'Selesai' : ucfirst($trx->status),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}