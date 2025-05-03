<h1>Detail Pembayaran</h1>

<p>Metode: {{ $pembayaran->metode }}</p>
<p>Jumlah: Rp{{ number_format($pembayaran->jumlah) }}</p>
<p>Tanggal: {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y H:i') }}</p>
<p>Status: {{ $pembayaran->status }}</p>

<p>Pemesanan:
    @if ($pembayaran->pemesanan)
        #{{ $pembayaran->pemesanan->id }} ({{ $pembayaran->pemesanan->status }})
    @else
        <em>Tidak tersedia</em>
    @endif
</p>

<p>Admin Verifikasi:
    @if ($pembayaran->admin)
        {{ $pembayaran->admin->nama }}
    @else
        Belum diverifikasi
    @endif
</p>

<p>Bukti Pembayaran:</p>
@if ($pembayaran->bukti)
    <img src="{{ asset('storage/' . $pembayaran->bukti) }}" alt="Bukti Pembayaran" style="max-width:300px;">
@else
    <p><em>Belum ada bukti</em></p>
@endif

<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>