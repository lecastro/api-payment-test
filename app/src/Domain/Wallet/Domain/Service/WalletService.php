<?php

declare(strict_types=1);

namespace Domain\Wallet\Domain\Service;

use Domain\Shared\ValueObjects\Uuid;
use Domain\User\Domain\Entities\User;
use Domain\Wallet\Domain\Entities\Wallet;
use Domain\Wallet\Domain\validator\WalletValidation;
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

    public function deposit(Uuid $walletId, float $amount): Wallet
    {
        $depositWallet = $this->findById($walletId->get());

        if ($depositWallet === null) {
            WalletValidation::walletNotfound();
        }

        WalletValidation::validateValueNegative($amount);

        $wallet = new Wallet(
            id: $walletId,
            userType: $depositWallet->userType,
            userId: $depositWallet->userId,
            balance: $depositWallet->balance + $amount,
            createdAt: $depositWallet->createdAt
        );

        $this->update($wallet);

        return $wallet;
    }
}
