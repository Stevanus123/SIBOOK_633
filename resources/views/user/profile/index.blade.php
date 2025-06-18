@extends('layouts.main')
@section('title', 'SIBOOK | Profile')
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
                    <h4>{{ $user->nama }}</h4>
                    <p class="text-muted">{{ $user->username }}</p>
                    <p class="mt-2"><strong>💰 Saldo:</strong> Rp. {{ number_format($user->saldo, 0, ',', '.') }}
                    </p>

                    <div class="mt-3">
                        <!-- Button Modal Top Up Saldo -->
                        <a href="#" class="btn btn-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#topupModal">💸 Top Up Saldo</a>

                        <!-- Modal Top Up Saldo -->
                        <div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog">
                                <form action="/profile/topup" method="POST" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="topupModalLabel">Top Up Saldo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label for="nominal_topup" class="form-label">Nominal Top Up</label>
                                            <input type="number" class="form-control" id="nominal_topup" name="jumlah" min="1000" max="200000" required placeholder="Masukkan nominal (max. 200.000)">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alasan_topup" class="form-label">Alasan</label>
                                            <input type="text" class="form-control" id="alasan_topup" name="alasan" required placeholder="Contoh: Isi saldo untuk beli buku">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="resetTopupModal()">Batal</button>
                                        <button type="submit" class="btn btn-primary">Top Up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            function resetTopupModal() {
                                document.getElementById('nominal_topup').value = '';
                                document.getElementById('alasan_topup').value = '';
                            }
                            document.getElementById('topupModal').addEventListener('hidden.bs.modal', resetTopupModal);
                        </script>

                        {{-- Button Modal Edit Profile --}}
                        <a href="#" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">✏️ Edit Profil</a>

                        <!-- Modal Edit Profil -->
                        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog">
                                <form action="/profile/edit" method="POST" enctype="multipart/form-data"
                                    class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3 text-center">
                                            <img id="previewProfileImg" src="{{ asset($user->foto) }}"
                                                class="rounded-circle mb-2" width="100" height="100">
                                            <input type="file" class="form-control mt-2" name="foto" accept="image/*"
                                                onchange="previewProfileImage(event)">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="edit_nama" name="nama"
                                                value="{{ $user->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="edit_email" name="email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_no_telp" class="form-label">No. HP</label>
                                            <input type="tel" class="form-control" id="edit_no_telp" name="no_telp"
                                                value="{{ $user->no_telp }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_desa" class="form-label">Desa Sekarang</label>
                                            <input type="text" class="form-control" id="edit_desa" name="desa"
                                                value="{{ $user->desa }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_kecamatan" class="form-label">Kecamatan Sekarang</label>
                                            <input type="text" class="form-control" id="edit_kecamatan" name="kecamatan"
                                                value="{{ $user->kecamatan }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_kota" class="form-label">Kota Sekarang</label>
                                            <input type="text" class="form-control" id="edit_kota" name="kota"
                                                value="{{ $user->kota }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            onclick="resetEditProfileModal()">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            function previewProfileImage(event) {
                                const reader = new FileReader();
                                reader.onload = function() {
                                    document.getElementById('previewProfileImg').src = reader.result;
                                }
                                if (event.target.files[0]) {
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            }

                            function resetEditProfileModal() {
                                document.getElementById('edit_nama').value = "{{ $user->nama }}";
                                document.getElementById('edit_email').value = "{{ $user->email }}";
                                document.getElementById('edit_no_telp').value = "{{ $user->no_telp }}";
                                document.getElementById('edit_desa').value = "{{ $user->desa }}";
                                document.getElementById('edit_kecamatan').value = "{{ $user->kecamatan }}";
                                document.getElementById('edit_kota').value = "{{ $user->kota }}";
                                document.getElementById('previewProfileImg').src = "{{ asset($user->foto) }}";
                                if (document.querySelector('input[name=foto]')) {
                                    document.querySelector('input[name=foto]').value = '';
                                }
                            }
                            document.getElementById('editProfileModal').addEventListener('hidden.bs.modal', resetEditProfileModal);
                        </script>

                        <!-- Tombol Ganti Password -->
                        <a href="#" class="btn btn-warning w-100 mb-2" data-bs-toggle="modal"
                            data-bs-target="#gantiPassword">🔒 Ganti Password</a>

                        <!-- Modal Ganti Password -->
                        <div class="modal fade" id="gantiPassword" tabindex="-1" aria-labelledby="gantiPasswordModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog">
                                <form action="/profile/gantiPass" method="POST" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="gantiPasswordModalLabel">Ganti Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div class="mb-3">
                                            <label for="pw_bf" class="form-label">Password Lama</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="pw_bf" required
                                                    oninput="debounceCheckOldPassword(this.value)">
                                                <button class="btn btn-warning" type="button"
                                                    onclick="togglePassword('pw_bf', this)">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                            </div>
                                            <small id="pw_bf_feedback" class="text-danger d-none">Password lama
                                                salah!</small>
                                            <script>
                                                let debounceTimeout;

                                                function debounceCheckOldPassword(value) {
                                                    clearTimeout(debounceTimeout);
                                                    debounceTimeout = setTimeout(() => {
                                                        checkOldPassword(value);
                                                    }, 700);
                                                }
                                                async function checkOldPassword(password) {
                                                    if (!password) {
                                                        document.getElementById('pw_bf_feedback').classList.add('d-none');
                                                        return;
                                                    }
                                                    const response = await fetch('/profile/check-password', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({
                                                            password
                                                        })
                                                    });
                                                    const data = await response.json();
                                                    if (data.valid) {
                                                        document.getElementById('pw_bf_feedback').classList.add('d-none');
                                                        document.querySelector('#gantiPassword button[type="submit"]').disabled = false;
                                                    } else {
                                                        document.getElementById('pw_bf_feedback').classList.remove('d-none');
                                                        document.querySelector('#gantiPassword button[type="submit"]').disabled = true;
                                                    }
                                                }
                                            </script>
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_pw" class="form-label">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="new_pw"
                                                    name="new_pw" oninput="cekPwLama(this.value)" required>
                                                <button class="btn btn-warning" type="button"
                                                    onclick="togglePassword('new_pw', this)">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                            </div>
                                            <small id="new_pw_feedback" class="text-danger d-none">Sama dengan password
                                                lama!</small>
                                        </div>
                                        <script>
                                            function cekPwLama(value) {
                                                const pw_bf = document.getElementById('pw_bf').value;
                                                if (value == pw_bf) {
                                                    document.getElementById('new_pw_feedback').classList.remove('d-none');
                                                    document.querySelector('#gantiPassword button[type="submit"]').disabled = true;
                                                } else {
                                                    document.getElementById('new_pw_feedback').classList.add('d-none');
                                                    document.querySelector('#gantiPassword button[type="submit"]').disabled = false;
                                                }
                                            }
                                        </script>
                                        <div class="mb-3">
                                            <label for="new_pw_c" class="form-label">Konfirmasi Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="new_pw_c"
                                                    oninput="cekCon(this.value)" required>
                                                <button class="btn btn-warning" type="button"
                                                    onclick="togglePassword('new_pw_c', this)">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                            </div>
                                            <small id="new_pw_c_feedback" class="text-danger d-none">Password tidak
                                                sama!</small>
                                        </div>
                                        <script>
                                            function cekCon(value) {
                                                const new_pw = document.getElementById('new_pw').value;
                                                if (value == new_pw) {
                                                    document.getElementById('new_pw_c_feedback').classList.add('d-none');
                                                    document.querySelector('#gantiPassword button[type="submit"]').disabled = false;
                                                } else {
                                                    document.getElementById('new_pw_c_feedback').classList.remove('d-none');
                                                    document.querySelector('#gantiPassword button[type="submit"]').disabled = true;
                                                }
                                            }

                                            function togglePassword(inputId, btn) {
                                                const input = document.getElementById(inputId);
                                                const icon = btn.querySelector('i');
                                                if (input.type === "password") {
                                                    input.type = "text";
                                                    icon.classList.remove('bi-eye-fill');
                                                    icon.classList.add('bi-eye-slash-fill');
                                                } else {
                                                    input.type = "password";
                                                    icon.classList.remove('bi-eye-slash-fill');
                                                    icon.classList.add('bi-eye-fill');
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            onclick="resetGantiPasswordModal()">Batal</button>
                                        <script>
                                            function resetGantiPasswordModal() {
                                                document.getElementById('pw_bf').value = '';
                                                document.getElementById('new_pw').value = '';
                                                document.getElementById('new_pw_c').value = '';
                                                document.getElementById('pw_bf_feedback').classList.add('d-none');
                                                document.getElementById('new_pw_feedback').classList.add('d-none');
                                                document.getElementById('new_pw_c_feedback').classList.add('d-none');
                                                document.querySelector('#gantiPassword button[type="submit"]').disabled = false;
                                            }

                                            // Optional: Reset juga saat modal ditutup dengan X
                                            document.getElementById('gantiPassword').addEventListener('hidden.bs.modal', resetGantiPasswordModal);
                                        </script>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="/logout" class="btn btn-danger w-100 mt-4">🚪 Logout</a>
                    </div>
                </div>
            </div>

            {{-- Konten Kanan --}}
            <div class="col-md-8">
                <div class="card shadow p-4 mb-4">
                    <h5 class="mb-3">📄 Informasi Akun</h5>
                    <p><strong>Nama:</strong> {{ $user->nama }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>No. HP:</strong> {{ $user->no_telp ?? '-' }}</p>
                    <p><strong>Alamat:</strong>
                        @if ($user->desa && $user->kecamatan)
                            {{ $user->desa }}, {{ $user->kecamatan }}, {{ $user->kota }}
                        @elseif ($user->kecamatan)
                            {{ $user->kecamatan }}, {{ $user->kota }}
                        @else
                            {{ $user->kota }}
                        @endif
                    </p>
                    <p><strong>Tanggal Bergabung:</strong> {{ $user->created_at->format('d M Y') }}</p>
                </div>

                {{-- Riwayat Pesanan --}}
                <div class="card shadow p-4">
                    <h5 class="mb-3">🛍️ Riwayat Pembelian</h5>
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
                                        <td>Rp. {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                {{-- Daftar buku yang dibeli --}}
                <div class="card shadow p-4 mt-4">
                    <h5 class="mb-3">📚 Buku yang Pernah Dibeli</h5>

                    @if ($books->isEmpty())
                        <p class="text-muted">Belum ada buku yang dibeli.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($books as $book)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $book->judul }}</strong> <br>
                                        <small class="text-muted">oleh {{ $book->penulis }}</small>
                                    </div>
                                    <a href="/profile/buku/{{ Str::slug($book->judul) }}"
                                        class="btn btn-sm btn-outline-primary">Detail</a>
                                </li>
                            @endforeach
                        </ul>
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
