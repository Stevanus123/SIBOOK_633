<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SaldoHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Order;
use App\Models\TerbitBuku;
use App\Models\User;
use Illuminate\Support\Facades\File;

class TerbitController extends Controller
{
    public function penerbitan()
    {
        return view('user.terbit.index', ['active' => 'penerbitan']);
    }
    public function insert_terbit()
    {
        $cate = Category::get();
        return view('user.terbit.insert', ['active' => 'penerbitan', 'cate' => $cate]);
    }

    public function store_terbit(Request $request)
    {
        if ($request->hasFile('sampul')) {
            $filename = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->move(public_path('cover'), $filename);
            $cover = 'cover/' . $filename;
        } else $cover = 'cover/no-image.png';

        // file proses 
        $filename = time() . '_' . $request->file('naskah')->getClientOriginalName();
        $request->file('naskah')->move(public_path('nasTerbit'), $filename);
        $naskah = 'nasTerbit/' . $filename;

        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();

        $terbit = new TerbitBuku();
        $terbit->user_id = Auth::id();
        $terbit->kategori_id = $cate->kategori_id;
        $terbit->judul = $request->judul;
        $terbit->jumlah_halaman = $request->jumlah_halaman;
        $terbit->harga = $request->harga;
        $terbit->sampul = $cover;
        $terbit->file_naskah = $naskah;
        $terbit->sinopsis = $request->sinopsis;
        $terbit->catatan = $request->catatan ?? '';
        $terbit->save();

        $user = User::where('id', '=', Auth::id())->first();
        $user->saldo += 20000;
        $user->save();

        $saldoHistories = new SaldoHistories();
        $saldoHistories->user_id = Auth::id();
        $saldoHistories->tipe = 'reward';
        $saldoHistories->jumlah = 20000;
        $saldoHistories->keterangan = 'Mengajukan buku baru';
        $saldoHistories->save();

        return redirect('/penerbitan')->with('success', 'Buku berhasil diajukan! Silakan tunggu konfirmasi selanjutnya!');
    }
    public function edit_terbit($id)
    {
        $terbit = TerbitBuku::where('id', '=', $id)->first();
        $cate = Category::get();

        return view('user.terbit.update', ['active' => 'profile', 'terbit' => $terbit, 'cate' => $cate]);
    }
    public function update_terbit(Request $request, $id)
    {
        $terbit = TerbitBuku::where('id', '=', $id)->first();
        if ($request->hasFile('sampul')) {
            if ($terbit->sampul && File::exists(public_path($terbit->sampul))) {
                File::delete(public_path($terbit->sampul));
            }
            $filename = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->move(public_path('cover'), $filename);
            $cover = 'cover/' . $filename;
        } else $cover = $terbit->sampul;

        // file proses 
        if ($request->hasFile('naskah')) {
            if ($terbit->file_naskah && File::exists(public_path($terbit->file_naskah))) {
                File::delete(public_path($terbit->file_naskah));
            }
            $filename = time() . '_' . $request->file('naskah')->getClientOriginalName();
            $request->file('naskah')->move(public_path('nasTerbit'), $filename);
            $naskah = 'nasTerbit/' . $filename;
        } else $naskah = $terbit->file_naskah;

        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();

        $terbit->kategori_id = $cate->kategori_id;
        $terbit->judul = $request->judul;
        $terbit->harga = $request->harga;
        $terbit->jumlah_halaman = $request->jumlah_halaman;
        $terbit->sampul = $cover;
        $terbit->file_naskah = $naskah;
        $terbit->sinopsis = $request->sinopsis;
        $terbit->catatan = $request->catatan ?? '';
        $terbit->save();

        return redirect('/profile')->with('success', 'Data penerbitan berhasil diupdate!');
    }
    public function delete_terbit($id)
    {
        $terbit = TerbitBuku::where('id', '=', $id)->first();
        if ($terbit) {
            if ($terbit->sampul && File::exists(public_path($terbit->sampul)))
                File::delete(public_path($terbit->sampul));
            if ($terbit->file_naskah && File::exists(public_path($terbit->file_naskah)))
                File::delete(public_path($terbit->file_naskah));
            $user = User::where('id', '=', Auth::id())->first();
            $user->saldo -= 20000;
            $user->save();

            $saldoHistories = new SaldoHistories();
            $saldoHistories->user_id = Auth::id();
            $saldoHistories->tipe = 'gagal';
            $saldoHistories->jumlah = 20000;
            $saldoHistories->keterangan = 'Pengajuan buku dihapus!';
            $saldoHistories->save();

            $terbit->delete();
            return redirect('/profile')->with('success', 'Penerbitan berhasil dihapus!');
        } else {
            return redirect('/profile')->with('error', 'Penerbitan yang kamu cari tidak ditemukan!');
        }
    }
}
