<nav class="navbar">
    <div class="navbar__container">
        <div class="navbar__brand" onclick="window.location.href='{{ route('home') }}'">
            <img src="/images/OrlinFarm.png" alt="Logo Orlin Farm" class="navbar__logo">
            <span class="navbar__title">Orlin Farm</span>
        </div>
        
        <ul class="navbar__menu">
            @if (currentPelanggan())
                <li class="navbar__item">
                    <a href="{{ route('pelanggan.profile') }}" class="navbar__link">Profil</a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('pelanggan.keranjang.index') }}" class="navbar__link navbar__link--cart">
                        Keranjang
                        @if(currentPelanggan()->keranjangs->count() > 0)
                            <span class="navbar__badge">{{ currentPelanggan()->keranjangs->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('pelanggan.pemesanan.index') }}" class="navbar__link">Pesanan</a>
                </li>
                <li class="navbar__item">
                    <form action="{{ route('pelanggan.logout') }}" method="POST" class="navbar__form">
                        @csrf
                        <button type="submit" class="navbar__logout-btn">Logout</button>
                    </form>
                </li>
            @endif
    
            @if (!currentPelanggan())
                <li class="navbar__item">
                    <a href="{{ route('pelanggan.login.form') }}" class="navbar__link">Masuk</a>
                </li>
                <li class="navbar__item">
                    <a href="{{ route('pelanggan.register.form') }}" class="navbar__link navbar__link--primary">Daftar</a>
                </li>
            @endif
    
            @if (Auth::guard('admin')->check())
                <li class="navbar__item">
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="navbar__link navbar__link--admin">Dashboard</a>
                </li>
                <li class="navbar__item">
                    <form action="{{ route('filament.admin.auth.logout') }}" method="POST" class="navbar__form">
                        @csrf
                        <button type="submit" class="navbar__logout-btn navbar__logout-btn--admin">Logout</button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
</nav>