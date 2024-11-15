<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LahanPetani extends Model
{
    protected $table = "lahan_petani";

    protected $fillable = [
        'luas_lahan',
        'user_id',
        'wilayah_id',
        'name',
        'lokasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
}
