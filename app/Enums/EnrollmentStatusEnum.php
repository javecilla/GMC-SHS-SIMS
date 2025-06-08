<?php

namespace App\Enums;

enum EnrollmentStatusEnum: string
{
    case Pending = 'Pending';
    case Enrolled = 'Enrolled';
    case Cancelled = 'Cancelled';
    case Dropped = 'Dropped';
    case Transferred = 'Transferred';
    case Graduated = 'Graduated';

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Enrolled => 'Enrolled',
            self::Cancelled => 'Cancelled',
            self::Dropped => 'Dropped',
            self::Transferred => 'Transferred',
            self::Graduated => 'Graduated',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
