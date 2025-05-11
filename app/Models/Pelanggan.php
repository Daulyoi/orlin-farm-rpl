<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
