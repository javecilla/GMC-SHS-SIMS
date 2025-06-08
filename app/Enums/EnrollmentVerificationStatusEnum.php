<?php

namespace App\Enums;

enum EnrollmentVerificationStatusEnum: string
{
    case Verified = 'Verified';
    case Pending = 'Pending';
    case NotVerified = 'Not Verified';

    public function label(): string
    {
        return match($this) {
            self::Verified => 'Verified',
            self::Pending => 'Pending',
            self::NotVerified => 'Not Verified',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
