<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_telp'
    ];

    protected $hidden = [
        'password'
    ];

    public function keranjangs(): HasMany
    {
        return $this->hasMany(Keranjang::class, 'id_pelanggan');
    }

    public function pemesanans(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'id_pelanggan');
    }
}
