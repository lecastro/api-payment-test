<?php

namespace Domain\Transaction\Infrastructure\Integration\Notifications\SMS;

use Illuminate\Support\Facades\Http;
use Domain\Transaction\Infrastructure\Integration\Notifications\AdapterSMSNotification;

class SMSClient implements AdapterSMSNotification
{
    public function sendSMSNotification(): bool
    {
        $request = Http::get('https://run.mocky.io/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6')
            ->json();

        return $request['message'] === true;
    }
}
