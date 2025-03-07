<?php

use App\Models\CagarBudaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cagar-budaya-coordinates', function () {
    // Ambil cagar budaya yang sudah diverifikasi dan memiliki koordinat
    $cagarBudayas = CagarBudaya::where('is_verified', true)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->select('id', 'objek_cagar_budaya', 'predikat', 'kategori', 'latitude', 'longitude')
        ->get();
    
    return response()->json($cagarBudayas);
});

Route::get('/cagar-budaya-image/{id}', function ($id) {
    try {
        $cagarBudaya = CagarBudaya::findOrFail($id);
        
        // URL gambar default jika tidak ada gambar ditemukan
        $imageUrl = asset('images/default-placeholder.jpg');
        
        // Ambil nilai dari kolom gambar
        if ($cagarBudaya->gambar) {
            // Path yang benar, tidak duplikat 'cagar-budaya'
            $imageUrl = asset('storage/' . $cagarBudaya->gambar);
            
            // Log untuk debug
            Log::info('Gambar URL', [
                'id' => $id,
                'path_from_db' => $cagarBudaya->gambar,
                'final_url' => $imageUrl
            ]);
        }
        
        return response()->json([
            'image_url' => $imageUrl,
            'status' => 'success'
        ]);
        
    } catch (\Exception $e) {
        Log::error('Error fetching image', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return response()->json([
            'image_url' => asset('images/default-placeholder.jpg'),
            'status' => 'error',
            'message' => 'Gagal mengambil gambar: ' . $e->getMessage()
        ]);
    }
});