<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class EmailAlreadyExistsException extends Exception
{
    protected $message  = 'Email already exists.';
    protected $code     = JsonResponse::HTTP_CONFLICT;
}
