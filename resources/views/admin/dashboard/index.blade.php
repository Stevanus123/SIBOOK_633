@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Dashboard')
@section('judKonten', 'Dashboard Penjualan')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card text-white mb-3" style="background-color: var(--pink)">
                <div class="card-body">
                    <h5 class="card-title">Total Penjualan</h5>
                    <p class="card-text">{{ $tJual }} transaksi</p>
                </div>
            </div>
        </div>
        <div class="col">
            <a href="/admin/terbit" style="text-decoration: none">
                <div class="card text-white mb-3" style="background-color: var(--pink)">
                    <div class="card-body">
                        <h5 class="card-title">Total Penerbitan Buku</h5>
                        <p class="card-text">{{ $tTerbit }} buku diterbitkan</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="/admin/user" style="text-decoration: none">
                <div class="card text-white mb-3" style="background-color: var(--pink)">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna Tergabung</h5>
                        <p class="card-text">{{ $tUser }} pengguna</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Buku Terlaris</h4>
                    <hr>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topBooks as $book)
                                <tr>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- grafik --}}
    <div class=" mt-4">
        <h4>Total Pendapatan Per Bulan</h4>
        <canvas id="chartPenjualan"></canvas>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartPenjualan');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($jualBulanan->pluck('bulan')) !!},
                datasets: [{
                    label: 'Total Pendapatan',
                    data: {!! json_encode($jualBulanan->pluck('total')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
