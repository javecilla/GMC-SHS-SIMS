<?php

namespace App\Enums;

enum SectionProgressStatusEnum: string
{
    case Pending = 'Pending';
    case Done = 'Done';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Done => 'Done',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
