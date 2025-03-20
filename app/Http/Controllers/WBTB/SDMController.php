<?php

namespace App\Http\Controllers\WBTB;

use App\Http\Controllers\Controller;
use App\Models\WBTB\SDM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SDMController extends Controller
{
    /**
     * Display a listing of SDM resources.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = SDM::query();

        // Filter berdasarkan pencarian
        if ($search = $request->input('search')) {
            $query->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('nomor_identitas', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Jika user biasa, tampilkan hanya yang sudah diverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }

        $sdmItems = $query->latest()->paginate(10);

        return view('wbtb.sdm.index', compact('sdmItems'));
    }

    /**
     * Show the form for creating a new SDM resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('wbtb.sdm.create');
    }

    /**
     * Store a newly created SDM resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'gelar_pendidikan' => 'nullable|string|max:255',
            'nama_alias' => 'nullable|string|max:255',
            'jenis_identitas' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:255',
            'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_identitas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nomor_hp' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'media_sosial' => 'nullable|string|max:255',
            'riwayat_pendidikan' => 'nullable|array',
            'riwayat_pelatihan' => 'nullable|array',
            'riwayat_pekerjaan' => 'nullable|array',
            'riwayat_aktivitas' => 'nullable|array',
            'riwayat_penghargaan' => 'nullable|array',
        ]);

        // Handle pas foto upload
        if ($request->hasFile('pas_foto')) {
            $pasFotoPath = $request->file('pas_foto')->store('wbtb/sdm/pas-foto', 'public');
            $validated['pas_foto'] = $pasFotoPath;
        }

        // Handle foto identitas upload
        if ($request->hasFile('foto_identitas')) {
            $fotoIdentitasPath = $request->file('foto_identitas')->store('wbtb/sdm/foto-identitas', 'public');
            $validated['foto_identitas'] = $fotoIdentitasPath;
        }

        // Prepare riwayat data
        $validated['riwayat_pendidikan'] = $request->riwayat_pendidikan ?? [];
        $validated['riwayat_pelatihan'] = $request->riwayat_pelatihan ?? [];
        $validated['riwayat_pekerjaan'] = $request->riwayat_pekerjaan ?? [];
        $validated['riwayat_aktivitas'] = $request->riwayat_aktivitas ?? [];
        $validated['riwayat_penghargaan'] = $request->riwayat_penghargaan ?? [];

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
        $sdm = SDM::create($validated);

        // Jika request AJAX, berikan response JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data SDM Kebudayaan berhasil ditambahkan.',
                'redirect' => route('wbtb.sdm.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.sdm.index')
            ->with('success', 'Data SDM Kebudayaan berhasil ditambahkan.');
    }

    /**
     * Display the specified SDM resource.
     *
     * @param  \App\Models\WBTB\SDM  $sdm
     * @return \Illuminate\View\View
     */
    public function show(SDM $sdm)
    {
        // Jika user biasa dan data belum diverifikasi, tolak akses
        if (Auth::user()->role === 'user' && !$sdm->is_verified) {
            abort(403, 'Data belum diverifikasi.');
        }

        return view('wbtb.sdm.show', compact('sdm'));
    }

    /**
     * Show the form for editing the specified SDM resource.
     *
     * @param  \App\Models\WBTB\SDM  $sdm
     * @return \Illuminate\View\View
     */
    public function edit(SDM $sdm)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $sdm->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        return view('wbtb.sdm.edit', compact('sdm'));
    }

    /**
     * Update the specified SDM resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WBTB\SDM  $sdm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SDM $sdm)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $sdm->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'gelar_pendidikan' => 'nullable|string|max:255',
            'nama_alias' => 'nullable|string|max:255',
            'jenis_identitas' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'kewarganegaraan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'nullable|string|max:255',
            'pas_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_identitas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'nomor_hp' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'media_sosial' => 'nullable|string|max:255',
            'riwayat_pendidikan' => 'nullable|array',
            'riwayat_pelatihan' => 'nullable|array',
            'riwayat_pekerjaan' => 'nullable|array',
            'riwayat_aktivitas' => 'nullable|array',
            'riwayat_penghargaan' => 'nullable|array',
        ]);

        // Handle pas foto upload
        if ($request->hasFile('pas_foto')) {
            // Hapus foto lama jika ada
            if ($sdm->pas_foto) {
                Storage::disk('public')->delete($sdm->pas_foto);
            }
            $pasFotoPath = $request->file('pas_foto')->store('wbtb/sdm/pas-foto', 'public');
            $validated['pas_foto'] = $pasFotoPath;
        }

        // Handle foto identitas upload
        if ($request->hasFile('foto_identitas')) {
            // Hapus foto lama jika ada
            if ($sdm->foto_identitas) {
                Storage::disk('public')->delete($sdm->foto_identitas);
            }
            $fotoIdentitasPath = $request->file('foto_identitas')->store('wbtb/sdm/foto-identitas', 'public');
            $validated['foto_identitas'] = $fotoIdentitasPath;
        }

        // Prepare riwayat data
        $validated['riwayat_pendidikan'] = $request->riwayat_pendidikan ?? $sdm->riwayat_pendidikan ?? [];
        $validated['riwayat_pelatihan'] = $request->riwayat_pelatihan ?? $sdm->riwayat_pelatihan ?? [];
        $validated['riwayat_pekerjaan'] = $request->riwayat_pekerjaan ?? $sdm->riwayat_pekerjaan ?? [];
        $validated['riwayat_aktivitas'] = $request->riwayat_aktivitas ?? $sdm->riwayat_aktivitas ?? [];
        $validated['riwayat_penghargaan'] = $request->riwayat_penghargaan ?? $sdm->riwayat_penghargaan ?? [];

        $sdm->update($validated);

        return redirect()->route('wbtb.sdm.show', $sdm)
            ->with('success', 'Data SDM Kebudayaan berhasil diperbarui.');
    }

    /**
     * Remove the specified SDM resource from storage.
     *
     * @param  \App\Models\WBTB\SDM  $sdm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SDM $sdm)
    {
        // Hanya superadmin yang bisa menghapus
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk menghapus data.');
        }

        // Hapus file terkait jika ada
        if ($sdm->pas_foto) {
            Storage::disk('public')->delete($sdm->pas_foto);
        }
        if ($sdm->foto_identitas) {
            Storage::disk('public')->delete($sdm->foto_identitas);
        }

        $sdm->delete();

        // Jika request AJAX, berikan response JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data SDM Kebudayaan berhasil dihapus.',
                'redirect' => route('wbtb.sdm.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.sdm.index')
            ->with('success', 'Data SDM Kebudayaan berhasil dihapus.');
    }

    /**
     * Verify an SDM data.
     *
     * @param  \App\Models\WBTB\SDM  $sdm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(SDM $sdm)
    {
        // Hanya superadmin yang bisa memverifikasi
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk memverifikasi data.');
        }

        $sdm->update([
            'is_verified' => true,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('wbtb.sdm.show', $sdm)
            ->with('success', 'Data SDM Kebudayaan berhasil diverifikasi.');
    }
}