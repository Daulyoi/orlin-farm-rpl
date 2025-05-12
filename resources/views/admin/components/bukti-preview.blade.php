@php
    $record = $getRecord()
@endphp

@if ($record && $record->bukti)
    @php
        $url = asset('storage/' . $record->bukti);
    @endphp
    <style>
        .lightbox-img {
            width: 100%;
            cursor: zoom-in;
            transition: 0.3s ease;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .lightbox-img:active {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: contain;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            margin: 0;
            max-width: none;
        }
    </style>
    <img src="{{ $url }}" class="lightbox-img" />
@else
    <p>Tidak ada bukti pembayaran.</p>
@endif
