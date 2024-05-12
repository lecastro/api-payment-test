<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Usecase\User\Create\DTO\InputUserDTO;
use Usecase\User\Create\CreateUserUseCase;

class RegisterController extends Controller
{
    public function __construct(private CreateUserUseCase $useCase)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $response = $this->useCase->execute(new InputUserDTO(
                name: $request->get('name'),
                email: $request->get('email'),
                document: $request->get('document'),
                password: Hash::make($request->get('password')),
                type: $request->get('type'),
            ));

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
