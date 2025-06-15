@extends('layouts.admin')
@section('title')
<title>Admin SIBOOK | Terbit Buku</title>

@section('judKonten', 'Kelola Penerbitan')

@section('content')

    <!-- Tabel Kategori -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Permintaan Terbit Buku</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center align-middle">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengusul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($terbit as $index => $t)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $t->judul }}</td>
                            <td>{{ $t->user->nama }}</td>
                            <td>{{ $t->created_at }}</td>
                            <td>{{ $t->status }}</td>
                            <td>
                                <a href="/admin/terbit/detail/{{ $t->kategori_id }}" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    @if ($terbit->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data kategori.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection