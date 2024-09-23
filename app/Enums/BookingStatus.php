<?php

namespace App\Enums;

/**
 * Enum for booking status.
 */
enum BookingStatus: string
{
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case PENDING = 'pending';
    case FAILED = 'failed';
}
