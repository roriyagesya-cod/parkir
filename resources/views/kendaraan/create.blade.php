@extends('layouts.app')
@section('title', 'Tambah Kendaraan — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Tambah kendaraan</h1><div class="desc">Tambahkan data master kendaraan baru.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('kendaraan.store') }}">
      @csrf
      <div class="field">
        <label>Plat nomor</label>
        <input type="text" name="plat_nomor" style="text-transform:uppercase;" value="{{ old('plat_nomor') }}" required>
        @error('plat_nomor') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Jenis kendaraan</label>
        <input type="text" name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}" required>
        @error('jenis_kendaraan') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Warna</label>
        <input type="text" name="warna" value="{{ old('warna') }}">
      </div>
      <div class="field">
        <label>Pemilik</label>
        <input type="text" name="pemilik" value="{{ old('pemilik') }}">
      </div>
      <div class="form-actions">
        <a href="{{ route('kendaraan.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan</button>
      </div>
    </form>
  </div>
@endsection
