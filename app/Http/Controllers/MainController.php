<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemKeranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Diskon;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ReqTopUp;
use App\Models\SaldoHistories;
use App\Models\TerbitBuku;
use LDAP\Result;

use function Laravel\Prompts\alert;

class MainController extends Controller
{
    public function not_found()
    {
        return response()->view('errors.404', ['active' => ''], 404);
    }
    public function login()
    {
        return view('auth.login');
    }
    public function ceklogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate(); // hindari session fixation attack
            $user = Auth::user(); // ambil user yang barusan login

            if ($user->username === 'deden') {
                return redirect('/admin/buku')->with('success', 'Selamat datang, Admin!');
            } else {
                return redirect('/home')->with('alert', 'Selamat datang, ' . $user->nama . '!');
            }
        }

        return redirect('/')->with('alert', 'Username atau Password salah!');
    }
    function regis()
    {
        return view('auth.regis');
    }
    function prosesRegis(Request $request)
    {
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->city = $request->city;
        $user->username = $request->username;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        return redirect('/')->with('alert', 'Registrasi berhasil! Silakan login.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('alert', 'Anda telah logout!');
    }


    public function home()
    {
        $books = Book::get();
        return view('user.home', ['active' => 'home', 'books' => $books]);
    }
    public function detail_buku($asal, $slug)
    {
        // Ubah slug menjadi judul buku biasa
        $judul = str_replace('-', ' ', $slug);
        $rute = str_replace('-', '/', $asal);
        $books = Book::whereRaw('LOWER(judul) = ?', [strtolower($judul)])->with('kategori')->first();
        return view('user.detail-buku', ['active' => $rute, 'books' => $books]);
    }
    public function promo()
    {
        $books = Book::get();
        $diskon = Diskon::get();
        return view('user.promo', ['active' => 'promo', 'books' => $books, 'diskon' => $diskon]);
    }
    public function penerbitan()
    {
        return view('user.terbit.index', ['active' => 'penerbitan']);
    }
    public function kategori($jenis)
    {
        $cate = Category::where('nama_kategori', '=', $jenis)->first();
        $books = Book::where('kategori_id', '=', $cate->kategori_id)->get();
        return view('user.kategori', ['active' => 'kategori', 'key' => $jenis, 'books' => $books]);
    }
    public function checkout(Request $request)
    {
        $ids = $request->input('beli', []);

        if (empty($ids)) {
            return redirect('/cart')->with('error', 'Pilih minimal satu item untuk checkout.');
        }

        $items = ItemKeranjang::whereIn('cartItems_id', $ids)->with('buku')->get();

        return view('user.checkout', ['items' => $items, 'active' => 'cart', 'total' => $request->total]);
    }
    public function order(Request $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_harga = $request->total;
        // $order->diskon_id = $request->diskon_id; -- Masih salah
        $order->status = 'lunas';
        $order->save();

        $order = Order::where('user_id', '=', Auth::id())->first();
        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        $cartItems = ItemKeranjang::where('cart_id', '=', $cart->cart_id)->get();
        $orderItems = new OrderItems();
        $orderItems->order_id = $order->order_id;

    }
    public function search(Request $request, $asal)
    {
        $query = $request->input('judul');
        $books = Book::where('judul', 'LIKE', '%' . $query . '%')->get();
        return view('user.pencarian', ['active' => $asal, 'books' => $books, 'query' => $query]);
    }
    public function insert_terbit()
    {
        $cate = Category::get();
        return view('user.terbit.insert', ['active' => 'penerbitan', 'cate' => $cate]);
    }
    public function cart_p_m($act, $id)
    {
        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
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
            $cart->delete();
        } else
            $cartItems->save();

        return redirect('/cart');
    }
    public function insert_cart($id)
    {
        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        if (!$cart) {
            $orderCount = Order::where('user_id', '=', Auth::id())->count();
            $cart = new Keranjang();
            $cart->user_id = Auth::id();
            if ($orderCount <= 2) {
                $diskon = Diskon::where('nama_diskon', '=', 'Pengguna Baru')->first();
                if ($diskon) {
                    $cart->diskon_id = $diskon->diskon_id;
                }
            }
            $cart->save();
        }

        $cart = Keranjang::where('user_id', '=', Auth::id())->first();
        $book = Book::where('buku_id', '=', $id)->with('diskon')->first();

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
    public function store_terbit(Request $request)
    {
        if ($request->hasFile('sampul')) {
            $filename = time() . '_' . $request->file('sampul')->getClientOriginalName();
            $request->file('sampul')->move(public_path('cover'), $filename);
            $cover = 'cover/' . $filename;
        } else $cover = 'cover/no-image.png';

        if ($request->hasFile('naskah')) {
            $filename = time() . '_' . $request->file('naskah')->getClientOriginalName();
            $request->file('naskah')->move(public_path('nasTerbit'), $filename);
            $naskah = 'nasTerbit/' . $filename;
        } else $naskah = 'nasTerbit/no-image.png';

        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();

        $terbit = new TerbitBuku();
        $terbit->user_id = Auth::id();
        $terbit->kategori_id = $cate->kategori_id;
        $terbit->judul = $request->judul;
        $terbit->sampul = $cover;
        $terbit->file_naskah = $naskah;
        $terbit->sinopsis = $request->sinopsis;
        $terbit->catatan = $request->catatan;
        $terbit->save();

        return view('user.terbit.index', ['active' => 'penerbitan']);
    }
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
    public function profile()
    {
        // Contoh mengambil data dari tabel 'users'
        $users = Auth::user();
        $orders = Order::where('user_id', '=', Auth::id())->get();
        $saldoHistories = SaldoHistories::where('user_id', '=', Auth::id())->get();
        return view('user.profile.index', ['users' => $users, 'active' => 'profile', 'orders' => $orders, 'saldoHistories' => $saldoHistories]);
    }
    public function topup_profile()
    {
        return view('user.profile.topup', ['active' => 'profile']);
    }
    public function req_topup(Request $request)
    {
        $reqTopup = new ReqTopUp();
        $reqTopup->user_id = Auth::id();
        $reqTopup->jumlah = $request->jumlah;
        $reqTopup->alasan = $request->alasan;
        $reqTopup->save();

        return redirect('/profile')->with('success', 'Permintaan saldo berhasil diajukan!');
    }



    public function admin_buku()
    {
        // Ambil data buku beserta nama kategori
        $books = Book::with('kategori')->orderBy('stok')->get();
        return view('admin.buku.index', ['books' => $books]);
    }
    public function admin_kategori()
    {
        $cate = Category::get();
        return view('admin.kategori.index', ['cate' => $cate]);
    }
    public function admin_diskon()
    {
        $disk = Diskon::get();
        return view('admin.diskon.index', ['disk' => $disk]);
    }
    public function admin_user()
    {
        $user = User::get();
        return view('admin.user.index', ['user' => $user]);
    }
    public function admin_terbit()
    {
        $terbit = TerbitBuku::with('user')->get();
        return view('admin.terbit.index', ['terbit' => $terbit]);
    }
    public function admin_saldo()
    {
        $reqTopup = ReqTopUp::orderBy('status', 'desc')->with('user')->get();
        return view('admin.saldo.index', ['reqTopup' => $reqTopup]);
    }
    public function act_saldo(Request $request, $act, $id)
    {
        $reqUp = ReqTopUp::where('id', '=', $id)->with('user')->first();
        if ($act === 'acc') {
            $reqUp->user->saldo += $request->jumlah;
            $reqUp->user->save();
            $reqUp->status = 'disetujui';
            $reqUp->pesan_admin = $request->pesan;
        } else if ($act === 'tolak') {
            $reqUp->status = 'ditolak';
            $reqUp->pesan_admin = $request->pesan;
        } else {
            return redirect('/errors/404');
        }

        $reqUp->save();


        $reqUp = ReqTopUp::where('id', '=', $id)->first();
        $saldoHistories = new SaldoHistories();
        $saldoHistories->user_id = $reqUp->user_id;
        $saldoHistories->tipe = 'topup';
        $saldoHistories->jumlah = $reqUp->jumlah;
        $saldoHistories->keterangan = $reqUp->pesan_admin;
        $saldoHistories->save();

        return redirect('/admin/saldo')->with('success', 'Permintaan sudah disetujui!');
    }

    public function detail_terbit($id) {}


    public function edit_buku($id)
    {
        $book = Book::where('buku_id', '=', $id)->first();
        return view('admin.buku.update', ['book' => $book]);
    }
    public function edit_kategori($id)
    {
        $cate = Category::where('kategori_id', '=', $id)->first();
        return view('update-kategori', ['cate' => $cate]);
    }
    public function edit_diskon($id)
    {
        $disk = Diskon::where('diskon_id', '=', $id)->first();
        return view('admin.diskon.update', ['disk' => $disk]);
    }

    public function update_buku(Request $request, $id)
    {
        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();

        $book = Book::where('buku_id', '=', $id)->first();
        //mengambil path dari gambar
        if ($request->hasFile('gambar')) {
            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('gambar'), $filename);
            $path = 'gambar/' . $filename;
        } else $path = $book->gambar;

        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->penerbit = $request->penerbit;
        $book->tahun_terbit = $request->tahun_terbit;
        $book->isbn = $request->isbn;
        $book->jumlah_halaman = $request->jumlah_halaman;
        $book->harga = $request->harga;
        $book->stok += $request->jumlah_buku;
        $book->kategori_id = $cate->kategori_id;
        $book->deskripsi = $request->deskripsi;
        $book->gambar = $path;
        $book->save();
        return redirect('/admin/buku')->with('success', 'Data berhasil diupdate!');
    }

    public function update_kategori(Request $request, $id)
    {
        $cate = Category::where('kategori_id', '=', $id)->first();
        $cate->nama_kategori = $request->nama_kategori;
        $cate->deskripsi = $request->deskripsi;
        $cate->save();
        return redirect('/admin/kategori')->with('success', 'Kategori berhasil diupdate!');
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

    public function delete_buku($id)
    {
        $book = Book::where('buku_id', '=', $id)->first();
        if ($book) {
            $book->delete();
            return redirect('/admin/buku')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/buku')->with('error', 'Data tidak ditemukan!');
        }
    }
    public function delete_kategori($id)
    {
        $cate = Category::where('kategori_id', '=', $id)->first();
        if ($cate) {
            $cate->delete();
            return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus!');
        } else {
            return redirect('/admin/kategori')->with('error', 'Kategori tidak ditemukan!');
        }
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
    public function delete_user($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/admin/user')->with('success', 'User berhasil dihapus!');
        } else {
            return redirect('/admin/user')->with('error', 'User tidak ditemukan!');
        }
    }


    public function insert_buku()
    {
        $cate = Category::get();
        return view('admin.buku.insert', ['cate' => $cate]);
    }
    public function insert_kategori()
    {
        return view('admin.kategori.insert');
    }
    public function insert_diskon()
    {

        return view('admin.diskon.insert');
    }
    public function insert_user()
    {

        return view('admin.user.insert');
    }
    public function store_buku(Request $request)
    {
        //menyambungkan kategori nama dengan kategori id
        $cate = Category::where('nama_kategori', '=', $request->kategori)->first();

        //mengambil path dari gambar
        if ($request->hasFile('gambar')) {
            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('gambar'), $filename);
            $path = 'gambar/' . $filename;
        } else $path = 'gambar/no-image.png';

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
        $book->deskripsi = $request->deskripsi;
        $book->gambar = $path;
        $book->save();

        return redirect('/admin/buku')->with('success', 'Data berhasil ditambahkan!');
    }

    public function store_kategori(Request $request)
    {
        $cate = new Category();
        $cate->nama_kategori = $request->nama_kategori;
        $cate->deskripsi = $request->deskripsi;
        $cate->save();
        return redirect('/admin/kategori')->with('success', 'Data berhasil ditambahkan!');
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

    public function store_user(Request $request)
    {
        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->city = $request->city;
        $user->username = $request->username;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        return redirect('/admin/user')->with('success', 'User berhasil ditambahkan!');
    }
}
