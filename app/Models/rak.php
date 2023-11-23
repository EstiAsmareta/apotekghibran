<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class rak extends Model
{
    use HasFactory;
    protected $table = 'raks';
    protected $fillable = [
        'rak',
        'no_rak',
    ];

    public function obat(): HasOne
    {
        return $this->hasOne(obat::class);
    }
}
