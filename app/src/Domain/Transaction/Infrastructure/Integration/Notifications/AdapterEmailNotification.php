<?php

declare(strict_types=1);

namespace Domain\Transaction\Infrastructure\Integration\Notifications;

interface AdapterEmailNotification
{
    public function sendEmailNotification(): bool;
}
