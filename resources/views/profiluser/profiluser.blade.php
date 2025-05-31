<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="UserProfil.css">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="/css/profiluser/profiluser.style.css">
</head>
<body>
    <x-header></x-header>

    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <button class="sidebar-button">Profil</button>
            <button class="sidebar-button">Riwayat Pemesanan</button>
        </aside>

        <div class="vertical-divider"></div>

        <section class="profil-section">
            <div class="profil-header">
                <img src="pfp-removebg-preview.png" alt="Foto User" class="user-photo">
                <h1>Selamat datang, Daffa Naufal Shahbaz Fadillah!</h1>
            </div>
            <form class="profil-form">
                <label for="nama">Nama</label>
                <input type="text" id="nama" value="Daffa Naufal Shahbaz Fadillah">

                <label for="email">Email</label>
                <input type="email" id="email" value="daffanaufalshahbazfadillah69420@gmail.com">

                <label for="telepon">Nomor Telepon</label>
                <input type="text" id="telepon" value="081231231234">

                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" value="Jl. Babakan Raya No.4, Babakan, Kec. Dramaga, Kabupaten Bogor, Jawa Barat">

                <label for="password-lama">Password</label>
                <div class="password-container">
                    <input type="password" id="password-lama" placeholder="Password Lama">
                    <input type="password" id="password-baru" placeholder="Password Baru">
                </div>

                <button type="submit" class="save-button">Simpan Perubahan</button>
            </form>
        </section>
    </div>
</body>
</html>
