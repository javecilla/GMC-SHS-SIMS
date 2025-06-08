<?php

namespace App\Enums;

enum FreebiesStatusEnum: string
{
    case NotReceived = 'Not Received';
    case Received = 'Received';

    public function label(): string
    {
        return match ($this) {
            self::NotReceived => 'Not Received',
            self::Received => 'Received',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}


