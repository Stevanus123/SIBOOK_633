@extends('layouts.admin')
@section('title')
<title>Admin SIBOOK | Saldo</title>

@section('judKonten', 'Kelola Saldo')

@section('content')

    <!-- Tabel Kategori -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permintaan Saldo</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark text-center align-middle">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Jumlah</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reqTopup as $index => $rt)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rt->user->nama }}</td>
                            <td>Rp. {{ number_format($rt->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $rt->alasan }}</td>
                            <td>{{ $rt->status }}</td>
                            <td>
                                <!-- Tombol Setujui yang memicu modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal{{ $rt->id }}">
                                    Setujui
                                </button>

                                <!-- Modal Setujui -->
                                <div class="modal fade" id="approveModal{{ $rt->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $rt->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="/admin/saldo/acc/{{ $rt->id }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="approveModalLabel{{ $rt->id }}">Setujui Permintaan Saldo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="jumlah{{ $rt->id }}" class="form-label">Jumlah Saldo (maks: {{ $rt->jumlah }})</label>
                                                        <input type="number" class="form-control" id="jumlah{{ $rt->id }}" name="jumlah" min="0" max="{{ $rt->jumlah }}" value="{{ $rt->jumlah }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pesan{{ $rt->id }}" class="form-label">Pesan dari Admin (opsional)</label>
                                                        <textarea class="form-control" id="pesan{{ $rt->id }}" name="pesan" rows="2">Gunakan uang itu dengan baik!</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Setujui</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Tombol Tolak yang memicu modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $rt->id }}">
                                    Tolak
                                </button>

                                <!-- Modal Tolak -->
                                <div class="modal fade" id="rejectModal{{ $rt->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $rt->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="/admin/saldo/tolak/{{ $rt->id }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $rt->id }}">Tolak Permintaan Saldo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="pesanTolak{{ $rt->id }}" class="form-label">Pesan Penolakan (opsional)</label>
                                                        <textarea class="form-control" id="pesanTolak{{ $rt->id }}" name="pesan" rows="2">Maaf, permintaan saldo Anda ditolak.</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if ($reqTopup->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data permintaan saldo.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection