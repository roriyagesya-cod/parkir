@extends('layouts.app')
@section('title', 'Tambah Pengguna — Portal Parkir')

@section('content')
  <div class="page-head">
    <div><h1>Tambah pengguna</h1><div class="desc">Buat akun baru untuk admin, petugas, atau owner.</div></div>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('users.store') }}">
      @csrf
      <div class="field">
        <label>Nama lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
        @error('nama_lengkap') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" required>
        @error('username') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Kata sandi</label>
        <input type="text" name="password" required>
        @error('password') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Peran</label>
        <select name="role">
          <option value="admin">Admin</option>
          <option value="petugas">Petugas</option>
          <option value="owner">Owner</option>
        </select>
      </div>
      <div class="field">
        <label>Status</label>
        <select name="status_aktif">
          <option value="1">Aktif</option>
          <option value="0">Nonaktif</option>
        </select>
      </div>
      <div class="form-actions">
        <a href="{{ route('users.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan</button>
      </div>
    </form>
  </div>
@endsection
