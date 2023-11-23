<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'total_item', 'total_harga', 'bayar', 'diterima', 'user_id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
