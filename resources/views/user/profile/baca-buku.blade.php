@extends('layouts.main')
@section('title', 'SIBOOK | Baca Buku')
@section('content')
    <link href="{{ asset('dflip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Baca Buku</li>
        </ol>
    </nav>
    <div class="row my-3 card shadow-sm" style="border-radius: 10px">
        <h3 class="mt-3 card-header">Baca Buku: {{ $buku->judul }}</h3>
        <div class="card-body">
            <div class="container-fluid d-flex justify-content-center">
                <div class="d-flex justify-content-start row row-cols-5" style="width: 110%">
                    <div class="_df_book" id="flipbok_example" source="{{ asset($buku->file_buku) }}"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dflip/js/libs/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dflip/js/dflip.min.js') }}" type="text/javascript"></script>
@endsection
