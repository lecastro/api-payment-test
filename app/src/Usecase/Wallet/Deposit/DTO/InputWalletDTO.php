<?php

namespace Usecase\Wallet\Deposit\DTO;

class InputWalletDTO
{
    public function __construct(
        public readonly string $walletId,
        public readonly float $amount,
    ) {
    }
}
