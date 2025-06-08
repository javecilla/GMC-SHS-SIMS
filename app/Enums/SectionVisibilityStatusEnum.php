<?php

namespace App\Enums;

enum SectionVisibilityStatusEnum: string
{
    case Visible = 'Visible';
    case Hidden = 'Hidden';

    public function label(): string
    {
        return match ($this) {
            self::Visible => 'Visible',
            self::Hidden => 'Hidden',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
