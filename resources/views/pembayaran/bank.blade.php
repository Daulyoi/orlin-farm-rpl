<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Orlin Farm - Pembayaran</title>
  <link rel="stylesheet" href="payment_bank.css" />
  <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
    }

    body {
    background-color: #f4f9ff;
    color: #333;
    }

    /* Header Style */
    header {
    background-color: #3498db;
    color: white;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    }

    .logo img {
    height: 50px;
    width: auto;
    }

    nav {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    }

    nav a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    }

    /* Container */
    .payment-container {
    display: flex;
    justify-content: center;
    padding: 2rem;
    }

    .payment-box {
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    padding: 2rem;
    max-width: 800px;
    width: 100%;
    }

    /* Deadline */
    .deadline {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left: 0;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    }

    .deadline-left {
    display: flex;
    align-items: center;
    gap: 1rem;
    }

    .icon img {
    width: 60px;
    height: 60px;
    }

    .title {
    font-weight: bold;
    font-size: 1rem;
    }

    .date {
    color: #555;
    }

    .countdown {
    font-size: 1.5rem;
    font-weight: bold;
    color: orangered;
    margin-top: 0.5rem;
    }

    /* Bank Info */
    .bank-info {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    }

    .bank-logo {
    width: 60px;
    margin-right: 1rem;
    }

    /* Input */
    label {
    display: block;
    margin-bottom: 0.25rem;
    font-weight: 500;
    }

    .input-group {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    }

    .input-group input {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 6px 0 0 6px;
    outline: none;
    }

    .copy-btn {
    padding: 0.5rem;
    background-color: #eaeaea;
    border: 1px solid #ddd;
    border-left: none;
    border-radius: 0 6px 6px 0;
    cursor: pointer;
    }

    /* Upload */
    .upload-box {
    border: 2px dashed #ccc;
    background-color: #f8f8f8;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 1.5rem;
    }

    .upload-box input[type="file"] {
    display: block;
    margin: 0 auto 0.5rem auto;
    }

    .note {
    font-size: 0.8rem;
    color: #888;
    }

    /* Buttons */
    .buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: space-between;
    }

    .guide-btn, .status-btn {
    padding: 0.6rem 1.2rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    }

    .guide-btn {
    background-color: white;
    border: 1px solid #3498db;
    color: #3498db;
    }

    .status-btn {
    background-color: #3498db;
    border: none;
    color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
    .payment-box {
        padding: 1.5rem;
    }

    .input-group {
        flex-direction: column;
        align-items: stretch;
    }

    .input-group input,
    .copy-btn {
        width: 100%;
        border-radius: 6px;
    }

    .copy-btn {
        margin-top: 0.5rem;
        border-left: 1px solid #ddd;
    }

    .buttons {
        flex-direction: column;
        align-items: stretch;
    }

    .deadline {
        flex-direction: column;
        align-items: flex-start;
    }

    nav {
        justify-content: center;
        width: 100%;
        margin-top: 0.5rem;
    }

    .countdown {
        font-size: 1.5rem;
        font-weight: bold;
        color: orangered;
        margin-top: 0.5rem;
    }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="logo-orlin-farm.png" alt="Orlin Farm Logo" />
    </div>
    <nav>
      <a href="#">Profil</a>
      <a href="#">Tabungan Qurban</a>
      <a href="#">Masuk</a>
      <a href="#">Daftar</a>
    </nav>
  </header>

  <main class="payment-container">
    <section class="payment-box">
      <div class="deadline">
        <div class="deadline-left">
          <div class="icon">
            <img src="https://cdn-icons-png.freepik.com/256/16937/16937622.png?ga=GA1.1.1665315006.1742976687&semt=ais_hybrid" alt="Clock Icon" />
          </div>
          <div>
            <p class="title">Batas Akhir Pembayaran</p>
            <p class="date">29 Februari 2025, 23.59 WIB</p>
          </div>
        </div>
        <div class="countdown" id="countdown">10:14:23</div>
      </div>

      <div class="bank-info">
        <img src="https://www.bca.co.id/-/media/Feature/Card/List-Card/Tentang-BCA/Brand-Assets/Logo-BCA/Logo-BCA_Biru.png" alt="Logo BCA" class="bank-logo">
        <div class="bank-name">
          <p><strong>Bank BCA</strong></p>
          <p>Transfer Manual</p>
        </div>
      </div>

      <label>Nomor Rekening</label>
      <div class="input-group">
        <input type="text" id="amount" value="12345678" readonly>
        <button class="copy-btn">📋</button>
      </div>

      <label>Nominal Transfer</label>
      <div class="input-group">
        <input type="text" id="amount" value="Rp 7.000.000" readonly>
        <button class="copy-btn">📋</button>
      </div>

      <label>Unggah Bukti Pembayaran</label>
      <div class="upload-box">
        <input type="file" accept=".jpg,.jpeg,.png" />
        <p class="note">Max: 5MB | Format: .jpg, .jpeg, .png</p>
      </div>

      <div class="buttons">
        <button class="guide-btn">Lihat Cara Bayar</button>
        <button class="status-btn">Cek Status Pembayaran</button>
      </div>
    </section>
  </main>
</body>
</html>
