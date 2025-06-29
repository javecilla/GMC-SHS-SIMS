<?php

namespace App\Enums;

enum SchoolStatus: string
{
    case Public = 'Public';
    case Private = 'Private';

    public function label(): string
    {
        return match ($this) {
            self::Public => 'Public',
            self::Private => 'Private',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

