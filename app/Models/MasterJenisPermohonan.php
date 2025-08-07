<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJenisPermohonan extends Model
{
    protected $table = 'master_jenis_permohonan';
    
    protected $fillable = [
        'jenis_permohonan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}