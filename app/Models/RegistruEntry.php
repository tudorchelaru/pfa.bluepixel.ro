<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistruEntry extends Model
{
    protected $table = 'registru_entries';

    protected $fillable = [
        'user_id', 'firma_id', 'data', 'tip', 'metoda', 'suma',
        'valuta', 'document', 'deductibilitate', 'tip_cheltuiala',
        'bon_imagine', 'bon_mime',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'date',
            'suma' => 'decimal:2',
            'deductibilitate' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function firma()
    {
        return $this->belongsTo(\App\Models\Firma::class);
    }
}
