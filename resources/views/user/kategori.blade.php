@extends('layouts.main')
@section('title', 'SIBOOK | Kategori Buku')
@section('content')
    <div class="row my-3 card shadow-sm" style="border-radius: 10px">
        <h3 class="my-3 card-header">Kategori {{ ucfirst($key) }}</h3>
        <div class="d-flex justify-content-center">
            <div class="row row-cols-5 card-body">
                @if ($books->isNotEmpty())
                    @foreach ($books as $b)
                        <a href="{{ url('/kategori-' . $key . '/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}"
                            class="col book-card m-2 pt-3 border">
                            <div class="mx-1">
                                <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" height="300em" />
                                <h6>{{ \Illuminate\Support\Str::limit($b->judul, 20) }}</h6>
                                <p>Rp. {{ number_format($b->harga, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    @endforeach ()
                @else
                    <div class="col-12 text-center">
                        <img src="{{ asset('icon/empty-book.png') }}" alt="Tidak ada buku" width="120" class="mb-3" />
                        <p class="text-muted" style="font-size: 18px">Belum ada buku di kategori ini.<br>Silakan cek kembali
                            nanti.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
