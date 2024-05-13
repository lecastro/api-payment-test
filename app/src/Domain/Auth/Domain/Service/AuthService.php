<?php

declare(strict_types=1);

namespace Domain\Auth\Domain\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\InvalidCredentialException;
use Domain\Auth\Domain\Repository\AuthRepositoryInterface;

class AuthService
{
    public function __construct(private AuthRepositoryInterface $repository)
    {
    }

    /** @return array<string> */
    public function login(string $email, string $password): array
    {
        $user = $this->repository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new InvalidCredentialException();
        }

        $token = $user->createToken($email)->accessToken;

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
