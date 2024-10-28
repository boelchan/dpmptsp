<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndeksKepuasanMasyarakat extends Model
{
    use HasFactory;

    protected $table = 'indeks_kepuasan_masyarakat';

    protected $guarded = ['id'];
}
