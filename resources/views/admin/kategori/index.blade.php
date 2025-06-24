@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Kategori')
@section('judKonten', 'Kelola Kategori')
@section('content')
    <!-- Tabel Kategori -->
    <div class="container-fluid">
        <div class="card my-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Kategori</h5>
                <a href="/admin/kategori/insert" class="btn btn-primary btn-sm">+ Tambah Kategori</a>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark text-center align-middle">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cate as $index => $c)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $c->nama_kategori }}</td>
                                <td>{{ $c->deskripsi }}</td>
                                <td class="text-center">
                                    <a href="/admin/kategori/edit/{{ $c->kategori_id }}" class="btn btn-warning btn-sm">✏️
                                        Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $c->kategori_id }}">
                                        🗑️ Hapus
                                    </button>

                                    {{-- ...existing code... --}}

                                    {{-- Modal Konfirmasi Hapus --}}
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus kategori ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="deleteForm" method="GET">
                                                        @csrf
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var deleteModal = document.getElementById('deleteModal');
                                            deleteModal.addEventListener('show.bs.modal', function(event) {
                                                var button = event.relatedTarget;
                                                var cateId = button.getAttribute('data-id');
                                                var form = document.getElementById('deleteForm');
                                                form.action = '/admin/kategori/delete/' + cateId;
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                        @if ($cate->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data kategori.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
