<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
     public function admin_user()
    {
        $user = User::get();
        return view('admin.user.index', ['user' => $user, 'active' => 'pengguna']);
    }
    public function insert_user()
    {

        return view('admin.user.insert', ['active' => 'pengguna']);
    }
    public function store_user(Request $request)
    {
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->kota = $request->kota;
        $user->username = $request->username;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        return redirect('/admin/user')->with('success', 'User berhasil ditambahkan!');
    }
    public function edit_user($id){
        $user = User::where('id', '=', $id)->first();
        $user->password = bcrypt('sibook2025');
        $user->save();

        return redirect('/admin/user')->with('success', 'Password berhasil direset!');
    }
    public function delete_user($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/admin/user')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect('/admin/user')->with('error', 'User tidak ditemukan!');
        }
    }
}
