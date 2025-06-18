@extends('layouts.main')

@section('title', 'SIBOOK | Checkout')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>
    <div class="container py-4">
        <h2 class="mb-4">🧾 Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow p-4 mb-4">
                    <h5 class="mb-3">📚 Ringkasan Pesanan</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->buku->judul }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>Rp. {{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <hr>
                    <h5 class="text-end">Total: <strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></h5>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow p-4">
                    <h5 class="mb-3">👤 Info Pembeli</h5>
                    <p><strong>Nama:</strong> {{ auth()->user()->nama }}</p>
                    <p><strong>Saldo Saat Ini:</strong> Rp. {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</p>

                    @if ($total > auth()->user()->saldo)
                        <div class="alert alert-danger mt-3">
                            💸 Saldo tidak cukup untuk melakukan pembelian.
                        </div>
                        <a href="/profile/saldo" class="btn btn-warning w-100 mt-2">➕ Top Up Saldo</a>
                    @else
                        <form action="/order" method="POST">
                            @csrf
                            <input type="hidden" name="total" value="{{ $total }}">
                            @foreach ($ids as $id)
                                <input type="hidden" name="ids[]" value="{{ $id }}">
                            @endforeach
                            <button type="submit" class="btn btn-success w-100 mt-4">💳 Bayar Sekarang</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection