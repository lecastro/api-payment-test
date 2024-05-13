<?php

declare(strict_types=1);

namespace Domain\Wallet\Domain\Repository;

use Domain\Wallet\Domain\Entities\Wallet;

interface WalletRepositoryInterface
{
    public function create(Wallet $wallet): Wallet;
    public function findByWalletByUserId(string $userId): ?Wallet;
    public function findById(string $walletId): ?Wallet;
    public function update(Wallet $wallet): void;
}
