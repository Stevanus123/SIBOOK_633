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
                <div class="card-header d-flex justify-content-between align-items-center bg-warning"
                    style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <span>
                        <i class="bi bi-gift-fill me-2"></i>
                        Promo: <strong>{{ $d->nama_diskon }}</strong>
                    </span>
                    <span class="badge bg-success text-white" style="font-size: 1em;">
                        Kode: {{ $d->kode }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="container-fluid d-flex justify-content-center ">
                        <div class="d-flex justify-content-start row row-cols-5 " style="width: 110%">
                            @if ($books->where('diskon_id', $d->diskon_id)->isEmpty())
                                <div class="col-12">
                                    <p class="text-muted">Buku untuk promo ini akan segera hadir.</p>
                                </div>
                            @else
                                @foreach ($books->where('diskon_id', $d->diskon_id)->take(10) as $b)
                                    <a href="{{ url('/detail/promo/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}"
                                        class="col book-card m-2 pt-3 border">
                                        <div class="mx-1">
                                            <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}"
                                                height="300em" />
                                            <h6>{{ \Illuminate\Support\Str::limit($b->judul, 40) }}</h6>
                                            <p>
                                                @if ($b->dibeli)
                                                    <span class="badge bg-success" style="font-size: 1em;">
                                                        Dibeli
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger" style="font-size: 1em;">
                                                        Rp. {{ number_format($b->harga, 0, ',', '.') }}
                                                    </span>
                                                @endif
                                            </p>
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
            </div>
        @endforeach
    @endif
@endsection
