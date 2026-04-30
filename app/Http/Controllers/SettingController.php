<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        // Profil Sekolah
        'school_name',
        'school_address',
        'school_website',
        'school_email',
        'school_phone',
        'school_logo',

        // Jadwal & Bel
        'school_start_time',
        'school_end_time',
        'lesson_duration',
        'break_duration',
        'break_start_time',
        'active_days',

        // Dokumen & KOP
        'principal_name',
        'principal_nip',
        'school_npsn',
        'school_nss',
        'school_accreditation',
        'kop_logo',

        // Data & System
        'app_name',
        'app_timezone',
        'app_language',
        'maintenance_mode',
    ];

    protected $casts = [
        'active_days'      => 'array',
        'maintenance_mode' => 'boolean',
    ];

    /**
     * Ambil setting (selalu baris pertama / singleton).
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate([], [
            'school_name'      => 'Nama Sekolah',
            'app_name'         => 'Sekolah Kita',
            'app_timezone'     => 'Asia/Jakarta',
            'app_language'     => 'id',
            'lesson_duration'  => 45,
            'break_duration'   => 15,
            'active_days'      => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
            'maintenance_mode' => false,
        ]);
    }
}