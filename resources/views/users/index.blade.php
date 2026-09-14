@extends('layouts.app')
@section('title', 'Pengguna — Portal Parkir')

@section('content')
  <div class="page-head">
    <div><h1>Pengguna</h1><div class="desc">Kelola akun admin, petugas, dan owner.</div></div>
    <a href="{{ route('users.create') }}" class="btn btn-amber">+ Tambah pengguna</a>
  </div>

  <div class="table-wrap"><table>
    <thead><tr><th>Nama</th><th>Username</th><th>Peran</th><th>Status</th><th></th></tr></thead>
    <tbody>
      @forelse($users as $user)
        <tr>
          <td>{{ $user->nama_lengkap }}</td>
          <td class="mono">{{ $user->username }}</td>
          <td>{{ ucfirst($user->role) }}</td>
          <td><span class="badge {{ $user->status_aktif ? 'badge-active' : 'badge-inactive' }}">{{ $user->status_aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
          <td>
            <div class="row-actions">
              <a class="btn btn-ghost btn-sm" href="{{ route('users.edit', $user) }}">Ubah</a>
              <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?');">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr class="empty-row"><td colspan="5">Belum ada pengguna.</td></tr>
      @endforelse
    </tbody>
  </table></div>
@endsection
