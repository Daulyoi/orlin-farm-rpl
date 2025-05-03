<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembayaran extends Model
{
    protected $fillable = [
        'metode',
        'jumlah',
        'tanggal',
        'bukti',
        'status',
        'id_pemesanan',
        'id_admin',
    ];
    public function pemesanan(): BelongsTo 
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
