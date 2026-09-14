@extends('layouts.app')
@section('title', 'Transaksi Parkir — Portal Parkir')

@php
  $rows = $tab === 'selesai' ? $selesai : $aktif;
@endphp

@section('content')
  <div class="page-head">
    <div><h1>Transaksi parkir</h1><div class="desc">Catat kendaraan masuk, proses keluar, dan cetak struk.</div></div>
    <a href="{{ route('transaksi.create') }}" class="btn btn-amber">+ Kendaraan masuk</a>
  </div>

  <div class="tabs">
    <a href="{{ route('transaksi.index', ['tab' => 'aktif']) }}" class="tab-btn {{ $tab==='aktif'?'active':'' }}">Sedang parkir ({{ $aktif->count() }})</a>
    <a href="{{ route('transaksi.index', ['tab' => 'selesai']) }}" class="tab-btn {{ $tab==='selesai'?'active':'' }}">Selesai ({{ $selesai->count() }})</a>
  </div>

  <div class="table-wrap"><table>
    <thead>
      <tr>
        <th>Plat nomor</th><th>Jenis</th><th>Area</th><th>Masuk</th><th>Keluar</th><th>Biaya</th><th>Status</th><th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($rows as $t)
        <tr>
          <td class="mono">{{ $t->kendaraan->plat_nomor }}</td>
          <td style="text-transform:capitalize;">{{ $t->kendaraan->jenis_kendaraan }}</td>
          <td>{{ $t->area->nama_area }}</td>
          <td class="mono">{{ $t->waktu_masuk->format('d M Y H:i') }}</td>
          <td class="mono">{{ $t->waktu_keluar ? $t->waktu_keluar->format('d M Y H:i') : '—' }}</td>
          <td class="mono">{{ $t->biaya_total ? 'Rp'.number_format($t->biaya_total,0,',','.') : '—' }}</td>
          <td><span class="badge {{ $t->status==='masuk' ? 'badge-in' : 'badge-out' }}">{{ $t->status==='masuk' ? 'Parkir' : 'Selesai' }}</span></td>
          <td>
            @if($t->status === 'masuk')
              <form method="POST" action="{{ route('transaksi.checkout', $t) }}">
                @csrf
                <button class="btn btn-amber btn-sm" type="submit">Checkout</button>
              </form>
            @else
              <a class="btn btn-ghost btn-sm" href="{{ route('transaksi.struk', $t) }}">Cetak struk</a>
            @endif
          </td>
        </tr>
      @empty
        <tr class="empty-row"><td colspan="8">Tidak ada data.</td></tr>
      @endforelse
    </tbody>
  </table></div>
@endsection
