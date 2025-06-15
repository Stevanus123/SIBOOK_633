@extends('layouts.main')
@section('title')
<title>SIBOOK | Kategori {{ ucfirst($key) }}</title>

@section('content')
    <div class="row my-4 card">
        <h3 class="my-3 card-header">Kategori {{ ucfirst($key) }}</h3>
        <div class="d-flex justify-content-center">
            <div class="row row-cols-6 card-body">
                @if ($books->isNotEmpty())
                    @foreach ($books as $b)
                        <a class="col text-decoration-none" href="{{ url('/kategori-'.$key.'/buku/' . \Illuminate\Support\Str::slug($b->judul)) }}">
                            <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" height="250em" width="180em" />
                            <h6>{{ \Illuminate\Support\Str::limit($b->judul, 20) }}</h6>
                            <p>Rp. {{ number_format($b->harga, 0, ',', '.') }}</p>
                        </a>
                    @endforeach ()
                @else
                    <div class="col-12 text-center">
                        <p class="">Belum ada buku dengan kategori ini.</p>
                    </div>
                @endif
                {{-- <a class="col text-decoration-none" href="#">
                    <img src="{{ asset('icon/buku-2.jpg') }}" alt="" height="250em" width="180em" />
                    <h6>Judul Buku 2</h6>
                    <p>Rp. 200.000</p>
                </a>
                <a class="col text-decoration-none" href="#">
                    <img src="{{ asset('icon/buku-3.jpg') }}" alt="" height="250em" width="180em" />
                    <h6>Hukum Waris Islam</h6>
                    <p>Rp. 200.000</p>
                </a>
                <a class="col text-decoration-none" href="#">
                    <img src="{{ asset('icon/buku-4.jpg') }}" alt="" height="250em" width="180em" />
                    <h6>Judul Buku 2</h6>
                    <p>Rp. 200.000</p>
                </a>
                <a class="col text-decoration-none" href="#">
                    <img src="{{ asset('icon/buku-5.jpg') }}" alt="" height="250em" width="180em" />
                    <h6>Judul Buku 2</h6>
                    <p>Rp. 200.000</p>
                </a>
                <a class="col text-decoration-none" href="#">
                    <img src="{{ asset('icon/buku-6.png') }}" alt="" height="250em" width="180em" />
                    <h6>Judul Buku 2</h6>
                    <p>Rp. 200.000</p>
                </a>
                <a class="col text-decoration-none" href="#">
                    <img src="{{ asset('icon/buku-7.jpg') }}" alt="" height="250em" width="180em" />
                    <h6>Judul Buku 2</h6>
                    <p>Rp. 200.000</p>
                </a> --}}
            </div>
        </div>
    </div>

@endsection