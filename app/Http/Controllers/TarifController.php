<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::orderBy('jenis_kendaraan')->get();

        return view('tarif.index', compact('tarifs'));
    }

    public function create()
    {
        return view('tarif.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_kendaraan' => 'required|string|max:20',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $tarif = Tarif::create($data);

        LogAktivitas::catat(session('user_id'), "Menambahkan tarif \"{$tarif->jenis_kendaraan}\"");

        return redirect()->route('tarif.index')->with('status', 'Tarif berhasil ditambahkan.');
    }

    public function edit(Tarif $tarif)
    {
        return view('tarif.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $data = $request->validate([
            'jenis_kendaraan' => 'required|string|max:20',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $tarif->update($data);

        LogAktivitas::catat(session('user_id'), "Mengubah tarif \"{$tarif->jenis_kendaraan}\"");

        return redirect()->route('tarif.index')->with('status', 'Tarif berhasil diperbarui.');
    }

    public function destroy(Tarif $tarif)
    {
        $jenis = $tarif->jenis_kendaraan;
        $tarif->delete();

        LogAktivitas::catat(session('user_id'), "Menghapus tarif \"{$jenis}\"");

        return redirect()->route('tarif.index')->with('status', 'Tarif berhasil dihapus.');
    }
}
