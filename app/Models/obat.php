<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class obat extends Model
{
    use HasFactory;
    protected $table = 'obats';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_obat',
        'nama_produsen',
        'stok',
        'tgl_kadaluarsa',
        'harga_beli',
        'harga_jual',
        'dosis',
        'user_id',
        'rak_id',
        'usertype'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rak(): BelongsTo
    {
        return $this->belongsTo(rak::class);
    }
}
