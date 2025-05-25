<!DOCTYPE html>
<html lang="id">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Orlin Farm</title>
    <style>
        /* Reset and Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f9ff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #3498db;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .logo img {
            height: 40px;
        }
        nav {
            display: flex;
            gap: 1.5rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        nav a:hover {
            opacity: 0.8;
        }

        /* Payment Container */
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

        .deadline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
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

        .countdown {
            font-size: 1.5rem;
            font-weight: bold;
            color: orangered;
        }

        .payment-info {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .payment-logo {
            width: 60px;
            margin-right: 1rem;
        }

        .qr-payment-section {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .qr-image {
            flex: 1;
            text-align: center;
        }

        .qr-code {
            max-width: 250px;
            border: 1px solid #ddd;
            border-radius: 12px;
        }

        .input-group {
            display: flex;
            margin-bottom: 1rem;
        }

        .input-group input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 6px 0 0 6px;
        }

        .copy-btn {
            padding: 0.5rem 1rem;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-left: none;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
        }

        .upload-box {
            border: 2px dashed #ddd;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .upload-box:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 6px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .guide-btn {
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid #007bff;
            color: #007bff;
            border-radius: 6px;
            cursor: pointer;
        }

        .status-btn {
            padding: 0.5rem 1rem;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .payment-box {
                padding: 1rem;
                margin: 1rem;
                border-radius: 12px;
            }

            .qr-payment-section {
                flex-direction: column;
                gap: 1rem;
            }

            .payment-info {
                flex-wrap: wrap;
                justify-content: center;
                text-align: center;
                gap: 1rem;
            }

            .payment-logo {
                width: 100px;
                margin: 0;
            }

            .deadline {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 1rem;
            }

            .input-group {
                flex-direction: column;
                gap: 0.5rem;
            }

            .input-group input,
            .copy-btn {
                width: 100%;
                border-radius: 6px;
            }

            .buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .guide-btn,
            .status-btn {
                width: 100%;
                padding: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="/" class="logo">
            <img src="/images/logo-orlin-farm.png" alt="Orlin Farm Logo">
            Orlin Farm
        </a>
        <nav>
            <a href="/dashboard">Dashboard</a>
            <a href="/keranjang">Keranjang</a>
            <a href="/pemesanan">Pemesanan</a>
        </nav>
    </header>

    <div class="payment-container">
        <section class="payment-box">
            <div class="deadline">
                <div class="deadline-left">
                    <div class="icon">
                        <img src="https://cdn-icons-png.freepik.com/256/16937/16937622.png" alt="Clock Icon" />
                    </div>
                    <div>
                        <p class="title">Batas Akhir Pembayaran</p>
                        <p class="date">{{ $pemesanan->expired_at }}</p>
                    </div>
                </div>
                <div class="countdown" id="countdown"></div>
            </div>

            @php
            $bankData = [
                'transfer_bca' => [
                    'name' => 'Bank BCA',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png',
                    'account' => '8877665544'
                ],
                'transfer_mandiri' => [
                    'name' => 'Bank Mandiri',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png',
                    'account' => '1020030040051'
                ],
                'transfer_bsi' => [
                    'name' => 'Bank Syariah Indonesia',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/2560px-Bank_Syariah_Indonesia.svg.png',
                    'account' => '7012345678'
                ],
                'transfer_bni' => [
                    'name' => 'Bank BNI',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png',
                    'account' => '0098765432'
                ],
                'transfer_bri' => [
                    'name' => 'Bank BRI',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/2560px-BANK_BRI_logo.svg.png',
                    'account' => '987654321098765'
                ],
                'qris' => [
                    'name' => 'QRIS',
                    'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/2560px-Logo_QRIS.svg.png',
                    'qr_code' => asset('images/qris.png')
                ]
            ];

            $currentPayment = $bankData[$pemesanan->metode] ?? null;
            $isQris = $pemesanan->metode === 'qris';
            @endphp

            @if($currentPayment)
                <div class="payment-info">
                    <img src="{{ $currentPayment['logo'] }}" alt="Logo {{ $currentPayment['name'] }}" class="payment-logo">
                    <div>
                        <p class="payment-title"><strong>{{ $currentPayment['name'] }}</strong></p>
                        <p class="payment-type">{{ $isQris ? 'QR - CODE' : 'Transfer Manual' }}</p>
                    </div>
                </div>

                @if($isQris)
                    <div class="qr-payment-section">
                        <div class="qr-image">
                            <img src="{{ $currentPayment['qr_code'] }}" alt="QRIS Code" class="qr-code">
                        </div>
                        <div class="payment-details">
                            <label>Nominal Bayar</label>
                            <div class="input-group">
                                <input type="text" id="nominal" value="Rp {{ number_format($pemesanan->jumlah, 0, ',', '.') }}" readonly>
                                <button class="copy-btn" onclick="copyText('nominal')">📋</button>
                            </div>
                        </div>
                    </div>
                @else
                    <label>Nomor Rekening</label>
                    <div class="input-group">
                        <input type="text" id="rekening" value="{{ $currentPayment['account'] }}" readonly>
                        <button class="copy-btn" onclick="copyText('rekening')">📋</button>
                    </div>

                    <label>Nominal Transfer</label>
                    <div class="input-group">
                        <input type="text" id="nominal" value="Rp {{ number_format($pemesanan->jumlah, 0, ',', '.') }}" readonly>
                        <button class="copy-btn" onclick="copyText('nominal')">📋</button>
                    </div>
                @endif

                <form action="{{ route('pelanggan.pembayaran.create') }}" method="POST" enctype="multipart/form-data" class="mt-4" id="payment-form">
                    @csrf
                    <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <label>Unggah Bukti Pembayaran</label>
                    <div class="upload-box">
                        <input type="file" name="bukti" accept=".jpg,.jpeg,.png" required id="bukti-upload"/>
                        <img id="bukti-preview" style="max-width: 100%; display: none; margin-top: 1rem;"/>
                        <p class="note">Max: 5MB | Format: .jpg, .jpeg, .png</p>
                        <p class="error-message" style="color: #dc3545; display: none;"></p>
                    </div>

                    <div class="buttons">
                        <button type="button" class="guide-btn" onclick="showGuide()">Lihat Cara Bayar</button>
                        @if($isQris)
                            <button type="button" class="guide-btn" onclick="downloadQRIS()">Download QRIS</button>
                        @endif
                        <button type="submit" class="status-btn">Upload Bukti Pembayaran</button>
                    </div>
                </form>
            @else
                <div class="alert alert-danger">
                    Metode pembayaran tidak valid.
                </div>
            @endif
        </section>
    </div>

    <script>
        function copyText(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            document.execCommand('copy');
            alert('Teks berhasil disalin!');
        }

        document.getElementById('bukti-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const errorMessage = document.querySelector('.error-message');
            const preview = document.getElementById('bukti-preview');
            
            // Reset
            errorMessage.style.display = 'none';
            preview.style.display = 'none';
            
            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    errorMessage.textContent = 'Format file tidak valid. Gunakan JPG atau PNG.';
                    errorMessage.style.display = 'block';
                    this.value = '';
                    return;
                }
                
                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    errorMessage.textContent = 'Ukuran file terlalu besar. Maksimal 5MB.';
                    errorMessage.style.display = 'block';
                    this.value = '';
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function downloadQRIS() {
            const qrUrl = '{{ $isQris ? $currentPayment['qr_code'] : '' }}';
            if (qrUrl) {
                const link = document.createElement('a');
                link.href = qrUrl;
                link.download = 'qris_orlin_farm.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        function showGuide() {
            const paymentMethod = '{{ $pemesanan->metode }}';
            let panduan = 'Panduan Pembayaran:\n\n';
            
            switch(paymentMethod) {
                case 'qris':
                    panduan += '1. Buka aplikasi e-wallet atau m-banking Anda\n' +
                              '2. Pilih menu Scan QRIS/Pay by QR\n' +
                              '3. Scan QR Code yang ditampilkan\n' +
                              '4. Periksa nominal pembayaran\n' +
                              '5. Masukkan PIN\n' +
                              '6. Selesai';
                    break;
                case 'transfer_bca':
                    panduan += '1. Buka aplikasi BCA Mobile\n2. Pilih m-Transfer\n3. Pilih Transfer ke BCA\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                    break;
                case 'transfer_mandiri':
                    panduan += '1. Buka aplikasi Livin by Mandiri\n2. Pilih Transfer\n3. Pilih Transfer ke Mandiri\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                    break;
                case 'transfer_bsi':
                    panduan += '1. Buka BSI Mobile\n2. Pilih Transfer\n3. Pilih Transfer BSI\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                    break;
                case 'transfer_bni':
                    panduan += '1. Buka BNI Mobile\n2. Pilih Transfer\n3. Pilih Transfer BNI\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                    break;
                case 'transfer_bri':
                    panduan += '1. Buka BRImo\n2. Pilih Transfer\n3. Pilih Transfer BRI\n4. Masukkan nomor rekening\n5. Masukkan nominal\n6. Masukkan PIN\n7. Selesai';
                    break;
            }
            
            alert(panduan);
        }

        function updateCountdown() {
            const deadline = new Date("{{ $pemesanan->expired_at }}").getTime();
            const now = new Date().getTime();
            const timeLeft = deadline - now;

            const countdownEl = document.getElementById('countdown');
            const formEl = document.querySelector('form');
            const buttonsEl = document.querySelector('.buttons');

            if (timeLeft <= 0) {
                countdownEl.innerHTML = "Waktu Habis";
                countdownEl.style.color = "#dc3545";
                if (formEl) {
                    formEl.style.display = "none";
                    const alertEl = document.createElement('div');
                    alertEl.className = "alert alert-danger";
                    alertEl.innerHTML = "Batas waktu pembayaran telah berakhir. Silakan buat pesanan baru.";
                    buttonsEl.insertAdjacentElement('beforebegin', alertEl);
                }
                return;
            }

            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            countdownEl.innerHTML = 
                hours.toString().padStart(2, '0') + ":" + 
                minutes.toString().padStart(2, '0') + ":" + 
                seconds.toString().padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>
</html>
