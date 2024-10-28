<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function setting($tipe)
    {
        $identitas = self::firstWhere('slug', $tipe);

        if ($identitas->tipe == 'website') {
            return asset('storage/static/'.$identitas->value);
        }

        return $identitas->value;
    }
}
