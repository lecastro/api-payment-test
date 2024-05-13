<?php

namespace Infrastructure\Transaction\Repository;

use App\Models\Transaction as Model;
use Domain\Transaction\Domain\Entities\Transaction;
use Domain\Transaction\Domain\Repository\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(Transaction $transaction): void
    {
        Model::create([
            'id'        => $transaction->id(),
            'payer_id'  => $transaction->payerId(),
            'payee_id'  => $transaction->payeeId(),
            'amount'    => $transaction->amount,
            'status'    => $transaction->status->value
        ]);
    }
}
