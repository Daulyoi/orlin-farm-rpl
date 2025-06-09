@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="main-container">
        {{-- <aside class="panel" style="max-width: 20%;">
            <a class="btn btn--primary sidebar__btn" href="{{ route('pelanggan.profile') }}">Profil</a>
            <a class="btn btn--secondary sidebar__btn" href="{{ route('pelanggan.pemesanan.index') }}">Riwayat Pemesanan</a>
        </aside> --}}

        <section class="panel">
            <div class="profile__header flex" style="flex-direction: row; align-items: center;">
                <img src="https://avatar.iran.liara.run/public?username={{ currentPelanggan()->id }}" alt="Foto User" class="user-photo" width="100" height="100">
                <h1>Selamat datang, {{ currentPelanggan()->nama }}</h1>
                <form action="{{ route('pelanggan.logout') }}" method="POST" class="navbar__form">
                    @csrf
                    <button type="submit" class="profile__logout">Logout</button>
                </form>

            </div>
            <form class="profil__form" action="{{ route('pelanggan.profile.update') }}" method="POST">
                @csrf
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', currentPelanggan()->nama) }}" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', currentPelanggan()->email) }}" required>

                <label for="telepon">Nomor Telepon</label>
                <input type="text" id="telepon" name="no_telp" value="{{ old('no_telp', currentPelanggan()->no_telp) }}" required>

                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="{{ old('alamat', currentPelanggan()->alamat ?? '') }}">

                <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password Baru">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru">
                </div>

                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </form>
        </section>
    </div>
@endsection
