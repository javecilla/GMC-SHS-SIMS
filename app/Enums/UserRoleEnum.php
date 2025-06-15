<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case SuperAdmin = 'Super Admin';
    case Employee = 'Employee';
    case Student = 'Student';

    public function label(): string
    {
        return match($this) {
            self::SuperAdmin => 'Super Admin',
            self::Employee => 'Employee',
            self::Student => 'Student',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
