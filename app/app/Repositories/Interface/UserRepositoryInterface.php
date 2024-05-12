<?php

declare(strict_types=1);

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Model as AbstractModel;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): null|AbstractModel;

    /**
     * @param array<mixed> $attributes
     */
    public function create(array $attributes): AbstractModel;
}
