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
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('poliklinik')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan');
            $table->string('status_kunjungan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
