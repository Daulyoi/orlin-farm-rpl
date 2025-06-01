@extends('layouts.app')
@section('title', 'Keranjang')

@section('content')
    <div class="main-container">
        <section class="keranjang-section">
            <h2>Keranjang</h2>
            <div class="keranjang-container">
                @if($keranjang->count())
                    <div class="products__grid" id="productsGrid">
                        @foreach($keranjang as $item)
                            @include('pelanggan.keranjang.parts.item', ['item' => $item])
                        @endforeach
                    </div>
                @else
                    <p>Keranjang Anda kosong.</p>
                @endif
            </div>
        </section>
        
        <section class="panel">
            <h2>Ringkasan</h2>
            <div class="cart-items">
                <p><strong>Barang :</strong></p>
                @php
                    $total = 0;
                    @endphp
                @if($keranjang->count())
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
                @else
                    <p>Tidak ada barang di keranjang</p>
                @endif
            </div>
        
            <p class="flex flex--between"><strong>Total :</strong> Rp{{ number_format($total) }}</p>
            <button class="btn btn--primary" onclick="window.location.href='{{ route('pelanggan.pemesanan.create') }}'">
                Pesan Hewan Qurban
            </button>
        </section>
    </div>
@endsection
