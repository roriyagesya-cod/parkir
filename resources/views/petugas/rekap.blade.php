@extends('layouts.app')

@section('content')
<div class="page-head">
    <div>
        <h1>Rekap Transaksi</h1>
        <div class="desc">Periode {{ $periode }}</div>
    </div>
</div>

<form method="GET" action="{{ route('rekap.index') }}" class="filter-row">
    <div class="field">
        <label for="dari">Dari</label>
        <input type="date" id="dari" name="dari" value="{{ request('dari') }}">
    </div>
    <div class="field">
        <label for="sampai">Sampai</label>
        <input type="date" id="sampai" name="sampai" value="{{ request('sampai') }}">
    </div>
    <button type="submit" class="btn btn-amber">Filter</button>
    <a href="{{ route('rekap.index') }}" class="btn btn-ghost">Reset</a>
</form>

<div class="stats-row">
    <div class="stat-card">
        <div class="num">{{ $total }}</div>
        <div class="lbl">Total transaksi</div>
    </div>
    <div class="stat-card accent">
        <div class="num">Rp {{ number_format($pendapatan, 0, ',', '.') }}</div>
        <div class="lbl">Total pendapatan</div>
    </div>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Waktu Keluar</th>
                <th>Kendaraan</th>
                <th>Area</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $t)
                <tr>
                    <td class="mono">{{ $t->waktu_keluar }}</td>
                    <td>{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                    <td>{{ $t->area->nama_area ?? '-' }}</td>
                    <td>Rp {{ number_format($t->biaya_total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="4">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection