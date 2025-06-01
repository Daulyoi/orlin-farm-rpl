@extends('layouts.app')
@section('title', 'Checkout Pemesanan')

@section('content')
  <form method="POST" action="{{ route('pelanggan.pemesanan.store') }}">
    @csrf
    <main class="main-container">
    <section class="list-container flex" style="width: 100%;">
      <div class="form__group">
      <label for="nama">Nama :</label>
      <input type="text" id="nama" name="nama" placeholder="Masukkan Nama"
        value="{{ currentPelanggan()->nama ?? '' }}">
      </div>

      <div class="form__group">
      <label for="alamat">Alamat :</label>
      <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat"
        value="{{ currentPelanggan()->alamat ?? '' }}">
      </div>

      <div class="form__group">
      <label for="telepon">No. Telp :</label>
      <input type="tel" id="telepon" name="no_telp" placeholder="08xxxxxxxxxx"
        value="{{ currentPelanggan()->no_telp ?? '' }}">
      </div>
      <div class="payment-section list-container flex" style="width: 100%;">
      <h3>Metode Pembayaran</h3>
      <div class="payment-grid">
        <label class="payment-item">
        <input type="radio" name="metode" value="qris" required style="position: absolute; opacity: 0;">
        <img src="{{asset('images/QrisLogo.png')}}" alt="QRIS"
          style="max-width: 100%; height: 60px; object-fit: contain;">
        <div class="selected-indicator"
          style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
        </div>
        </label>
        <label class="payment-item">
        <input type="radio" name="metode" value="transfer_bni" required style="position: absolute; opacity: 0;">
        <img src="{{asset('images/BNI.png')}}" alt="BNI"
          style="max-width: 100%; height: 60px; object-fit: contain;">
        <div class="selected-indicator"
          style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
        </div>
        </label>

        <label class="payment-item">
        <input type="radio" name="metode" value="transfer_bca" required style="position: absolute; opacity: 0;">
        <img src="{{asset('images/BCA.png')}}" alt="BCA"
          style="max-width: 100%; height: 60px; object-fit: contain;">
        <div class="selected-indicator"
          style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
        </div>
        </label>

        <label class="payment-item">
        <input type="radio" name="metode" value="transfer_mandiri" required style="position: absolute; opacity: 0;">
        <img src="{{asset('images/Mandiri.png')}}" alt="Mandiri"
          style="max-width: 100%; height: 60px; object-fit: contain;">
        <div class="selected-indicator"
          style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
        </div>
        </label>

        <label class="payment-item">
        <input type="radio" name="metode" value="transfer_bsi" required style="position: absolute; opacity: 0;">
        <img src="{{asset('images/BSI.png')}}" alt="BSI"
          style="max-width: 100%; height: 60px; object-fit: contain;">
        <div class="selected-indicator"
          style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
        </div>
        </label>

        <label class="payment-item">
        <input type="radio" name="metode" value="transfer_bri" required style="position: absolute; opacity: 0;">
        <img src="{{asset('images/BRI.png')}}" alt="BRI"
          style="max-width: 100%; height: 60px; object-fit: contain;">
        <div class="selected-indicator"
          style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
        </div>
        </label>
      </div>
    </section>
    <aside class="checkout-box panel">
      <h2>Checkout</h2>
      
      <div class="cart-items">
        <p><strong>Pembayaran :</strong> <span id="selected-payment">-</span></p>
        <p><strong>Barang :</strong></p>
        @php
          $total = 0;
        @endphp

        @if(currentPelanggan()->keranjangs->count() > 0)
        <ul class="list-container">
          @foreach(currentPelanggan()->keranjangs as $item)
          <li>
            <div>{{ $item->hewanQurban->jenis }}</div>
            <div>Rp{{ number_format($item->hewanQurban->harga) }}</div>
          </li>
          @php
        $total += $item->hewanQurban->harga;
        @endphp
        @endforeach
        <p><strong>Total :</strong> Rp{{ number_format($total) }}</p>
        </ul>
      @else
        <p>Tidak ada barang di keranjang</p>
      @endif
      </div>

      <button type="submit" class="btn btn--primary">Buat Pemesanan</button>
    </aside>
    </main>
  </form>
@endsection

@push('scripts')
  <script>
    // Update the payment method display when a payment method is selected
    document.addEventListener('DOMContentLoaded', function () {
    const paymentRadios = document.querySelectorAll('input[name="metode"]');
    const selectedPaymentDisplay = document.getElementById('selected-payment');

    paymentRadios.forEach(radio => {
      radio.addEventListener('change', function () {
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
    document.addEventListener('DOMContentLoaded', function () {
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
      item.addEventListener('click', function () {
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
@endpush