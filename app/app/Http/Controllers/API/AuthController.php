<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Usecase\Auth\Login\LoginUseCase;
use Usecase\Auth\Login\DTO\InputLoginDTO;

class AuthController extends Controller
{
    public function __construct(private LoginUseCase $useCase)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $response = $this->useCase->execute(new InputLoginDTO(
                $request->get('email'),
                $request->get('password')
            ));
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
