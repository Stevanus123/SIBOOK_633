@extends('layouts.admin')
@section('title', 'Admin SIBOOK | Update Buku')
@section('judKonten', 'Update Buku')
@section('content')
    <div class="container-fluid">
        <form action="/admin/buku/update/{{ $book->buku_id }}" method="POST" enctype="multipart/form-data">
            <div class="row border p-3 shadow" style="border-radius: 10px;">
                @csrf
                @method('PUT')
                <div class="col-md-6 mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $book->judul }}"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $book->penulis }}"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $book->penerbit }}"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                        value="{{ $book->tahun_terbit }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman"
                        value="{{ $book->jumlah_halaman }}" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $book->harga }}"
                        min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jumlah_buku" class="form-label">Tambah Jumlah Buku</label>
                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="0"
                        min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($cate as $c)
                            <option value="{{ $c->nama_kategori }}"
                                {{ $c->kategori_id == $book->kategori_id ? 'selected' : '' }}>
                                {{ ucfirst($c->nama_kategori) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="diskon" class="form-label">Diskon</label>
                    <select class="form-select" id="diskon" name="diskon" required>
                        <option value="" disabled selected>Pilih Diskon</option>
                        @foreach ($diskon as $d)
                            <option value="{{ $d->nama_diskon }}"
                                {{ $d->diskon_id == $book->diskon_id ? 'selected' : '' }}>{{ ucfirst($d->nama_diskon) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $book->deskripsi }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    @if ($book->file_buku)
                        <p>File saat ini: <a href="{{ asset($book->file_buku) }}" target="_blank">Lihat file</a></p>
                    @endif
                    <label for="file_buku" class="form-label">File Buku (PDF)</label>
                    <input type="file" class="form-control" id="file_buku" name="file_buku" accept=".pdf">
                </div>
                <div class="col-md-6 mb-3">
                    {{-- Tampilkan gambar lama --}}
                    @if ($book->gambar)
                        <div class="mb-2">
                            <span>Gambar saat ini:</span><br>
                            <img src="{{ asset($book->gambar) }}" alt="Gambar Lama" class="img-fluid"
                                style="max-height: 200px;">
                            <div class="small text-secondary mt-1">{{ basename($book->gambar) }}</div>
                        </div>
                    @else
                        <label for="gambar" class="form-label">Gambar</label>
                    @endif
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*"
                        onchange="previewImage(event)">
                    {{-- Preview gambar baru --}}
                    <img id="preview" src="#" alt="Preview Gambar" class="img-fluid mt-2"
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
                <div class="gap-2 my-3 text-end">
                    <button type="submit" class="btn btn-primary w-25 py-2">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
