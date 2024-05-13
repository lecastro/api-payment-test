<?php

declare(strict_types=1);

namespace Domain\Transaction\Infrastructure\Integration\Notifications;

interface AdapterSMSNotification
{
    public function sendSMSNotification(): bool;
}
