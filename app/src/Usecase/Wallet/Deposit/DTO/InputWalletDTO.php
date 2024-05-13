<?php

declare(strict_types=1);

namespace Usecase\Wallet\Deposit\DTO;

class InputWalletDTO
{
    public function __construct(
        public readonly string $walletId,
        public readonly float $amount,
    ) {
    }
}
