<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HewanQurban extends Model
{
    protected $fillable = [
            'jenis',
            'bobot',
            'harga',
            'status',
            'kelamin',
            'deskripsi',
            'lokasi',
            'foto',
    ];
}
