<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
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
