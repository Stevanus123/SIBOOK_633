@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Insert Kategori')
@section('judKonten', 'Insert Kategori')
@section('content')
    <div class="container-fluid">
        <form action="/admin/kategori/store" method="POST" class="d-flex justify-content-center">
            <div class="row border p-3 shadow w-50" style="border-radius: 10px;">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="d-grid gap-2 my-3">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
@endsection
