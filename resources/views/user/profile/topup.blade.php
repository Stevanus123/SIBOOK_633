@extends('layouts.main')
@section('title')
    <title>SIBOOK | Top Up Saldo</title>
@endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Top Up Saldo</li>
        </ol>
    </nav>
    <div class="container mt-5 d-flex align-items-center justify-content-center">
        <div class="col-5 ">
            <h3 class="mb-4">💳 Top Up Saldo</h3>

            <form method="POST" action="/topup/request">
                @csrf
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Top Up (Rp)</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1000" max="500000" required>
                </div>
                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan</label>
                    <input type="text" name="alasan" id="alasan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan Top Up</button>    
            </form>
        </div>
    </div>
@endsection