<?php

namespace App\Http\Controllers;

use App\Models\CagarBudaya;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

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
    
    // Simpan data
    $cagarBudaya = CagarBudaya::create($validated);
    
    // Jika request AJAX, berikan response JSON
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Data cagar budaya berhasil ditambahkan.',
            'redirect' => route('cagar-budaya.index')
        ]);
    }
    
    // Jika bukan AJAX, redirect dengan flash message
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

/**
 * Request revision for a cagar budaya data.
 */
public function requestRevision(Request $request, CagarBudaya $cagarBudaya)
{
    // Hanya superadmin yang bisa meminta revisi
    if (Auth::user()->role !== 'superadmin') {
        abort(403, 'Tidak memiliki izin untuk meminta revisi data.');
    }
    
    $validated = $request->validate([
        'revision_notes' => 'required|string',
        'revision_history' => 'nullable|string',
    ]);
    
    // Persiapkan histori revisi jika ada revisi sebelumnya
    $revisionHistory = $validated['revision_history'] ?? '';
    $currentDate = now()->format('d/m/Y H:i');
    $currentUser = Auth::user()->name;
    
    // Simpan catatan revisi saat ini ke dalam histori jika sudah ada histori sebelumnya
    if (!empty($revisionHistory)) {
        $revisionHistory = "[$currentDate oleh $currentUser]: {$validated['revision_notes']}\n\nRevisi sebelumnya:\n$revisionHistory";
    } else {
        $revisionHistory = "[$currentDate oleh $currentUser]: {$validated['revision_notes']}";
    }
    
    $cagarBudaya->update([
        'status' => 'needs_revision',
        'revision_notes' => $validated['revision_notes'],
        'revision_history' => $revisionHistory,
        'is_verified' => false,
    ]);
    
    return redirect()->route('notifikasi')
        ->with('success', 'Permintaan revisi berhasil dikirim.');
}

/**
 * Submit revision for a cagar budaya data.
 */
public function submitRevision(Request $request, CagarBudaya $cagarBudaya)
{
    // Cek apakah user adalah pembuat data
    if (Auth::id() !== $cagarBudaya->created_by) {
        abort(403, 'Anda tidak memiliki izin untuk merevisi data ini.');
    }
    
    // Cek apakah data memang perlu direvisi
    if ($cagarBudaya->status !== 'needs_revision') {
        abort(403, 'Data ini tidak memerlukan revisi.');
    }
    
    // Validasi data input sama seperti method update
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
    
    // Update data - simpan catatan revisi dan riwayat revisi
    $validated['status'] = 'revised';
    
    // PENTING: Pastikan revision_notes dan revision_history tetap tersimpan
    // Kita tidak mengubah nilai dari revision_notes agar masih bisa dilihat setelah revisi
    // Revision history juga tetap disimpan untuk menampilkan riwayat lengkap
    $validated['revision_notes'] = $cagarBudaya->revision_notes;
    $validated['revision_history'] = $cagarBudaya->revision_history;
    
    $cagarBudaya->update($validated);
    
    return redirect()->route('cagar-budaya.show', $cagarBudaya)
        ->with('success', 'Revisi data cagar budaya berhasil disubmit.');
}

    public function importForm()
    {
        return view('cagar-budaya.import');
    }

    public function import(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|file|mimes:csv,xls,xlsx|max:5120',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        $file = $request->file('file');
        $path = $file->store('temp');
        
        $count = 0;
        $errors = [];
        
        (new FastExcel)->import(storage_path('app/' . $path), function ($row) use (&$count, &$errors) {
            $count++;
            
            if (empty($row['objek_cagar_budaya']) || empty($row['predikat']) || empty($row['kategori'])) {
                $errors[] = "Baris $count: Data objek_cagar_budaya, predikat, dan kategori wajib diisi.";
                return null;
            }
            
            try {
                return CagarBudaya::create([
                    'objek_cagar_budaya' => $row['objek_cagar_budaya'],
                    'predikat' => $row['predikat'],
                    'kategori' => $row['kategori'],
                    'bahan' => $row['bahan'] ?? null,
                    'lokasi_jalan_dukuhan' => $row['lokasi_jalan_dukuhan'] ?? null,
                    'lokasi_dusun' => $row['lokasi_dusun'] ?? null,
                    'lokasi_desa' => $row['lokasi_desa'] ?? null,
                    'lokasi_kecamatan' => $row['lokasi_kecamatan'] ?? null,
                    'latitude' => $row['latitude'] ?? null,
                    'longitude' => $row['longitude'] ?? null,
                    'no_reg_bpk_lama' => $row['no_reg_bpk_lama'] ?? null,
                    'no_reg_bpk_baru' => $row['no_reg_bpk_baru'] ?? null,
                    'no_reg_disparbud_nomor_urut' => $row['no_reg_disparbud_nomor_urut'] ?? null,
                    'no_reg_disparbud_kode_kecamatan' => $row['no_reg_disparbud_kode_kecamatan'] ?? null,
                    'no_reg_disparbud_kode_kabupaten' => $row['no_reg_disparbud_kode_kabupaten'] ?? null,
                    'no_reg_disparbud_tahun' => $row['no_reg_disparbud_tahun'] ?? null,
                    'deskripsi_singkat' => $row['deskripsi_singkat'] ?? null,
                    'kondisi_saat_ini' => $row['kondisi_saat_ini'] ?? null,
                    'created_by' => Auth::id(),
                    'is_verified' => Auth::user()->role === 'superadmin',
                ]);
            } catch (\Exception $e) {
                $errors[] = "Baris $count: " . $e->getMessage();
                return null;
            }
        });
        
        // Hapus file temporary
        Storage::delete($path);
        
        if (count($errors) > 0) {
            return response()->json([
                'success' => false,
                'errors' => $errors,
            ], 422);
        }
        
        // Response untuk AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Data cagar budaya berhasil diimpor ($count data).",
                'redirect' => route('cagar-budaya.index')
            ]);
        }
        
        // Response untuk non-AJAX
        return redirect()->route('cagar-budaya.index')
            ->with('success', "Data cagar budaya berhasil diimpor ($count data).");
    } catch (\Exception $e) {
        Log::error('Error importing cagar budaya: ' . $e->getMessage());
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
        
        return redirect()->route('cagar-budaya.index')
            ->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
    }
}

    public function downloadTemplate()
    {
        $template = collect([
            [
                'objek_cagar_budaya' => 'Candi Borobudur',
                'predikat' => 'Cagar Budaya',
                'kategori' => 'Bangunan',
                'bahan' => 'Batu Andesit',
                'lokasi_jalan_dukuhan' => 'Jalan Candi',
                'lokasi_dusun' => 'Dusun Borobudur',
                'lokasi_desa' => 'Desa Borobudur',
                'lokasi_kecamatan' => 'Kecamatan Borobudur',
                'latitude' => '-7.6079',
                'longitude' => '110.2038',
                'no_reg_bpk_lama' => 'BPK-123',
                'no_reg_bpk_baru' => 'BPK-456',
                'no_reg_disparbud_nomor_urut' => '001',
                'no_reg_disparbud_kode_kecamatan' => 'KEC01',
                'no_reg_disparbud_kode_kabupaten' => 'KAB01',
                'no_reg_disparbud_tahun' => '2023',
                'deskripsi_singkat' => 'Candi Buddha terbesar di dunia',
                'kondisi_saat_ini' => 'Terawat dengan baik'
            ]
        ]);
        
        // Export langsung sebagai download
        return (new FastExcel($template))->download('template-cagar-budaya.xlsx');
    }
    
    public function lokasi()
{
    return view('cagar-budaya.lokasi');
}
}