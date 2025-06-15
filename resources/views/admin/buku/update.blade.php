<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container py-5 d-flex justify-content-center align-items-center">
        <div class="card shadow" style="width: 50%">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Update Data Buku</h3>
            </div>
            <div class="card-body">
                <form action="/admin/buku/update/{{ $book->buku_id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $book->judul }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $book->penulis }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit"
                            value="{{ $book->penerbit }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                            value="{{ $book->tahun_terbit }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman"
                            value="{{ $book->jumlah_halaman }}" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ $book->harga }}"
                            min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_buku" class="form-label">Jumlah_buku</label>
                        <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="0" min="0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="" disabled>Pilih Kategori</option>
                            <option value="kesehatan" {{ $book->kategori_id == 2 ? 'selected' : '' }}>Kesehatan</option>
                            <option value="teknologi" {{ $book->kategori_id == 1 ? 'selected' : '' }}>Teknologi</option>
                            <option value="kuliner" {{ $book->kategori_id == 4 ? 'selected' : '' }}>Kuliner</option>
                            <option value="pendidikan" {{ $book->kategori_id == 3 ? 'selected' : '' }}>Pendidikan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                            required>{{ $book->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
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
                                    reader.onload = function (e) {
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
                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>