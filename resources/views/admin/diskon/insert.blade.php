@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Insert Diskon')
@section('judKonten', 'Insert Diskon')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Insert Diskon</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <form action="/admin/diskon/store" method="POST">
            <div class="row border p-3 shadow" style="border-radius: 10px;">
            @csrf
            <div class="col-md-6 mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="persen" class="form-label">Persen</label>
                <input type="number" class="form-control" id="persen" name="persen" min="0" max="100"
                    required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tglMulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tglMulai" name="tglMulai" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="tglSelesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tglSelesai" name="tglSelesai" required>
            </div>
            <div class="col-md-6 mb-4">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>

            <div class=" gap-2 my-3 text-end">
                <button type="submit" class="btn btn-primary w-25 py-2">Tambah Data</button>
            </div>
        </form>
    </div>
@endsection