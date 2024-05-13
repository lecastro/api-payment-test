<?php

declare(strict_types=1);

namespace Domain\Transaction\Domain\Enums;

enum TransactionStatusEnum: string
{
    case CREATED    = 'created';
    case COMPLETED  = 'completed';
    case CANCELED   = 'canceled';
    case DEFAULT    = 'default';
}
