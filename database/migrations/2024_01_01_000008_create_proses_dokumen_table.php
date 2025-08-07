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
        Schema::create('proses_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_id')->constrained('master_bidang')->onDelete('cascade');
            $table->foreignId('posisi_id')->constrained('master_posisi')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses_dokumen');
    }
};