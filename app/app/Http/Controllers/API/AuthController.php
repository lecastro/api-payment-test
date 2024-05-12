<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $response = $this->authService->login($request);

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

    public function logout(): JsonResponse
    {
        try {
            $response = $this->authService->logout();

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
