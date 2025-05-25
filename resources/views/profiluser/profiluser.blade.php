<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="UserProfil.css">
    <title>Profil Pengguna</title>
    <style>
     /* Global Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Header */
    header {
        background-color: #009fe3; /* Warna biru header */
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        color: white;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo img {
        width: 40px;
        height: 40px;
    }

    .logo span {
        font-size: 20px;
        font-weight: bold; 
    }

    nav a {
        color: white;
        text-decoration: none;
        margin-right: 20px;
    }

    /* Main Container */
    .main-container {
        display: flex;
        margin: 20px;
        gap: 20px;
    }

    /* Sidebar */
    .sidebar {
        width: 20%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .sidebar-button {
        background-color: #f9f9f9; /* Warna latar tombol sidebar */
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
        cursor: pointer;
        font-size: 16px;
        border-radius: 4px;
    }

    .sidebar-button:hover {
        background-color: #e0e0e0; /* Warna hover tombol sidebar */
    }

    /* Vertical Divider */
    .vertical-divider {
        width: 1px;
        background-color: #000; /* Warna garis pemisah */
        height: auto;
    }

    /* Profil Section */
    .profil-section {
        width: 95%;
    }

    .profil-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .user-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%; /* Membuat foto berbentuk lingkaran */
        border: 2px solid #ccc; /* Garis tepi foto */
    }

    .profil-section h1 {
        font-size: 24px;
    }

    .profil-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .profil-form label {
        font-size: 14px;
        font-weight: bold;
    }

    .profil-form input,
    .profil-form textarea {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .profil-form textarea {
        resize: none;
        height: 30px;
    }

    .password-container {
        display: flex;
        gap: 10px;
        margin-bottom: 5px;
    }

    .password-container input {
        flex: content;
    }

    .save-button {
        background-color: #009fe3; /* Warna biru tombol simpan */
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
    }

    .save-button:hover {
        background-color: #007bb5; /* Warna hover tombol simpan */
    }   
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Logo Orlin Farm.png" alt="Logo Orlin Farm">
            <span>Orlin Farm</span>
        </div>
        <nav>
            <a href="#">Profil</a>
            <a href="#">Masuk</a>
            <a href="#">Daftar</a>
        </nav>
    </header>

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
                <textarea id="alamat">Jl. Babakan Raya No.4, Babakan, Kec. Dramaga, Kabupaten Bogor, Jawa Barat</textarea>

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