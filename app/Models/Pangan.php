<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangan extends Model
{
    protected $table = "pangan";

    protected $fillable = [
        'id',
        'name'
    ];
}
