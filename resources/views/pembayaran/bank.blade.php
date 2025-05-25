<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Orlin Farm - Pembayaran Bank</title>
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
            <p class="date">{{ $pemesanan->expired_at }}</p>
          </div>
        </div>
        <div class="countdown" id="countdown">10:14:23</div>
      </div>

      <div class="bank-info">
        @php
        $bankData = [
            'transfer_bca' => [
                'name' => 'Bank BCA',
                'logo' => 'https://www.bca.co.id/-/media/Feature/Card/List-Card/Tentang-BCA/Brand-Assets/Logo-BCA/Logo-BCA_Biru.png',
                'account' => '1234567890'
            ],
            'transfer_mandiri' => [
                'name' => 'Bank Mandiri',
                'logo' => 'https://www.bankmandiri.co.id/image/layout_set_logo?img_id=31567&t=1684988419389',
                'account' => '2345678901'
            ],
            'transfer_bsi' => [
                'name' => 'Bank Syariah Indonesia (BSI)',
                'logo' => 'https://bankbsi.co.id/img/logo-new.png',
                'account' => '3456789012'
            ],
            'transfer_bni' => [
                'name' => 'Bank BNI',
                'logo' => 'https://bni.co.id/static/web2021/assets/img/logo/logo-bni-46.svg',
                'account' => '4567890123'
            ],
            'transfer_bri' => [
                'name' => 'Bank BRI',
                'logo' => 'https://bri.co.id/documents/20123/56702/logo-bank-bri-png.png',
                'account' => '5678901234'
            ]
        ];

        $currentBank = $bankData[$pemesanan->metode] ?? null;
        @endphp

        @if($currentBank)
        <img src="{{ $currentBank['logo'] }}" alt="Logo {{ $currentBank['name'] }}" class="bank-logo">
        <div class="bank-name">
          <p><strong>{{ $currentBank['name'] }}</strong></p>
          <p>Transfer Manual</p>
        </div>
        @endif
      </div>

      <label>Nomor Rekening</label>
      <div class="input-group">
        <input type="text" id="rekening" value="{{ $currentBank['account'] ?? '' }}" readonly>
        <button class="copy-btn" onclick="copyText('rekening')">📋</button>
      </div>

      <label>Nominal Transfer</label>
      <div class="input-group">
        <input type="text" id="nominal" value="Rp {{ number_format($pemesanan->jumlah, 0, ',', '.') }}" readonly>
        <button class="copy-btn" onclick="copyText('nominal')">📋</button>
      </div>

      <form action="{{ route('pelanggan.pembayaran.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
        <input type="hidden" name="metode" value="{{ $pemesanan->metode }}">
        <input type="hidden" name="jumlah" value="{{ $pemesanan->jumlah }}">

        <label>Unggah Bukti Pembayaran</label>
        <div class="upload-box">
          <input type="file" name="bukti" accept=".jpg,.jpeg,.png" required/>
          <p class="note">Max: 5MB | Format: .jpg, .jpeg, .png</p>
        </div>

        <div class="buttons">
          <button type="button" class="guide-btn" onclick="showGuide()">Lihat Cara Bayar</button>
          <button type="submit" class="status-btn">Upload Bukti Pembayaran</button>
        </div>
      </form>
    </section>
  </main>

  <script>
    function copyText(elementId) {
        const element = document.getElementById(elementId);
        element.select();
        document.execCommand('copy');
    }

    function showGuide() {
        // Implementasi panduan pembayaran sesuai bank yang dipilih
        const bankMethod = '{{ $pemesanan->metode }}';
        let panduan = 'Panduan Transfer:\n\n';
        
        switch(bankMethod) {
            case 'transfer_bca':
                panduan += '1. Buka aplikasi BCA Mobile\n2. Pilih m-Transfer\n3. Pilih Transfer ke BCA\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                break;
            case 'transfer_mandiri':
                panduan += '1. Buka aplikasi Livin by Mandiri\n2. Pilih Transfer\n3. Pilih Mandiri\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                break;
            // Tambahkan panduan untuk bank lainnya
        }
        
        alert(panduan);
    }

    // Implementasi countdown timer lengkap
    function updateCountdown() {
        const deadline = new Date("{{ $pemesanan->expired_at }}").getTime();
        const now = new Date().getTime();
        const timeLeft = deadline - now;

        if (timeLeft <= 0) {
            document.getElementById('countdown').innerHTML = "Waktu Habis";
            return;
        }

        const hours = Math.floor(timeLeft / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.getElementById('countdown').innerHTML = 
            hours.toString().padStart(2, '0') + ":" + 
            minutes.toString().padStart(2, '0') + ":" + 
            seconds.toString().padStart(2, '0');
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
  </script>
</body>
</html>
