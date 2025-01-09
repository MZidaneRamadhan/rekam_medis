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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->nullable();
            $table->foreignId('pasien_id')->constrained('pasien')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokter')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tindakan_id')->nullable();
            $table->string('keluhan');
            $table->string('diagnosa')->nullable();
            $table->string('resep')->nullable();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->longText('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
