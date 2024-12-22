<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPanen extends Model
{
    protected $table = "data_panen";

    protected $fillable = [
        'tanggal_penanaman',
        'tanggal_panen',
        'pangan_id',
        'user_id',
        'hasil_panen',
        'lahan_id'
    ];

    public function pangan()
    {
        return $this->belongsTo(Pangan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lahan()
    {
        return $this->belongsTo(LahanPetani::class);
    }   
}
