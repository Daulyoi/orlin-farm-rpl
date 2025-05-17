<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Etalase</title>
  <link rel="stylesheet" href="etalase.css">
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
