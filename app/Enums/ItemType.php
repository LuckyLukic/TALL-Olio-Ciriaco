<?php

namespace App\Enums;

enum ItemType: string
{

    case EXTRAVIRGENOIL = 'olio_extravergine';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
