<h1>Daftar Pemesanan</h1>
<ul>
    @foreach ($pemesanans as $pemesanan)
        <li>
            @php
                $jumlah = 0;
                foreach ($pemesanan->itemPemesanans as $item) {
                    $hargaHewan = $item->hewanQurban->harga;
                    $jumlah += $hargaHewan;
                }
            @endphp
            <a href="{{ route('pelanggan.pemesanan.detail', $pemesanan->id) }}">
                Pemesanan #{{ $pemesanan->id }} - {{ $pemesanan->status }} - Rp{{ number_format($jumlah) }}
            </a>
        </li>
    @endforeach
</ul>