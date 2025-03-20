<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CagarBudayaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


// storage-link //
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully.';
});

// Route Publik
Route::get('/', function () {
    return view('welcome');
});

// WBTB Routes
Route::prefix('wbtb')->name('wbtb.')->middleware(['auth'])->group(function () {
    // OPK Routes
    Route::resource('opk', \App\Http\Controllers\WBTB\OPKController::class);
    Route::post('opk/{opk}/verify', [\App\Http\Controllers\WBTB\OPKController::class, 'verify'])->name('opk.verify');
    
    // SDM Kebudayaan Routes
    Route::resource('sdm', \App\Http\Controllers\WBTB\SDMController::class);
    Route::post('sdm/{sdm}/verify', [\App\Http\Controllers\WBTB\SDMController::class, 'verify'])->name('sdm.verify');
    
    // Lembaga Kebudayaan Routes
    Route::resource('lembaga', \App\Http\Controllers\WBTB\LembagaController::class);
    Route::post('lembaga/{lembaga}/verify', [\App\Http\Controllers\WBTB\LembagaController::class, 'verify'])->name('lembaga.verify');
    
    // Sarpras Routes
    Route::resource('sarpras', \App\Http\Controllers\WBTB\SarprasController::class, [
        'parameters' => ['sarpras' => 'sarpras']
    ]);
    Route::post('sarpras/{sarpras}/verify', [\App\Http\Controllers\WBTB\SarprasController::class, 'verify'])->name('sarpras.verify');
    
    // Peta Lokasi Route
    Route::get('lokasi', [\App\Http\Controllers\WBTB\LokasiWBTBController::class, 'index'])
    ->name('lokasi');
});

// Route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/cagar-budaya/lokasi', [CagarBudayaController::class, 'lokasi'])->name('cagar-budaya.lokasi');
    Route::get('/cagar-budaya/import', [CagarBudayaController::class, 'importForm'])->name('cagar-budaya.import-form');
    Route::post('/cagar-budaya/import', [CagarBudayaController::class, 'import'])->name('cagar-budaya.import');
    Route::get('/cagar-budaya/template-download', [CagarBudayaController::class, 'downloadTemplate'])->name('cagar-budaya.template-download');
    // Route untuk semua user yang sudah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes dari Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Route untuk cagar budaya (bisa diakses oleh semua user tetapi dengan limitasi)
    Route::get('/cagar-budaya', [CagarBudayaController::class, 'index'])->name('cagar-budaya.index');
    Route::get('/cagar-budaya/create', [CagarBudayaController::class, 'create'])->name('cagar-budaya.create');
    Route::get('/cagar-budaya/{cagarBudaya}', [CagarBudayaController::class, 'show'])->name('cagar-budaya.show');
    
    // Route untuk admin dan superadmin
    Route::middleware('role:admin,superadmin')->group(function () {
        // Route untuk export PDF per kecamatan
        Route::get('/cagar-budaya/export/kecamatan', [CagarBudayaController::class, 'exportByKecamatan'])->name('cagar-budaya.export.kecamatan');
        // Route untuk export PDF per objek
        Route::get('/cagar-budaya/{cagarBudaya}/export', [CagarBudayaController::class, 'exportById'])->name('cagar-budaya.export.detail');
        Route::get('/cagar-budaya/create', [CagarBudayaController::class, 'create'])->name('cagar-budaya.create');
        Route::post('/cagar-budaya', [CagarBudayaController::class, 'store'])->name('cagar-budaya.store');
        Route::get('/cagar-budaya/{cagarBudaya}/edit', [CagarBudayaController::class, 'edit'])->name('cagar-budaya.edit');
        Route::put('/cagar-budaya/{cagarBudaya}', [CagarBudayaController::class, 'update'])->name('cagar-budaya.update');
        
        // Ubah route notifikasi ke notifikasi.index (sesuai dengan struktur file)
        Route::get('/notifikasi', [DashboardController::class, 'notifikasi'])->name('notifikasi');
        
        // Route baru untuk submit hasil revisi
        Route::put('/cagar-budaya/{cagarBudaya}/submit-revision', [CagarBudayaController::class, 'submitRevision'])
            ->name('cagar-budaya.submit-revision');
    });
    
    // Route khusus superadmin
    Route::middleware('role:superadmin')->group(function () {
        // Pengelolaan admin
        Route::resource('admin', AdminController::class);
        
        // Pengelolaan user
        Route::resource('user', UserController::class);
        
        // Verifikasi cagar budaya
        Route::put('/cagar-budaya/{cagarBudaya}/verify', [CagarBudayaController::class, 'verify'])->name('cagar-budaya.verify');
        Route::delete('/cagar-budaya/{cagarBudaya}', [CagarBudayaController::class, 'destroy'])->name('cagar-budaya.destroy');
        
        // Route baru untuk meminta revisi (gunakan POST, bukan PUT)
        Route::post('/cagar-budaya/{cagarBudaya}/request-revision', [CagarBudayaController::class, 'requestRevision'])
            ->name('cagar-budaya.request-revision');
    });

    // Route untuk test koneksi
    Route::get('/connection-test', function() {
        return response()->json(['status' => 'ok', 'time' => now()->toIso8601String()]);
    })->name('connection.test');
});

Route::prefix('api/wbtb')->group(function () {
    Route::get('lembaga-coordinates', [\App\Http\Controllers\WBTB\LokasiWBTBController::class, 'getLembagaCoordinates']);
    Route::get('sarpras-coordinates', [\App\Http\Controllers\WBTB\LokasiWBTBController::class, 'getSarprasCoordinates']);
    Route::get('sdm-coordinates', [\App\Http\Controllers\WBTB\LokasiWBTBController::class, 'getSDMCoordinates']);
    Route::get('opk-coordinates', [\App\Http\Controllers\WBTB\LokasiWBTBController::class, 'getOPKCoordinates']);
});

require __DIR__.'/auth.php';