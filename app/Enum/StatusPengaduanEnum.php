<?php

namespace App\Enum;

enum StatusPengaduanEnum: string
{
    case BARU = 'baru';
    case VALID = 'valid';
    case SELESAI = 'selesai';

    public static function choice(): array
    {
        return [
            StatusPengaduanEnum::BARU->value => 'Baru',
            StatusPengaduanEnum::VALID->value => 'Valid',
            StatusPengaduanEnum::SELESAI->value => 'Selesai',
        ];
    }

    public static function label($case): string
    {
        return StatusPengaduanEnum::choice()[$case];
    }
}
