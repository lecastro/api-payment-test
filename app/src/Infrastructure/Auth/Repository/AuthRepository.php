<?php

namespace Infrastructure\Auth\Repository;

use App\Models\User;
use Domain\Auth\Domain\Repository\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
