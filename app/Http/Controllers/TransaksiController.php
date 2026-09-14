<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Tarif;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'aktif');

        $aktif = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'masuk')->latest('waktu_masuk')->get();

        $selesai = Transaksi::with(['kendaraan', 'area'])
            ->where('status', 'keluar')->latest('waktu_keluar')->get();

        return view('transaksi.index', compact('tab', 'aktif', 'selesai'));
    }

    public function create()
    {
        $areas = AreaParkir::whereColumn('terisi', '<', 'kapasitas')->orderBy('nama_area')->get();
        $tarifs = Tarif::orderBy('jenis_kendaraan')->get();

        return view('transaksi.checkin', compact('areas', 'tarifs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'id_tarif' => 'required|exists:tb_tarif,id_tarif',
            'id_area' => 'required|exists:tb_area_parkir,id_area',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'nullable|string|max:100',
        ]);

        $area = AreaParkir::findOrFail($data['id_area']);
        if ($area->terisi >= $area->kapasitas) {
            return back()->withInput()->with('error', 'Area yang dipilih sudah penuh.');
        }

        $tarif = Tarif::findOrFail($data['id_tarif']);
        $plat = strtoupper($data['plat_nomor']);

        $kendaraan = Kendaraan::firstOrCreate(
            ['plat_nomor' => $plat],
            [
                'jenis_kendaraan' => $tarif->jenis_kendaraan,
                'warna' => $data['warna'] ?? null,
                'pemilik' => $data['pemilik'] ?? null,
                'id_user' => session('user_id'),
            ]
        );

        Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'waktu_masuk' => now(),
            'id_tarif' => $tarif->id_tarif,
            'status' => 'masuk',
            'id_user' => session('user_id'),
            'id_area' => $area->id_area,
        ]);

        $area->increment('terisi');

        LogAktivitas::catat(session('user_id'), "Mencatat kendaraan masuk \"{$plat}\"");

        return redirect()->route('transaksi.index')->with('status', 'Kendaraan berhasil dicatat masuk.');
    }

    public function checkout(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'masuk') {
            return back()->with('error', 'Transaksi ini sudah selesai.');
        }

        $now = now();
        $jam = max(1, (int) ceil($transaksi->waktu_masuk->diffInMinutes($now) / 60));
        $biaya = $jam * $transaksi->tarif->tarif_per_jam;

        $transaksi->update([
            'waktu_keluar' => $now,
            'durasi_jam' => $jam,
            'biaya_total' => $biaya,
            'status' => 'keluar',
        ]);

        $area = $transaksi->area;
        if ($area) {
            $area->decrement('terisi', min(1, $area->terisi));
        }

        LogAktivitas::catat(
            session('user_id'),
            "Checkout kendaraan \"{$transaksi->kendaraan->plat_nomor}\" — Rp".number_format($biaya, 0, ',', '.')
        );

        return redirect()->route('transaksi.struk', $transaksi)->with('status', 'Checkout berhasil diproses.');
    }

    public function struk(Transaksi $transaksi)
    {
        $transaksi->load(['kendaraan', 'area', 'tarif']);

        return view('transaksi.struk', compact('transaksi'));
    }
}
