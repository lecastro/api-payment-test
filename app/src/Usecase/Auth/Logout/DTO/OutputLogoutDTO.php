<?php

namespace Usecase\Auth\Logout\DTO;

class OutputLogoutDTO
{
    public function __construct(
        public readonly string $status,
        public readonly string $message
    ) {
    }
}
