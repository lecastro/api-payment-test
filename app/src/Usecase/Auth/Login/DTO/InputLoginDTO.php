<?php

declare(strict_types=1);

namespace Usecase\Auth\Login\DTO;

class InputLoginDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
