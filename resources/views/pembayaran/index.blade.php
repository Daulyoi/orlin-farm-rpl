<h1>Daftar Pembayaran</h1>
<ul>
    @foreach ($pembayarans as $pembayaran)
        <li>
            <a href="{{ route('pelanggan.pembayaran.detail', $pembayaran->id) }}">
                Pembayaran #{{ $pembayaran->id }} - {{ $pembayaran->status }} - Rp{{ number_format($pembayaran->jumlah) }}
            </a>
        </li>
    @endforeach
</ul>