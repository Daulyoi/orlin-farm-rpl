<div class="product-card">
    <div class="product-img">
        {{-- <img src="{{ $hewanQurban->gambar ? asset('storage/' . $hewanQurban->gambar) : '/DummyImg.jpg' }}" alt="{{ $hewanQurban->nama }}"> --}}
        <img src="/DummyImg.jpg" alt="{{ $hewanQurban->jenis }}">
    </div>
    <div class="product-info">
        <div class="text-container">
            <p style="font-weight: 600">{{ $hewanQurban->jenis }}</p>
        </div>
        <div class="text-container">
            <p><img src="/images/dollar.svg" style="height: 25px; margin-right: 5px;"/>Rp. {{ number_format($hewanQurban->harga) }}</p>
        </div>
        <div class="text-container">
            <p><img src="/images/kilogram.svg" style="height: 25px; margin-right: 5px;"/>{{ $hewanQurban->bobot }} kg</p>
        </div>
        <div class="text-container">
            <p class="description"><img src="/images/info.svg" style="height: 25px; margin-right: 5px;"/>{{ $hewanQurban->deskripsi }}</p>
        </div>
        <div class="text-container">
            <p><img src="/images/location-pin.svg" style="height: 25px; margin-right: 5px;"/>{{ $hewanQurban->lokasi }}</p>
        </div>

        <form method="POST" action="{{ route('pelanggan.keranjang.add') }}">
            @csrf
            <input type="hidden" name="id_hewan" value="{{ $hewanQurban->id }}">
            <button type="submit">Tambahkan ke Keranjang</button>
        </form>
    </div>
</div>
