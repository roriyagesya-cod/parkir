@extends('layouts.app')
@section('title', 'Ubah Pengguna — Portal Parkir')

@section('content')
  <div class="page-head">
    <div><h1>Ubah pengguna</h1><div class="desc">Perbarui data akun {{ $user->username }}.</div></div>
  </div>

  <div class="form-card">
    <form method="POST" action="{{ route('users.update', $user) }}">
      @csrf @method('PUT')
      <div class="field">
        <label>Nama lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
        @error('nama_lengkap') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
        @error('username') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Kata sandi baru (kosongkan jika tidak diubah)</label>
        <input type="text" name="password">
        @error('password') <div class="error-box">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>Peran</label>
        <select name="role">
          <option value="admin" {{ $user->role==='admin'?'selected':'' }}>Admin</option>
          <option value="petugas" {{ $user->role==='petugas'?'selected':'' }}>Petugas</option>
          <option value="owner" {{ $user->role==='owner'?'selected':'' }}>Owner</option>
        </select>
      </div>
      <div class="field">
        <label>Status</label>
        <select name="status_aktif">
          <option value="1" {{ $user->status_aktif?'selected':'' }}>Aktif</option>
          <option value="0" {{ !$user->status_aktif?'selected':'' }}>Nonaktif</option>
        </select>
      </div>
      <div class="form-actions">
        <a href="{{ route('users.index') }}" class="btn btn-ghost">Batal</a>
        <button type="submit" class="btn btn-amber">Simpan perubahan</button>
      </div>
    </form>
  </div>
@endsection
