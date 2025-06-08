<?php

namespace App\Enums;

enum TuitionStatusEnum: string
{
    case VoucherHolder = 'Voucher Holder';
    case TuitionPayer = 'Tuition Payer';

    public function label(): string
    {
        return match($this) {
            self::VoucherHolder => 'Voucher Holder (Scholar)',
            self::TuitionPayer => 'Tuition Payer (Non-Scholar)',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
