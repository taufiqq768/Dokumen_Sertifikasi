<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJenisHak extends Model
{
    protected $table = 'master_jenis_hak';
    
    protected $fillable = [
        'jenis_hak',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}