<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $table = 'firme';

    protected $fillable = [
        'user_id', 'nume', 'cui', 'nr_reg_com', 'adresa', 'banca', 'iban', 'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
