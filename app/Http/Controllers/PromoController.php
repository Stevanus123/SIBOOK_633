<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\Diskon;
use App\Models\Order;
use App\Models\OrderItems;

class PromoController extends Controller
{
    public function promo()
    {
        $books = Book::get()->map(function($book){
            $order = Order::where('user_id', '=', Auth::id())->first();
            if ($order) {
                $book->dibeli = OrderItems::where('order_id', '=', $order->order_id)->where('buku_id', '=', $book->buku_id)->exists();
            } else {
                $book->dibeli = false;
            }
            return $book;
        });
        $diskon = Diskon::get();
        return view('user.promo.index', ['active' => 'promo', 'books' => $books, 'diskon' => $diskon]);
    }
    public function detail_promo($id)
    {
        $books = Book::where('diskon_id', '=', $id)->get();
        $diskon = Diskon::where('diskon_id', '=', $id)->first();
        return view('user.promo.detail', ['books' => $books, 'diskon' => $diskon, 'active' => 'promo']);
    }
}
