<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiSuhu extends Model
{
    protected $table = "informasi_suhu";

    protected $fillable = [
        'content',
        'wilayah_id'
    ];
}
