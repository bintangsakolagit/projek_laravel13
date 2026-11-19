<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//memanggil class relasi HasOne
use Illuminate\Database\Eloquent\Relations\HasOne;
//memanggil class relasi HasMany
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    //membuat relasi 1 ke 1 ke model DataDiri
    public function dataDiri(): HasOne
    {
        return $this->hasOne(DataDiri::class);
    }

    //membuat relasi 1 user memiliki banyak projek
    public function projek(): HasMany
    {
        return $this->hasMany(Projek::class);
    }
}
