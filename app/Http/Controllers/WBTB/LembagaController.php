<?php

namespace App\Http\Controllers\WBTB;

use App\Http\Controllers\Controller;
use App\Models\WBTB\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LembagaController extends Controller
{
    /**
     * Display a listing of lembaga resources.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Lembaga::query();

        // Filter berdasarkan pencarian
        if ($search = $request->input('search')) {
            $query->where('nama_lembaga', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_lembaga', $request->kategori);
        }

        // Filter berdasarkan tingkat
        if ($request->filled('tingkat')) {
            $query->where('tingkat_lembaga', $request->tingkat);
        }

        // Jika user biasa, tampilkan hanya yang sudah diverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }

        $lembagaItems = $query->latest()->paginate(10);

        return view('wbtb.lembaga.index', compact('lembagaItems'));
    }

    /**
     * Show the form for creating a new lembaga resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('wbtb.lembaga.create');
    }

    /**
     * Store a newly created lembaga resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'kategori_lembaga' => 'required|string|max:255',
            'nomor_registrasi' => 'nullable|string|max:255',
            'tanggal_berdiri' => 'nullable|date',
            'tingkat_lembaga' => 'nullable|string|max:255',
            'status_hukum' => 'nullable|string|max:255',
            'visi_misi' => 'nullable|string',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nomor_telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'media_sosial' => 'nullable|string|max:255',
            'nama_pimpinan' => 'required|string|max:255',
            'jabatan_pimpinan' => 'nullable|string|max:255',
            'pengurus' => 'nullable|array',
            'jumlah_anggota' => 'nullable|integer',
            'aktivitas' => 'nullable|array',
            'prestasi' => 'nullable|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_bangunan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kegiatan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen_legalitas' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('wbtb/lembaga/logo', 'public');
            $validated['logo'] = $logoPath;
        }

        // Handle foto bangunan upload
        if ($request->hasFile('foto_bangunan')) {
            $fotoBangunanPath = $request->file('foto_bangunan')->store('wbtb/lembaga/foto-bangunan', 'public');
            $validated['foto_bangunan'] = $fotoBangunanPath;
        }

        // Handle multiple foto kegiatan
        if ($request->hasFile('foto_kegiatan')) {
            $fotoKegiatanPaths = [];
            foreach ($request->file('foto_kegiatan') as $file) {
                $path = $file->store('wbtb/lembaga/foto-kegiatan', 'public');
                $fotoKegiatanPaths[] = $path;
            }
            $validated['foto_kegiatan'] = $fotoKegiatanPaths;
        }

        // Handle dokumen legalitas upload
        if ($request->hasFile('dokumen_legalitas')) {
            $dokumenPath = $request->file('dokumen_legalitas')->store('wbtb/lembaga/dokumen-legalitas', 'public');
            $validated['dokumen_legalitas'] = $dokumenPath;
        }

        // Prepare JSON data
        $validated['pengurus'] = $request->pengurus ?? [];
        $validated['aktivitas'] = $request->aktivitas ?? [];
        $validated['prestasi'] = $request->prestasi ?? [];

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
        $lembaga = Lembaga::create($validated);

        // Jika request AJAX, berikan response JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Lembaga Kebudayaan berhasil ditambahkan.',
                'redirect' => route('wbtb.lembaga.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.lembaga.index')
            ->with('success', 'Data Lembaga Kebudayaan berhasil ditambahkan.');
    }

    /**
     * Display the specified lembaga resource.
     *
     * @param  \App\Models\WBTB\Lembaga  $lembaga
     * @return \Illuminate\View\View
     */
    public function show(Lembaga $lembaga)
    {
        // Jika user biasa dan data belum diverifikasi, tolak akses
        if (Auth::user()->role === 'user' && !$lembaga->is_verified) {
            abort(403, 'Data belum diverifikasi.');
        }

        return view('wbtb.lembaga.show', compact('lembaga'));
    }

    /**
     * Show the form for editing the specified lembaga resource.
     *
     * @param  \App\Models\WBTB\Lembaga  $lembaga
     * @return \Illuminate\View\View
     */
    public function edit(Lembaga $lembaga)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $lembaga->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        return view('wbtb.lembaga.edit', compact('lembaga'));
    }

    /**
     * Update the specified lembaga resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WBTB\Lembaga  $lembaga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Lembaga $lembaga)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $lembaga->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        $validated = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'kategori_lembaga' => 'required|string|max:255',
            'nomor_registrasi' => 'nullable|string|max:255',
            'tanggal_berdiri' => 'nullable|date',
            'tingkat_lembaga' => 'nullable|string|max:255',
            'status_hukum' => 'nullable|string|max:255',
            'visi_misi' => 'nullable|string',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nomor_telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'media_sosial' => 'nullable|string|max:255',
            'nama_pimpinan' => 'required|string|max:255',
            'jabatan_pimpinan' => 'nullable|string|max:255',
            'pengurus' => 'nullable|array',
            'jumlah_anggota' => 'nullable|integer',
            'aktivitas' => 'nullable|array',
            'prestasi' => 'nullable|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_bangunan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kegiatan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen_legalitas' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($lembaga->logo) {
                Storage::disk('public')->delete($lembaga->logo);
            }
            $logoPath = $request->file('logo')->store('wbtb/lembaga/logo', 'public');
            $validated['logo'] = $logoPath;
        }

        // Handle foto bangunan upload
        if ($request->hasFile('foto_bangunan')) {
            // Hapus foto lama jika ada
            if ($lembaga->foto_bangunan) {
                Storage::disk('public')->delete($lembaga->foto_bangunan);
            }
            $fotoBangunanPath = $request->file('foto_bangunan')->store('wbtb/lembaga/foto-bangunan', 'public');
            $validated['foto_bangunan'] = $fotoBangunanPath;
        }

        // Handle multiple foto kegiatan
        if ($request->hasFile('foto_kegiatan')) {
            // Hapus foto lama jika ada
            if (is_array($lembaga->foto_kegiatan)) {
                foreach ($lembaga->foto_kegiatan as $path) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            $fotoKegiatanPaths = [];
            foreach ($request->file('foto_kegiatan') as $file) {
                $path = $file->store('wbtb/lembaga/foto-kegiatan', 'public');
                $fotoKegiatanPaths[] = $path;
            }
            $validated['foto_kegiatan'] = $fotoKegiatanPaths;
        }

        // Handle dokumen legalitas upload
        if ($request->hasFile('dokumen_legalitas')) {
            // Hapus dokumen lama jika ada
            if ($lembaga->dokumen_legalitas) {
                Storage::disk('public')->delete($lembaga->dokumen_legalitas);
            }
            $dokumenPath = $request->file('dokumen_legalitas')->store('wbtb/lembaga/dokumen-legalitas', 'public');
            $validated['dokumen_legalitas'] = $dokumenPath;
        }

        // Prepare JSON data
        $validated['pengurus'] = $request->pengurus ?? $lembaga->pengurus ?? [];
        $validated['aktivitas'] = $request->aktivitas ?? $lembaga->aktivitas ?? [];
        $validated['prestasi'] = $request->prestasi ?? $lembaga->prestasi ?? [];

        $lembaga->update($validated);

        return redirect()->route('wbtb.lembaga.show', $lembaga)
            ->with('success', 'Data Lembaga Kebudayaan berhasil diperbarui.');
    }

    /**
     * Remove the specified lembaga resource from storage.
     *
     * @param  \App\Models\WBTB\Lembaga  $lembaga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Lembaga $lembaga)
    {
        // Hanya superadmin yang bisa menghapus
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk menghapus data.');
        }

        // Hapus file terkait jika ada
        if ($lembaga->logo) {
            Storage::disk('public')->delete($lembaga->logo);
        }
        if ($lembaga->foto_bangunan) {
            Storage::disk('public')->delete($lembaga->foto_bangunan);
        }
        if (is_array($lembaga->foto_kegiatan)) {
            foreach ($lembaga->foto_kegiatan as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        if ($lembaga->dokumen_legalitas) {
            Storage::disk('public')->delete($lembaga->dokumen_legalitas);
        }

        $lembaga->delete();

        // Jika request AJAX, berikan response JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Lembaga Kebudayaan berhasil dihapus.',
                'redirect' => route('wbtb.lembaga.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.lembaga.index')
            ->with('success', 'Data Lembaga Kebudayaan berhasil dihapus.');
    }

    /**
     * Verify a lembaga data.
     *
     * @param  \App\Models\WBTB\Lembaga  $lembaga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Lembaga $lembaga)
    {
        // Hanya superadmin yang bisa memverifikasi
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk memverifikasi data.');
        }

        $lembaga->update([
            'is_verified' => true,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('wbtb.lembaga.show', $lembaga)
            ->with('success', 'Data Lembaga Kebudayaan berhasil diverifikasi.');
    }
}