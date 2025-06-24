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
                    <img src="{{ asset($book->gambar) }}" class="rounded shadow-sm" alt="{{ $book->judul }}"
                        width="250rem">
                </div>

                <div class="col-md-8 border-start border-2 ps-4">
                    <h2 class="mb-3">{{ $book->judul }}</h2>
                    <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
                    <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
                    <p><strong>Kategori:</strong> {{ $book->kategori->nama_kategori }}</p>
                    <p><strong>Jumlah Halaman:</strong> {{ $book->jumlah_halaman }}</p>
                    <p><strong>Harga:</strong> Rp{{ number_format($book->harga, 0, ',', '.') }}</p>

                    <hr>
                    <h5>Deskripsi Buku</h5>
                    <p>{{ $book->deskripsi }}</p>
                    @if ($book->dibeli)
                        <a href="/profile/baca/{{ Str::slug($book->judul) }}" class="btn btn-sm btn-primary px-3">Baca
                            Buku</a>
                    @elseif($book->penulis == auth()->user()->nama)
                    @else
                        <a href="/cart/insert/{{ $book->buku_id }}" class="btn btn-primary mt-3">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
