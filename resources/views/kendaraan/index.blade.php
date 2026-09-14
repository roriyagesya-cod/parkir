@extends('layouts.app')
@section('title', 'Kendaraan — Portal Parkir')

@section('content')
  <div class="page-head">
    <div><h1>Kendaraan</h1><div class="desc">Data master kendaraan yang pernah tercatat.</div></div>
    <a href="{{ route('kendaraan.create') }}" class="btn btn-amber">+ Tambah kendaraan</a>
  </div>

  <div class="table-wrap"><table>
    <thead><tr><th>Plat nomor</th><th>Jenis</th><th>Warna</th><th>Pemilik</th><th></th></tr></thead>
    <tbody>
      @forelse($kendaraans as $k)
        <tr>
          <td class="mono">{{ $k->plat_nomor }}</td>
          <td style="text-transform:capitalize;">{{ $k->jenis_kendaraan }}</td>
          <td>{{ $k->warna ?? '—' }}</td>
          <td>{{ $k->pemilik ?? '—' }}</td>
          <td>
            <div class="row-actions">
              <a class="btn btn-ghost btn-sm" href="{{ route('kendaraan.edit', $k) }}">Ubah</a>
              <form method="POST" action="{{ route('kendaraan.destroy', $k) }}" onsubmit="return confirm('Hapus data kendaraan ini?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr class="empty-row"><td colspan="5">Belum ada kendaraan tercatat.</td></tr>
      @endforelse
    </tbody>
  </table></div>
@endsection
