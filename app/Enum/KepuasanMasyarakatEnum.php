<?php

namespace App\Enum;

enum KepuasanMasyarakatEnum: int
{
    case PUAS = 1;
    case TIDAK_PUAS = 2;

    public static function choice(): array
    {
        return [
            KepuasanMasyarakatEnum::PUAS->value => 'Puas',
            KepuasanMasyarakatEnum::TIDAK_PUAS->value => 'Tidak Puas',
        ];
    }

    public static function label($case): string
    {
        return KepuasanMasyarakatEnum::choice()[$case];
    }
}
