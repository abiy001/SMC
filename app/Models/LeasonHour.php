<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LeasonHour extends Model
{

    use HasUuids;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'room_class_id',
        'day',          // ← tambah
        'lesson_hour',  // ← tambah
        'room', 
        'title',
        'color',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'lesson_hour' => 'integer',

    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classes()
    {
        return $this->belongsTo(RoomClass::class, 'room_class_id');
    }

    // Map warna ke hex untuk FullCalendar
    public function getColorHexAttribute(): string
    {
        return match($this->color) {
            'Danger'  => '#EF4444',
            'Success' => '#22C55E',
            'Warning' => '#F59E0B',
            default   => '#7C3AED', // Primary
        };
    }
}

