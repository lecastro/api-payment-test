<?php

declare(strict_types=1);

namespace Domain\Transaction\Domain\Repository;

use Domain\Transaction\Domain\Entities\Transaction;

interface TransactionRepositoryInterface
{
    public function create(Transaction $transaction): void;
}
