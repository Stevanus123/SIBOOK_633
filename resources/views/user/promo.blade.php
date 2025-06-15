@extends('layouts.main')
@section('title')
<title>SIBOOK | Promo Menarik</title>

@section('content')
    @foreach ($diskon as $d)
        <div class="row my-4 card shadow">
            <div class="card-header">
                Promo: {{ $d->nama_diskon }} (Kode: {{ $d->kode }})
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($books->where('diskon_id', $d->diskon_id) as $book)
                        <div class="col-md-2 mb-3">
                            <a href="{{ url('/promo/buku/' . \Illuminate\Support\Str::slug($book->judul)) }}" class=" text-decoration-none">
                                <div class="card h-100">
                                    <img src="{{ asset($book->gambar) }}" alt="{{ $book->judul }}">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $book->judul }}</h6>
                                        <p class="card-text">Harga: Rp. {{ number_format($book->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @if ($books->where('diskon_id', $d->diskon_id)->isEmpty())
                        <div class="col">
                            <p class="text-muted">Tidak ada buku untuk promo ini.</p>
                        </div>
                    @endif
                </div>
            </div>
            <a href="#" class="text-end py-4 px-4">Lihat Selengkapnya</a>
        </div>
    @endforeach

@endsection