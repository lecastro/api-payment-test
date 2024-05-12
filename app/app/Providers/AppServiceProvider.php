<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Domain\User\Domain\Service\UserService;
use Infrastructure\User\Repository\UserRepository;
use Domain\User\Domain\Repository\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
    }

    public function boot(): void
    {
        //
    }
}
