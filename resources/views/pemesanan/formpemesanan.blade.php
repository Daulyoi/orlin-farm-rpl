<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orlin Farm - Form Pemesanan</title>
  <link rel="stylesheet" href="/css/formpemesanan/formpemesanan.style.css">
</head>

<body>
  <x-header></x-header>
  <!-- KONTEN UTAMA -->
  <form method="POST" action="{{ route('pelanggan.pemesanan.create') }}">
    @csrf
    <main class="container">
      <section class="form-area">
        <div class="form-group">
          <label for="nama">Nama :</label>
          <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ currentPelanggan()->nama ?? '' }}">
        </div>

        <div class="form-group">
          <label for="alamat">Alamat :</label>
          <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="{{ currentPelanggan()->alamat ?? '' }}">
        </div>

        <div class="form-group">
          <label for="telepon">No. Telp :</label>
          <input type="tel" id="telepon" name="no_telp" placeholder="08xxxxxxxxxx" value="{{ currentPelanggan()->no_telp ?? '' }}">
        </div>
        <div class="payment-section">
          <h3>Metode Pembayaran</h3>
          <div class="payment-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-top: 15px;">
            <label class="payment-item" style="cursor: pointer; border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s ease; position: relative;">
              <input type="radio" name="metode" value="qris" required style="position: absolute; opacity: 0;">
              <img src="images/QrisLogo.png" alt="QRIS" style="max-width: 100%; height: 60px; object-fit: contain;">
              <div class="selected-indicator" style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;"></div>
            </label>
            
            <label class="payment-item" style="cursor: pointer; border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s ease; position: relative;">
              <input type="radio" name="metode" value="transfer_bni" required style="position: absolute; opacity: 0;">
              <img src="images/BNI.png" alt="BNI" style="max-width: 100%; height: 60px; object-fit: contain;">
              <div class="selected-indicator" style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;"></div>
            </label>
            
            <label class="payment-item" style="cursor: pointer; border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s ease; position: relative;">
              <input type="radio" name="metode" value="transfer_bca" required style="position: absolute; opacity: 0;">
              <img src="images/BCA.png" alt="BCA" style="max-width: 100%; height: 60px; object-fit: contain;">
              <div class="selected-indicator" style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;"></div>
            </label>
            
            <label class="payment-item" style="cursor: pointer; border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s ease; position: relative;">
              <input type="radio" name="metode" value="transfer_mandiri" required style="position: absolute; opacity: 0;">
              <img src="images/Mandiri.png" alt="Mandiri" style="max-width: 100%; height: 60px; object-fit: contain;">
              <div class="selected-indicator" style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;"></div>
            </label>
            
            <label class="payment-item" style="cursor: pointer; border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s ease; position: relative;">
              <input type="radio" name="metode" value="transfer_bsi" required style="position: absolute; opacity: 0;">
              <img src="images/BSI.png" alt="BSI" style="max-width: 100%; height: 60px; object-fit: contain;">
              <div class="selected-indicator" style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;"></div>
            </label>
            
            <label class="payment-item" style="cursor: pointer; border: 2px solid #ddd; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s ease; position: relative;">
              <input type="radio" name="metode" value="transfer_bri" required style="position: absolute; opacity: 0;">
              <img src="images/BRI.png" alt="BRI" style="max-width: 100%; height: 60px; object-fit: contain;">
              <div class="selected-indicator" style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;"></div>
            </label>
          </div>
          
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const paymentItems = document.querySelectorAll('.payment-item');
              const selectedPaymentDisplay = document.getElementById('selected-payment');
              
              paymentItems.forEach(item => {
                const radio = item.querySelector('input[type="radio"]');
                const indicator = item.querySelector('.selected-indicator');
                
                // Initial state
                if (radio.checked) {
                  item.style.borderColor = '#4CAF50';
                  indicator.style.display = 'block';
                  selectedPaymentDisplay.textContent = radio.value;
                }
                
                // Click event
                item.addEventListener('click', function() {
                  // Reset all items
                  paymentItems.forEach(otherItem => {
                    otherItem.style.borderColor = '#ddd';
                    otherItem.querySelector('.selected-indicator').style.display = 'none';
                    otherItem.querySelector('input[type="radio"]').checked = false;
                  });
                  
                  // Highlight selected item AND check the radio button
                  item.style.borderColor = '#4CAF50';
                  indicator.style.display = 'block';
                  radio.checked = true; // This actually selects the radio button
                  
                  // Update payment display in checkout
                  selectedPaymentDisplay.textContent = radio.value;
                });
              });
            });
          </script>
      </section>
      <aside class="checkout-box">
        <h2>Checkout</h2>
        <p><strong>Pembayaran :</strong> <span id="selected-payment">-</span></p>
        
        <div class="cart-items">
          <p><strong>Barang :</strong></p>
          @php
            $total = 0;
          @endphp
          
          @if(currentPelanggan()->keranjangs->count() > 0)
            <ul style="list-style: none; padding: 0; margin-top: 10px;">
              @foreach(currentPelanggan()->keranjangs as $item)
                <li style="margin-bottom: 10px; padding: 8px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                  <div>{{ $item->hewanQurban->jenis }}</div>
                  <div>Rp{{ number_format($item->hewanQurban->harga) }}</div>
                </li>
                @php
                  $total += $item->hewanQurban->harga;
                @endphp
              @endforeach
            </ul>
          @else
            <p>Tidak ada barang di keranjang</p>
          @endif
        </div>
        
        <p><strong>Total :</strong> Rp{{ number_format($total) }}</p>
        <button type="submit">Buat Pemesanan</button>
        
        <script>
          // Update the payment method display when a payment method is selected
          document.addEventListener('DOMContentLoaded', function() {
            const paymentRadios = document.querySelectorAll('input[name="metode"]');
            const selectedPaymentDisplay = document.getElementById('selected-payment');
            
            paymentRadios.forEach(radio => {
              radio.addEventListener('change', function() {
                if (this.checked) {
                  selectedPaymentDisplay.textContent = this.value;
                }
              });
              
              // Check if any radio is pre-selected on page load
              if (radio.checked) {
                selectedPaymentDisplay.textContent = radio.value;
              }
            });
          });
        </script>
      </aside>
    </main>
  </form>

</body>

</html>