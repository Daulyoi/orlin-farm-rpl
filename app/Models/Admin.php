<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }
    public function getFilamentName(): string
    {
        return $this->nama;
    }

    public function getNameAttribute(): string
    {
        return $this->nama;
    }
}
