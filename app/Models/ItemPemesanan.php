<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemPemesanan extends Model
{
    protected $fillable = [
        'id_pemesanan',
        'id_hewan',
    ];

    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function hewanQurban(): BelongsTo
    {
        return $this->belongsTo(HewanQurban::class, 'id_hewan');
    }
}
