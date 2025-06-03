@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="main-container">
        <aside class="panel" style="max-width: 20%;">
            <a class="btn btn--primary sidebar__btn" href="{{ route('pelanggan.profile') }}">Profil</a>
            <a class="btn btn--secondary sidebar__btn" href="{{ route('pelanggan.pemesanan.index') }}">Riwayat Pemesanan</a>
        </aside>

        <section class="panel">
            <div class="profile__header flex" style="flex-direction: row; align-items: center;">
                <img src="https://avatar.iran.liara.run/public?username={{ currentPelanggan()->id }}" alt="Foto User" class="user-photo" width="100" height="100">
                <h1>Selamat datang, {{ currentPelanggan()->nama }}</h1>
            </div>
            <form class="profil__form" action="{{ route('pelanggan.profile.update') }}" method="POST">
                <label for="nama">Nama</label>
                <input type="text" id="nama" value="{{ currentPelanggan()->nama }}">

                <label for="email">Email</label>
                <input type="email" id="email" value="{{ currentPelanggan()->email }}">

                <label for="telepon">Nomor Telepon</label>
                <input type="text" id="telepon" value="{{ currentPelanggan()->no_telp }}">

                <label for="alamat">Alamat</label>
                <input type="text" id="alamat"
                    value="{{ currentPelanggan()->alamat ?? '' }}">

                <label for="password-lama">Password</label>
                <div class="password-container">
                    <input type="password" id="password-lama" placeholder="Password Lama">
                    <input type="password" id="password-baru" placeholder="Password Baru">
                </div>

                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </form>
        </section>
    </div>
@endsection
