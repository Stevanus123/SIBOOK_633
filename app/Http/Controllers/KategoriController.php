<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItems;

class KategoriController extends Controller
{
    public function kategori($jenis)
    {
        $cate = Category::where('nama_kategori', '=', $jenis)->first();
        $books = Book::where('kategori_id', '=', $cate->kategori_id)->get()->map(function($book){
            $order = Order::where('user_id', '=', Auth::id())->first();
            if ($order) {
                $book->dibeli = OrderItems::where('order_id', '=', $order->order_id)->where('buku_id', '=', $book->buku_id)->exists();
            } else {
                $book->dibeli = false;
            }
            return $book;
        });
        return view('user.kategori', ['active' => 'kategori', 'key' => $jenis, 'books' => $books, 'cate' => $cate]);
    }
}
