<?php

namespace App\Enum;

enum IndeksKepuasanEnum: int
{
    case SANGAT_PUAS = 5;
    case PUAS = 4;
    case CUKUP = 3;
    case TIDAK_PUAS = 2;
    case SANGAT_TIDAK_PUAS = 1;

    public static function choice(): array
    {
        return [
            IndeksKepuasanEnum::SANGAT_PUAS->value => 'SANGAT PUAS',
            IndeksKepuasanEnum::PUAS->value => 'PUAS',
            IndeksKepuasanEnum::CUKUP->value => 'CUKUP',
            IndeksKepuasanEnum::TIDAK_PUAS->value => 'TIDAK PUAS',
            IndeksKepuasanEnum::SANGAT_TIDAK_PUAS->value => 'SANGAT TIDAK PUAS',
        ];
    }

    public static function label($case): string
    {
        return IndeksKepuasanEnum::choice()[$case];
    }
}
