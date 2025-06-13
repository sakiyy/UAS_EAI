<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * Attribut yang boleh diisi secara massal
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Attribut yang disembunyikan saat model di-serialize
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mendapatkan identifier untuk disimpan dalam JWT 'sub' claim
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Klaim kustom tambahan untuk JWT (kosong jika tidak ada)
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
