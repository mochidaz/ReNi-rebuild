<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiAir extends Model
{
    protected $table = "informasi_air";

    protected $fillable = [
        'content',
        'wilayah_id'
    ];
}
