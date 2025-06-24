<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\Diskon;
use App\Models\ItemKeranjang;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use App\Models\SaldoHistories;


class CartController extends Controller
{
    public function cart()
    {
        $cart = Keranjang::where('user_id', Auth::id())->with('diskon')->first();
        if ($cart) {
            $cartItems = ItemKeranjang::where('cart_id', $cart->cart_id)->with('buku')->get();
        } else {
            $cartItems = collect();
        }
        return view('user.cart', ['active' => 'cart', 'cartItems' => $cartItems, 'cart' => $cart]);
    }
    public function cart_p_m($act, $id)
    {
        $cartItems = ItemKeranjang::where('cartItems_id', '=', $id)->first();
        if (!$cartItems)
            return redirect('/errors/404');

        if ($act === 'plus')
            $cartItems->jumlah += 1;
        else if ($act === 'minus')
            $cartItems->jumlah -= 1;
        else
            return redirect('/errors/404');

        if ($cartItems->jumlah <= 0) {
            $cartItems->delete();
        } else
            $cartItems->save();

        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        $cartItems = ItemKeranjang::where('cart_id', '=', $cart->cart_id)->count();
        if ($cartItems == 0)
            $cart->delete();

        return redirect('/cart');
    }
    public function insert_cart($id)
    {
        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        $book = Book::where('buku_id', '=', $id)->with('diskon')->first();
        if (!$cart) {
            $cart = new Keranjang();
            $cart->user_id = Auth::id();
            $cart->diskon_id = $book->diskon_id;
            $cart->save();
        }

        $cart = Keranjang::where('user_id', '=', Auth::id())->first();

        // Check if the item already exists in the cart
        $cartItems = ItemKeranjang::where('cart_id', $cart->cart_id)
            ->where('buku_id', $id)
            ->first();

        if ($cartItems) {
            $cartItems->jumlah += 1;
        } else {
            $cartItems = new ItemKeranjang();
            $cartItems->cart_id = $cart->cart_id;
            $cartItems->buku_id = $id;
            $cartItems->jumlah = 1;
            $cartItems->harga = $book->harga;
        }
        $cartItems->save();

        return redirect('/cart')->with('success', 'Buku berhasil dimasukkan ke keranjang!');
    }
    public function checkout(Request $request)
    {
        $ids = $request->input('beli', []);

        if (empty($ids)) {
            return redirect('/cart')->with('error', 'Pilih minimal satu item untuk checkout.');
        }

        $items = ItemKeranjang::whereIn('cartItems_id', $ids)->with('buku')->get();

        return view('user.checkout', ['items' => $items, 'active' => 'cart', 'total' => $request->total, 'ids' => $ids]);
    }
    public function order(Request $request)
    {
        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_harga = $request->total;
        $order->diskon_id = $cart->diskon_id;
        $order->status = 'lunas';
        $order->save();

        $ids = $request->input('ids', []);
        $order = Order::where('user_id', '=', Auth::id())->latest()->first();
        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        $cartItems = ItemKeranjang::where('cart_id', '=', $cart ? $cart->cart_id : null)
            ->whereIn('cartItems_id', $ids)
            ->get();

        foreach ($cartItems as $ci) {
            $orderItems = new OrderItems();
            $orderItems->order_id = $order->order_id;
            $orderItems->buku_id = $ci->buku_id;
            $orderItems->jumlah = $ci->jumlah;
            $orderItems->harga_now = $ci->harga;
            $orderItems->save();
        }

        // Delete only the purchased cart items
        ItemKeranjang::whereIn('cartItems_id', $request->ids)->delete();

        // If cart is empty after purchase, delete the cart
        if ($cart && ItemKeranjang::where('cart_id', $cart->cart_id)->count() == 0) {
            $cart->delete();
        }

        $user = User::find(Auth::id());
        $user->saldo -= $order->total_harga;
        $user->save();

        $saldoHistories = new SaldoHistories();
        $saldoHistories->user_id = Auth::id();
        $saldoHistories->tipe = 'beli';
        $saldoHistories->jumlah = $order->total_harga;
        $saldoHistories->keterangan = 'Beli buku';
        $saldoHistories->save();

        $books = Book::whereIn('buku_id', $cartItems->pluck('buku_id'))->get();
        foreach ($books as $book) {
            $penjual = User::where('nama', '=', $book->penulis)->first();
            if ($penjual) {
                $harga = $book->harga;
                $potongan = $harga * 0.10;
                $pendapatan = $harga - $potongan;

                $penjual->saldo += $pendapatan;
                $penjual->save();

                $saldoHistories = new SaldoHistories();
                $saldoHistories->user_id = $penjual->id;
                $saldoHistories->tipe = 'reward';
                $saldoHistories->jumlah = $pendapatan;
                $saldoHistories->keterangan = 'Selamat! Buku kamu dibeli user lain.';
                $saldoHistories->save();
            }
        }

        return redirect('/profile')->with('success', 'Buku berhasil dibeli!');
    }
}
