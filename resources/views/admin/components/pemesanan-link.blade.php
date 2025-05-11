@if ($record && $record->pemesanan)
    <a href="{{ route('filament.admin.resources.pemesanans.edit', $record->pemesanan->id) }}" target="_blank" class="text-blue-500 hover:underline">
        View Pemesanan Details
    </a>
@else
    <p>No Pemesanan found.</p>
@endif
