<?php

namespace App\Models\WBTB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sarpras extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wbtb_sarpras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_sarpras',
        'deskripsi',
        'alamat',
        'latitude',
        'longitude',
        'nama_kontak',
        'no_hp',
        'status_kepemilikan',
        'nama_pemilik',
        'nama_pengelola',
        'papan_nama',
        'foto_dalam',
        'foto_luar',
        'fasilitas',
        'created_by',
        'verified_by',
        'verified_at',
        'is_verified',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fasilitas' => 'array',
        'verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the user who created this sarpras.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who verified this sarpras.
     */
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}