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
        Schema::create('master_bidang', function (Blueprint $table) {
            $table->id();
            $table->string('NIA');
            $table->string('Entitas');
            $table->string('Regional');
            $table->string('Kebun');
            $table->string('Provinsi');
            $table->string('Kabupaten');
            $table->string('Kecamatan');
            $table->string('Desa');
            $table->decimal('Luas_areal', 10, 2); // 10 digit total, 2 digit desimal
            $table->integer('Jenis_Hak');
            $table->integer('Jenis_Permohonan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_bidang');
    }
};
