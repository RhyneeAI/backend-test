<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'ADMIN';
    case EMPLOYEE = 'EMPLOYEE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'ADMIN',
            self::EMPLOYEE => 'EMPLOYEE',
        };
    }
}