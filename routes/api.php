<?php

use App\Models\CagarBudaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cagar-budaya-coordinates', function () {
    // Ambil cagar budaya yang sudah diverifikasi dan memiliki koordinat
    $cagarBudayas = CagarBudaya::where('is_verified', true)
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->select('id', 'objek_cagar_budaya', 'kategori', 'latitude', 'longitude')
        ->get();
    
    return response()->json($cagarBudayas);
});