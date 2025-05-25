<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orlin Farm - Form Pemesanan</title>
  <link rel="stylesheet" href="/css/formpemesanan/formpemesanan.style.css">
</head>
<body>

  <!-- HEADER SAMA PERSIS DENGAN LOGIN -->
  <header>
    <div class="logo">
      <img src="/images/OrlinFarm.png">
      Orlin Farm
    </div>
    <nav>
      <a href="#">Profil</a>
      <a href="#">Masuk</a>
      <a href="#">Daftar</a>
    </nav>
  </header>

  <!-- KONTEN UTAMA -->
  <main class="container">
    <section class="form-area">
      <div class="form-group">
        <label for="nama">Nama :</label>
        <input type="text" id="nama" placeholder="Masukkan Nama">
      </div>

      <div class="form-group">
        <label for="alamat">Alamat :</label>
        <input type="text" id="alamat" placeholder="Masukkan Alamat">
      </div>

      <div class="form-group">
        <label for="telepon">No. Telp :</label>
        <input type="tel" id="telepon" placeholder="08xxxxxxxxxx">
      </div>

      <div class="payment-section">
        <h3>Metode Pembayaran</h3>

        <div class="payment-box">
          <div class="payment-method"> QRIS </div>
          <div class="icon-row">
          <img src="images/Qris.png">
          </div>
        </div>


        <div class="payment-box">
          <div class="payment-method">🏦 Transfer Bank</div>
          <div class="icon-row">
            <img src="images/Mandiri.png" alt="Mandiri">
            <img src="images/BSI.png" alt="BSI">
            <img src="images/BCA.png" alt="BCA">
            <img src="images/BNI.png" alt="BNI">
            <img src="images/BRI.png" alt="BRI">
          </div>
        </div>

    </section>

    <aside class="checkout-box">
      <h2>Checkout</h2>
      <p><strong>Pembayaran :</strong> -</p>
      <p><strong>Barang :</strong> -</p>
      <p><strong>Total :</strong> -</p>
      <button type="submit">Bayar</button>
    </aside>
  </main>

</body>
</html>
