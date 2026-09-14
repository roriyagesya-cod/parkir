<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $data['username'])
            ->where('status_aktif', 1)
            ->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username atau kata sandi salah, atau akun tidak aktif.']);
        }

        $request->session()->regenerate();
        $request->session()->put('user_id', $user->id_user);
        $request->session()->put('user_role', $user->role);
        $request->session()->put('user_name', $user->nama_lengkap);

        LogAktivitas::catat($user->id_user, 'Login ke sistem');

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        LogAktivitas::catat($request->session()->get('user_id'), 'Logout dari sistem');

        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login');
    }
}
