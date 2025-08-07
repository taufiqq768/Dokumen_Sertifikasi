<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProsesDokumen extends Model
{
    protected $table = 'proses_dokumen';
    
    protected $fillable = [
        'bidang_id',
        'posisi_id',
        'keterangan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel master_bidang
     */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(MasterBidang::class, 'bidang_id');
    }

    /**
     * Relasi ke tabel master_posisi
     */
    public function posisi(): BelongsTo
    {
        return $this->belongsTo(MasterPosisi::class, 'posisi_id');
    }
}