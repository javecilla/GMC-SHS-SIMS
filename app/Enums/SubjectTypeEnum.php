<?php

namespace App\Enums;

enum SubjectTypeEnum: string
{
    case Applied = 'Applied';
    case Core = 'Core';
    case Specialized = 'Specialized';

    public function label(): string
    {
        return match($this) {
            self::Applied => 'Applied',
            self::Core => 'Core',
            self::Specialized => 'Specialized',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
