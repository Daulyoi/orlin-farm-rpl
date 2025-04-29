<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Home</h1>

    @if (!session('pelanggan_id'))
    <a href="{{ route('pelanggan.register') }}">Register</a>
    <a href="{{ route('pelanggan.login') }}">Login</a>
    <a href="{{ route('admin.login') }}">Admin</a>
    @endif

    @if (session('admin_id'))
        <p> Hai Admin!</p>
        <a href="{{ route('admin.dashboard') }}">dashboard admin</a>
        <a href="{{ route('admin.logout') }}">Logout</a>
    @endif

    <br>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>

    @endif

    @if (currentPelanggan())
    <h2>hai {{ currentPelanggan()->nama }}</h2>
    <form action="{{ route('pelanggan.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @endif

    @if (!$hewanQurbans->isEmpty())
        <h2>Hewan Qurban</h2>
        @foreach ($hewanQurbans as $hewanQurban)
            <br>
            <div>
                <h2>{{ $hewanQurban->nama }}</h2>
                <p>Jenis: {{ $hewanQurban->jenis }}</p>
                <p>Bobot: {{ $hewanQurban->bobot }}</p>
                <p>Harga: {{ $hewanQurban->harga }}</p>
                <p>Status: {{ $hewanQurban->status }}</p>
                <p>Deskripsi: {{ $hewanQurban->deskripsi }}</p>
                <p>Lokasi: {{ $hewanQurban->lokasi }}</p>
        @endforeach
    @endif
</body>
</html>
