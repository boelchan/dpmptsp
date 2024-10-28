<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Team extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Dokter';

    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->nama,
            $this->url
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->nama);

            if ($file = request()->file('gambar')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/team/', $fileName);

                $model->gambar = $fileName;
            }
        });
    }

    public function getUrlGambarAttribute()
    {
        return $this->gambar != '' ? asset("storage/team/$this->gambar") : false;
    }

    public function getUrlAttribute()
    {
        return route('front.dokter.baca', $this->slug);
    }
}
