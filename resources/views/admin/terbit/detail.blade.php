@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Detail Penerbitan')
@section('judKonten', 'Detail Penerbitan')

@section('content')
<link href="{{ asset('dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">

<!-- Content Card -->
<div class="card shadow-sm my-4">
    <div class="card-body">
        <h5 class="card-title fw-bold mb-3">Informasi Buku</h5>
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Judul:</strong> {{ $terbit->judul }}</p>
                <p><strong>Harga:</strong> {{ $terbit->harga }}</p>
                <p><strong>Jumlah Halaman:</strong> {{ $terbit->jumlah_halaman }}</p>
                <p><strong>Penulis:</strong> {{ $terbit->user->nama }}</p>
                <p><strong>Sinopsis:</strong> {{ $terbit->sinopsis }}</p>
                <p><strong>Sampul:</strong> {{ $terbit->sampul ?? '-' }}</p>
                <p><strong>Catatan:</strong> {{ $terbit->catatan ?? '-' }}</p>
            </div>
        </div>

        <hr>

        <h5 class="fw-bold mb-3">Pratinjau Buku</h5>
        <div class="d-flex justify-content-center">
            <div class="_df_book" source="{{ asset($terbit->file_naskah) }}" style="max-width: 100%; height: 600px;"></div>
        </div>

        <hr>

        
    </div>
</div>

<script src="{{ asset('dflip/js/libs/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dflip/js/dflip.min.js') }}" type="text/javascript"></script>
@endsection
