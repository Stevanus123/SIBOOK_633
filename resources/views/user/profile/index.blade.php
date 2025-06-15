@extends('layouts.main')
@section('title')
<title>SIBOOK | Profile</title>

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">👤 Profil Saya</h2>

        <div class="row">
            {{-- Sidebar Kiri --}}
            <div class="col-md-4">
                <div class="card p-3 text-center shadow">
                    <div class="text-center">
                        <img src="{{ asset('profil/profile_default.png') }}" class="rounded-circle mb-3" width="120"
                            height="120">
                    </div>
                    <h4>{{ auth()->user()->nama }}</h4>
                    <p class="text-muted">{{ auth()->user()->username }}</p>
                    <p class="mt-2"><strong>💰 Saldo:</strong> Rp. {{ number_format(auth()->user()->saldo, 0, ',', '.') }}
                    </p>

                    <div class="mt-3">
                        <a href="/profile/topup" class="btn btn-success w-100 mb-2">💸 Top Up Saldo</a>
                        <a href="/profile/edit" class="btn btn-primary w-100 mb-2">✏️ Edit Profil</a>
                        <a href="/profile/gantiPassword" class="btn btn-warning w-100 mb-2">🔒 Ganti Password</a>
                        <a href="/logout" class="btn btn-danger w-100 mt-4">🚪 Logout</a>
                    </div>
                </div>
            </div>

            {{-- Konten Kanan --}}
            <div class="col-md-8">
                <div class="card shadow p-4 mb-4">
                    <h5 class="mb-3">📄 Informasi Akun</h5>
                    <p><strong>Nama:</strong> {{ auth()->user()->nama }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>No. HP:</strong> {{ auth()->user()->no_telp ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ auth()->user()->alamat ?? '-' }}</p>
                    <p><strong>Tanggal Bergabung:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
                </div>

                {{-- Riwayat Pesanan --}}
                <div class="card shadow p-4">
                    <h5 class="mb-3">🛍️ Riwayat Pemesanan</h5>
                    @if ($orders->isEmpty())
                        <p class="text-muted">Belum ada pesanan.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $o)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $o->created_at->format('d M Y') }}</td>
                                        <td>{{ ucfirst($o->status) }}</td>
                                        <td>Rp. {{ number_format($o->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                
                {{-- Riwayat Saldo --}}
                <div class="card shadow p-4 mt-4">
                    <h5 class="mb-3">💰 Riwayat Saldo</h5>
                    @if ($saldoHistories->isEmpty())
                        <p class="text-muted">Belum ada aktivitas saldo.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Tipe</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saldoHistories as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ ucfirst($s->tipe) }}</td>
                                        <td class="{{ $s->tipe == 'topup' ? 'text-success' : 'text-danger' }}">
                                            {{ $s->tipe == 'topup' ? '+' : '-' }}Rp.
                                            {{ number_format(abs($s->jumlah), 0, ',', '.') }}
                                        </td>
                                        <td>{{ $s->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection