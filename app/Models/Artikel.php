<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = "articles";

    protected $fillable = [
        'title',
        'content',
        'image',
        'category',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
