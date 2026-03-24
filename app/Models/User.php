<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password', 'role', 'is_approved'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'is_approved' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || strtolower($this->username) === 'tudor';
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
