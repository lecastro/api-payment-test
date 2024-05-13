<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Usecase\Auth\Logout\LogoutUseCase;

class LogoutController extends Controller
{
    public function __construct(private LogoutUseCase $useCase)
    {
    }

    public function logout(): JsonResponse
    {
        try {
            $response = $this->useCase->execute();

            return response()->json(
                $response,
                JsonResponse::HTTP_OK,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}
