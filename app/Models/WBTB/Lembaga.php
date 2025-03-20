<?php

namespace App\Models\WBTB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wbtb_lembaga';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lembaga',
        'kategori_lembaga',
        'nomor_registrasi',
        'tanggal_berdiri',
        'tingkat_lembaga',
        'status_hukum',
        'visi_misi',
        'alamat',
        'latitude',
        'longitude',
        'nomor_telepon',
        'email',
        'website',
        'media_sosial',
        'nama_pimpinan',
        'jabatan_pimpinan',
        'pengurus',
        'jumlah_anggota',
        'aktivitas',
        'prestasi',
        'logo',
        'foto_bangunan',
        'foto_kegiatan',
        'dokumen_legalitas',
        'created_by',
        'is_verified',
        'verified_by',
        'verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_berdiri' => 'date',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'pengurus' => 'array',
        'aktivitas' => 'array',
        'prestasi' => 'array',
        'foto_kegiatan' => 'array',
    ];

    /**
     * Get the user that created the Lembaga.
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    /**
     * Get the user that verified the Lembaga.
     */
    public function verifier()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }
}