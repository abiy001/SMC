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
    Schema::create('leason_hours', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('teacher_id');
        $table->uuid('subject_id')->nullable();
        $table->uuid('room_class_id')->nullable();
        $table->string('title');
        $table->string('day')->nullable();          // ← tanpa ->after()
        $table->integer('lesson_hour')->nullable(); // ← tanpa ->after()
        $table->string('room')->nullable();         // ← tanpa ->after()
        $table->string('color')->default('Primary');
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->timestamps();

        $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leason_hours');
    }
};
