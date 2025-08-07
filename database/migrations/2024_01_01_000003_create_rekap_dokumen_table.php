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
        Schema::create('rekap_dokumen', function (Blueprint $table) {
            $table->id(); // Id
            $table->string('No_Berkas'); // No_Berkas
            $table->string('Lokasi'); // Lokasi (untuk company code)
            $table->enum('Posisi', ['berkas_baru_masuk', 'penelaahan', 'sirkular']); // Posisi
            $table->enum('Status', ['clear', 'unclear']); // Status
            $table->date('Tanggal_Informasi'); // Tanggal_Informasi
            $table->text('Keterangan')->nullable(); // Keterangan
            $table->string('PIC'); // PIC (Person In Charge)
            $table->text('Note')->nullable(); // Note
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_dokumen');
    }
};