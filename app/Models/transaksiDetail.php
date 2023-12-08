<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_details';
    protected $primaryKey = 'id';
    protected $guarded =[];

    public function obat(): BelongsTo
    {
        return $this->belongsTo(obat::class);
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(transaksi::class);
    }
}
