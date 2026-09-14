@extends('layouts.app')
@section('title', 'Tarif Parkir — Portal Parkir')

@section('content')
  <div class="page-head">
    <div><h1>Tarif parkir</h1><div class="desc">Tarif per jam berdasarkan jenis kendaraan.</div></div>
    <a href="{{ route('tarif.create') }}" class="btn btn-amber">+ Tambah tarif</a>
  </div>

  <div class="table-wrap"><table>
    <thead><tr><th>Jenis kendaraan</th><th>Tarif / jam</th><th></th></tr></thead>
    <tbody>
      @forelse($tarifs as $tarif)
        <tr>
          <td style="text-transform:capitalize;">{{ $tarif->jenis_kendaraan }}</td>
          <td class="mono">Rp{{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
          <td>
            <div class="row-actions">
              <a class="btn btn-ghost btn-sm" href="{{ route('tarif.edit', $tarif) }}">Ubah</a>
              <form method="POST" action="{{ route('tarif.destroy', $tarif) }}" onsubmit="return confirm('Hapus tarif ini?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr class="empty-row"><td colspan="3">Belum ada tarif.</td></tr>
      @endforelse
    </tbody>
  </table></div>
@endsection
