@extends('layouts.main')
@section('title', 'SIBOOK | Promo Menarik')
@section('content')
    @if ($diskon->isEmpty())
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card text-center shadow-sm mt-3" style="border-radius: 10px; min-height: 230px;">
                <div class="card-body">
                    <img src="{{ asset('icon/coming-soon.jpeg') }}" alt="Tidak ada promo"
                        style="width: 100px; margin-bottom: 10px;">
                    <h5 class="card-title mb-3">Belum Ada Promo Menarik</h5>
                    <p class="card-text text-muted">Saat ini belum tersedia promo. Silakan cek kembali nanti untuk penawaran
                        menarik lainnya!</p>
                </div>
            </div>
        </div>
    @else
        @foreach ($diskon as $d)
            <div class="row my-3 card shadow-sm" style="border-radius: 10px">
                <div class="card-header">
                    Promo: {{ $d->nama_diskon }} (Kode: {{ $d->kode }})
                </div>
                <div class="card-body">
                    <div class="row row-cols-5">
                        @if ($books->where('diskon_id', $d->diskon_id)->isEmpty())
                            <div class="col">
                                <p class="text-muted">Tidak ada buku untuk promo ini.</p>
                            </div>
                        @else
                            @foreach ($books->where('diskon_id', $d->diskon_id)->take(10) as $book)
                                <a href="{{ url('/promo/buku/' . \Illuminate\Support\Str::slug($book->judul)) }}"
                                    class="col book-card m-2 pt-3 border">
                                    <div class="mx-1">
                                        <img src="{{ asset($book->gambar) }}" alt="{{ $book->judul }}" height="300em" />
                                        <h6>{{ \Illuminate\Support\Str::limit($book->judul, 20) }}</h6>
                                        <p>Rp. {{ number_format($book->harga, 0, ',', '.') }}</p>
                                    </div>
                                </a>
                            @endforeach
                            @if ($books->where('diskon_id', $d->diskon_id)->count() > 10)
                                <div class="col-12 text-end">
                                    <a href="/promo/{{ $d->diskon_id }}" class="py-4 px-4">Lihat Selengkapnya</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection
