<?php

namespace Infrastructure\Wallet\Repository;

use App\Models\Wallet as Model;
use Domain\Shared\ValueObjects\Uuid;
use Domain\Shared\Enums\TypeUserEnum;
use Domain\Wallet\Domain\Entities\Wallet;
use Domain\Wallet\Domain\Repository\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function create(Wallet $wallet): Wallet
    {
        Model::create([
            'id'        => $wallet->id(),
            'user_type' => $wallet->userType->value,
            'user_id'   => $wallet->userId->get(),
            'balance'   => $wallet->getBalance(),
        ]);

        return $wallet;
    }
    public function findByWalletByUserId(string $userId): ?Wallet
    {
        $wallet = Model::where('user_id', $userId)->first();

        if ($wallet !== null) {
            return $this->make($wallet);
        }

        return $wallet;
    }

    public function findById(string $walletId): ?Wallet
    {
        $wallet = Model::where('id', $walletId)->first();

        if ($wallet !== null) {
            return $this->make($wallet);
        }

        return null;
    }

    public function update(Wallet $wallet): void
    {
        $foundWallet = Model::where('id', $wallet->id())->first();

        if ($wallet !== null) {
            $foundWallet->update([
                'balance' => $wallet->balance,
            ]);
        }
    }
    private function make(Model $wallet)
    {
        return new Wallet(
            id: new Uuid($wallet->getId()),
            userType: TypeUserEnum::isValid($wallet->user_type),
            userId: new Uuid($wallet->user_id),
            balance: (float) $wallet->balance,
            createdAt: $wallet->created_at->toDateTime()
        );
    }
}
