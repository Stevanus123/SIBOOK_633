@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Kelola Buku')

@section('judKonten', 'Kelola Buku')

@section('content')
    

    <!-- Tabel Buku -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Buku</h5>
            <a href="/admin/buku/insert" class="btn btn-primary btn-sm">+ Tambah Buku</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $index => $book)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->penulis }}</td>
                            <td class="text-end">Rp. {{ number_format($book->harga, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $book->stok }}</td>
                            <td>{{ $book->kategori->nama_kategori }}</td>
                            <td class="text-center">
                                <a href="/admin/buku/edit/{{ $book->buku_id }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $book->buku_id }}">
                                    🗑️ Hapus
                                </button>

                                {{-- ...existing code... --}}

                                {{-- Modal Konfirmasi Hapus --}}
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus buku ini?
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
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var deleteModal = document.getElementById('deleteModal');
                                        deleteModal.addEventListener('show.bs.modal', function (event) {
                                            var button = event.relatedTarget;
                                            var bukuId = button.getAttribute('data-id');
                                            var form = document.getElementById('deleteForm');
                                            form.action = '/admin/buku/delete/' + bukuId;
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    @endforeach
                    @if ($books->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data buku.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection