@extends('layouts.main')
@section('title', 'SIBOOK | Pengisian Form Penerbitan')
@section('content')
    <!-- form terbit buku -->
    <div class="row my-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/penerbitan">Penerbitan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Penerbitan</li>
            </ol>
        </nav>
        <h2 class="text-center my-3">Ayo, Terbitkan Bukumu Sekarang!</h2>
        <form id="formPenerbitan" method="post" action="/terbit/insert" enctype="multipart/form-data">
            <!-- Informasi Buku -->
            @csrf
            <div class="row mb-4">
                <h4>Informasi Buku</h4>
                <div class="col-md-6">
                    <label for="judul" class="form-label">Judul Naskah Buku</label>
                    <input type="text" class="form-control" id="judul" name="judul" required />
                </div>
                <div class="col-md-6">
                    <label for="kategori" class="form-label">Kategori Buku</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option selected disabled>Pilih Kategori</option>
                        @foreach($cate as $c)
                        <option value="{{ $c->nama_kategori }}">{{ $c->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="sampul" class="form-label">Upload Sampul</label>
                    <input type="file" class="form-control" id="sampul" name="sampul" accept="image/*"/>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="naskah" class="form-label">Upload Naskah (PDF/DOCX)</label>
                    <input type="file" class="form-control" id="naskah" name="naskah" accept=".pdf,.doc,.docx" required />
                </div>
                <div class="col-md-6 mt-3">
                    <label for="sinopsis" class="form-label">Sinopsis Buku</label>
                    <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3"></textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>
            </div>

            <!-- persetujuan -->
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="asli" required />
                    <label class="form-check-label" for="asli">
                        Saya menyatakan bahwa naskah ini adalah karya asli saya.
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="syarat" required />
                    <label class="form-check-label" for="syarat">
                        Saya setuju dengan syarat dan ketentuan penerbitan.
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary px-5 py-2">
                    Ajukan Penerbitan
                </button>
            </div>
        </form>
    </div>
@endsection
