<?php

namespace App\Enums;

enum AttendanceStatus: string
{
    case PRESENT = 'PRESENT';
    case ABSENT = 'ABSENT';
    case LATE = 'LATE';
    case SICK = 'SICK';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::PRESENT => 'PRESENT',
            self::ABSENT => 'ABSENT',
            self::LATE => 'LATE',
            self::SICK => 'SICK',
        };
    }
}