<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = (string) Str::slug($model->nama);

            if ($file = request()->file('icon')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/link/', $fileName);

                $model->icon = $fileName;
            }
        });
    }

    public function getIconUrlAttribute()
    {
        return $this->icon != '' ? asset("storage/link/$this->icon") : false;
    }

    public function getFullUrlAttribute()
    {
        return Str::contains($this->url, ['https://', 'https://']) ? $this->url : 'https://'.$this->url;
    }
}
