@extends('layouts.app')
@section('title', 'Ubah Tarif — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Ubah tarif</h1><div class="desc">Perbarui tarif {{ $tarif->jenis_kendaraan }}.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('tarif.update', $tarif) }}">
      @csrf @method('PUT')
      <div class="field">
        <label>Jenis kendaraan</label>
        <input type="text" name="jenis_kendaraan" value="{{ old('jenis_kendaraan', $tarif->jenis_kendaraan) }}" required>
        @error('jenis_kendaraan') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Tarif per jam (Rp)</label>
        <input type="number" min="0" name="tarif_per_jam" value="{{ old('tarif_per_jam', $tarif->tarif_per_jam) }}" required>
        @error('tarif_per_jam') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="form-actions">
        <a href="{{ route('tarif.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan perubahan</button>
      </div>
    </form>
  </div>
@endsection
