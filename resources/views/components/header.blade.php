<link rel="stylesheet" href="/css/components/header.style.css">
<header>
    <div class="logo" onclick="window.location.href='{{ route('home') }}'">
        <img src="/images/OrlinFarm.png" alt="Logo Orlin Farm">
        <span>Orlin Farm</span>
    </div>
    <nav>
        <ul>
            @if (currentPelanggan())
                <li><a href="#">Profil</a></li>
                <li><a href="{{ route('pelanggan.keranjang') }}">Keranjang</a></li>
                <li>
                    <form action="{{ route('pelanggan.logout') }}" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit">Logout</button>
                    </form>
                </li>

            @endif
            @if (!currentPelanggan())
                <li><a href="{{ route('pelanggan.login') }}">Masuk</a></li>
                <li><a href="{{ route('pelanggan.register') }}">Daftar</a></li>
            @endif
            @if (Auth::guard('admin')->check())
                <li><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                <li><a href="{{ route('admin.logout') }}">Logout</a></li>
            @endif
        </ul>
    </nav>
</header>
