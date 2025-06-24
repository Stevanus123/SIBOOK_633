@extends('layouts.main')
@section('title', 'SIBOOK | Update Penerbitan')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Penerbitan</li>
        </ol>
    </nav>
    <div class="row my-3 card shadow-sm" style="border-radius: 10px">
        <!-- form terbit buku -->
        <h2 class="text-center my-3">Update Penerbitanmu!</h2>
        <form method="post" action="/terbit/update/{{ $terbit->id }}" enctype="multipart/form-data">
            <!-- Informasi Buku -->
            @csrf
            @method('PUT')
            <div class="row mb-4 mx-2">
                <h4>Informasi Buku</h4>
                <div class="col-md-6">
                    <label for="judul" class="form-label">Judul Naskah Buku</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $terbit->judul }}" required />
                </div>
                <div class="col-md-6">
                    <label for="harga" class="form-label">Harga Buku yang Diinginkan</label>
                    <input type="number" class="form-control" id="harga" name="harga" min="1000" value="{{ $terbit->harga }}" required />
                </div>
                <div class="col-md-6">
                    <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" min="1" value="{{ $terbit->jumlah_halaman }}" required />
                </div>
                <div class="col-md-6">
                    <label for="kategori" class="form-label">Kategori Buku</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option selected disabled>Pilih Kategori</option>
                        @foreach ($cate as $c)
                            <option value="{{ $c->nama_kategori }}" {{ $terbit->kategori_id == $c->kategori_id ? 'selected' : '' }}>{{ $c->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="sampul" class="form-label">Upload Sampul</label>
                    <input type="file" class="form-control" id="sampul" name="sampul" accept="image/*" />
                </div>
                <div class="col-md-6 mt-3">
                    <label for="naskah" class="form-label">Upload Naskah (PDF)</label>
                    <input type="file" class="form-control" id="naskah" name="naskah" accept=".pdf" />
                </div>
                <div class="col-md-6 mt-3">
                    <label for="sinopsis" class="form-label">Sinopsis Buku</label>
                    <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3" required>{{ $terbit->sinopsis }}</textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $terbit->catatan }}</textarea>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center my-4">
                <button type="submit" class="btn btn-primary px-5 py-2">
                    Ajukan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
