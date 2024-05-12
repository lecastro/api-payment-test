<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function handleException(\Throwable $th): JsonResponse
    {
        $statusCode = $th->getCode();

        if ($statusCode === 0) {
            $statusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json([
            'message'   => 'error',
            'error'     => $th->getMessage()
        ], $statusCode);
    }
}
