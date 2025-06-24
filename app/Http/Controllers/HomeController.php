<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItems;

class HomeController extends Controller
{
    public function home()
    {
        $books = Book::get()->map(function ($book) {
            $order = Order::where('user_id', '=', Auth::id())->first();
            if ($order) {
                $book->dibeli = OrderItems::where('order_id', '=', $order->order_id)->where('buku_id', '=', $book->buku_id)->exists();
            } else {
                $book->dibeli = false;
            }
            return $book;
        });
        $bestSellers = Book::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(10)
            ->get()
            ->map(function ($book) {
            $order = Order::where('user_id', '=', Auth::id())->first();
            $book->dibeli = false;
            if ($order) {
                $book->dibeli = OrderItems::where('order_id', '=', $order->order_id)
                ->where('buku_id', $book->buku_id)
                ->exists();
            }
            return $book;
            });
        return view('user.home', ['active' => 'home', 'books' => $books, 'bestSellers' => $bestSellers]);
    }
}
