@extends('layouts.app')
@section('title', 'Log Aktivitas — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Log aktivitas</h1><div class="desc">Riwayat aktivitas seluruh pengguna sistem.</div></div></div>

  <div class="table-wrap"><table>
    <thead><tr><th>Waktu</th><th>Pengguna</th><th>Aktivitas</th></tr></thead>
    <tbody>
      @forelse($logs as $log)
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

  <div style="margin-top:16px;">{{ $logs->links() }}</div>
@endsection
