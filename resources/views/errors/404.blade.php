@php
    if ($user->username == 'deden') {
        $layout = 'layouts.admin';
    } else {
        $layout = 'layouts.main';
    }
@endphp
@extends($layout)

@section('title', 'SIBOOK | Not Found')
@section('content')
    <div class="text-center mt-5">
        <h1>404</h1>
        <p>Halaman tidak ditemukan.</p>
        @if ($user->username == 'deden')
            <a href="/admin/dashboard" class="btn btn-primary">Kembali ke Dashboard</a>
        @else
            <a href="/home" class="btn btn-primary">Kembali ke Home</a>
        @endif
    </div>
@endsection
