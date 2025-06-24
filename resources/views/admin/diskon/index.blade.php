@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Diskon')
@section('judKonten', 'Kelola Diskon')
@section('content')
    <!-- Tabel Diskon -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Diskon</h5>
            <a href="/admin/diskon/insert" class="btn btn-primary btn-sm">+ Tambah Diskon</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Persen</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disk as $index => $d)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $d->kode }}</td>
                            <td class="text-center">{{ $d->persen . '%' }}</td>
                            @php
                                $start = \Carbon\Carbon::parse($d->tglMulai);
                                $end = \Carbon\Carbon::parse($d->tglSelesai);

                                if ($start->year == $end->year) {
                                    if ($start->month == $end->month) {
                                        // Contoh: 1 - 5 Juni 2024
                                        $tanggal =
                                            $start->day . ' - ' . $end->day . ' ' . $start->translatedFormat('F Y');
                                    } else {
                                        // Contoh: 28 Mei - 2 Juni 2024
                                        $tanggal =
                                            $start->day .
                                            ' ' .
                                            $start->translatedFormat('F') .
                                            ' - ' .
                                            $end->day .
                                            ' ' .
                                            $end->translatedFormat('F Y');
                                    }
                                } else {
                                    // Contoh: 28 Desember 2023 - 2 Januari 2024
                                    $tanggal =
                                        $start->day .
                                        ' ' .
                                        $start->translatedFormat('F Y') .
                                        ' - ' .
                                        $end->day .
                                        ' ' .
                                        $end->translatedFormat('F Y');
                                }
                            @endphp
                            <td>{{ $tanggal }}</td>
                            <td class="text-center">
                                <a href="/admin/diskon/edit/{{ $d->diskon_id }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $d->diskon_id }}">
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
                                                Apakah Anda yakin ingin menghapus diskon ini?
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
                                            var diskonId = button.getAttribute('data-id');
                                            var form = document.getElementById('deleteForm');
                                            form.action = '/admin/diskon/delete/' + diskonId;
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    @endforeach
                    @if ($disk->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data diskon.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection