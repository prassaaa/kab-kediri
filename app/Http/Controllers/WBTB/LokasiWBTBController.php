<?php

namespace App\Http\Controllers\WBTB;

use App\Http\Controllers\Controller;
use App\Models\WBTB\Lembaga;
use App\Models\WBTB\Sarpras;
use App\Models\WBTB\SDM;
use App\Models\WBTB\OPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LokasiWBTBController extends Controller
{
    /**
     * Menampilkan halaman lokasi WBTB
     */
    public function index()
    {
        return view('wbtb.lokasi.index'); // Disesuaikan dengan struktur direktori yang ada
    }
    
    /**
     * Mengembalikan koordinat lembaga kebudayaan dalam format JSON untuk peta
     */
    public function getLembagaCoordinates()
    {
        $query = Lembaga::select('id', 'nama_lembaga', 'kategori_lembaga', 'alamat', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
            
        // Jika bukan admin/superadmin, hanya tampilkan yang sudah terverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }
        
        $lembaga = $query->get();
        
        return response()->json($lembaga);
    }
    
    /**
     * Mengembalikan koordinat sarana dan prasarana kebudayaan dalam format JSON untuk peta
     */
    public function getSarprasCoordinates()
    {
        $query = Sarpras::select('id', 'nama_sarpras', 'status_kepemilikan', 'alamat', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
            
        // Jika bukan admin/superadmin, hanya tampilkan yang sudah terverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }
        
        $sarpras = $query->get();
        
        return response()->json($sarpras);
    }
    
    /**
     * Mengembalikan koordinat SDM kebudayaan dalam format JSON untuk peta
     */
    public function getSDMCoordinates()
    {
        $query = SDM::select('id', 'nama_lengkap', 'alamat', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
            
        // Jika bukan admin/superadmin, hanya tampilkan yang sudah terverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }
        
        $sdm = $query->get();
        
        return response()->json($sdm);
    }
    
    /**
     * Mengembalikan koordinat objek pemajuan kebudayaan dalam format JSON untuk peta
     */
    public function getOPKCoordinates()
    {
        $query = OPK::select('id', 'nama_opk', 'jenis_opk', 'alamat', 'latitude', 'longitude')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
            
        // Jika bukan admin/superadmin, hanya tampilkan yang sudah terverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }
        
        $opk = $query->get();
        
        return response()->json($opk);
    }
}