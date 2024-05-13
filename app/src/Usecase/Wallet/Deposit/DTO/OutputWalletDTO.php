<?php

declare(strict_types=1);

namespace Usecase\Wallet\Deposit\DTO;

class OutputWalletDTO
{
    public function __construct(
        public readonly string $walletId,
        public readonly float $amount,
        public readonly string $createdAt,
    ) {
    }
}
