<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterStatusDokumen extends Model
{
    use HasFactory;

    protected $table = 'master_status_dokumen';

    protected $fillable = [
        'status_dokumen'
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
        return $this->hasMany(ProsesDokumen::class, 'status_dokumen_id');
    }
}
