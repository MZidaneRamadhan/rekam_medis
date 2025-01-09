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
        Schema::create('obat_pasien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->constrained('rekam_medis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('obat_id')->constrained('obat')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat_pasien');
    }
};
