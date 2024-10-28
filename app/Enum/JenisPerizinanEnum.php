<?php

namespace App\Enum;

enum JenisPerizinanEnum: string
{
    case PERIZINAN = 'perizinan';
    case NON_PERIZINAN = 'non_perizinan';

    public static function choice(): array
    {
        return [
            JenisPerizinanEnum::PERIZINAN->value => 'Perizinan',
            JenisPerizinanEnum::NON_PERIZINAN->value => 'Non Perizinan',
        ];
    }

    public static function label($case): string
    {
        return JenisPerizinanEnum::choice()[$case];
    }
}
