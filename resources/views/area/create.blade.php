@extends('layouts.app')
@section('title', 'Tambah Area — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Tambah area</h1><div class="desc">Area parkir baru beserta kapasitasnya.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('area.store') }}">
      @csrf
      <div class="field">
        <label>Nama area</label>
        <input type="text" name="nama_area" value="{{ old('nama_area') }}" required>
        @error('nama_area') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Kapasitas</label>
        <input type="number" min="0" name="kapasitas" value="{{ old('kapasitas') }}" required>
        @error('kapasitas') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="form-actions">
        <a href="{{ route('area.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan</button>
      </div>
    </form>
  </div>
@endsection
