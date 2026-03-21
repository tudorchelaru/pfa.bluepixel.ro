<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function registruEntries()
    {
        return $this->hasMany(RegistruEntry::class);
    }

    public function firme()
    {
        return $this->hasMany(Firma::class);
    }

    public function firmaDefault()
    {
        return $this->hasOne(Firma::class)->where('is_default', true)->latestOfMany();
    }
}
