@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Insert User')
@section('judKonten', 'Insert User')
@section('content')
    <div class="container-fluid">
        <form action="/admin/user/store" method="POST">
            <div class="row border p-3 shadow" style="border-radius: 10px;">
                @csrf
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" class="form-control" id="username" name="username" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="no_telp" class="form-label">No Telp</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" required>
                </div>

                <div class=" gap-2 yt-3 text-end">
                    <button type="submit" class="btn btn-primary w-25 py-2">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
@endsection
