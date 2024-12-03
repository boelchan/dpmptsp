<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    /**
     * Get all of the pegawai for the Bidang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'bidang_id')
            ->orderBy('is_leader', 'asc');
    }
}
