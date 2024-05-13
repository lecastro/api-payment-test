<?php

declare(strict_types=1);

namespace Usecase\Auth\Logout;

use Domain\Auth\Domain\Service\AuthService;
use Usecase\Auth\Logout\DTO\OutputLogoutDTO;

class LogoutUseCase
{
    public function __construct(protected AuthService $service)
    {
    }

    public function execute(): OutputLogoutDTO
    {
        $logout = $this->service->logout();

        return new OutputLogoutDTO(
            $logout['status'],
            $logout['message']
        );
    }
}
