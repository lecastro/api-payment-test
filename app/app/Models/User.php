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

    /** @var array<string>*/
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function addresses(): HasMany
    {
        return $this->hasMany(Product::class, 'id');
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAtAttribute(string $value): string
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute(string $value): string
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function getDeletedAttribute(string $value): string
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
