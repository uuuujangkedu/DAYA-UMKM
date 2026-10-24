<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Umkm extends Model
{
    protected $table = 'umkm';

    protected $primaryKey = 'id_umkm';

    protected $fillable = [
        'user_id',
        'nama_usaha',
        'jenis_usaha',
        'pemilik',
        'nik_penanggung_jawab',
        'nomor_whatsapp',
        'provinsi_kota',
        'kecamatan',
        'kelurahan',
        'rt',
        'rw',
        'deskripsi',
        'foto_produk',
        'file_proposal',
        'id_ruko_diminati',
        'status_pengajuan',
        'modal_dibutuhkan',
        'estimasi_bagi_hasil',
    ]; // ponytail: tambah kolom (target_pendanaan, nib, omzet_bulanan, dsb) via migrasi jika produk butuh.

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruko()
    {
        return $this->belongsTo(Ruko::class, 'id_ruko_diminati', 'id_ruko');
    }

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_umkm', 'id_umkm');
    }

    public function investasi(): HasMany
    {
        return $this->hasMany(Investasi::class, 'id_umkm', 'id_umkm');
    }

    public function transaksiSewa(): HasMany
    {
        return $this->hasMany(TransaksiSewa::class, 'id_umkm', 'id_umkm');
    }

    public function catatanKeuangan(): HasMany
    {
        return $this->hasMany(CatatanKeuangan::class, 'id_umkm', 'id_umkm');
    }

    public function ulasanUmkm(): HasMany
    {
        return $this->hasMany(UlasanUmkm::class, 'id_umkm', 'id_umkm')->where('status', 'tayang');
    }

    /**
     * Rating rata-rata dari seluruh investor terverifikasi (skala 1-5)
     */
    public function getRatingRataRataAttribute(): float
    {
        $avg = $this->ulasanUmkm()->avg('rating');

        return $avg ? round((float) $avg, 1) : 0.0;
    }

    /**
     * Total ulasan terverifikasi yang diterima
     */
    public function getTotalUlasanAttribute(): int
    {
        return $this->ulasanUmkm()->count();
    }
}
