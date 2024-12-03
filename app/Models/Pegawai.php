<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
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
            if ($file = request()->file('foto')) {
                $fileName = microtime().'.'.$file->extension();
                $file->move('storage/pegawai/', $fileName);

                $model->foto = $fileName;
            }
        });
    }

    /**
     * Get the bidang that owns the Pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function getFotoUrlAttribute()
    {
        return $this->foto != '' ? asset("storage/pegawai/$this->foto") : asset('static/sampel.jpg');
    }
}
