<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ruko extends Model
{
    protected $table = 'ruko';

    protected $primaryKey = 'id_ruko';

    protected $fillable = [
        'id_penyedia',
        'nama_ruko',
        'lokasi',
        'harga_sewa_per_bulan',
        'status_ketersediaan',
    ];

    protected $casts = [
        'harga_sewa_per_bulan' => 'decimal:2',
    ];

    public function penyedia(): BelongsTo
    {
        return $this->belongsTo(PenyediaRuko::class, 'id_penyedia', 'id_penyedia');
    }

    public function transaksiSewa(): HasMany
    {
        return $this->hasMany(TransaksiSewa::class, 'id_ruko', 'id_ruko');
    }
}
