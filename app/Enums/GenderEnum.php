<?php

namespace App\Enums;

enum GenderEnum: string
{
    case Male = 'M';
    case Female = 'F';
    //case Other = 'Other';

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female',
            //self::Other => 'Other',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
