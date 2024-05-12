<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** @var array<string>*/
    protected $fillable = [
        'name', 'detail', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute(string $value): string
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute(string $value): string
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getDeletedAttribute(string $value): string
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
