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
            $table->foreignId('jenis_permohonan_id')->constrained('master_jenis_permohonan')->onDelete('cascade');
            $table->decimal('Luas_permohonan', 10, 2);
            $table->foreignId('posisi_id')->constrained('master_posisi')->onDelete('cascade');
            $table->foreignId('status_dokumen_id')->constrained('master_status_dokumen')->onDelete('cascade');
            $table->date('tanggal_pemberitahuan');
            $table->text('keterangan')->nullable();
            $table->boolean('tl_ptpn')->nullable();
            $table->boolean('tl_bpn')->nullable();
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