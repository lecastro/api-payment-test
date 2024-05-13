<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;

    /** @var array<string>*/
    protected $fillable = [
        'id',
        'payer_id',
        'payee_id',
        'amount',
        'status'
    ];
}
