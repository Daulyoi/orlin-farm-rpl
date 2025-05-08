<h1>Daftar Pemesanan</h1>
<hr>
<form method="GET" action="{{ route('pelanggan.pemesanan') }}">
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="">-- Semua --</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
    </select>

    <label for="sort_by">Urut Berdasarkan:</label>
    <select name="sort_by" id="sort_by">
        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal</option>
        <option value="jumlah" {{ request('sort_by') == 'jumlah' ? 'selected' : '' }}>Jumlah</option>
    </select>

    <label for="sort_order">Urutan:</label>
    <select name="sort_order" id="sort_order">
        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>↓ Desc</option>
        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>↑ Asc</option>
    </select>

    <label for="date_from">Dari Tanggal:</label>
    <input type="date" name="date_from" value="{{ request('date_from') }}">

    <label for="date_to">Sampai Tanggal:</label>
    <input type="date" name="date_to" value="{{ request('date_to') }}">

    <button type="submit">Terapkan</button>
</form>
<hr>
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