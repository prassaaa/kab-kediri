<?php

namespace App\Http\Controllers\WBTB;

use App\Http\Controllers\Controller;
use App\Models\WBTB\Sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SarprasController extends Controller
{
    /**
     * Display a listing of sarpras resources.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Sarpras::query();

        // Filter berdasarkan pencarian
        if ($search = $request->input('search')) {
            $query->where('nama_sarpras', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan status kepemilikan
        if ($request->filled('status_kepemilikan')) {
            $query->where('status_kepemilikan', $request->status_kepemilikan);
        }

        // Jika user biasa, tampilkan hanya yang sudah diverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }

        $sarprasItems = $query->latest()->paginate(10);

        return view('wbtb.sarpras.index', compact('sarprasItems'));
    }

    /**
     * Show the form for creating a new sarpras resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('wbtb.sarpras.create');
    }

    /**
     * Store a newly created sarpras resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sarpras' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nama_kontak' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'status_kepemilikan' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'nama_pengelola' => 'nullable|string|max:255',
            'papan_nama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_dalam' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_luar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas' => 'nullable|array',
        ]);

        // Handle papan nama upload
        if ($request->hasFile('papan_nama')) {
            $papanNamaPath = $request->file('papan_nama')->store('wbtb/sarpras/papan-nama', 'public');
            $validated['papan_nama'] = $papanNamaPath;
        }

        // Handle foto dalam upload
        if ($request->hasFile('foto_dalam')) {
            $fotoDalamPath = $request->file('foto_dalam')->store('wbtb/sarpras/foto-dalam', 'public');
            $validated['foto_dalam'] = $fotoDalamPath;
        }

        // Handle foto luar upload
        if ($request->hasFile('foto_luar')) {
            $fotoLuarPath = $request->file('foto_luar')->store('wbtb/sarpras/foto-luar', 'public');
            $validated['foto_luar'] = $fotoLuarPath;
        }

        // Prepare JSON data
        $validated['fasilitas'] = $request->fasilitas ?? [];

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
        $sarpras = Sarpras::create($validated);

        // Jika request AJAX, berikan response JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Sarpras Kebudayaan berhasil ditambahkan.',
                'redirect' => route('wbtb.sarpras.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.sarpras.index')
            ->with('success', 'Data Sarpras Kebudayaan berhasil ditambahkan.');
    }

    /**
     * Display the specified sarpras resource.
     *
     * @param  \App\Models\WBTB\Sarpras  $sarpras
     * @return \Illuminate\View\View
     */
    public function show(Sarpras $sarpras)
    {
        // Jika user biasa dan data belum diverifikasi, tolak akses
        if (Auth::user()->role === 'user' && !$sarpras->is_verified) {
            abort(403, 'Data belum diverifikasi.');
        }

        return view('wbtb.sarpras.show', compact('sarpras'));
    }

    /**
     * Show the form for editing the specified sarpras resource.
     *
     * @param  \App\Models\WBTB\Sarpras  $sarpras
     * @return \Illuminate\View\View
     */
    public function edit(Sarpras $sarpras)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $sarpras->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        return view('wbtb.sarpras.edit', compact('sarpras'));
    }

    /**
     * Update the specified sarpras resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WBTB\Sarpras  $sarpras
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Sarpras $sarpras)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $sarpras->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        $validated = $request->validate([
            'nama_sarpras' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nama_kontak' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'status_kepemilikan' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'nama_pengelola' => 'nullable|string|max:255',
            'papan_nama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_dalam' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_luar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas' => 'nullable|array',
        ]);

        // Handle papan nama upload
        if ($request->hasFile('papan_nama')) {
            // Hapus papan nama lama jika ada
            if ($sarpras->papan_nama) {
                Storage::disk('public')->delete($sarpras->papan_nama);
            }
            $papanNamaPath = $request->file('papan_nama')->store('wbtb/sarpras/papan-nama', 'public');
            $validated['papan_nama'] = $papanNamaPath;
        }

        // Handle foto dalam upload
        if ($request->hasFile('foto_dalam')) {
            // Hapus foto dalam lama jika ada
            if ($sarpras->foto_dalam) {
                Storage::disk('public')->delete($sarpras->foto_dalam);
            }
            $fotoDalamPath = $request->file('foto_dalam')->store('wbtb/sarpras/foto-dalam', 'public');
            $validated['foto_dalam'] = $fotoDalamPath;
        }

        // Handle foto luar upload
        if ($request->hasFile('foto_luar')) {
            // Hapus foto luar lama jika ada
            if ($sarpras->foto_luar) {
                Storage::disk('public')->delete($sarpras->foto_luar);
            }
            $fotoLuarPath = $request->file('foto_luar')->store('wbtb/sarpras/foto-luar', 'public');
            $validated['foto_luar'] = $fotoLuarPath;
        }

        // Prepare JSON data
        $validated['fasilitas'] = $request->fasilitas ?? $sarpras->fasilitas ?? [];

        $sarpras->update($validated);

        return redirect()->route('wbtb.sarpras.show', $sarpras)
            ->with('success', 'Data Sarpras Kebudayaan berhasil diperbarui.');
    }

    /**
     * Remove the specified sarpras resource from storage.
     *
     * @param  \App\Models\WBTB\Sarpras  $sarpras
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Sarpras $sarpras)
    {
        // Hanya superadmin yang bisa menghapus
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk menghapus data.');
        }

        // Hapus file terkait jika ada
        if ($sarpras->papan_nama) {
            Storage::disk('public')->delete($sarpras->papan_nama);
        }
        if ($sarpras->foto_dalam) {
            Storage::disk('public')->delete($sarpras->foto_dalam);
        }
        if ($sarpras->foto_luar) {
            Storage::disk('public')->delete($sarpras->foto_luar);
        }

        $sarpras->delete();

        // Jika request AJAX, berikan response JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Sarpras Kebudayaan berhasil dihapus.',
                'redirect' => route('wbtb.sarpras.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.sarpras.index')
            ->with('success', 'Data Sarpras Kebudayaan berhasil dihapus.');
    }

    /**
     * Verify a sarpras data.
     *
     * @param  \App\Models\WBTB\Sarpras  $sarpras
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Sarpras $sarpras)
    {
        // Hanya superadmin yang bisa memverifikasi
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk memverifikasi data.');
        }

        $sarpras->update([
            'is_verified' => true,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('wbtb.sarpras.show', $sarpras)
            ->with('success', 'Data Sarpras Kebudayaan berhasil diverifikasi.');
    }
}