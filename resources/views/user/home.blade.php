@extends('layouts/main')
@section('title')
<title>SIBOOK | Sistem Informasi Buku</title>
@section('content')
    <!-- poster -->
    <div class="row py-4">
        <div class="container mt-2">
            <div class="position-relative d-flex justify-content-center" style="height: 300px">
                <img src="icon/poster-1.jpeg" class="poster-carousel d-block h-100" alt="Poster 1" />
                <img src="icon/poster-2.jpeg" class="poster-carousel d-none h-100" alt="Poster 2" />
                <img src="icon/poster-3.jpeg" class="poster-carousel d-none h-100" alt="Poster 3" />
                <img src="icon/poster-4.png" class="poster-carousel d-none h-100" alt="Poster 4" />
                <button class="btn btn-outline-dark position-absolute start-0 top-50 translate-middle-y"
                    onclick="prevSlide()">
                    ❮
                </button>
                <button class="btn btn-outline-dark position-absolute end-0 top-50 translate-middle-y"
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
    <div class="row border">
        <div class="col-12">
            <h5>Daftar Buku Promo</h5>
            <p>Nikmati promo menarik bulan ini!</p>
            <div class="d-flex justify-content-evenly">
                @foreach ($books as $b)
                    @if($b->diskon_id != null)
                        <a href="{{ url('/home/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}" class="px-4 text-decoration-none">
                            <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" height="300em" />
                            <h6>{{ \Illuminate\Support\Str::limit($b->judul, 20) }}</h6>
                            <p>Rp. {{ number_format($b->harga, 0, ',', '.') }}</p>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- terlaris --}}
    <div class="row border">
        <div class="col-12">
            <h5>Best Seller</h5>
            <div class="d-flex justify-content-evenly">
                @foreach ($books as $b)
                    @if($b->diskon_id != null)
                        <a href="{{ url('/home/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}" class="px-4 text-decoration-none">
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