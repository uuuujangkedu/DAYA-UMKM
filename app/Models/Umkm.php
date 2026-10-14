<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';

    protected $fillable = [
        'nama_usaha',
        'jenis_usaha',
        'pemilik',
        'deskripsi',
    ];

    public function investasi(): HasMany
    {
        return $this->hasMany(Investasi::class, 'id_umkm', 'id_umkm');
    }

    public function transaksiSewa(): HasMany
    {
        return $this->hasMany(TransaksiSewa::class, 'id_umkm', 'id_umkm');
    }
}
