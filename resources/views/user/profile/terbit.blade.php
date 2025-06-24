@extends('layouts.main')
@section('title', 'Admin SIBOOK | Detail Penerbitan')
@section('content')
    <link href="{{ asset('dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Buku Yang Diterbitkan</li>
        </ol>
    </nav>
    <!-- Content Card -->
    <div class="card shadow-sm my-3">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">Informasi Buku</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Judul:</strong> {{ $book->judul }}</p>
                    <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
                    <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
                    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    <p><strong>Jumlah Halaman:</strong> {{ $book->jumlah_halaman }}</p>
                    <p><strong>Harga:</strong> {{ $book->harga }}</p>
                    <p><strong>Stok:</strong> {{ $book->stok }}</p>
                    <p><strong>Kategori:</strong> {{ $book->kategori->nama_kategori }}</p>
                    <p><strong>Diskon:</strong> {{ $book->diskon->nama_diskon }}</p>
                    <p><strong>Deskripsi:</strong> {{ $book->deskripsi }}</p>
                    <p><strong>Gambar:</strong> {{ $book->gambar }}</p>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">File Buku</h5>
            <div class="d-flex justify-content-center">
                <div class="_df_book" source="{{ asset($book->file_buku) }}" style="max-width: 100%; height: 600px;"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dflip/js/libs/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dflip/js/dflip.min.js') }}" type="text/javascript"></script>
@endsection
