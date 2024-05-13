<?php

declare(strict_types=1);

namespace Usecase\Transaction\Create\DTO;

class InputTransactionDTO
{
    public function __construct(
        public readonly float $amount,
        public readonly string $payer,
        public readonly string $payee
    ) {
    }
}
