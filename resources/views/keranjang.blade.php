<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="/css/keranjang.style.css">
</head>

<body>
    <x-header></x-header>
    <div class="main-container">
        <!-- Keranjang Section -->
        <section class="keranjang-section">
            <h2>Keranjang</h2>
            <div class="keranjang-container">
                @if($itemKeranjangs->count())
                    @foreach($itemKeranjangs as $item)
                        <div class="keranjang-card">
                            <div class="keranjang-img"><img src="" alt=""></div>
                            <p>Deskripsi hewan qurban jenis 1</p>
                            <p>Jenis : {{ $item->hewanQurban->jenis }}</p>
                            <p>Bobot : {{ $item->hewanQurban->bobot }}</p>
                            <p>Harga : Rp{{ number_format($item->hewanQurban->harga) }}</p>
                            <form method="POST" action="{{ route('pelanggan.keranjang.delete', $item->id) }}"
                                class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>Keranjang Anda kosong.</p>
                @endif
            </div>
        </section>

        <section class="ringkasan-section">
            <h2>Ringkasan</h2>
            <div class="cart-items">
                <p><strong>Barang :</strong></p>
                @php
                    $total = 0;
                  @endphp

                @if(currentPelanggan()->keranjangs->count() > 0)
                    <ul style="list-style: none; padding: 0; margin-top: 10px;">
                        @foreach(currentPelanggan()->keranjangs as $item)
                            <li
                                style="margin-bottom: 10px; padding: 8px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
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

            <p><strong>Total :</strong> Rp{{ number_format($total) }}</p>
            <button class="pesan-button" onclick="window.location.href='{{ route('pelanggan.formpemesanan') }}'">
                Pesan Hewan Qurban
            </button>
        </section>
    </div>
</body>

</html>