@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Kelola User')
@section('judKonten', 'Kelola User')
@section('content')
    <!-- Tabel User -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar User</h5>
            <a href="/admin/user/insert" class="btn btn-primary btn-sm">+ Tambah User</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center align-middle">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $index => $u)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->no_telp }}</td>
                            <td>{{ $u->kota}}</td>
                            <td class="text-center">
                                <a href="/admin/user/edit/{{ $u->id }}" class="btn btn-info btn-sm">✏️ Reset Pw</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $u->id }}">
                                    🗑️ Hapus
                                </button>

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
                                                Apakah Anda yakin ingin menghapus user ini?
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
                                            var userId = button.getAttribute('data-id');
                                            var form = document.getElementById('deleteForm');
                                            form.action = '/admin/user/delete/' + userId;
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    @endforeach
                    @if ($user->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data kategori.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection