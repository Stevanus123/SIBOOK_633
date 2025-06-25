<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Book;
use App\Models\User;
use App\Models\ReqTopUp;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\SaldoHistories;
use App\Models\TerbitBuku;

class ProfileController extends Controller
{
    public function profile()
    {
        // Contoh mengambil data dari tabel 'users'
        $user = Auth::user();
        $orders = Order::where('user_id', '=', Auth::id())->get();
        $saldoHistories = SaldoHistories::where('user_id', '=', Auth::id())->get();

        // Ambil semua order_id milik user
        $orderIds = $orders->pluck('order_id')->toArray();
        // Ambil semua order items berdasarkan order_id
        $orderItems = OrderItems::whereIn('order_id', $orderIds)->get();
        // Ambil semua buku_id dari order items
        $bookIds = $orderItems->pluck('buku_id')->toArray();
        // Ambil semua buku berdasarkan buku_id
        $books = Book::whereIn('buku_id', $bookIds)->get();

        $terbit = TerbitBuku::where('user_id', '=', Auth::id())->get();
        // Ambil semua judul dari koleksi $terbit
        $judulTerbit = $terbit->pluck('judul')->toArray();
        // Ambil semua buku yang judulnya ada di $judulTerbit
        $book_terbit = Book::whereIn('judul', $judulTerbit)->get();

        return view('user.profile.index', [
            'user' => $user,
            'active' => 'profile',
            'orders' => $orders,
            'saldoHistories' => $saldoHistories,
            'books' => $books,
            'terbit' => $terbit,
            'book_terbit' => $book_terbit,
        ]);
    }
    public function baca_profile($judul)
    {
        $book = Book::where('judul', '=', $judul)->first();
        $order = Order::where('user_id', '=', Auth::id())->first();
        $pembelian = OrderItems::where('order_id', '=', $order->order_id)
            ->where('buku_id', $book->buku_id)
            ->exists();
        if (!$pembelian) {
            abort(403, 'Kamu belum membeli buku ini.');
        }

        return view('user.profile.baca-buku', ['buku' => $book, 'active' => 'profile']);
    }
    public function edit_profile(Request $request)
    {
        $user = User::where('id', '=', Auth::id())->first();
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('profil'), $filename);
            $user->foto = 'profil/' . $filename;
        }
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->desa = ucfirst($request->desa);
        $user->kecamatan = ucfirst($request->kecamatan);
        $user->kota = ucfirst($request->kota);
        $user->save();

        return redirect('/profile')->with('success', 'Profil berhasil diupdate!');
    }
    public function gantiPass_profile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->password = bcrypt($request->new_pw);
        $user->save();

        return redirect('/profile')->with('success', 'Password berhasil diganti!');
    }
    public function checkPassword(Request $request)
    {
        $valid = Hash::check($request->password, Auth::user()->password);
        return response()->json(['valid' => $valid, 'active' => 'profile']);
    }
    public function topup_profile(Request $request)
    {
        $reqTopup = new ReqTopUp();
        $reqTopup->user_id = Auth::id();
        $reqTopup->jumlah = $request->jumlah;
        $reqTopup->alasan = $request->alasan;
        $reqTopup->save();

        return redirect('/profile')->with('success', 'Permintaan saldo berhasil diajukan!');
    }
    public function terbit_profile($id)
    {
        $book = Book::where('buku_id', '=', $id)->first();

        return view('user.profile.terbit', ['book' => $book, 'active' => 'profile']);
    }
}
