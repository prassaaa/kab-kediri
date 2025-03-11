<?php

namespace App\Http\Controllers;

use App\Models\CagarBudaya;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_cagar_budaya' => CagarBudaya::count(),
            'verified_cagar_budaya' => CagarBudaya::where('is_verified', true)->count(),
            'unverified_cagar_budaya' => CagarBudaya::where('is_verified', false)->count(),
            
            // Tambahkan perhitungan berdasarkan predikat
            'cagar_budaya_count' => CagarBudaya::where('predikat', 'Cagar Budaya')->count(),
            'objek_diduga_count' => CagarBudaya::where('predikat', 'Objek diduga cagar budaya')->count(),
            
            // Tambahkan distribusi kategori
            'kategori_distribution' => [
                'Benda' => CagarBudaya::where('kategori', 'Benda')->count(),
                'Bangunan' => CagarBudaya::where('kategori', 'Bangunan')->count(),
                'Struktur' => CagarBudaya::where('kategori', 'Struktur')->count(),
                'Situs' => CagarBudaya::where('kategori', 'Situs')->count(),
                'Kawasan' => CagarBudaya::where('kategori', 'Kawasan')->count(),
            ],
            
            // Tambahkan distribusi kecamatan
            'kecamatan_distribution' => $this->getKecamatanDistribution()
        ];
        
        // Jika superadmin, tambahkan data admin dan user
        if (auth()->user()->role === 'superadmin') {
            $data['total_admin'] = User::where('role', 'admin')->count();
            $data['total_user'] = User::where('role', 'user')->count();
        }
        
        return view('dashboard', compact('data'));
    }
    
    /**
     * (kecamatan)
     * 
     * @return array
     */
    private function getKecamatanDistribution()
    {
        $kecamatanData = CagarBudaya::select('lokasi_kecamatan', DB::raw('count(*) as total'))
            ->whereNotNull('lokasi_kecamatan')
            ->groupBy('lokasi_kecamatan')
            ->orderBy('total', 'desc')
            ->get()
            ->take(10) // Limit to top 10 kecamatan
            ->pluck('total', 'lokasi_kecamatan')
            ->toArray();
            
        return $kecamatanData;
    }
    
        /**
     * Show notification page.
     */
    public function notifikasi()
    {
        // Ambil data cagar budaya yang belum diverifikasi
        $unverified = CagarBudaya::where('is_verified', false)
                      ->with('creator')
                      ->latest()
                      ->get();
        
        // Jika user adalah superadmin, tambahkan data yang sudah direvisi
        if (Auth::user()->role === 'superadmin') {
            $revised = CagarBudaya::where('status', 'revised')
                      ->where('is_verified', false)
                      ->with('creator')
                      ->latest()
                      ->get();
            
            return view('notifikasi.index', compact('unverified', 'revised'));
        }
        
        // Jika user adalah admin, ambil hanya data yang memerlukan revisi miliknya
        if (Auth::user()->role === 'admin') {
            $needsRevision = CagarBudaya::where('status', 'needs_revision')
                            ->where('created_by', Auth::id())
                            ->with('creator')
                            ->latest()
                            ->get();
            
            return view('notifikasi.index', compact('unverified', 'needsRevision'));
        }
        
        return view('notifikasi.index', compact('unverified'));
    }
}