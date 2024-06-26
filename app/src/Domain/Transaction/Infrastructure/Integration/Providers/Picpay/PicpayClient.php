<?php

declare(strict_types=1);

namespace Domain\Transaction\Infrastructure\Integration\Providers\Picpay;

use Illuminate\Support\Facades\Http;
use Domain\Transaction\Infrastructure\Integration\Providers\AdapterProviderInterface;

class PicpayClient implements AdapterProviderInterface
{
    public function authorizeTransaction(): bool
    {
        $request = Http::get('https://run.mocky.io/v3/5794d450-d2e2-4412-8131-73d0293ac1cc')->json();

        return $request['message'] == 'Autorizado';
    }
}
