<?php

namespace Domain\Auth\Domain\Repository;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
