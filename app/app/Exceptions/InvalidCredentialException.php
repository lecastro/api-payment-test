<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidCredentialException extends Exception
{
    protected $message  = 'Invalid credentials.';
    protected $code     = JsonResponse::HTTP_UNAUTHORIZED;
}
