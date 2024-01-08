<?php

namespace App\Enums;

enum ItemType: string
{

    case EXTRAVIRGENOIL = 'olio extravergine';


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
