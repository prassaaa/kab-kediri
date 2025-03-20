<?php

namespace App\Models\WBTB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDM extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wbtb_sdm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap',
        'gelar_pendidikan',
        'nama_alias',
        'jenis_identitas',
        'nomor_identitas',
        'tempat_lahir',
        'kewarganegaraan',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pas_foto',
        'foto_identitas',
        'alamat',
        'latitude',
        'longitude',
        'nomor_hp',
        'nama_ayah',
        'nama_ibu',
        'email',
        'media_sosial',
        'riwayat_pendidikan',
        'riwayat_pelatihan',
        'riwayat_pekerjaan',
        'riwayat_aktivitas',
        'riwayat_penghargaan',
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
        'tanggal_lahir' => 'date',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'riwayat_pendidikan' => 'array',
        'riwayat_pelatihan' => 'array',
        'riwayat_pekerjaan' => 'array',
        'riwayat_aktivitas' => 'array',
        'riwayat_penghargaan' => 'array',
    ];

    /**
     * Get the user that created the SDM.
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    /**
     * Get the user that verified the SDM.
     */
    public function verifier()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }
}