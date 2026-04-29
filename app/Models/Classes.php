<?php
// app/Models/Classes.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Classes extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'level', 'grade', 'capacity'];

    protected $table = 'classes';
}