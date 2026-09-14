<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user')->latest('waktu_aktivitas')->paginate(30);

        return view('log.index', compact('logs'));
    }
}
