@extends('layouts.main')
@section('title', 'SIBOOK | Keranjang Belanja')
@section('content')
    <!-- tampilan cart -->
    <div class="row my-3">
        <h2 class="text-center mb-3">Keranjang Belanjamu</h2>
        @if ($cart)
            <form action="/checkout" method="post">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="table-responsive my-3 shadow bg-white" style="overflow: hidden; border-radius: 10px">
                            <table class="table table-striped table-hover">
                                <thead style="background-color: blanchedalmond">
                                    <tr>
                                        <th></th>
                                        <th>Cover</th>
                                        <th>Judul Buku</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $ci)
                                        <tr class="align-middle">
                                            <td class="text-center">
                                                <input type="checkbox" name="beli[]" class="form-check-input item-checkbox"
                                                    value="{{ $ci->cartItems_id }}"
                                                    data-harga="{{ $ci->harga * $ci->jumlah }}"
                                                    style="transform: scale(1.3);" onchange="hitungSubtotal()">
                                            </td>
                                            <td><img src="{{ asset($ci->buku->gambar) }}" alt="{{ $ci->buku->judul }}"
                                                    width="40em" />
                                            </td>
                                            <td>{{ $ci->buku->judul }}</td>
                                            <td>Rp. {{ number_format($ci->harga, 0, ',', '.') }}</td>
                                            <td>
                                                <a href="/cart/minus/{{ $ci->cartItems_id }}"
                                                    class="btn btn-outline-danger btn-sm me-1" style="width: 2em">-</a>
                                                <span>{{ $ci->jumlah }}</span>
                                                <a href="/cart/plus/{{ $ci->cartItems_id }}"
                                                    class="btn btn-outline-success btn-sm ms-1" style="width: 2em">+</a>
                                            </td>
                                            <td>Rp. {{ number_format($ci->harga * $ci->jumlah, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- total  -->
                    <div class="col">
                        <div class="my-3 pb-3 shadow bg-white" style="border-radius: 10px; overflow: hidden">
                            <h6 class="py-2 fw-bold ps-3 border-bottom border-dark"
                                style="background-color: blanchedalmond">
                                Total Pembayaran
                            </h6>
                            <table class="table border-light ms-3" style="width: 80%">
                                <tr style="height: 4em" class="align-middle">
                                    <td>Subtotal</td>
                                    <td>
                                        Rp.
                                        <span id="subtotal-display">0</span>
                                    </td>
                                </tr>
                                <tr style="height: 4em" class="align-middle">
                                    <td>Diskon</td>
                                    <td>Rp.
                                        <span id="diskon-display">0</span>
                                    </td>
                                </tr>
                                <tr style="height: 4em" class="align-middle">
                                    <td>Total</td>
                                    <td>Rp.
                                        <span id="total-display">0</span>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="total" id="total-hidden" value="0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Lanjut Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="d-flex flex-column align-items-center justify-content-center py-5">
                <img src="{{ asset('icon/empty_cart.png') }}" alt="Keranjang Kosong" style="width:120px; opacity:0.7;">
                <h4 class="mt-4 mb-2 text-secondary">Keranjangmu masih kosong!</h4>
                <p class="mb-3 text-muted">Yuk, temukan buku favoritmu dan mulai belanja sekarang.</p>
                <a href="/promo" class="btn btn-outline-primary px-4 py-2">
                    <i class="bi bi-bag-plus"></i> Belanja Sekarang
                </a>
            </div>
        @endif
    </div>

    <script>
        const diskonPersen = {{ !empty($cart->diskon) ? $cart->diskon->persen : 0 }};

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka).replace('Rp', '').trim();
        }

        function hitungSubtotal() {
            let subtotal = 0;

            document.querySelectorAll('.item-checkbox').forEach(cb => {
                if (cb.checked) {
                    subtotal += parseInt(cb.getAttribute('data-harga'));
                }
            });

            const diskon = subtotal * (diskonPersen / 100);
            const total = subtotal - diskon;

            document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
            document.getElementById('diskon-display').textContent = formatRupiah(diskon);
            document.getElementById('total-display').textContent = formatRupiah(total);
            document.getElementById('total-hidden').value = total;
        }

        document.addEventListener('DOMContentLoaded', hitungSubtotal);
    </script>


@endsection
