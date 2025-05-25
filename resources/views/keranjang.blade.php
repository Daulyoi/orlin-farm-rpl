<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="keranjang.css">
    <title>Keranjang</title>
    <link rel="stylesheet" href="/css/keranjang.style.css">
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
