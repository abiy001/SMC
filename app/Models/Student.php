<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Student extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'nisn',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}