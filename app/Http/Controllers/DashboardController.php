<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CagarBudaya;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_cagar_budaya' => CagarBudaya::count(),
            'verified_cagar_budaya' => CagarBudaya::where('is_verified', true)->count(),
            'unverified_cagar_budaya' => CagarBudaya::where('is_verified', false)->count(),
        ];
        
        // Jika superadmin, tambahkan data admin dan user
        if (auth()->user()->role === 'superadmin') {
            $data['total_admin'] = User::where('role', 'admin')->count();
            $data['total_user'] = User::where('role', 'user')->count();
        }
        
        return view('dashboard', compact('data'));
    }

    public function notifikasi()
{
    // Implementasi notifikasi (untuk tahap awal, kita bisa menampilkan data cagar budaya yang belum diverifikasi)
    $unverified = CagarBudaya::where('is_verified', false)
        ->with('creator')
        ->orderBy('created_at', 'desc')
        ->get();
        
    return view('notifikasi.index', compact('unverified')); // Perhatikan perubahan di sini
}
}
