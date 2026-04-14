<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'jurusan',
        'asesor_id',
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
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Guru yang menjadi asesor dari siswa ini.
     */
    public function asesor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }

    /**
     * Relasi ke semua Siswa yang diasesori oleh guru ini.
     */
    public function siswa(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'asesor_id');
    }

    /**
     * Query scope untuk memfilter user dengan role admin.
     */
    public function scopeOnlyAdmin($query)
    {
        return $query->where('users.role', 'admin');
    }

    /**
     * Query scope untuk memfilter user dengan role siswa.
     */
    public function scopeOnlySiswa($query)
    {
        return $query->where('users.role', 'siswa');
    }

    /**
     * Query scope untuk memfilter user dengan role guru.
     */
    public function scopeOnlyGuru($query)
    {
        return $query->where('users.role', 'guru');
    }

    /**
     * Query scope untuk memfilter siswa berdasarkan asesornya.
     */
    public function scopeByAsesor($query, $asesorId)
    {
        return $query->where('users.asesor_id', $asesorId);
    }
}
