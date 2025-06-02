@extends('layouts.app')
@section('title', 'Pemesanan')

@section('content')
    <div class="main-container">
        <aside class="sidebar">
            <a class="btn btn--secondary sidebar__btn" href="{{ route('pelanggan.profile') }}">Profil</a>
            <a class="btn btn--primary sidebar__btn" href="{{ route('pelanggan.pemesanan.index') }}">Riwayat Pemesanan</a>
        </aside>

        <!-- Riwayat Pemesanan Section -->
        <section class="riwayat-section">
            <h1>Riwayat Pemesanan</h1>
            <div class="search-container">
                <button class="filter-button">
                    <img src="/images/filter-icon.svg" alt="Filter">
                </button>
                <button class="sort-button">
                    <img src="/images/sort-icon.png" alt="Sort">
                </button>
                <input type="text" placeholder="Search Here">
                <button class="search-button">
                    <img src="/images/search-icon.png" alt="Search">
                </button>
            </div>
            <div class="order-list"> {{-- Keep this div if you have other elements in this container, otherwise you can remove it and apply styles to the table directly --}}
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Detail Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanans as $pemesanan)
                            @php
                            $hewanYangDipesan = '';
                            $total = count($pemesanan->itemPemesanans);
                        @endphp
                        @foreach ($pemesanan->itemPemesanans as $index => $item)
                            @php
                                if ($item->hewanQurban) {
                                    $hewanYangDipesan .= $item->hewanQurban->jenis;
                                    if ($index < $total - 1) {
                                        $hewanYangDipesan .= ', ';
                                    }
                                }
                            @endphp
                        @endforeach

                            <tr>
                                <td>{{ $pemesanan->created_at->format('Y-m-d') }}</td>
                                <td>{{ $hewanYangDipesan }}</td>
                                <td>Rp.{{ number_format($pemesanan->jumlah) }}</td>
                                <td><span class="order-status pending">Menunggu Verifikasi</span></td>
                                <td>
                                    <button class="edit-button">
                                        <img src="/images/arrow-right.png" alt="Expand">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
