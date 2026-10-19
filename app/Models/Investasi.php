<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investasi extends Model
{
    protected $table = 'investasi';

    protected $primaryKey = 'id_investasi';

    protected $fillable = [
        'id_pengguna',
        'id_umkm',
        'jumlah_modal',
        'persentase_bagi_hasil',
        'periode_pembagian',
        'status',
        'catatan',
        'dibaca',
        'tanggal_investasi',
    ];

    protected $casts = [
        'jumlah_modal' => 'decimal:2',
        'persentase_bagi_hasil' => 'decimal:2',
        'tanggal_investasi' => 'datetime',
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }

    public function umkm(): BelongsTo
    {
        return $this->belongsTo(Umkm::class, 'id_umkm', 'id_umkm');
    }

    public function bagiHasilLog(): HasMany
    {
        return $this->hasMany(BagiHasilLog::class, 'id_investasi', 'id_investasi');
    }

    public function pesanInvestasi(): HasMany
    {
        return $this->hasMany(PesanInvestasi::class, 'id_investasi', 'id_investasi')->oldest();
    }

    public function ulasan()
    {
        return $this->hasOne(UlasanUmkm::class, 'id_investasi', 'id_investasi');
    }
}
