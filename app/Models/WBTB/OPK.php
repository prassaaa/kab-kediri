<?php

namespace App\Models\WBTB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPK extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wbtb_opk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_opk',
        'jenis_opk',
        'deskripsi',
        'alamat',
        'foto',
        'dokumen_kajian',
        'tautan_video',
        'dokumen_lainnya',
        'latitude',
        'longitude',
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
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the user that created the OPK.
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    /**
     * Get the user that verified the OPK.
     */
    public function verifier()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }
}