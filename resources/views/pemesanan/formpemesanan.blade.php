<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orlin Farm - Form Pemesanan</title>
  <link rel="stylesheet" href="pemesanan.css">
</head>
<body>

  <!-- HEADER SAMA PERSIS DENGAN LOGIN -->
  <header>
    <div class="logo">
      <img src="OrlinFarm.png" alt="Logo Orlin Farm">
    </div>
    <nav>
      <a href="#">Profil</a>
      <a href="#">Tabungan Qurban</a>
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
          <div class="payment-method">
            <span>🕌 Tabungan Qurban</span>
            <span class="saldo">Saldo: Rp. ---</span>
          </div>
        </div>

        <div class="payment-box">
          <div class="payment-method">💳 E-wallet</div>
          <div class="icon-row">
            <!-- Tambahkan ikon sesuai kebutuhan -->
            <img src="e-wallet/dana.png" alt="Dana">
            <img src="e-wallet/qris.png" alt="QRIS">
            <img src="e-wallet/ovo.png" alt="OVO">
            <img src="e-wallet/shopeepay.png" alt="ShopeePay">
            <img src="e-wallet/gopay.png" alt="Gopay">
          </div>
        </div>

        <div class="payment-box">
          <div class="payment-method">🏦 Transfer Bank</div>
          <div class="icon-row">
            <img src="bank/mandiri.png" alt="Mandiri">
            <img src="bank/bsi.png" alt="BSI">
            <img src="bank/bca.png" alt="BCA">
            <img src="bank/bni.png" alt="BNI">
            <img src="bank/cimb.png" alt="CIMB">
            <img src="bank/bri.png" alt="BRI">
            <img src="bank/danamon.png" alt="Danamon">
          </div>
        </div>

        <div class="payment-box">
          <div class="payment-method">🏛️ Bank Digital</div>
          <div class="icon-row">
            <img src="digital/superbank.png" alt="Superbank">
            <img src="digital/blu.png" alt="Blu">
            <img src="digital/seabank.png" alt="Seabank">
            <img src="digital/jago.png" alt="Jago">
          </div>
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
