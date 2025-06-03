@extends('layouts.app')
@section('title', 'Checkout Pemesanan')

@section('content')
    <form method="POST" action="{{ route('pelanggan.pembayaran.store', $pemesanan->id) }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id }}">
        <main class="main-container">
            <section class="list-container flex" style="width: 100%; flex-direction: column; gap: var(--spacing-md);">
                    <div class="payment-timer panel">
                        <h4 class="payment-timer__title">
                            Waktu Tersisa Pembayaran
                        </h4>
                        <div id="countdown" class="payment-timer__countdown red-text"></div>
                        <small class="payment-timer__text">Selesaikan pembayaran sebelum waktu habis</small>
                    </div>
                <div class="panel">
                    <div class="form__group">
                        <input type="file" id="bukti" name="bukti" accept   =".jpg, .jpeg, .png, .gif, .webp" required class="flex">
                        @error('bukti')
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div id="payment-instructions" class="payment-instructions" style="display: none;">
                    <div id="instruction-content" class="payment-instructions__content panel"></div>
                </div>
                <div class="payment-section list-container flex" style="width: 100%; flex-direction: column;">
                    <div class="payment-grid">
                        <label class="payment-item" data-method="qris">
                            <input type="radio" name="metode" value="qris" required style="position: absolute; opacity: 0;">
                            <img src="{{asset('images/QrisLogo.png')}}" alt="QRIS"
                                style="max-width: 100%; height: 60px; object-fit: contain;">
                            <div class="selected-indicator"
                                style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
                            </div>
                        </label>
                        <label class="payment-item" data-method="transfer_bni">
                            <input type="radio" name="metode" value="transfer_bni" required
                                style="position: absolute; opacity: 0;">
                            <img src="{{asset('images/BNI.png')}}" alt="BNI"
                                style="max-width: 100%; height: 60px; object-fit: contain;">
                            <div class="selected-indicator"
                                style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
                            </div>
                        </label>

                        <label class="payment-item" data-method="transfer_bca">
                            <input type="radio" name="metode" value="transfer_bca" required
                                style="position: absolute; opacity: 0;">
                            <img src="{{asset('images/BCA.png')}}" alt="BCA"
                                style="max-width: 100%; height: 60px; object-fit: contain;">
                            <div class="selected-indicator"
                                style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
                            </div>
                        </label>

                        <label class="payment-item" data-method="transfer_mandiri">
                            <input type="radio" name="metode" value="transfer_mandiri" required
                                style="position: absolute; opacity: 0;">
                            <img src="{{asset('images/Mandiri.png')}}" alt="Mandiri"
                                style="max-width: 100%; height: 60px; object-fit: contain;">
                            <div class="selected-indicator"
                                style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
                            </div>
                        </label>

                        <label class="payment-item" data-method="transfer_bsi">
                            <input type="radio" name="metode" value="transfer_bsi" required
                                style="position: absolute; opacity: 0;">
                            <img src="{{asset('images/BSI.png')}}" alt="BSI"
                                style="max-width: 100%; height: 60px; object-fit: contain;">
                            <div class="selected-indicator"
                                style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
                            </div>
                        </label>

                        <label class="payment-item" data-method="transfer_bri">
                            <input type="radio" name="metode" value="transfer_bri" required
                                style="position: absolute; opacity: 0;">
                            <img src="{{asset('images/BRI.png')}}" alt="BRI"
                                style="max-width: 100%; height: 60px; object-fit: contain;">
                            <div class="selected-indicator"
                                style="position: absolute; top: 5px; right: 5px; width: 15px; height: 15px; border-radius: 50%; border: 2px solid #4CAF50; display: none;">
                            </div>
                        </label>
                    </div>
                </div>
            </section>
            <aside class="checkout-box panel" style="min-width: 30%;">

                <div class="cart-items">
                    <p><strong>Nama:</strong> {{ $pemesanan->nama }}</p>
                    <p><strong>Alamat:</strong> {{ $pemesanan->alamat }}</p>
                    <p><strong>No. Telp:</strong> {{ $pemesanan->no_telp }}</p>
                    <p><strong>Pembayaran :</strong> <span id="selected-payment">-</span></p>
                    <p><strong>Barang :</strong></p>
                    @php
                        $total = 0;
                    @endphp

                    @if($pemesanan->itemPemesanans->count() > 0)
                        <ul class="list-container">
                            @foreach($pemesanan->itemPemesanans as $item)
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
                        <p>Tidak ada barang di pemesanan</p>
                    @endif
                </div>

                <button type="submit" class="btn btn--primary btn--upload">
                    Upload Bukti Pembayaran
                </button>
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

        // Payment instructions
        const paymentInstructions = {
            qris: `
                <div class="payment-instructions__content-text" style="align-items: start;">
                    <p style="align-self: start;"><strong>Langkah Pembayaran QRIS:</strong></p>
                    <ol class="payment-instructions__content-text" style="align-items: start;">
                        <li>1. Buka aplikasi mobile banking atau e-wallet Anda</li>
                        <li>2. Pilih menu "Scan QR" atau "QRIS"</li>
                        <li>3. Scan kode QR di samping</li>
                        <li>4. Masukkan nominal: Rp{{ number_format($total) }}</li>
                        <li>5. Konfirmasi pembayaran</li>
                        <li>6. Screenshot bukti pembayaran dan upload disini</li>
                    </ol>
                </div>
                <div style="flex: 0 0 200px; display: flex; flex-direction: column; align-items: center;">
                    <img id="qris-img" src="{{ asset('images/qris.png') }}" alt="QRIS Code" style="width: 180px; height: 180px; border: 1px solid var(--border-color); border-radius: var(--radius-md);">
                    <a id="download-qris-btn" href="{{ asset('images/qris.png') }}" download="qris.png" class="btn btn--secondary" style="margin-top: 10px;">Download QRIS</a>
                </div>
            `,
            transfer_bca: `
                <div class="payment-instructions__content-text" style="align-items: start;">
                    <p style="align-self: start;"><strong>Langkah Pembayaran Transfer BCA:</strong></p>
                    <ol class="payment-instructions__content-text" style="align-items: start;">
                        <li>1. Transfer ke rekening berikut:</li>
                        <li style="list-style: none;">
                            <ul class="payment-instructions__content-text" style="align-items: start; margin-left: 40px;">
                                <li>
                                    - No. Rekening: 1234567890
                                </li>
                                <li>
                                    - Atas Nama: Orlin Farm
                                </li>
                                <li>
                                    - Nominal: Rp{{ number_format($total) }}
                                </li>
                            </ul>
                        </li>
                        <li>2. Simpan bukti transfer</li>
                        <li>3. Upload bukti transfer disini</li>
                    </ol>
                </div>
            `,
            transfer_bni: `
                <div class="payment-instructions__content-text" style="align-items: start;">
                    <p style="align-self: start;"><strong>Langkah Pembayaran Transfer BNI:</strong></p>
                    <ol class="payment-instructions__content-text" style="align-items: start;">
                        <li>1. Transfer ke rekening berikut:</li>
                        <li style="list-style: none;">
                            <ul class="payment-instructions__content-text" style="align-items: start; margin-left: 40px;">
                                <li>
                                    - No. Rekening: 0987654321
                                </li>
                                <li>
                                    - Atas Nama: Orlin Farm
                                </li>
                                <li>
                                    - Nominal: Rp{{ number_format($total) }}
                                </li>
                            </ul>
                        </li>
                        <li>2. Simpan bukti transfer</li>
                        <li>3. Upload bukti transfer disini</li>
                    </ol>
                </div>
            `,
            transfer_mandiri: `
                <div class="payment-instructions__content-text" style="align-items: start;">
                    <p style="align-self: start;"><strong>Langkah Pembayaran Transfer Mandiri:</strong></p>
                    <ol class="payment-instructions__content-text" style="align-items: start;">
                        <li>1. Transfer ke rekening berikut:</li>
                        <li style="list-style: none;">
                            <ul class="payment-instructions__content-text" style="align-items: start; margin-left: 40px;">
                                <li>
                                    - No. Rekening: 1122334455
                                </li>
                                <li>
                                    - Atas Nama: Orlin Farm
                                </li>
                                <li>
                                    - Nominal: Rp{{ number_format($total) }}
                                </li>
                            </ul>
                        </li>
                        <li>2. Simpan bukti transfer</li>
                        <li>3. Upload bukti transfer disini</li>
                    </ol>
                </div>
            `,
            transfer_bsi: `
                <div class="payment-instructions__content-text" style="align-items: start;">
                    <p style="align-self: start;"><strong>Langkah Pembayaran Transfer BSI:</strong></p>
                    <ol class="payment-instructions__content-text" style="align-items: start;">
                        <li>1. Transfer ke rekening berikut:</li>
                        <li style="list-style: none;">
                            <ul class="payment-instructions__content-text" style="align-items: start; margin-left: 40px;">
                                <li>
                                    - No. Rekening: 5566778899
                                </li>
                                <li>
                                    - Atas Nama: Orlin Farm
                                </li>
                                <li>
                                    - Nominal: Rp{{ number_format($total) }}
                                </li>
                            </ul>
                        </li>
                        <li>2. Simpan bukti transfer</li>
                        <li>3. Upload bukti transfer disini</li>
                    </ol>
                </div>
            `,
            transfer_bri: `
                <div class="payment-instructions__content-text" style="align-items: start;">
                    <p style="align-self: start;"><strong>Langkah Pembayaran Transfer BRI:</strong></p>
                    <ol class="payment-instructions__content-text" style="align-items: start;">
                        <li>1. Transfer ke rekening berikut:</li>
                        <li style="list-style: none;">
                            <ul class="payment-instructions__content-text" style="align-items: start; margin-left: 40px;">
                                <li>
                                    - No. Rekening: 9988776655
                                </li>
                                <li>
                                    - Atas Nama: Orlin Farm
                                </li>
                                <li>
                                    - Nominal: Rp{{ number_format($total) }}
                                </li>
                            </ul>
                        </li>
                        <li>2. Simpan bukti transfer</li>
                        <li>3. Upload bukti transfer disini</li>
                    </ol>
                </div>
            `
        };

        // Show payment instructions
        document.addEventListener('DOMContentLoaded', function () {
            const paymentItems = document.querySelectorAll('.payment-item');
            const instructionDiv = document.getElementById('payment-instructions');
            const instructionContent = document.getElementById('instruction-content');

            paymentItems.forEach(item => {
                item.addEventListener('click', function () {
                    const method = this.dataset.method;
                    if (paymentInstructions[method]) {
                        instructionContent.innerHTML = paymentInstructions[method];
                        instructionDiv.style.display = 'block';
                    }
                });
            });
        });

        // Timer countdown
        const expiredAt = new Date('{{ $pemesanan->expired_at }}').getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiredAt - now;

            if (distance < 0) {
                document.getElementById('countdown').innerHTML = 'WAKTU HABIS';
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('countdown').innerHTML =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
@endpush