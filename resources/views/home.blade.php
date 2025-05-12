<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    @if (!currentPelanggan())
        <a href="{{ route('pelanggan.register') }}">Register</a>
        <a href="{{ route('pelanggan.login') }}">Login</a>
        <a href="{{ route('filament.admin.auth.login') }}">Admin</a>
    @endif

    @if (Auth::guard('admin')->check())
        <p> Hai Admin!</p>
        <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        <a href="{{ route('admin.logout') }}">Logout</a>
    @endif

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if (currentPelanggan())
        <h2>Hai {{ currentPelanggan()->nama }}</h2>
        <a href="{{ route('pelanggan.keranjang') }}">Keranjang</a>
        <a href="{{ route('pelanggan.pemesanan') }}">Pemesanan</a>
        <a href="{{ route('pelanggan.pembayaran') }}">Pembayaran</a>
        <form action="{{ route('pelanggan.logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endif

    <hr>

    <form method="GET" action="{{ url()->current() }}">
        <input type="text" name="search" placeholder="Cari jenis, lokasi, deskripsi" value="{{ request('search') }}">

        <select name="kelamin">
            <option value="">--Kelamin--</option>
            <option value="Jantan" {{ request('kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
            <option value="Betina" {{ request('kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
        </select>

        <select name="sort_by">
            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
            <option value="harga" {{ request('sort_by') == 'harga' ? 'selected' : '' }}>Harga</option>
            <option value="bobot" {{ request('sort_by') == 'bobot' ? 'selected' : '' }}>Bobot</option>
        </select>

        <select name="sort_order">
            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>↓ Desc</option>
            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>↑ Asc</option>
        </select>

        <button type="submit">Terapkan</button>
    </form>

    <hr>

    @if (!$hewanQurbans->isEmpty())
        <h2>Hewan Qurban</h2>
        @foreach ($hewanQurbans as $hewanQurban)
            <div style="margin-bottom: 20px;">
                <h3>{{ $hewanQurban->nama }}</h3>
                <p>Jenis: {{ $hewanQurban->jenis }}</p>
                <p>Bobot: {{ $hewanQurban->bobot }}</p>
                <p>Harga: {{ number_format($hewanQurban->harga) }}</p>
                <p>Deskripsi: {{ $hewanQurban->deskripsi }}</p>
                <p>Lokasi: {{ $hewanQurban->lokasi }}</p>

                <form method="POST" action="{{ route('pelanggan.keranjang.add') }}">
                    @csrf
                    <input type="hidden" name="id_hewan" value="{{ $hewanQurban->id }}">
                    <button type="submit">Tambahin ke Keranjang</button>
                </form>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div>
            {{ $hewanQurbans->appends(request()->query())->links() }}
        </div>
    @else
        <p>Tidak ada hewan qurban tersedia.</p>
    @endif
</body>
</html>
