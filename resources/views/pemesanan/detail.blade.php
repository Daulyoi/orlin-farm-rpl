@section('content')
<h1>Detail Pemesanan #{{ $pemesanan->id }}</h1>

<p>Status: {{ $pemesanan->status }}</p>
<p>Total: Rp{{ number_format($jumlah) }}</p>

<h3>Daftar Hewan</h3>
<ul>
@foreach ($pemesanan->itemPemesanans as $item)
    <li>{{ $item->hewanQurban->jenis }} - Rp{{ number_format($item->hewanQurban->harga) }}</li>
@endforeach
</ul>

@if ($pemesanan->status != 'cancelled')
    @if ($pemesanan->pembayaran)
        <a href="{{ route('pelanggan.pembayaran.detail',['id_pembayaran' => $pemesanan->pembayaran->id]) }}">lihat pembayaran</a>
    @else
        <form method="POST" action="{{ route('pelanggan.pembayaran.create') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">

            <label for="metode">Metode Pembayaran</label>
            <select name="metode" id="metode" required>
                <option value="">-- Pilih Metode --</option>
                <option value="transfer">Transfer Bank</option>
                <option value="qris">QRIS</option>
            </select>

            <label for="bukti">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti" required>

            <button type="submit">Kirim Pembayaran</button>
        </form>
        <a href="{{ route('pelanggan.pemesanan.cancel', $pemesanan->id) }}"> cancel </a>
    @endif
@endif