@extends('layouts.app')
@section('title', 'Keranjang')

@section('content')
    <div class="main-container">
        <section class="keranjang-section">
            <div class="keranjang-container">
                <div class="products__grid" id="productsGrid">
                    @if($keranjang->count())
                        @foreach($keranjang as $item)
                            @include('pelanggan.keranjang.parts.item', ['item' => $item])
                        @endforeach
                    @else
                        <div class="products__empty panel" style="grid-column: 1 / -1;">
                            <div class="products__empty-icon">🛒</div>
                            <h3 class="products__empty-title">Keranjang Anda kosong</h3>
                            <p class="products__empty-text">
                                Belum ada produk yang ditambahkan ke keranjang. Silakan lihat produk kami dan tambahkan ke
                                keranjang.
                            </p>
                            <a href="{{ route('home') }}" class="btn btn--primary">Lihat Produk</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @php
            $total = 0;
        @endphp
        @if($keranjang->count())
            <section class="flex flex--column" style="width: 30%; gap: var(--spacing-md); ">
                <section class="panel">
                    <div class="cart-items">
                        <p><strong>Barang :</strong></p>
                        <ul class="list-container">
                            @foreach(currentPelanggan()->keranjangs as $item)
                                <li>
                                    <div>{{ $item->hewanQurban->jenis }}</div>
                                    <div>Rp{{ number_format($item->hewanQurban->harga) }}</div>
                                </li>
                                @php
                                    $total += $item->hewanQurban->harga;
                                @endphp
                            @endforeach
                        </ul>
                    </div>
                    <p class="flex flex--between"><strong>Total :</strong> Rp{{ number_format($total) }}</p>
                </section>
                <section class="panel">
                    <form method="POST" action="{{ route('pelanggan.pemesanan.store') }}">
                        @csrf
                        <section class="list-container flex" style="width: 100%;">
                            <div class="form__group">
                                <label for="nama">Nama :</label>
                                <input class="form-border" type="text" id="nama" name="nama" placeholder="Masukkan Nama"
                                    value="{{ currentPelanggan()->nama ?? '' }}">
                            </div>

                            <div class="form__group">
                                <label for="alamat">Alamat :</label>
                                <input class="form-border" type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat"
                                    value="{{ currentPelanggan()->alamat ?? '' }}" required>
                            </div>
                            <div class="form__group">
                                <label for="telepon">No. Telp :</label>
                                <input class="form-border" type="tel" id="telepon" name="no_telp" placeholder="08xxxxxxxxxx"
                                    value="{{ currentPelanggan()->no_telp ?? '' }}">
                            </div>
                            <button class="btn btn--primary" type="submit" style="margin-top: var(--spacing-xl);">
                                Pesan Hewan Qurban
                            </button>
                        </section>
                    </form>
                </section>
            </section>
        @endif
    </div>
@endsection