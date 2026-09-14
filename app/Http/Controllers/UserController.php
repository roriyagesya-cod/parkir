<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('nama_lengkap')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:tb_user,username',
            'password' => 'required|string|max:100',
            'role' => 'required|in:admin,petugas,owner',
            'status_aktif' => 'required|boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        LogAktivitas::catat(session('user_id'), "Menambahkan pengguna \"{$user->username}\"");

        return redirect()->route('users.index')->with('status', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:tb_user,username,'.$user->id_user.',id_user',
            'password' => 'nullable|string|max:100',
            'role' => 'required|in:admin,petugas,owner',
            'status_aktif' => 'required|boolean',
        ]);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        LogAktivitas::catat(session('user_id'), "Mengubah data pengguna \"{$user->username}\"");

        return redirect()->route('users.index')->with('status', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id_user === session('user_id')) {
            return back()->with('error', 'Tidak dapat menghapus akun yang sedang digunakan.');
        }

        $username = $user->username;
        $user->delete();

        LogAktivitas::catat(session('user_id'), "Menghapus pengguna \"{$username}\"");

        return redirect()->route('users.index')->with('status', 'Pengguna berhasil dihapus.');
    }
}
