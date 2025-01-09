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
        Schema::create('labolatorium', function (Blueprint $table) {
            $table->id();
            $table->string('no_lab');
            $table->foreignId('rekam_medis_id')->constrained('rekam_medis')->onUpdate('cascade')->onDelete('cascade');
            $table->string('hasil_lab');
            $table->string('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labolatorium');
    }
};
