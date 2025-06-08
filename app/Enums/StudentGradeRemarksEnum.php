<?php

namespace App\Enums;

enum StudentGradeRemarksEnum: string
{
    //'Not Posted Yet', 'Passed', 'Failed'
    case NotPostedYet = 'Not Posted Yet';
    case Passed = 'Passed';
    case Failed = 'Failed';

    public function label(): string
    {
        return match ($this) {
            self::NotPostedYet => 'Not Posted Yet',
            self::Passed => 'Passed',
            self::Failed => 'Failed',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
