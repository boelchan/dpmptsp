<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Service extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Fasilitas';

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

            if ($file = request()->file('icon')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/layanan/', $fileName);

                $model->icon = $fileName;
            }
        });
    }

    public function getIconUrlAttribute()
    {
        return $this->icon != '' ? asset("storage/layanan/$this->icon") : false;
    }

    public function getUrlAttribute()
    {
        return route('front.fasilitas.baca', $this->slug);
    }
}
