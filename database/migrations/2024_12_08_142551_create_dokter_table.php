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
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poli_id')->constrained('poliklinik')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_dokter');
            $table->string('SIP');
            $table->string('telp');
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
