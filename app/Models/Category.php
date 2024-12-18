<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->nama);
        });
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'kategori_id');
    }

    public function subMenu()
    {
        return $this->hasMany(Post::class, 'kategori_id')->where('add_to_submenu', 'ya')->orderBy('publish_at', 'desc')->limit(10);
    }

    public function getUrlAttribute()
    {
        return route('front.post.kategori', $this->slug);
    }

    public static function kategoriOption(): array
    {
        if (auth()->user()->hasRole('instansi')) {
            return Category::whereNotIn('id', [1, 2, 3])->pluck('nama', 'id')->all();
        }

        return Category::pluck('nama', 'id')->all();
    }
}
