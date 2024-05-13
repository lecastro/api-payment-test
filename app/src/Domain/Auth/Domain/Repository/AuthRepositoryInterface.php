<?php

declare(strict_types=1);

namespace Domain\Auth\Domain\Repository;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
