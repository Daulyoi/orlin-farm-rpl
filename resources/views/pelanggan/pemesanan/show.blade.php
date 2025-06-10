@extends('layouts.app')
@section('title', 'Detail Pemesanan')

@section('content')
    <div class="main-container">
        {{-- <aside class="panel" style="max-width: 20%;">
            <a class="btn btn--secondary sidebar__btn" href="{{ route('pelanggan.profile') }}">Profil</a>
            <a class="btn btn--primary sidebar__btn" href="{{ route('pelanggan.pemesanan.index') }}">Riwayat Pemesanan</a>
        </aside> --}}

        <!-- Detail Pemesanan Section -->
        <section class="panel">
            <div style="display: flex; align-items: center; gap: var(--spacing-md); margin-bottom: var(--spacing-lg);">
                <a href="{{ route('pelanggan.pemesanan.index') }}" class="btn btn--secondary btn--small">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="currentColor" style="margin-right: var(--spacing-xs);"><path d="M400-80 0-480l400-400 56 57-343 343 343 343L400-80Z"/></svg>
                    Kembali
                </a>
                <h1>Detail Pemesanan #{{ $pemesanan->id }}</h1>
            </div>

            <!-- Informasi Pemesanan -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
                <div class="panel">
                    <h3 style="margin-bottom: var(--spacing-md); color: var(--text-primary);">Informasi Pemesanan</h3>
                    <div style="display: flex; flex-direction: column; gap: var(--spacing-sm);">
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-secondary);">Tanggal Pemesanan:</span>
                            <span>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y, H:i') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-secondary);">Status:</span>
                            @php
                                $statusClass = '';
                                if ($pemesanan->status == 'cancelled') {
                                    $statusClass = 'red-text';
                                    $statusText = 'Dibatalkan';
                                } elseif ($pemesanan->status == 'processing') {
                                    $statusClass = 'yellow-text';
                                    $statusText = 'Diproses';
                                } elseif ($pemesanan->status == 'completed') {
                                    $statusClass = 'green-text';
                                    $statusText = 'Selesai';
                                } elseif ($pemesanan->status == 'pending') {
                                    if ($pemesanan->pembayaran) {
                                        $statusClass = 'yellow-text';
                                        $statusText = 'Menunggu Verifikasi';
                                    } else {
                                        $statusClass = 'yellow-text';
                                        $statusText = 'Belum Dibayar';
                                    }
                                }
                            @endphp
                            <span class="order-status {{ $statusClass }}">
                                {{ $statusText }}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-secondary);">Metode Pembayaran:</span>
                            <span>
                                @if(isset($pemesanan->pembayaran))
                                    {{ strtoupper(str_replace('_', ' ', $pemesanan->pembayaran->metode)) }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        @if($pemesanan->expired_at)
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-secondary);">Batas Pembayaran:</span>
                            <span>{{ \Carbon\Carbon::parse($pemesanan->expired_at)->format('d M Y, H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="panel">
                    <h3 style="margin-bottom: var(--spacing-md); color: var(--text-primary);">Informasi Pengiriman</h3>
                    <div style="display: flex; flex-direction: column; gap: var(--spacing-sm);">
                        <div>
                            <span style="color: var(--text-secondary); display: block;">Nama Penerima:</span>
                            <span>{{ $pemesanan->nama }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-secondary); display: block;">Alamat:</span>
                            <span>{{ $pemesanan->alamat }}</span>
                        </div>
                        <div>
                            <span style="color: var(--text-secondary); display: block;">No. Telepon:</span>
                            <span>{{ $pemesanan->no_telp }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Item Pemesanan -->
            <div class="panel">
                <h3>Hewan Qurban yang Dipesan</h3>
                <div class="order-list">
                    <table>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Jenis Hewan</th>
                                <th>Kelamin</th>
                                <th>Bobot</th>
                                <th>Lokasi</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan->itemPemesanans as $item)
                                @if($item->hewanQurban)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->hewanQurban->foto) }}"
                                             alt="{{ $item->hewanQurban->jenis }}"
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-md);">
                                    </td>
                                    <td>{{ $item->hewanQurban->jenis }}</td>
                                    <td>{{ $item->hewanQurban->kelamin }}</td>
                                    <td>{{ $item->hewanQurban->bobot }} kg</td>
                                    <td>{{ $item->hewanQurban->lokasi }}</td>
                                    <td>Rp{{ number_format($item->hewanQurban->harga) }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div>
                <h3 style="margin-bottom: var(--spacing-md); color: var(--text-primary);">Ringkasan Pembayaran</h3>
                <div style="display: flex; flex-direction: column; gap: var(--spacing-sm);">
                    @foreach($pemesanan->itemPemesanans as $item)
                        @if($item->hewanQurban)
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--text-secondary);">{{ $item->hewanQurban->jenis }}</span>
                                <span>Rp{{ number_format($item->hewanQurban->harga) }}</span>
                            </div>
                        @endif
                    @endforeach
                    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: var(--font-size-lg); margin-bottom: var(--spacing-smd);">
                        <span>Total Pembayaran:</span>
                        <span style="color: var(--color-primary);">Rp{{ number_format($pemesanan->jumlah) }}</span>
                    </div>
                </div>

                @if($pemesanan->status == 'pending' && $pemesanan->pembayaran == null)
                <div style="margin-top: var(--spacing-lg); padding-top: var(--spacing-lg); border-top: 1px solid var(--border-color);">
                    <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                        <form action="{{ route('pelanggan.pemesanan.cancel', $pemesanan->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn--cancel">Batalkan Pesanan</button>
                        </form>
                        <a href="{{ route('pelanggan.pembayaran.create', $pemesanan->id) }}" class="btn btn--primary btn--small">
                            Bayar Sekarang
                        </a>
                    </div>
                </div>
                @else
                    <div>
                        <img    src="{{ asset("storage/" . $pemesanan->pembayaran->bukti) }}" alt="Bukti Pembayaran" style="max-width: 220px; max-height: 220px; border-radius: var(--radius-md);">
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
