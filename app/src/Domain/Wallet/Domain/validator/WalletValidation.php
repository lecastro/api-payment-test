<?php

namespace Domain\Wallet\Domain\validator;

use Domain\Wallet\Domain\validator\Exceptions\WalletException;
use Domain\Wallet\Domain\validator\Exceptions\NegativeBalanceException;
use Domain\Wallet\Domain\validator\Exceptions\InsufficientBalanceException;

class WalletValidation
{
    public static function validateValueNegative(float $value): void
    {
        if ($value < 0) {
            throw new NegativeBalanceException("Negative balance is not allowed {$value}");
        }
    }

    public static function validateBalance(float $value): void
    {
        throw new InsufficientBalanceException("Insufficient balance for withdrawal {$value}");
    }

    public static function walletNotfound(): void
    {
        throw new WalletException('wallet Not found');
    }
}
