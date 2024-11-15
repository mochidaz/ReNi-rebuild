<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiTanah extends Model
{
    protected $table = "informasi_tanah";

    protected $fillable = [
        'content',
        'wilayah_id'
    ];
}
