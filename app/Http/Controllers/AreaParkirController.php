<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    public function index()
    {
        $areas = AreaParkir::orderBy('nama_area')->get();

        return view('area.index', compact('areas'));
    }

    public function create()
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:0',
        ]);
        $data['terisi'] = 0;

        $area = AreaParkir::create($data);

        LogAktivitas::catat(session('user_id'), "Menambahkan area \"{$area->nama_area}\"");

        return redirect()->route('area.index')->with('status', 'Area berhasil ditambahkan.');
    }

    public function edit(AreaParkir $area)
    {
        return view('area.edit', compact('area'));
    }

    public function update(Request $request, AreaParkir $area)
    {
        $data = $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:0',
        ]);

        $area->update($data);

        LogAktivitas::catat(session('user_id'), "Mengubah area \"{$area->nama_area}\"");

        return redirect()->route('area.index')->with('status', 'Area berhasil diperbarui.');
    }

    public function destroy(AreaParkir $area)
    {
        $nama = $area->nama_area;
        $area->delete();

        LogAktivitas::catat(session('user_id'), "Menghapus area \"{$nama}\"");

        return redirect()->route('area.index')->with('status', 'Area berhasil dihapus.');
    }
}
