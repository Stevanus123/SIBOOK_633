@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Terbit Buku')
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
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $t->judul }}</td>
                            <td>{{ $t->user->nama }}</td>
                            <td>{{ $t->created_at }}</td>
                            <td>{{ ucfirst($t->status) }}</td>
                            @if ($t->status == 'menunggu')
                                <td>
                                    <a href="/admin/terbit/setuju/{{ $t->id }}"
                                        class="btn btn-success btn-sm">Setujui</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#tolakModal">Tolak</a>
                                    <a href="/admin/terbit/detail/{{ $t->id }}"
                                        class="btn btn-primary btn-sm">Detail</a>
                                </td>
                                <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 rounded-3 shadow-lg">
                                            <div class="modal-header bg-danger text-white rounded-top">
                                                <h5 class="modal-title" id="tolakModalLabel">Konfirmasi Penolakan</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-3">Apakah Anda yakin ingin <strong>menolak</strong>
                                                    permintaan penerbitan buku ini?</p>
                                                <form action="/admin/terbit/tolak/{{ $t->id }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="catatan" class="form-label">Alasan Penolakan</label>
                                                        <textarea class="form-control" name="catatan" id="catatan" rows="3" required></textarea>
                                                    </div>
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <td>
                                    <a href="/admin/terbit/detail/{{ $t->id }}"
                                        class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    @if ($terbit->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Belum ada permintaan terbit buku.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
