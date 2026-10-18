<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BagiHasilLog extends Model
{
    protected $table = 'bagi_hasil_log';

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_investasi',
        'tanggal_distribusi',
        'nominal_diterima',
        'bukti_transfer',
    ];

    protected $casts = [
        'nominal_diterima' => 'decimal:2',
        'tanggal_distribusi' => 'datetime',
    ];

    public function investasi(): BelongsTo
    {
        return $this->belongsTo(Investasi::class, 'id_investasi', 'id_investasi');
    }
}
