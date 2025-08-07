<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapDokumen extends Model
{
    use HasFactory;

    protected $table = 'rekap_dokumen';

    protected $fillable = [
        'No_Berkas',
        'Lokasi',
        'Posisi',
        'Status',
        'Tanggal_Informasi',
        'Keterangan',
        'PIC',
        'Note'
    ];

    protected $casts = [
        'Tanggal_Informasi' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk filter berdasarkan posisi
    public function scopeByPosisi($query, $posisi)
    {
        return $query->where('Posisi', $posisi);
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('Status', $status);
    }

    // Scope untuk filter berdasarkan lokasi (company code)
    public function scopeByLokasi($query, $lokasi)
    {
        return $query->where('Lokasi', $lokasi);
    }
}