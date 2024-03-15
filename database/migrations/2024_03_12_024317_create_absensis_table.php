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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_kelas')->nullable();
            $table->foreignId('id_materi')->nullable();
            $table->string('id_asisten')->nullable();
            $table->string('teaching_role')->nullable();
            $table->string('date');
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->integer('duration')->nullable();
            $table->foreignId('id_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
