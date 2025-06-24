<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function ceklogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->username === 'deden') {
                return redirect('/admin/buku')->with('success', 'Selamat datang, Admin!');
            } else {
                return redirect('/home')->with('alert', 'Selamat datang, ' . $user->nama . '!');
            }
        }

        return redirect('/')->with('alert', 'Username atau Password salah!');
    }
    function regis()
    {
        return view('auth.regis');
    }
    function prosesRegis(Request $request)
    {
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->kota = $request->kota;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/login')->with('alert', 'Registrasi berhasil! Silakan login.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('alert', 'Anda telah logout!');
    }
}
