<?php

namespace App\Models;

use App\Enum\IndeksKepuasanEnum;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianDetail extends Model
{
    use HasFactory, Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'antrian_detail';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function layanan()
    {
        return $this->belongsTo(InstansiLayanan::class);
    }

    public function getKepuasanLabelAttribute()
    {
        if ($this->kepuasan) {
            return IndeksKepuasanEnum::label($this->kepuasan);
        }
    }

    public function getLayananLabelAttribute()
    {
        if ($this->layanan_id == 999999) {
            return 'Lainnya';
        }
        if ($this->layanan_id) {
            return $this->layanan->nama;
        }
    }
}
