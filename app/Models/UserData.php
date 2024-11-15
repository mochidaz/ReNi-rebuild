<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = "user_data";

    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'profile_photo'
    ];
}
