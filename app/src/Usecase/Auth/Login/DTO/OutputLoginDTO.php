<?php

namespace Usecase\Auth\Login\DTO;

class OutputLoginDTO
{
    public function __construct(
        public readonly string $status,
        public readonly string $message,
        public readonly string $token,
    ) {
    }
}
