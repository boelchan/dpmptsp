<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Instansi extends Model implements Searchable
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instansi';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public $searchableType = 'Instansi';

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
                $file->move('storage/instansi/', $fileName);

                $model->icon = $fileName;
            }
        });
    }

    public function getUrlAttribute()
    {
        return route('front.instansi', $this->slug);
    }

    public function getIconUrlAttribute()
    {
        return $this->icon != '' ? asset("storage/instansi/$this->icon") : asset('static/sampel.jpg');
    }

    public function layanan()
    {
        return $this->hasMany(InstansiLayanan::class, 'instansi_id');
    }

    public function layananAktif()
    {
        return $this->hasMany(InstansiLayanan::class, 'instansi_id')->where('publish', 'ya');
    }

    public function getJumlahAntrianInstansiAttribute()
    {
        $tanggal = request()->tanggal ?? Carbon::today();

        $antrian = Antrian::where('instansi_id', $this->id)->where('tanggal', $tanggal)->first();
        if ($antrian) {
            return $antrian->detail_kunjungan->count();
        }

        return 0;
    }

    public static function jumlahAntrian()
    {
        $tanggal = request()->tanggal ?? Carbon::today();

        $antrian = Antrian::where('tanggal', $tanggal)->get();
        if ($antrian) {
            $total = 0;
            foreach ($antrian as $an) {
                $total += $an->detail_kunjungan->count();
            }

            return $total;
        }

        return 0;
    }
}
