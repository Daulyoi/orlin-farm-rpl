<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="keranjang.css">
    <title>Keranjang</title>
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
        background-color: #009fe3; 
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
        justify-content: space-between;
        margin: 20px;
    }

    /* Keranjang Section */
    .keranjang-section {
        width: 63%; /* Lebar bagian keranjang */
    }

    .keranjang-section h2 {
        margin-bottom: 20px; /* Jarak vertikal antara judul dan kotak keranjang */
    }

    .keranjang-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .keranjang-card {
        border: 1px solid #000;
        background-color: white;
        padding: 10px;
        width: calc(50% - 10px); /* Dua kartu dalam satu baris */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .keranjang-img {
        background-color: #009fe3;
        color: white;
        text-align: center;
        padding: 10px;
        margin-bottom: 10px;
    }

    .keranjang-quantity {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .quantity-button {
        background-color: #009fe3;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 4px; /* Membuat tombol lebih halus */
    }

    /* Ringkasan Section */
    .ringkasan-section {
        width: 35%; /* Lebar bagian ringkasan */
        border: 1px solid #000;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .ringkasan-section h2 {
        margin-bottom: 30px; /* Jarak vertikal antara judul dan kotak ringkasan */  
        margin-top: -5px;
    }

    .ringkasan-card {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 50px;
        background-color: #f9f9f9;
        display: flex;
        justify-content: space-between;
    }

    .pesan-button {
        background-color: #009fe3;
        color: white;   
        border: none;
        padding: 10px;
        width: 100%;
        cursor: pointer;
        font-size: 16px;
        border-radius: 4px; /* Membuat tombol lebih halus */
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
        <!-- Keranjang Section -->
        <section class="keranjang-section">
            <h2>Keranjang</h2>
            <div class="keranjang-container">
                <div class="keranjang-card">
                    <div class="keranjang-img"><img src="sapi.jpg" alt=""></div>
                    <p>Deskripsi hewan qurban jenis 1</p>
                    <div class="keranjang-quantity">
                        <button class="quantity-button">-</button>
                        <span>1</span>
                        <button class="quantity-button">+</button>
                    </div>
                </div>
                <div class="keranjang-card">
                    <div class="keranjang-img"><img src="kambing.jpg" alt=""></div>
                    <p>Deskripsi hewan qurban jenis 2</p>
                    <div class="keranjang-quantity">
                        <button class="quantity-button">-</button>
                        <span>1</span>
                        <button class="quantity-button">+</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="ringkasan-section">
            <h2>Ringkasan</h2>
            <div class="ringkasan-card">
                <p>Kuantitas total hewan qurban yang dimasukkan ke dalam keranjang</p>
            </div>
            <div class="ringkasan-card">
                <p>Harga total hewan qurban yang dimasukkan ke dalam keranjang</p>
            </div>
            <button class="pesan-button">Pesan Hewan Qurban</button>
        </section>
    </div>
</body>
</html>