@extends('layouts/main')
@section('title', 'SIBOOK | Home')
@section('content')
    <!-- poster -->
    <div class="row py-4 my-3 border bg-white shadow-sm" style="border-radius: 10px">
        <div class="container" style="width: 98%">
            <div class="position-relative d-flex justify-content-center" style="height: 300px">
                <img src="icon/poster-1.jpeg" class="poster-carousel d-block h-100" alt="Poster 1" />
                <img src="icon/poster-2.jpeg" class="poster-carousel d-none h-100" alt="Poster 2" />
                <img src="icon/poster-3.jpeg" class="poster-carousel d-none h-100" alt="Poster 3" />
                <img src="icon/poster-4.png" class="poster-carousel d-none h-100" alt="Poster 4" />
                <button class="btn btn-outline-dark position-absolute start-0 top-50 translate-middle-y ms-4"
                    onclick="prevSlide()">
                    ❮
                </button>
                <button class="btn btn-outline-dark position-absolute end-0 top-50 translate-middle-y me-4"
                    onclick="nextSlide()">
                    ❯
                </button>
            </div>
            <div class="d-flex justify-content-center mt-3 gap-2" id="dotContainer"></div>
            <style>
                .dot {
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                    background-color: #ccc;
                    cursor: pointer;
                }

                .dot.active {
                    background-color: #333;
                }
            </style>
        </div>
    </div>

    <!-- promo -->
    <div class="row border bg-white my-3 shadow-sm" style="border-radius: 10px">
        <div class="col-12 my-4">
            @if ($books->whereNotNull('diskon_id')->isEmpty())
                <div class="card border-warning mb-3 mx-auto" style="max-width: 400px;">
                    <div class="card-body text-center">
                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-2">Tidak Ada Promo</h5>
                        <p class="card-text">Maaf, tidak ada buku yang promo saat ini.</p>
                    </div>
                </div>
            @else
                <div class="header ms-2">
                    <h5>Daftar Buku Promo</h5>
                    <p>Nikmati promo menarik bulan ini!</p>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-start row row-cols-5">
                        @foreach ($books->whereNotNull('diskon_id')->take(10) as $b)
                            <a href="{{ url('/home/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}"
                                class="col book-card m-2 pt-3 border">
                                <div class="mx-1">
                                    <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" height="300em" />
                                    <h6>{{ \Illuminate\Support\Str::limit($b->judul, 20) }}</h6>
                                    <p>Rp. {{ number_format($b->harga, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @endforeach
                        @if ($books->whereNotNull('diskon_id')->count() > 10)
                            <div class="col-12 text-end">
                                <a href="/promo" class="py-4 px-4">Lihat Selengkapnya</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- terlaris || masih perlu ditambahkan record best seller di database --}}
    <div class="row border my-3 bg-white shadow-sm" style="border-radius: 10px">
        <div class="col-12 my-4">
            <div class="header ms-2">
                <h5>Best Seller</h5>
                <p>Buku terlaris sepanjang sejarah!</p>
            </div>
            <div class="d-flex justify-content-start row row-cols-5">
                @foreach ($books as $b)
                    @if ($b->diskon_id != null)
                        <a href="{{ url('/home/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}"
                            class="col px-4 text-decoration-none">
                            <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" height="300em" />
                            <h6>{{ \Illuminate\Support\Str::limit($b->judul, 20) }}</h6>
                            <p>Rp. {{ number_format($b->harga, 0, ',', '.') }}</p>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
