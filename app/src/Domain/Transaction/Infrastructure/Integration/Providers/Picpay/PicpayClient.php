<?php

namespace Domain\Transaction\Infrastructure\Integration\Providers\Picpay;

use Domain\Transaction\Infrastructure\Integration\Providers\AdapterProviderInterface;

class PicpayClient implements AdapterProviderInterface
{
    public function authorizeTransaction(): bool
    {
        return true;
    }
}
