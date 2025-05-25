<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pemesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal',
        'expired_at',
        'status', # pending, processing, completed, cancelled
        'nama',
        'alamat',
        'no_telp',
        'metode',
        'id_pelanggan',
        'jumlah'
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function itemPemesanans(): HasMany
    {
        return $this->hasMany(ItemPemesanan::class, 'id_pemesanan');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan');
    }
}
