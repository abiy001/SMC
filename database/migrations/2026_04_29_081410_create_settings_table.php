<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Profil Sekolah
            $table->string('school_name')->nullable();
            $table->text('school_address')->nullable();
            $table->string('school_website')->nullable();
            $table->string('school_email')->nullable();
            $table->string('school_phone')->nullable();
            $table->string('school_logo')->nullable();

            // Jadwal & Bel
            $table->time('school_start_time')->nullable();       // Jam masuk
            $table->time('school_end_time')->nullable();         // Jam pulang
            $table->integer('lesson_duration')->nullable();      // Durasi 1 jam pelajaran (menit)
            $table->integer('break_duration')->nullable();       // Durasi istirahat (menit)
            $table->time('break_start_time')->nullable();        // Jam mulai istirahat
            $table->json('active_days')->nullable();             // Hari aktif: ["Senin","Selasa",...]

            // Dokumen & KOP
            $table->string('principal_name')->nullable();        // Nama Kepala Sekolah
            $table->string('principal_nip')->nullable();         // NIP Kepala Sekolah
            $table->string('school_npsn')->nullable();           // NPSN
            $table->string('school_nss')->nullable();            // NSS
            $table->string('school_accreditation')->nullable();  // Akreditasi
            $table->string('kop_logo')->nullable();              // Logo KOP surat

            // Data & System
            $table->string('app_name')->nullable();
            $table->string('app_timezone')->default('Asia/Jakarta');
            $table->string('app_language')->default('id');
            $table->boolean('maintenance_mode')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};