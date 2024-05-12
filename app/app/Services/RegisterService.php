<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Exceptions\EmailAlreadyExistsException;
use App\Repositories\Interface\UserRepositoryInterface;

class RegisterService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /** @return array<string> */
    public function register(RegisterRequest $request): array
    {
        $user = $this->userRepository->findByEmail($request->get('email'));

        if ($user) {
            throw new EmailAlreadyExistsException();
        }

        $user = $this->userRepository->create([
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password')),
            'document'  => $request->get('document'),
            'type'      => $request->get('email'),
        ]);

        $token = $user->createToken($request->get('email'))->accessToken;

        return [
            'status'        => 'success',
            'message'       => 'User created successfully',
            'access_token'  => $token
        ];
    }
}
