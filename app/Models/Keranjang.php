<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Keranjang extends Model
{
    protected $fillable = [
        'id_pelanggan',
        'id_hewan',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function hewanQurban(): BelongsTo
    {
        return $this->belongsTo(HewanQurban::class, 'id_hewan');
    }
}
