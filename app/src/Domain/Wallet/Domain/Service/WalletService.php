<?php

namespace Domain\Wallet\Domain\Service;

use Domain\User\Domain\Entities\User;
use Domain\Wallet\Domain\Entities\Wallet;
use Domain\Wallet\Domain\Repository\WalletRepositoryInterface;

class WalletService
{
    public function __construct(protected WalletRepositoryInterface $walletRepository)
    {
    }

    public function create(User $user): Wallet
    {
        $wallet = $this->walletRepository->findByWalletByUserId($user->id());

        if ($wallet !== null) {
            return $wallet;
        }

        return $this->walletRepository->create(new Wallet(
            null,
            $user->type,
            $user->id,
            0,
            $user->createdAt
        ));
    }

    public function getWalletByPayerId(string $payerId): ?Wallet
    {
        return $this->walletRepository->findByWalletByUserId($payerId);
    }

    public function getWalletByPayeeId(string $payeeId): ?Wallet
    {
        return $this->walletRepository->findByWalletByUserId($payeeId);
    }

    public function findById(string $walletId): ?Wallet
    {
        return $this->walletRepository->findById($walletId);
    }

    public function hasBalance(string $walletId, float $amount): bool
    {
        $wallet = $this->walletRepository->findById($walletId);

        if ($wallet === null) {
            return false;
        }

        return $wallet->hasBalance($amount);
    }

    public function getBalance(string $walletId): float
    {
        $wallet = $this->walletRepository->findById($walletId);

        if ($wallet === null) {
            return 0;
        }

        return $wallet->getBalance();
    }

    public function update(Wallet $wallet): void
    {
        $this->walletRepository->update($wallet);
    }
}
