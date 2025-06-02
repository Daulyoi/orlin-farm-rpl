@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="main-container">
        <aside class="sidebar">
            <button class="btn btn--secondary sidebar__btn">Profil</button>
            <button class="btn btn--primary sidebar__btn">Riwayat Pemesanan</button>
        </aside>

        <section class="profile">
            <div class="profile__header">
                <img src="{{ asset('DummyImg.jpg') }}" alt="Foto User" class="user-photo">
                <h1>Selamat datang, {{ currentPelanggan()->nama }}</h1>
            </div>
            <form class="profil__form">
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