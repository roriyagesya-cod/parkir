@extends('layouts.app')
@section('title', 'Area Parkir — Portal Parkir')

@section('content')
  <div class="page-head">
    <div><h1>Area parkir</h1><div class="desc">Kapasitas dan okupansi tiap area.</div></div>
    <a href="{{ route('area.create') }}" class="btn btn-amber">+ Tambah area</a>
  </div>

  <div class="table-wrap"><table>
    <thead><tr><th>Nama area</th><th>Kapasitas</th><th>Terisi</th><th>Sisa</th><th></th></tr></thead>
    <tbody>
      @forelse($areas as $area)
        <tr>
          <td>{{ $area->nama_area }}</td>
          <td class="mono">{{ $area->kapasitas }}</td>
          <td class="mono">{{ $area->terisi }}</td>
          <td class="mono">{{ $area->sisa() }}</td>
          <td>
            <div class="row-actions">
              <a class="btn btn-ghost btn-sm" href="{{ route('area.edit', $area) }}">Ubah</a>
              <form method="POST" action="{{ route('area.destroy', $area) }}" onsubmit="return confirm('Hapus area ini?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr class="empty-row"><td colspan="5">Belum ada area.</td></tr>
      @endforelse
    </tbody>
  </table></div>
@endsection
