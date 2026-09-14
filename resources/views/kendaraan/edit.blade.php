@extends('layouts.app')
@section('title', 'Ubah Kendaraan — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Ubah kendaraan</h1><div class="desc">Perbarui data {{ $kendaraan->plat_nomor }}.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('kendaraan.update', $kendaraan) }}">
      @csrf @method('PUT')
      <div class="field">
        <label>Plat nomor</label>
        <input type="text" name="plat_nomor" style="text-transform:uppercase;" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}" required>
        @error('plat_nomor') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Jenis kendaraan</label>
        <input type="text" name="jenis_kendaraan" value="{{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan) }}" required>
        @error('jenis_kendaraan') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Warna</label>
        <input type="text" name="warna" value="{{ old('warna', $kendaraan->warna) }}">
      </div>
      <div class="field">
        <label>Pemilik</label>
        <input type="text" name="pemilik" value="{{ old('pemilik', $kendaraan->pemilik) }}">
      </div>
      <div class="form-actions">
        <a href="{{ route('kendaraan.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan perubahan</button>
      </div>
    </form>
  </div>
@endsection
