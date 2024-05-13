<?php

declare(strict_types=1);

namespace Domain\Transaction\Infrastructure\Integration\Providers;

use Domain\Transaction\Infrastructure\Integration\Providers\AdapterProviderInterface;

class CallProvider
{
    public function __construct(protected AdapterProviderInterface $provider)
    {
    }

    public function getAdapter(): AdapterProviderInterface
    {
        return $this->provider;
    }
}
