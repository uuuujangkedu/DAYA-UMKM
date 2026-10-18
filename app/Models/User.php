<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'provinsi_kota',
        'kecamatan',
        'kelurahan',
        'kategori_diminati',
        'password',
        'role',
        'email_verified_at',
        'phone_verified_at',
        'status',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // ponytail: izinkan admin & super_admin. upgrade: tambah check permission spathie jika skala membesar.
        return in_array($this->role, ['admin', 'super_admin']);
    }

    public function thirdPartyAuthentications(): HasMany
    {
        return $this->hasMany(ThirdPartyAuthentication::class, 'user_id');
    }

    public function verificationCodes(): HasMany
    {
        return $this->hasMany(VerificationCode::class, 'user_id');
    }

    public function isEmailVerified(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    public function isActive(): bool
    {
        return $this->status === 'aktif';
    }

    public function umkm(): HasOne
    {
        return $this->hasOne(Umkm::class, 'user_id');
    }

    public function investasis(): HasMany
    {
        return $this->hasMany(Investasi::class, 'id_pengguna', 'id');
    }
}
