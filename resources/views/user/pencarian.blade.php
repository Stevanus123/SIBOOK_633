@extends('layouts.main')
@section('title', 'SIBOOK | Cari Buku')
@section('content')
    <div class="row card my-3 shadow-sm" style="border-radius: 10px">
        <h3 class="my-2 card-header">Hasil Pencarian: "{{ $query }}"</h3>
        <div class="card-body">
            <div class="container-fluid d-flex justify-content-center ">
                <div class="d-flex justify-content-start row row-cols-5 " style="width: 110%">
                    @if ($books->count() > 0)
                        @foreach ($books as $book)
                            <a class="col book-card m-2 pt-3 border"
                                href="/detail/{{ $active }}/buku/{{ \Illuminate\Support\Str::slug($book->judul) }}">
                                <img src="{{ asset($book->gambar) }}" alt="{{ $book->judul }}" height="250em"
                                    width="180em" />
                                <h6>{{ \Illuminate\Support\Str::limit($book->judul, 20) }}</h6>
                                <p>
                                    @if ($book->dibeli)
                                        <span class="badge bg-success" style="font-size: 1em;">
                                            Dibeli
                                        </span>
                                    @else
                                        <span class="badge bg-danger" style="font-size: 1em;">
                                            Rp. {{ number_format($book->harga, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </p>
                            </a>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <img src="{{ asset('icon/empty-book.png') }}" alt="Tidak ada buku" width="120"
                                class="mb-3" />
                            <p class="text-muted" style="font-size: 18px">Buku yang kamu cari belum tersedia.<br>Silakan cek
                                kembali nanti.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
