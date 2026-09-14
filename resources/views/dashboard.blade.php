@extends('layouts.app')
@section('title', 'Dashboard — Parkir Kabasa')

@section('content')
  <div class="page-head">
    <div>
      <h1>Dashboard</h1>
      <div class="desc">Ringkasan operasional area parkir hari ini.</div>
    </div>
  </div>

  <div class="stats-row">
    <div class="stat-card accent"><div class="num">{{ $aktif }}</div><div class="lbl">Kendaraan sedang parkir</div></div>
    <div class="stat-card"><div class="num">{{ $totalTerisi }}/{{ $totalKapasitas }}</div><div class="lbl">Okupansi area parkir</div></div>
    <div class="stat-card"><div class="num">{{ $transaksiHariIni }}</div><div class="lbl">Transaksi masuk hari ini</div></div>
    <div class="stat-card"><div class="num">Rp{{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</div><div class="lbl">Pendapatan hari ini</div></div>
  </div>

  @if($role === 'admin')
    <div class="panel">
      <h3>Aktivitas terbaru</h3>
      <div class="table-wrap"><table>
        <thead><tr><th>Waktu</th><th>Pengguna</th><th>Aktivitas</th></tr></thead>
        <tbody>
          @forelse($extra['logs'] as $log)
            <tr>
              <td class="mono">{{ $log->waktu_aktivitas->format('d M Y H:i') }}</td>
              <td>{{ $log->user->nama_lengkap ?? '—' }}</td>
              <td>{{ $log->aktivitas }}</td>
            </tr>
          @empty
            <tr class="empty-row"><td colspan="3">Belum ada aktivitas tercatat.</td></tr>
          @endforelse
        </tbody>
      </table></div>
    </div>
  @elseif($role === 'petugas')
    <div class="panel">
      <h3>Kendaraan sedang parkir</h3>
      <div class="table-wrap"><table>
        <thead><tr><th>Plat nomor</th><th>Area</th><th>Masuk</th></tr></thead>
        <tbody>
          @forelse($extra['antre'] as $t)
            <tr>
              <td class="mono">{{ $t->kendaraan->plat_nomor }}</td>
              <td>{{ $t->area->nama_area }}</td>
              <td class="mono">{{ $t->waktu_masuk->format('d M Y H:i') }}</td>
            </tr>
          @empty
            <tr class="empty-row"><td colspan="3">Tidak ada kendaraan sedang parkir.</td></tr>
          @endforelse
        </tbody>
      </table></div>
    </div>
  @elseif($role === 'owner')
    <div class="panel">
      <h3>Transaksi selesai terbaru</h3>
      <div class="table-wrap"><table>
        <thead><tr><th>Plat nomor</th><th>Keluar</th><th>Biaya</th></tr></thead>
        <tbody>
          @forelse($extra['selesai'] as $t)
            <tr>
              <td class="mono">{{ $t->kendaraan->plat_nomor }}</td>
              <td class="mono">{{ $t->waktu_keluar->format('d M Y H:i') }}</td>
              <td class="mono">Rp{{ number_format($t->biaya_total, 0, ',', '.') }}</td>
            </tr>
          @empty
            <tr class="empty-row"><td colspan="3">Belum ada transaksi selesai.</td></tr>
          @endforelse
        </tbody>
      </table></div>
    </div>
  @endif
@endsection
