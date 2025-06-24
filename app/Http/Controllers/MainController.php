<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItems;

class MainController extends Controller
{
    public function detail_buku($asal, $slug)
    {
        // Ubah slug menjadi judul buku biasa
        $judul = str_replace('-', ' ', $slug);
        $rute = str_replace('-', '/', $asal);
        $book = Book::whereRaw('LOWER(judul) = ?', [strtolower($judul)])->with('kategori')->first();
        if ($book) {
            $order = Order::where('user_id', '=', Auth::id())->first();
            if ($order) {
            $book->dibeli = OrderItems::where('order_id', '=', $order->order_id)->where('buku_id', '=', $book->buku_id)->exists();
            } else {
            $book->dibeli = false;
            }
        }
        return view('user.detail-buku', ['active' => $rute, 'book' => $book]);
    }
    public function search(Request $request, $asal)
    {
        $query = $request->input('judul');
        $books = Book::where('judul', 'LIKE', '%' . $query . '%')->get()->map(function($book){
            $order = Order::where('user_id', '=', Auth::id())->first();
            if ($order) {
                $book->dibeli = OrderItems::where('order_id', '=', $order->order_id)->where('buku_id', '=', $book->buku_id)->exists();
            } else {
                $book->dibeli = false;
            }
            return $book;
        });
        return view('user.pencarian', ['active' => $asal, 'books' => $books, 'query' => $query]);
    }
}
