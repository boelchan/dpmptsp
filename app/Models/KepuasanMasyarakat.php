<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KepuasanMasyarakat extends Model
{
    use HasFactory, Uuid;

    protected $table = 'survei_kepuasan_masyarakat';

    protected $guarded = ['id'];

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(InstansiLayanan::class, 'layanan_id');
    }

    public function detail()
    {
        return $this->hasMany(SKMDetail::class, 'skm_id');
    }
}
