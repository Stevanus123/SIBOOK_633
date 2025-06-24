<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Diskon;

class DiskonController extends Controller
{
     public function admin_diskon()
    {
        $disk = Diskon::get();
        return view('admin.diskon.index', ['disk' => $disk, 'active' => 'diskon']);
    }
    public function insert_diskon()
    {

        return view('admin.diskon.insert', ['active' => 'diskon']);
    }
    public function store_diskon(Request $request)
    {
        $disk = new Diskon();
        $disk->kode = $request->kode;
        $disk->deskripsi = $request->deskripsi;
        $disk->persen = $request->persen;
        $disk->tglMulai = $request->tglMulai;
        $disk->tglSelesai = $request->tglSelesai;
        $disk->save();
        return redirect('/admin/diskon')->with('success', 'Diskon berhasil ditambahkan!');
    }
    public function edit_diskon($id)
    {
        $disk = Diskon::where('diskon_id', '=', $id)->first();
        return view('admin.diskon.update', ['disk' => $disk, 'active' => 'diskon']);
    }
    public function update_diskon(Request $request, $id)
    {
        $disk = Diskon::where('diskon_id', '=', $id)->first();
        $disk->kode = $request->kode;
        $disk->deskripsi = $request->deskripsi;
        $disk->persen = $request->persen;
        $disk->tglMulai = $request->tglMulai;
        $disk->tglSelesai = $request->tglSelesai;
        $disk->save();
        return redirect('/admin/diskon')->with('success', 'Diskon berhasil diupdate!');
    }
    public function delete_diskon($id)
    {
        $disk = Diskon::where('diskon_id', '=', $id)->first();
        if ($disk) {
            $disk->delete();
            return redirect('/admin/diskon')->with('success', 'Diskon berhasil dihapus!');
        } else {
            return redirect('/admin/diskon')->with('error', 'Diskon tidak ditemukan!');
        }
    }
}
