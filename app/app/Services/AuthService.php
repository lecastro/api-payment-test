<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Exceptions\InvalidCredentialException;
use App\Repositories\Interface\UserRepositoryInterface;

class AuthService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /** @return array<string> */
    public function register(RegisterRequest $request): array
    {
        $user = $this->userRepository->findByEmail($request->get('email'));

        if ($user) {
            return [
                'status'    => 'failed',
                'message'   => 'Email already exists',
            ];
        }

        $user = $this->userRepository->create([
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'password'  => Hash::make($request->get('password')),
        ]);

        $token = $user->createToken($request->get('email'))->accessToken;

        return [
            'status'        => 'success',
            'message'       => 'User created successfully',
            'access_token'  => $token
        ];
    }

    /** @return array<string> */
    public function login(LoginRequest $request): array
    {
        $user = $this->userRepository->findByEmail($request->email);

        if (!$user || !Hash::check($request->get('password'), $user->getPassword())) {
            throw new InvalidCredentialException();
        }

        $token = $user->createToken($request->email)->accessToken;

        return [
            'status'        => 'success',
            'message'       => 'User is logged in successfully.',
            'access_token'  => $token
        ];
    }

    /** @return array<string> */
    public function logout(): array
    {
        Auth::user()->tokens()->delete();

        return [
            'status'    => 'success',
            'message'   => 'User is logged out successfully'
        ];
    }
}
