<?php

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
