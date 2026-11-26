<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
      $kendaraans = Kendaraan::orderBy('plat_nomer')->get();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'plat_nomer' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'nullable|string|max:100',
        ]);
        $data['plat_nomer'] = strtoupper($data['plat_nomer']);
        $data['id_user'] = session('user_id');

        $kendaraan = Kendaraan::create($data);

        LogAktivitas::catat(session('user_id'), "Menambahkan kendaraan \"{$kendaraan->plat_nomer}\"");

        return redirect()->route('kendaraan.index')->with('status', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $data = $request->validate([
            'plat_nomer' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna' => 'nullable|string|max:20',
            'pemilik' => 'nullable|string|max:100',
        ]);
        $data['plat_nomer'] = strtoupper($data['plat_nomer']);

        $kendaraan->update($data);

        LogAktivitas::catat(session('user_id'), "Mengubah data kendaraan \"{$kendaraan->plat_nomer}\"");

        return redirect()->route('kendaraan.index')->with('status', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $plat = $kendaraan->plat_nomer;
        $kendaraan->delete();

        LogAktivitas::catat(session('user_id'), "Menghapus kendaraan \"{$plat}\"");

        return redirect()->route('kendaraan.index')->with('status', 'Kendaraan berhasil dihapus.');
    }
}
