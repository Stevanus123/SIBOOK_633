<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\TerbitBuku;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $tDapat = Order::sum('total_harga');
        $tJual = Order::count();
        $tTerbit = TerbitBuku::count();
        $tUser = User::count();
        $topBooks = OrderItems::join('books', 'order_items.buku_id', '=', 'books.buku_id')->select('judul', 'penulis', 'order_items.buku_id', DB::raw('sum(order_items.jumlah) as total'))->groupBy('order_items.buku_id', 'judul', 'penulis')->orderByDesc('total')->limit(5)->get();

        $data = Order::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $bulanLengkap = [];
        for ($i = 1; $i <= 12; $i++) {
            $namaBulan = Carbon::create()->month($i)->translatedFormat('F'); // Nama bulan lokal
            $bulanLengkap[] = [
                'bulan' => $namaBulan,
                'total' => $data[$i] ?? 0,
            ];
        }

        return view('admin.dashboard.index', [
            'active' => 'dashboard',
            'tDapat' => $tDapat,
            'tJual' => $tJual,
            'tTerbit' => $tTerbit,
            'tUser' => $tUser,
            'topBooks' => $topBooks,
            'jualBulanan' => collect($bulanLengkap),
        ]);
    }
}
