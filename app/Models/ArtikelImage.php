<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelImage extends Model
{
    protected $table = "artikel_images";

    protected $fillable = [
        'artikel_id',
        'image'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }
}
