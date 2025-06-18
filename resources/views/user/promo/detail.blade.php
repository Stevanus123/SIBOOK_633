@extends('layouts.main')
@section('title', 'SIBOOK | Detail Promo')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Promo</li>
        </ol>
    </nav>
    <div class="row my-3 card shadow-sm" style="border-radius: 10px">
        <div class="card-header">
            Promo: {{ $diskon->nama_diskon }} (Kode: {{ $diskon->kode }})
        </div>
        <div class="card-body">
            <div class="row row-cols-6">
                @foreach ($books as $book)
                    <div class="col-md-2 mb-3">
                        <a href="{{ url('/promo/buku/' . \Illuminate\Support\Str::slug($book->judul)) }}"
                            class=" text-decoration-none">
                            <div class="card h-100">
                                <img src="{{ asset($book->gambar) }}" alt="{{ $book->judul }}">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $book->judul }}</h6>
                                    <p class="card-text">Harga: Rp.
                                        {{ number_format($book->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
