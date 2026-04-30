<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomClass extends Model
{
    protected $table = 'classes';
 
    protected $fillable = [
        'school_id',
        'name',
    ];
}
