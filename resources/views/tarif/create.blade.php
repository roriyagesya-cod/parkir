@extends('layouts.app')
@section('title', 'Tambah Tarif — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Tambah tarif</h1><div class="desc">Tarif baru untuk jenis kendaraan tertentu.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('tarif.store') }}">
      @csrf
      <div class="field">
        <label>Jenis kendaraan</label>
        <input type="text" name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}" required>
        @error('jenis_kendaraan') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Tarif per jam (Rp)</label>
        <input type="number" min="0" name="tarif_per_jam" value="{{ old('tarif_per_jam') }}" required>
        @error('tarif_per_jam') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="form-actions">
        <a href="{{ route('tarif.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan</button>
      </div>
    </form>
  </div>
@endsection
