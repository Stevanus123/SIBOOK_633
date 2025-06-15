@extends('layouts.main')
@section('title')
<title>SIBOOK | Cari Buku</title>

@section('content')
    <div class="container mt-4">
        <h4>Hasil Pencarian: "{{ $query }}"</h4>
        @if($books->count() > 0)
            <div class="row">
                @foreach($books as $book)
                    <div class="col-md-2 mb-3">
                        <a href="/{{ $active }}/buku/{{\Illuminate\Support\Str::slug($book->judul) }}"
                            class=" text-decoration-none">
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
            </div>
        @else
            <p>Tidak ditemukan buku yang sesuai.</p>
        @endif
    </div>
@endsection