<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ProductNotFoundException extends Exception
{
    protected $message  = 'Product not found.';
    protected $code     = JsonResponse::HTTP_NOT_FOUND;
}
