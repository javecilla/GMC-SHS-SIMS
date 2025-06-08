<?php

namespace App\Enums;

enum EvaluationQuestionStatusEnum: string
{
    //'Active', 'Inactive'
    case Active = 'Active';
    case Inactive = 'Inactive';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
