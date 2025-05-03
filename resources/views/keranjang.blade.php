<div class="container">
    <h1>Keranjang Saya</h1>
    @if($itemKeranjangs->count())
        <ul>
            @foreach($itemKeranjangs as $item)
                <li>
                    <p>Jenis : {{ $item->hewanQurban->jenis }}</p>
                    <p>Bobot : {{ $item->hewanQurban->bobot }}</p>
                    <p>Harga : Rp{{ number_format($item->hewanQurban->harga) }}</p>
                    <form method="POST" action="{{ route('pelanggan.keranjang.delete', $item->id) }}" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <form method="POST" action="{{ route('pelanggan.pemesanan.create') }}">
            @csrf
            <button type="submit">Buat Pemesanan</button>
        </form>
    @else
        <p>Keranjang kosong.</p>
    @endif
</div>