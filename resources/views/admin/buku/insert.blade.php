@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Insert Buku')
@section('judKonten', 'Insert Buku')
@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/{{ $active }}">{{ ucfirst($active) }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Insert Buku</li>
        </ol>
    </nav>
    <div class="container-fluid">
            <form action="/admin/buku/store" method="POST" enctype="multipart/form-data">
                <div class="row border p-3 shadow" style="border-radius: 10px;">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" min="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" min="1000" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jumlah_buku" class="form-label">Jumlah_buku</label>
                        <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" min="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($cate as $c)
                                <option value="{{ $c->nama_kategori }}">{{ ucfirst($c->nama_kategori) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="diskon" class="form-label">Diskon</label>
                        <select class="form-select" id="diskon" name="diskon" required>
                            <option value="" disabled selected>Pilih Diskon</option>
                            @foreach ($diskon as $d)
                                <option value="{{ $d->nama_diskon }}">{{ ucfirst($d->nama_diskon) }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-6 mb-3">
                        <label for="file_buku" class="form-label">File Buku (PDF)</label>
                        <input type="file" class="form-control" id="file_buku" name="file_buku" accept=".pdf" required>
                     </div>
                    <div class="col-md-6 mb-3">
                        <label for="cover" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="cover" name="cover" accept="image/*" required
                            onchange="previewImage(event)">
                        <img id="preview" src="#" alt="Preview Cover" class="img-fluid mt-2"
                            style="display: none; max-height: 200px;">
                        <script>
                            function previewImage(event) {
                                const input = event.target;
                                const preview = document.getElementById('preview');
                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block';
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                } else {
                                    preview.src = '#';
                                    preview.style.display = 'none';
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>

                    <div class="gap-2 my-4 text-end">
                        <button type="submit" class="btn btn-primary w-25 py-2">+ Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
