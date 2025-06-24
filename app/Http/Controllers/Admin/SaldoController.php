<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReqTopUp;
use App\Models\SaldoHistories;

class SaldoController extends Controller
{
    public function admin_saldo()
    {
        $reqTopup = ReqTopUp::orderBy('status', 'desc')->with('user')->get();
        return view('admin.saldo.index', ['reqTopup' => $reqTopup, 'active' => 'saldo']);
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
}
