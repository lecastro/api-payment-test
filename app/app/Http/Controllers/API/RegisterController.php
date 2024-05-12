<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $response = $this->registerService->register($request);
            return response()->json(
                $response,
                JsonResponse::HTTP_CREATED,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}
