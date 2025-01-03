<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = "artikel";

    protected $fillable = [
        'title',
        'content',
        'image',
        'category',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
