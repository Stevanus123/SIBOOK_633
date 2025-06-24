@extends('layouts.main')
@section('title', 'SIBOOK | Pengisian Form Penerbitan')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/penerbitan">Penerbitan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form Penerbitan</li>
        </ol>
    </nav>
    <div class="row my-3 card shadow-sm" style="border-radius: 10px">
        <!-- form terbit buku -->
        <h2 class="text-center my-3">Ayo, Terbitkan Bukumu Sekarang!</h2>
        <form id="formPenerbitan" method="post" action="/terbit/store" enctype="multipart/form-data">
            <!-- Informasi Buku -->
            @csrf
            <div class="row mb-4 mx-2">
                <h4>Informasi Buku</h4>
                <div class="col-md-6">
                    <label for="judul" class="form-label">Judul Naskah Buku</label>
                    <input type="text" class="form-control" id="judul" name="judul" required />
                </div>
                <div class="col-md-6">
                    <label for="harga" class="form-label">Harga Buku yang Diinginkan</label>
                    <input type="number" class="form-control" id="harga" name="harga" min="1000" required />
                </div>
                <div class="col-md-6">
                    <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" min="1" required />
                </div>
                <div class="col-md-6">
                    <label for="kategori" class="form-label">Kategori Buku</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option selected disabled>Pilih Kategori</option>
                        @foreach ($cate as $c)
                            <option value="{{ $c->nama_kategori }}">{{ $c->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="sampul" class="form-label">Upload Sampul</label>
                    <input type="file" class="form-control" id="sampul" name="sampul" accept="image/*" />
                </div>
                <div class="col-md-6 mt-3">
                    <label for="naskah" class="form-label">Upload Naskah (PDF)</label>
                    <input type="file" class="form-control" id="naskah" name="naskah" accept=".pdf" required />
                </div>
                <div class="col-md-6 mt-3">
                    <label for="sinopsis" class="form-label">Sinopsis Buku</label>
                    <textarea class="form-control" id="sinopsis" name="sinopsis" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="catatan" class="form-label">Catatan Tambahan (opsional)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>
            </div>

            <!-- persetujuan -->
            <div class="mb-4 ms-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="asli" required />
                    <label class="form-check-label" for="asli">
                        Saya menyatakan bahwa naskah ini adalah karya asli saya.
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="syarat" required />
                    <label class="form-check-label" for="syarat">
                        Saya setuju dengan syarat dan ketentuan penerbitan.
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center my-4">
                <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal"
                    data-bs-target="#konfirmasiModal">
                    Ajukan Penerbitan
                </button>
            </div>
            <!-- Modal Konfirmasi -->
            <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-warning-subtle">
                            <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Penerbitan Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <p>📚 Dengan mengajukan buku, Anda akan mendapatkan:</p>
                            <ul>
                                <li>Saldo tambahan sebesar <strong>Rp 20.000</strong></li>
                                <li>Jika buku dibeli oleh pengguna lain, Anda akan menerima saldo sebesar <strong>harga jual buku
                                        dikurangi 10% pajak</strong>.</li>
                            </ul>
                            <p>Apakah Anda yakin ingin melanjutkan pengajuan penerbitan?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                            <!-- Tombol Submit Form -->
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('formPenerbitan').submit();">
                                Ajukan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
