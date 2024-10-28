<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotIKM extends Model
{
    use HasFactory;

    protected $table = 'bobot_ikm';

    protected $guarded = ['id'];
}
