@extends('layouts.main')
@section('title', 'SIBOOK | Detail Buku')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Buku</li>
        </ol>
    </nav>
    <div class="row my-3 card shadow-sm p-4" style="border-radius: 10px">
        <div class="container my-2">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset($books->gambar) }}" class="rounded shadow-sm" alt="{{ $books->judul }}" width="250rem">
                </div>

                <div class="col-md-8 border-start border-2 ps-4">
                    <h2 class="mb-3">{{ $books->judul }}</h2>
                    <p><strong>Penulis:</strong> {{ $books->penulis }}</p>
                    <p><strong>Penerbit:</strong> {{ $books->penerbit }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $books->tahun_terbit }}</p>
                    <p><strong>Kategori:</strong> {{ $books->kategori->nama_kategori }}</p>
                    <p><strong>Jumlah Halaman:</strong> {{ $books->jumlah_halaman }}</p>
                    <p><strong>Harga:</strong> Rp{{ number_format($books->harga, 0, ',', '.') }}</p>

                    <hr>
                    <h5>Deskripsi Buku</h5>
                    <p>{{ $books->deskripsi }}</p>
                    <a href="/cart/insert/{{ $books->buku_id }}" class="btn btn-primary mt-3">
                       <i class="bi bi-cart-plus"></i> Tambah ke Keranjang </a>
                </div>
            </div>
        </div>
    </div>
@endsection
