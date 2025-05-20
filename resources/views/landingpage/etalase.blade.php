<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Etalase</title>
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
  
  /* ========== HEADER ========== */
  header {
    background-color: #009fe3; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 1px;
    color: white;
  }
  
  /* === Logo Orlin Farm di kiri atas === */
  .logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: 20px;  /* jarak logo ke kiri */
  }
  
  .logo img {
    width: 40px;
    height: 40px;
  }
  
  .logo span {
    font-size: 20px;
    font-weight: bold; 
  }
  
  /* Menu navigasi kanan atas */
  nav ul {
    list-style: none;
    display: flex;
    gap: 30px;
    margin-right: 20px;
  }
  
  nav a {
    color: white;
    text-decoration: none;
    margin-right: 30px;
  }
  
  /* Filter Section */
  .filter-section {
    margin: 20px; 
  }
  
  .filter-section h2 {
    display: inline-block;
    margin-right: 10px;
  }
  
  .filter-controls {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    margin-right: -15px; 
  }
  
  .filter-controls select {
    padding: 12px 2px;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    cursor: pointer;
    margin-right: 1px;
    margin-bottom: 1px; /* jarak ke kiri */
    text-align: center;
  }
  
  .filter-controls button {
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #ccc;
    cursor: pointer;
    padding: 10px 10px;
    font-size: 20px;
  }
  
  /* Product Grid */
  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 40px;
    padding: 25px;
  }
  
  /* Kartu produk */
  .product-card {
    border: 1px solid #000;
    display: flex;
    flex-direction: column;
    background-color: white;
  }
  
  /* Bagian atas kartu (foto) */
  .product-img {
    background-color: #009fe3;
    color: white;
    text-align: center;
  }
  
  /* Bagian info produk */
  .product-info {
    padding: 10px;
    background-color: #f5f5f5;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  /* Tombol tambah ke keranjang */
  .product-info button {
    margin-top: 8px;
    padding: 10px;
    background-color: #009fe3;
    color: white;
    border: none;
    cursor: pointer;
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
      <a href="#">Tabungan Qurban</a>
      <a href="#">Masuk</a>
      <a href="#">Daftar</a>
    </nav>
  </header>

  <section class="filter-section">
    <h2>Urutkan berdasarkan</h2>
    <div class="filter-controls">
      <select id="filter-kategori">
        <option value="harga">Harga</option>
        <option value="bobot">Bobot</option>
      </select>
      <button id="sort-asc">↑</button>
      <button id="sort-desc">↓</button>
    </div>
  </section>

  <main class="product-grid">
    <!-- Ulangi blok ini untuk setiap produk -->
    <div class="product-card">
      <div class="product-img"><img src="sapi.jpg" alt="" srcset=""></div>
      <div class="product-info">
      <p>Hewan Qurban Jenis 1</p>
      <p>Harga per 1 Ekor</p>
      <p>Bobot (Rentang)</p>
      <button>Tambahkan ke Keranjang</button>
    </div>
  </div>
  <div class="product-card">
    <div class="product-img"><img src="kambing.jpg" alt=""></div>
      <div class="product-info">
      <p>Hewan Qurban Jenis 2</p>
      <p>Harga per 1 Ekor</p>
      <p>Bobot (Rentang)</p>
      <button>Tambahkan ke Keranjang</button>
    </div>
  </div>
  <div class="product-card">
    <div class="product-img"><img src="domba.jpg" alt=""></div>
    <div class="product-info">
      <p>Hewan Qurban Jenis 3</p>
      <p>Harga per 1 Ekor</p>
      <p>Bobot (Rentang)</p>
      <button>Tambahkan ke Keranjang</button>
      </div>
    </div>
  </main>
</body>
</html>
