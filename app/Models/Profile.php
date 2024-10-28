<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->nama);

            if ($file = request()->file('gambar')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/profil/', $fileName);

                $model->gambar = $fileName;
            }
        });
    }

    public function getUrlGambarAttribute()
    {
        return $this->gambar != '' ? asset("storage/profil/$this->gambar") : false;
    }
}
