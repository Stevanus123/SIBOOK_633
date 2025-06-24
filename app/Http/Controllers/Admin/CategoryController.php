<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function admin_kategori()
    {
        $cate = Category::get();
        return view('admin.kategori.index', ['cate' => $cate, 'active' => 'kategori']);
    }
    public function insert_kategori()
    {
        return view('admin.kategori.insert', ['active' => 'kategori']);
    }
    public function store_kategori(Request $request)
    {
        $cate = new Category();
        $cate->nama_kategori = $request->nama_kategori;
        $cate->deskripsi = $request->deskripsi;
        $cate->save();
        return redirect('/admin/kategori')->with('success', 'Data kategori berhasil ditambahkan!');
    }
    public function edit_kategori($id)
    {
        $cate = Category::where('kategori_id', '=', $id)->first();
        return view('admin.kategori.update', ['cate' => $cate, 'active' => 'kategori']);
    }
    public function update_kategori(Request $request, $id)
    {
        $cate = Category::where('kategori_id', '=', $id)->first();
        $cate->nama_kategori = $request->nama_kategori;
        $cate->deskripsi = $request->deskripsi;
        $cate->save();
        return redirect('/admin/kategori')->with('success', 'Data Kategori berhasil diupdate!');
    }
    public function delete_kategori($id)
    {
        $cate = Category::where('kategori_id', '=', $id)->first();
        if ($cate) {
            $cate->delete();
            return redirect('/admin/kategori')->with('success', 'Data Kategori berhasil dihapus!');
        } else {
            return redirect('/admin/kategori')->with('error', 'Data Kategori tidak ditemukan!');
        }
    }
}
