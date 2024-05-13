<?php

declare(strict_types=1);

namespace Domain\Transaction\Infrastructure\Integration\Notifications;

class CallSMSNotification
{
    public function __construct(protected AdapterSMSNotification $notification)
    {
    }

    public function getAdapter(): AdapterSMSNotification
    {
        return $this->notification;
    }
}
