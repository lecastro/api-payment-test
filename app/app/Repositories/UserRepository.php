<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): null|User
    {
        return User::where('email', $email)->first();
    }

    /** @param array<mixed> $attributes*/
    public function create(array $attributes): User
    {
        return User::create($attributes);
    }
}
