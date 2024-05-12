<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Product;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;

    /** @var array<string>*/
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'document',
        'type'
    ];

    /** @var array<string>*/
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @var array<string>*/
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed'
    ];

    public function wallet(): HasMany
    {
        return $this->hasMany(Wallet::class, 'id');
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
