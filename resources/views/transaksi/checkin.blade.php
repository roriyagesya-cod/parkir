@extends('layouts.app')
@section('title', 'Kendaraan Masuk — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Kendaraan masuk</h1><div class="desc">Catat kendaraan yang baru masuk ke area parkir.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('transaksi.store') }}">
      @csrf
      <div class="field">
        <label>Plat nomor</label>
        <input type="text" name="plat_nomor" style="text-transform:uppercase;" value="{{ old('plat_nomor') }}" required placeholder="cth. B 1234 ABC">
        @error('plat_nomor') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Jenis / tarif kendaraan</label>
        <select name="id_tarif" required>
          @foreach($tarifs as $tarif)
            <option value="{{ $tarif->id_tarif }}">{{ $tarif->jenis_kendaraan }} — Rp{{ number_format($tarif->tarif_per_jam,0,',','.') }}/jam</option>
          @endforeach
        </select>
      </div>
      <div class="field">
        <label>Area parkir</label>
        @if($areas->isEmpty())
          <select disabled><option>Semua area penuh</option></select>
        @else
          <select name="id_area" required>
            @foreach($areas as $area)
              <option value="{{ $area->id_area }}">{{ $area->nama_area }} (sisa {{ $area->sisa() }})</option>
            @endforeach
          </select>
        @endif
      </div>
      <div class="field">
        <label>Warna (opsional)</label>
        <input type="text" name="warna" value="{{ old('warna') }}" placeholder="cth. Hitam">
      </div>
      <div class="field">
        <label>Nama pemilik (opsional)</label>
        <input type="text" name="pemilik" value="{{ old('pemilik') }}" placeholder="cth. Andi">
      </div>
      <div class="form-actions">
        <a href="{{ route('transaksi.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber" {{ $areas->isEmpty() ? 'disabled' : '' }}>Catat masuk</button>
      </div>
    </form>
  </div>
@endsection
