<?php

namespace App\Enums;

enum ComplterAsEnum: string
{
    case ALS = 'Alternative Learning System';
    case JHS = 'Junior High School';

    public function label(): string
    {
        return match ($this) {
            self::ALS => 'Alternative Learning System (ALS)',
            self::JHS => 'Junior High School (JHS)',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

