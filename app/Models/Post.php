<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    use HasFactory;

    public $searchableType = 'Post';

    protected $guarded = ['id'];

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->judul,
            $this->url
        );
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->judul);

            if ($file = request()->file('gambar')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/gambar/', $fileName);

                $model->gambar = $fileName;
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function getUrlAttribute()
    {
        return route('front.post.baca', $this->slug);
    }

    public function getGambarUrlAttribute()
    {
        return $this->gambar != '' ? asset("storage/gambar/$this->gambar") : asset('static/sampel.jpg');
    }

    public function getPublishAtLabelAttribute()
    {
        return Carbon::parse($this->publish_at)->diffForHumans();
    }
}
