@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Update Kategori')
@section('judKonten', 'Update Kategori')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Kategori</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <form action="/admin/kategori/update/{{ $cate->kategori_id }}" method="POST" class="d-flex justify-content-center">
            <div class="row border p-3 shadow w-50" style="border-radius: 10px;">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        value="{{ $cate->nama_kategori }}" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $cate->deskripsi }}</textarea>
                </div>
                <div class="d-grid gap-2 my-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
