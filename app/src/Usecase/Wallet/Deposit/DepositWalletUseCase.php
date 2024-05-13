<?php

declare(strict_types=1);

namespace Usecase\Wallet\Deposit;

use Domain\Shared\ValueObjects\Uuid;
use Domain\Wallet\Domain\Service\WalletService;
use Usecase\Wallet\Deposit\DTO\{
    InputWalletDTO,
    OutputWalletDTO
};

class DepositWalletUseCase
{
    public function __construct(private WalletService $service)
    {
    }
    public function execute(InputWalletDTO $input): OutputWalletDTO
    {
        $wallet = $this->service->deposit(
            new Uuid($input->walletId),
            $input->amount
        );

        return new OutputWalletDTO(
            $wallet->id->get(),
            $wallet->getBalance(),
            $wallet->createdAt->format('Y-m-d H:i:s')
        );
    }
}
