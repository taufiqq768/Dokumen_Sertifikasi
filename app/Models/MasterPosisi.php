<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterPosisi extends Model
{
    use HasFactory;

    protected $table = 'master_posisi';

    protected $fillable = [
        'posisi'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel proses_dokumen
     */
    public function prosesDokumen(): HasMany
    {
        return $this->hasMany(ProsesDokumen::class, 'posisi_id');
    }
}
