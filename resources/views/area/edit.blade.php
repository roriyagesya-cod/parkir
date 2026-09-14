@extends('layouts.app')
@section('title', 'Ubah Area — Portal Parkir')

@section('content')
  <div class="page-head"><div><h1>Ubah area</h1><div class="desc">Perbarui data {{ $area->nama_area }}.</div></div></div>

  <div class="form-card">
    <form method="POST" action="{{ route('area.update', $area) }}">
      @csrf @method('PUT')
      <div class="field">
        <label>Nama area</label>
        <input type="text" name="nama_area" value="{{ old('nama_area', $area->nama_area) }}" required>
        @error('nama_area') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Kapasitas</label>
        <input type="number" min="0" name="kapasitas" value="{{ old('kapasitas', $area->kapasitas) }}" required>
        @error('kapasitas') <div class="error-box">{{ $message }}</div> @enderror
        <div class="hint" style="color:var(--muted);font-size:12px;margin-top:6px;">Terisi saat ini: {{ $area->terisi }}</div>
      </div>
      <div class="form-actions">
        <a href="{{ route('area.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan perubahan</button>
      </div>
    </form>
  </div>
@endsection
