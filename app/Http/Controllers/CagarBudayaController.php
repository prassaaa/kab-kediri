<?php

namespace App\Http\Controllers;

use App\Models\CagarBudaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Str;

class CagarBudayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CagarBudaya::query();

        // Filter berdasarkan pencarian
        if ($search = $request->input('search')) {
            $query->where('objek_cagar_budaya', 'like', '%' . $search . '%');
        }
    
        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        // Filter berdasarkan status verifikasi
        if ($request->filled('status')) {
            $query->where('is_verified', $request->status === 'verified');
        }
        
        // Filter berdasarkan lokasi kecamatan
        if ($request->filled('kecamatan')) {
            $query->where('lokasi_kecamatan', $request->kecamatan);
        }
        
        // Jika user biasa, tampilkan hanya yang sudah diverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }
    
        $cagarBudayas = $query->latest()->paginate(10);
    
        // Ambil daftar kecamatan untuk filter
        $kecamatans = CagarBudaya::select('lokasi_kecamatan')
            ->distinct()
            ->pluck('lokasi_kecamatan');
        
        return view('cagar-budaya.index', compact('cagarBudayas', 'kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cagar-budaya.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'objek_cagar_budaya' => 'required|string|max:255',
            'predikat' => 'required|in:Cagar Budaya,Objek diduga cagar budaya',
            'kategori' => 'required|in:Benda,Bangunan,Struktur,Situs,Kawasan',
            'no_reg_bpk_lama' => 'nullable|string|max:255',
            'no_reg_bpk_baru' => 'nullable|string|max:255',
            'no_reg_disparbud_nomor_urut' => 'nullable|string|max:255',
            'no_reg_disparbud_kode_kecamatan' => 'nullable|string|max:255',
            'no_reg_disparbud_kode_kabupaten' => 'nullable|string|max:255',
            'no_reg_disparbud_tahun' => 'nullable|string|max:255',
            'lokasi_jalan_dukuhan' => 'nullable|string|max:255',
            'lokasi_dusun' => 'nullable|string|max:255',
            'lokasi_desa' => 'required|string|max:255',
            'lokasi_kecamatan' => 'required|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'deskripsi_singkat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisi_saat_ini' => 'nullable|string',
        ]);
        
        // Handle file upload jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('cagar-budaya', 'public');
            $validated['gambar'] = $gambarPath;
        }
        
        // Set created_by to current user
        $validated['created_by'] = Auth::id();
        
        // Set is_verified true jika superadmin
        if (Auth::user()->role === 'superadmin') {
            $validated['is_verified'] = true;
            $validated['verified_by'] = Auth::id();
            $validated['verified_at'] = now();
        } else {
            $validated['is_verified'] = false;
        }
        
        CagarBudaya::create($validated);
        
        return redirect()->route('cagar-budaya.index')
            ->with('success', 'Data cagar budaya berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CagarBudaya $cagarBudaya)
    {
        // Jika user biasa dan data belum diverifikasi, tolak akses
        if (Auth::user()->role === 'user' && !$cagarBudaya->is_verified) {
            abort(403, 'Data belum diverifikasi.');
        }
        
        return view('cagar-budaya.show', compact('cagarBudaya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CagarBudaya $cagarBudaya)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $cagarBudaya->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }
        
        return view('cagar-budaya.edit', compact('cagarBudaya'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CagarBudaya $cagarBudaya)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $cagarBudaya->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }
        
        $validated = $request->validate([
            'objek_cagar_budaya' => 'required|string|max:255',
            'predikat' => 'required|in:Cagar Budaya,Objek diduga cagar budaya',
            'kategori' => 'required|in:Benda,Bangunan,Struktur,Situs,Kawasan',
            'no_reg_bpk_lama' => 'nullable|string|max:255',
            'no_reg_bpk_baru' => 'nullable|string|max:255',
            'no_reg_disparbud_nomor_urut' => 'nullable|string|max:255',
            'no_reg_disparbud_kode_kecamatan' => 'nullable|string|max:255',
            'no_reg_disparbud_kode_kabupaten' => 'nullable|string|max:255',
            'no_reg_disparbud_tahun' => 'nullable|string|max:255',
            'lokasi_jalan_dukuhan' => 'nullable|string|max:255',
            'lokasi_dusun' => 'nullable|string|max:255',
            'lokasi_desa' => 'required|string|max:255',
            'lokasi_kecamatan' => 'required|string|max:255',
            'bahan' => 'nullable|string|max:255',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'deskripsi_singkat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kondisi_saat_ini' => 'nullable|string',
        ]);
        
        // Handle file upload jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($cagarBudaya->gambar) {
                Storage::disk('public')->delete($cagarBudaya->gambar);
            }
            
            $gambarPath = $request->file('gambar')->store('cagar-budaya', 'public');
            $validated['gambar'] = $gambarPath;
        }
        
        $cagarBudaya->update($validated);
        
        return redirect()->route('cagar-budaya.show', $cagarBudaya)
            ->with('success', 'Data cagar budaya berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CagarBudaya $cagarBudaya)
    {
        // Hanya superadmin yang bisa menghapus
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk menghapus data.');
        }
        
        // Hapus gambar jika ada
        if ($cagarBudaya->gambar) {
            Storage::disk('public')->delete($cagarBudaya->gambar);
        }
        
        $cagarBudaya->delete();
        
        return redirect()->route('cagar-budaya.index')
            ->with('success', 'Data cagar budaya berhasil dihapus.');
    }
    
    /**
     * Verify a cagar budaya data.
     */
    public function verify(CagarBudaya $cagarBudaya)
    {
        // Hanya superadmin yang bisa memverifikasi
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk memverifikasi data.');
        }
        
        $cagarBudaya->update([
            'is_verified' => true,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);
        
        return redirect()->route('cagar-budaya.show', $cagarBudaya)
            ->with('success', 'Data cagar budaya berhasil diverifikasi.');
    }

    public function exportByKecamatan(Request $request)
{
    $kecamatan = $request->kecamatan;
    
    $query = CagarBudaya::query();
    
    // Jika ada filter kecamatan
    if ($kecamatan) {
        $query->where('lokasi_kecamatan', $kecamatan);
    }
    
    // Filter verifikasi jika user adalah user biasa
    if (Auth::user()->role === 'user') {
        $query->where('is_verified', true);
    }
    
    $cagarBudayas = $query->get();
    
    // Create PDF
    $pdf = PDF::loadView('cagar-budaya.pdf.kecamatan', [
        'cagarBudayas' => $cagarBudayas,
        'kecamatan' => $kecamatan ?: 'Semua Kecamatan',
        'tanggal' => now()->format('d-m-Y')
    ]);
    
    return $pdf->stream('cagar-budaya-' . (Str::slug($kecamatan ?: 'semua-kecamatan')) . '.pdf');
}

// Method untuk export PDF per objek
public function exportById(CagarBudaya $cagarBudaya)
{
    // Check if user is allowed to see this
    if (Auth::user()->role === 'user' && !$cagarBudaya->is_verified) {
        abort(403, 'Data belum diverifikasi.');
    }
    
    // Create PDF
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('cagar-budaya.pdf.detail', [
        'cagarBudaya' => $cagarBudaya,  // Pastikan ini benar
        'tanggal' => now()->format('d-m-Y')
    ]);
    
    return $pdf->stream('cagar-budaya-' . \Illuminate\Support\Str::slug($cagarBudaya->objek_cagar_budaya) . '.pdf');
}
}