<?php

namespace App\Enums;

enum Liters: int
{

    case LITER = 1;
    case LITER5 = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
