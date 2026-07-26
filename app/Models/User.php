<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Fakultas;
use App\Models\Unit;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
    'username', 'email', 'password', 'role',
    'fakultas_id', 'unit_id', 'status',
];

public function fakultas()
{
    return $this->belongsTo(Fakultas::class);
}

public function unit()
{
    return $this->belongsTo(Unit::class);
}

public function isSuperAdmin(): bool
{
    return $this->role === 'superadmin';
}

public function isAdmin(): bool
{
    return $this->role === 'admin';
}

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
}
