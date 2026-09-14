@extends('layouts.app')
@section('title', 'Rekap Transaksi — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Rekap transaksi</h1><div class="desc">Ringkasan transaksi selesai pada rentang waktu tertentu.</div></div></div>

  <div class="panel">
    <form method="GET" action="{{ route('rekap.index') }}" class="filter-row">
      <div class="field"><label>Dari tanggal</label><input type="date" name="dari" value="{{ $dari }}"></div>
      <div class="field"><label>Sampai tanggal</label><input type="date" name="sampai" value="{{ $sampai }}"></div>
      <button class="btn btn-amber" type="submit">Tampilkan</button>
      <a href="{{ route('rekap.index') }}" class="btn btn-ghost">Reset</a>
    </form>
    <div class="stats-row" style="margin-bottom:0;">
      <div class="stat-card accent"><div class="num">{{ $totalTransaksi }}</div><div class="lbl">Jumlah transaksi</div></div>
      <div class="stat-card"><div class="num">Rp{{ number_format($totalPendapatan,0,',','.') }}</div><div class="lbl">Total pendapatan</div></div>
    </div>
  </div>

  <div class="table-wrap"><table>
    <thead><tr><th>Plat nomor</th><th>Jenis</th><th>Area</th><th>Masuk</th><th>Keluar</th><th>Biaya</th></tr></thead>
    <tbody>
      @forelse($rows as $t)
        <tr>
          <td class="mono">{{ $t->kendaraan->plat_nomor }}</td>
          <td style="text-transform:capitalize;">{{ $t->kendaraan->jenis_kendaraan }}</td>
          <td>{{ $t->area->nama_area }}</td>
          <td class="mono">{{ $t->waktu_masuk->format('d M Y H:i') }}</td>
          <td class="mono">{{ $t->waktu_keluar->format('d M Y H:i') }}</td>
          <td class="mono">Rp{{ number_format($t->biaya_total,0,',','.') }}</td>
        </tr>
      @empty
        <tr class="empty-row"><td colspan="6">Tidak ada transaksi pada rentang ini.</td></tr>
      @endforelse
    </tbody>
  </table></div>
@endsection
