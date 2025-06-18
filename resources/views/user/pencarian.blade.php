@extends('layouts.main')
@section('title', 'SIBOOK | Cari Buku')
@section('content')
    <div class="row my-3 card shadow-sm" style="border-radius: 10px">
        <h3 class="my-3 card-header">Hasil Pencarian: "{{ $query }}"</h3>
        <div class="d-flex justify-content-center">
            <div class="row row-cols-6 card-body">
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <a class="col text-decoration-none mb-3"
                            href="/{{ $active }}/buku/{{ \Illuminate\Support\Str::slug($book->judul) }}">
                            <img src="{{ asset($book->gambar) }}" alt="{{ $book->judul }}" height="250em" width="180em" />
                            <h6>{{ \Illuminate\Support\Str::limit($book->judul, 20) }}</h6>
                            <p>Rp. {{ number_format($book->harga, 0, ',', '.') }}</p>
                        </a>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <img src="{{ asset('icon/empty-book.png') }}" alt="Tidak ada buku" width="120" class="mb-3" />
                        <p class="text-muted" style="font-size: 18px">Buku yang kamu cari belum tersedia.<br>Silakan cek
                            kembali nanti.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
