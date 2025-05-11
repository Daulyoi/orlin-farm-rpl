<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HewanQurban extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'bobot',
        'harga',
        'tersedia',
        'kelamin',
        'deskripsi',
        'lokasi',
        'foto',
    ];

    public function itemPemesanan(): HasOne
    {
        return $this->hasOne(ItemPemesanan::class, 'id_pemesanan');
    }

    public function keranjangs(): HasMany
    {
        return $this->HasMany(ItemPemesanan::class, 'id_pemesanan');
    }
}
