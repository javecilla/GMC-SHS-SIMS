<?php

namespace App\Enums;

enum DocumentStatusEnum: string
{
    case NotSubbmited = 'Not Subbmited';
    case Subbmited = 'Subbmited';

    public function label(): string
    {
        return match ($this) {
            self::NotSubbmited => 'Not Submitted',
            self::Subbmited => 'Submitted',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

