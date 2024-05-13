<?php

declare(strict_types=1);

namespace Usecase\Auth\Login;

use Domain\Auth\Domain\Service\AuthService;

use Usecase\Auth\Login\DTO\{
    InputLoginDTO,
    OutputLoginDTO
};

class LoginUseCase
{
    public function __construct(protected AuthService $service)
    {
    }

    public function execute(InputLoginDTO $input): OutputLoginDTO
    {
        $login = $this->service->login(
            $input->email,
            $input->password
        );

        return new OutputLoginDTO(
            $login['status'],
            $login['message'],
            $login['access_token']
        );
    }
}
