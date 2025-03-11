<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CagarBudaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'objek_cagar_budaya',
        'predikat',
        'kategori',
        'no_reg_bpk_lama',
        'no_reg_bpk_baru',
        'no_reg_disparbud_nomor_urut',
        'no_reg_disparbud_kode_kecamatan',
        'no_reg_disparbud_kode_kabupaten',
        'no_reg_disparbud_tahun',
        'lokasi_jalan_dukuhan',
        'lokasi_dusun',
        'lokasi_desa',
        'lokasi_kecamatan',
        'bahan',
        'longitude',
        'latitude',
        'deskripsi_singkat',
        'gambar',
        'kondisi_saat_ini',
        'is_verified',
        'verified_by',
        'verified_at',
        'created_by',
        'status',           // Kolom baru untuk status revisi
        'revision_notes',
    ];

    // Relasi ke user yang membuat
    public function creator() 
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke user yang memverifikasi
    public function verifier() 
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Cagar budaya that need revision.
    public function scopeNeedsRevision($query)
    {
    return $query->where('status', 'needs_revision');
    }
}
