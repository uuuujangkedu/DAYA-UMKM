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
        'foto_ruko',
        'deskripsi_potensi',
        'kontak_pemilik',
        'harga_sewa_per_bulan',
        'total_unit',
        'unit_terisi',
        'status_ketersediaan',
    ];

    protected $casts = [
        'harga_sewa_per_bulan' => 'decimal:2',
        'total_unit' => 'integer',
        'unit_terisi' => 'integer',
    ];

    /**
     * Hitung sisa unit yang masih kosong / belum diisi
     */
    public function getSisaUnitAttribute(): int
    {
        $total = max(1, (int) ($this->total_unit ?? 1));
        $terisi = max(0, (int) ($this->unit_terisi ?? 0));
        return max(0, $total - $terisi);
    }

    /**
     * Cek apakah ruko sudah penuh terisi
     */
    public function getIsPenuhAttribute(): bool
    {
        return $this->sisa_unit <= 0 || $this->status_ketersediaan === 'tersewa';
    }

    /**
     * Status deskriptif: Kosong, Terisi Sebagian, atau Sudah Diisi
     */
    public function getStatusDisplayAttribute(): string
    {
        if ($this->is_penuh) {
            return 'Sudah Diisi (Penuh)';
        } elseif (($this->unit_terisi ?? 0) > 0) {
            return 'Terisi Sebagian';
        }
        return 'Kosong (Siap Huni)';
    }

    /**
     * Class CSS badge warna berdasarkan status ketersediaan
     */
    public function getStatusBadgeClassAttribute(): string
    {
        if ($this->is_penuh) {
            return 'bg-rose-50 text-rose-700 border-rose-200';
        } elseif (($this->unit_terisi ?? 0) > 0) {
            return 'bg-amber-50 text-amber-800 border-amber-200';
        }
        return 'bg-emerald-50 text-emerald-800 border-emerald-200';
    }

    public function penyedia(): BelongsTo
    {
        return $this->belongsTo(PenyediaRuko::class, 'id_penyedia', 'id_penyedia');
    }

    public function transaksiSewa(): HasMany
    {
        return $this->hasMany(TransaksiSewa::class, 'id_ruko', 'id_ruko');
    }
}
