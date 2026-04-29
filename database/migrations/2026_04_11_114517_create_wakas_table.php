<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wakas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        
            $table->string('nis')->unique();
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakas');
    }
};
