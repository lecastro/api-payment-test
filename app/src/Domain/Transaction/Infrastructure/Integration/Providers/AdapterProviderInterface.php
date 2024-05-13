<?php

declare(strict_types=1);

namespace Domain\Transaction\Infrastructure\Integration\Providers;

interface AdapterProviderInterface
{
    public function authorizeTransaction(): bool;
}
