@extends('layouts.app')
@section('title', 'Pemesanan')

@section('content')
    <div class="main-container">
        <aside class="panel" style="max-width: 20%;">
            <a class="btn btn--secondary sidebar__btn" href="{{ route('pelanggan.profile') }}">Profil</a>
            <a class="btn btn--primary sidebar__btn" href="{{ route('pelanggan.pemesanan.index') }}">Riwayat Pemesanan</a>
        </aside>

        <!-- Riwayat Pemesanan Section -->
        <section class="panel">
            <h1>Riwayat Pemesanan</h1>
            <form method="GET" action="{{ route('pelanggan.pemesanan.index') }}" class="search-form" id="searchForm">
                <div class="form__input-group">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari detail pemesanan, tanggal, atau status" 
                           class="form__input"
                           value="{{ request('search') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="form__icon"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </div>
            </form>
            <div class="order-list"> 
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
                            // Status lookup
                            $statusClass = 'yellow-text';
                            $statusText = 'Menunggu Verifikasi';
                            if (isset($pemesanan->status)) {
                                if ($pemesanan->status === 'cancelled') {
                                    $statusClass = 'red-text';
                                    $statusText = 'Dibatalkan';
                                } elseif ($pemesanan->status === 'processing') {
                                    $statusClass = 'yellow-text';
                                    $statusText = 'Diproses';
                                } elseif ($pemesanan->status === 'completed') {
                                    $statusClass = 'green-text';
                                    $statusText = 'Selesai';
                                } elseif ($pemesanan->status === 'pending') {
                                    $statusClass = 'yellow-text';
                                    $statusText = 'Pending';
                                }
                            }
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
                                <td>Rp{{ number_format($pemesanan->jumlah) }}</td>
                                <td><span class="order-status {{ $statusClass }}">{{ $statusText }}</span></td>
                                <td>
                                    <a href="{{ route('pelanggan.pemesanan.show', $pemesanan->id) }}" class="edit-button btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" ><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z"/></svg>
                                    </a>\
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search with debounce
    const searchInput = document.querySelector('input[name="search"]');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.closest('form').submit();
            }, 500); // 500ms delay
        });
    }
});
</script>
@endpush
