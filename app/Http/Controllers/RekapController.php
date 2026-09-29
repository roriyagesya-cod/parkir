<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'keluar');

        if ($request->filled('dari')) {
            $query->whereDate('waktu_keluar', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('waktu_keluar', '<=', $request->sampai);
        }

        $transaksi = $query->orderByDesc('waktu_keluar')->get();

        $total = $transaksi->count();
        $pendapatan = $transaksi->sum('biaya_total');

        $periode = ($request->filled('dari') || $request->filled('sampai'))
            ? ($request->dari ?: 'Awal') . ' s/d ' . ($request->sampai ?: 'Sekarang')
            : 'Awal s/d Sekarang';

        return view('petugas.rekap', compact('transaksi', 'total', 'pendapatan', 'periode'));
    }
}