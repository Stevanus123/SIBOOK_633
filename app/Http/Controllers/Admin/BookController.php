<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;
use App\Models\Diskon;

class BookController extends Controller
{
    public function admin_buku()
    {
        // Ambil data buku beserta nama kategori
        $books = Book::with('kategori')->orderBy('stok')->get();
        return view('admin.buku.index', ['books' => $books, 'active' => 'buku']);
    }
    public function insert_buku()
    {
        $cate = Category::get();
        $diskon = Diskon::get();
        return view('admin.buku.insert', ['cate' => $cate, 'active' => 'buku', 'diskon' => $diskon]);
    }
    public function store_buku(Request $request)
    {
        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();
        $diskon = Diskon::where('nama_diskon', '=', $request->diskon)->first();

        if ($request->hasFile('cover')) {
            $filename = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('gambar'), $filename);
            $path = 'gambar/' . $filename;
        } else $path = 'gambar/no-image.png';

        $filename = time() . '_' . $request->file('file_buku')->getClientOriginalName();
        $request->file('file_buku')->move(public_path('buku'), $filename);
        $buku = 'buku/' . $filename;

        $book = new Book();
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->penerbit = $request->penerbit;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->isbn = $request->isbn;
        $book->jumlah_halaman = $request->jumlah_halaman;
        $book->harga = $request->harga;
        $book->stok = $book->stok + $request->jumlah_buku;
        $book->kategori_id = $cate->kategori_id;
        $book->diskon_id = $diskon->diskon_id;
        $book->deskripsi = $request->deskripsi;
        $book->file_buku = $buku;
        $book->gambar = $path;
        $book->save();

        return redirect('/admin/buku')->with('success', 'Data buku berhasil ditambahkan!');
    }
    public function edit_buku($id)
    {
        $book = Book::where('buku_id', '=', $id)->first();
        $cate = Category::get();
        $diskon = Diskon::get();
        return view('admin.buku.update', ['book' => $book, 'active' => 'buku', 'diskon' => $diskon, 'cate' => $cate]);
    }
    public function update_buku(Request $request, $id)
    {
        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();
        $diskon = Diskon::where('nama_diskon', '=', $request->diskon)->first();

        $book = Book::where('buku_id', '=', $id)->first();
        //mengambil path dari gambar
        if ($request->hasFile('gambar')) {
            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('gambar'), $filename);
            $path = 'gambar/' . $filename;
        } else $path = $book->gambar;

        if ($request->hasFile('file_buku')) {
            if ($book->file_buku && File::exists(public_path($book->file_buku))) {
                File::delete(public_path($book->file_buku));
            }
            $filename = time() . '_' . $request->file('file_buku')->getClientOriginalName();
            $request->file('file_buku')->move(public_path('buku'), $filename);
            $buku = 'buku/' . $filename;
        } else $buku = $book->file_buku;

        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->penerbit = $request->penerbit;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->isbn = $request->isbn;
        $book->jumlah_halaman = $request->jumlah_halaman;
        $book->harga = $request->harga;
        $book->stok += $request->jumlah_buku;
        $book->kategori_id = $cate->kategori_id;
        $book->diskon_id = $diskon->diskon_id;
        $book->deskripsi = $request->deskripsi;
        $book->file_buku = $buku;
        $book->gambar = $path;
        $book->save();
        return redirect('/admin/buku')->with('success', 'Data buku berhasil diupdate!');
    }
    public function delete_buku($id)
    {
        $book = Book::where('buku_id', '=', $id)->first();
        if ($book) {
            $book->delete();
            return redirect('/admin/buku')->with('success', 'Data buku berhasil dihapus!');
        } else {
            return redirect('/admin/buku')->with('error', 'Data buku tidak ditemukan!');
        }
    }
}
