<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('user_role');

        $aktif = Transaksi::where('status', 'masuk')->count();
        $totalKapasitas = AreaParkir::sum('kapasitas');
        $totalTerisi = AreaParkir::sum('terisi');
        $transaksiHariIni = Transaksi::whereDate('waktu_masuk', today())->count();
        $pendapatanHariIni = Transaksi::whereDate('waktu_keluar', today())->sum('biaya_total');

        $extra = [];

        if ($role === 'admin') {
            $extra['logs'] = LogAktivitas::with('user')->latest('waktu_aktivitas')->take(6)->get();
        } elseif ($role === 'petugas') {
            $extra['antre'] = Transaksi::with(['kendaraan', 'area'])
                ->where('status', 'masuk')->latest('waktu_masuk')->take(6)->get();
        } elseif ($role === 'owner') {
            $extra['selesai'] = Transaksi::with(['kendaraan', 'area'])
                ->where('status', 'keluar')->latest('waktu_keluar')->take(6)->get();
        }

        return view('dashboard', compact(
            'role', 'aktif', 'totalKapasitas', 'totalTerisi', 'transaksiHariIni', 'pendapatanHariIni', 'extra'
        ));
    }
}
