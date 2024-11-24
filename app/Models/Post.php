<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
        $post_at = Carbon::parse($this->publish_at);

        $post_day = $post_at->diffInDays(Carbon::now());

        if ($post_day < 10) {
            return Carbon::parse($this->publish_at)->diffForHumans();
        }

        return tanggal($this->publish_at);
    }
}
