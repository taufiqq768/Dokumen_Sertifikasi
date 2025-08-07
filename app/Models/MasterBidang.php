<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterBidang extends Model
{
    use HasFactory;

    protected $table = 'master_bidang';

    protected $fillable = [
        'NIA',
        'Entitas',
        'Regional',
        'Kebun',
        'Provinsi',
        'Kabupaten',
        'Kecamatan',
        'Desa',
        'Luas_areal',
        'Jenis_Hak',
        'Jenis_Permohonan'
    ];

    protected $casts = [
        'Luas_areal' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel proses_dokumen
     */
    public function prosesDokumen(): HasMany
    {
        return $this->hasMany(ProsesDokumen::class, 'bidang_id');
    }
}