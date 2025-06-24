<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

use App\Models\TerbitBuku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TerbitController extends Controller
{
    function generateIsbn()
    {
        // Prefix biasanya '978' atau '979'
        $prefix = '978';

        // Generate 9 digit angka acak setelah prefix (total 12 digit sebelum check digit)
        $random = str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);
        $isbnBase = $prefix . $random;

        // Hitung check digit (algoritma ISBN-13)
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $digit = (int) $isbnBase[$i];
            $sum += ($i % 2 === 0) ? $digit : $digit * 3;
        }
        $checkDigit = (10 - ($sum % 10)) % 10;

        return $isbnBase . $checkDigit;
    }
    public function admin_terbit()
    {
        $terbit = TerbitBuku::with('user')->get();
        return view('admin.terbit.index', ['terbit' => $terbit, 'active' => 'terbit']);
    }
    public function detail_terbit($id)
    {
        $terbit = TerbitBuku::where('id', '=', $id)->with('user')->first();

        return view('admin.terbit.detail', ['terbit' => $terbit, 'active' => 'terbit']);
    }
    public function setuju_terbit($id)
    {
        $terbit = TerbitBuku::where('id', '=', $id)->with('user')->first();
        $terbit->status = 'disetujui';
        $terbit->save();

        $book = new Book();
        $book->judul = $terbit->judul;
        $book->penulis = $terbit->user->nama;
        $book->penerbit = "SIBOOK";
        $book->tahun_terbit = date('Y');
        $book->isbn = $this->generateIsbn();
        $book->jumlah_halaman = $terbit->jumlah_halaman;
        $book->harga = $terbit->harga;
        $book->stok = 1;
        $book->kategori_id = $terbit->kategori_id;
        $book->diskon_id = 1;
        $book->deskripsi = $terbit->sinopsis;
        $book->gambar = $terbit->sampul;
        $book->file_buku = $terbit->file_naskah;
        $book->save();

        return redirect('/admin/terbit')->with('success', 'Terbitan buku sudah disetujui!');
    }

    public function tolak_terbit(Request $request, $id){
        $terbit = TerbitBuku::where('id', '=', $id)->with('user')->first();
        $terbit->status = 'ditolak';
        $terbit->catatan = $request->catatan;
        $terbit->save();

        return redirect('/admin/terbit')->with('error', 'Terbitan buku ditolak!');
    }
}
