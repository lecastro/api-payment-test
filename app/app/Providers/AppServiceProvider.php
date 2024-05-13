<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\User\Domain\Service\UserService;
use Domain\Wallet\Domain\Service\WalletService;
use Infrastructure\User\Repository\UserRepository;
use Infrastructure\Wallet\Repository\WalletRepository;
use Domain\Transaction\Domain\Service\TransactionService;
use Domain\User\Domain\Repository\UserRepositoryInterface;
use Domain\Wallet\Domain\Repository\WalletRepositoryInterface;
use Infrastructure\Transaction\Repository\TransactionRepository;
use Domain\Transaction\Domain\Repository\TransactionRepositoryInterface;
use Domain\Transaction\Infrastructure\Integration\Providers\CallProvider;
use Domain\Transaction\Infrastructure\Integration\Notifications\SMS\SMSClient;
use Domain\Transaction\Infrastructure\Integration\Notifications\Mail\MailClient;
use Domain\Transaction\Infrastructure\Integration\Providers\Picpay\PicpayClient;
use Domain\Transaction\Infrastructure\Integration\Notifications\SMS\SMSClientMock;
use Domain\Transaction\Infrastructure\Integration\Notifications\Mail\MailClientMock;
use Domain\Transaction\Infrastructure\Integration\Providers\Picpay\PicpayClientMock;
use Domain\Transaction\Infrastructure\Integration\Providers\AdapterProviderInterface;
use Domain\Transaction\Infrastructure\Integration\Notifications\AdapterSMSNotification;
use Domain\Transaction\Infrastructure\Integration\Notifications\AdapterEmailNotification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(WalletRepositoryInterface::class, WalletRepository::class);

        if ($this->app->runningInConsole()) {
            $this->app->bind(AdapterProviderInterface::class, PicpayClientMock::class);
            $this->app->bind(AdapterEmailNotification::class, MailClientMock::class);
            $this->app->bind(AdapterSMSNotification::class, SMSClientMock::class);
        } else {
            $this->app->bind(AdapterProviderInterface::class, PicpayClient::class);
            $this->app->bind(AdapterEmailNotification::class, MailClient::class);
            $this->app->bind(AdapterSMSNotification::class, SMSClient::class);
        }

        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                $app->make(UserRepositoryInterface::class),
                $app->make(WalletService::class)
            );
        });

        $this->app->bind(WalletService::class, function ($app) {
            return new WalletService($app->make(WalletRepositoryInterface::class));
        });

        $this->app->bind(TransactionService::class, function ($app) {
            return new TransactionService(
                $app->make(TransactionRepositoryInterface::class),
                $app->make(WalletService::class),
                $app->make(AdapterProviderInterface::class),
                $app->make(AdapterEmailNotification::class),
                $app->make(AdapterSMSNotification::class),
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
