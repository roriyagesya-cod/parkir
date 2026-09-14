<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');

        $query = Transaksi::with(['kendaraan', 'area'])->where('status', 'keluar');

        if ($dari) {
            $query->whereDate('waktu_keluar', '>=', $dari);
        }
        if ($sampai) {
            $query->whereDate('waktu_keluar', '<=', $sampai);
        }

        $rows = $query->latest('waktu_keluar')->get();
        $totalTransaksi = $rows->count();
        $totalPendapatan = $rows->sum('biaya_total');

        return view('transaksi.rekap', compact('rows', 'dari', 'sampai', 'totalTransaksi', 'totalPendapatan'));
    }
}
