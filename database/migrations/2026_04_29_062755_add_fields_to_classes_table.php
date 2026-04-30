<?php
// database/migrations/xxxx_add_fields_to_classes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->enum('level', ['SD', 'SMP', 'SMA'])->default('SMA')->after('name');
            $table->string('grade')->nullable()->after('level'); // X, XI, XII, dll
            $table->integer('capacity')->default(36)->after('grade');
        });
    }

    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn(['level', 'grade', 'capacity']);
        });
    }
};