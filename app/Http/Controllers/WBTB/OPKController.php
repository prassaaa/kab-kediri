<?php

namespace App\Http\Controllers\WBTB;

use App\Http\Controllers\Controller;
use App\Models\WBTB\OPK;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class OPKController extends Controller
{
    /**
     * Display a listing of OPK resources.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = OPK::query();

        // Filter berdasarkan pencarian
        if ($search = $request->input('search')) {
            $query->where('nama_opk', 'like', '%' . $search . '%');
        }

        // Filter berdasarkan jenis OPK
        if ($request->filled('jenis_opk')) {
            $query->where('jenis_opk', $request->jenis_opk);
        }

        // Jika user biasa, tampilkan hanya yang sudah diverifikasi
        if (Auth::user()->role === 'user') {
            $query->where('is_verified', true);
        }

        $opkItems = $query->latest()->paginate(10);

        return view('wbtb.opk.index', compact('opkItems'));
    }

    /**
     * Show the form for creating a new OPK resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('wbtb.opk.create');
    }

    /**
     * Store a newly created OPK resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_opk' => 'required|string|max:255',
            'jenis_opk' => 'required|in:Tradisi lisan,Manuskrip,Adat istiadat,Ritus,Pengetahuan tradisional,Teknologi tradisional,Seni,Bahasa,Permainan rakyat,Olahraga tradisional',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen_kajian' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'tautan_video' => 'nullable|url|max:255',
            'dokumen_lainnya' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('wbtb/opk/foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Handle dokumen kajian upload
        if ($request->hasFile('dokumen_kajian')) {
            $dokumenPath = $request->file('dokumen_kajian')->store('wbtb/opk/dokumen-kajian', 'public');
            $validated['dokumen_kajian'] = $dokumenPath;
        }

        // Handle dokumen lainnya upload
        if ($request->hasFile('dokumen_lainnya')) {
            $dokumenLainnyaPath = $request->file('dokumen_lainnya')->store('wbtb/opk/dokumen-lainnya', 'public');
            $validated['dokumen_lainnya'] = $dokumenLainnyaPath;
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
        $opk = OPK::create($validated);

        // Jika request AJAX, berikan response JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data OPK berhasil ditambahkan.',
                'redirect' => route('wbtb.opk.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.opk.index')
            ->with('success', 'Data OPK berhasil ditambahkan.');
    }

    /**
     * Display the specified OPK resource.
     *
     * @param  \App\Models\WBTB\OPK  $opk
     * @return \Illuminate\View\View
     */
    public function show(OPK $opk)
    {
        // Jika user biasa dan data belum diverifikasi, tolak akses
        if (Auth::user()->role === 'user' && !$opk->is_verified) {
            abort(403, 'Data belum diverifikasi.');
        }

        return view('wbtb.opk.show', compact('opk'));
    }

    /**
     * Show the form for editing the specified OPK resource.
     *
     * @param  \App\Models\WBTB\OPK  $opk
     * @return \Illuminate\View\View
     */
    public function edit(OPK $opk)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $opk->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        return view('wbtb.opk.edit', compact('opk'));
    }

    /**
     * Update the specified OPK resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WBTB\OPK  $opk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, OPK $opk)
    {
        // Cek apakah user adalah admin yang mencoba mengedit data yang sudah diverifikasi
        if (Auth::user()->role === 'admin' && $opk->is_verified) {
            abort(403, 'Data sudah diverifikasi, tidak dapat diedit.');
        }

        $validated = $request->validate([
            'nama_opk' => 'required|string|max:255',
            'jenis_opk' => 'required|in:Tradisi lisan,Manuskrip,Adat istiadat,Ritus,Pengetahuan tradisional,Teknologi tradisional,Seni,Bahasa,Permainan rakyat,Olahraga tradisional',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dokumen_kajian' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'tautan_video' => 'nullable|url|max:255',
            'dokumen_lainnya' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($opk->foto) {
                Storage::disk('public')->delete($opk->foto);
            }
            $fotoPath = $request->file('foto')->store('wbtb/opk/foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        // Handle dokumen kajian upload
        if ($request->hasFile('dokumen_kajian')) {
            // Hapus dokumen lama jika ada
            if ($opk->dokumen_kajian) {
                Storage::disk('public')->delete($opk->dokumen_kajian);
            }
            $dokumenPath = $request->file('dokumen_kajian')->store('wbtb/opk/dokumen-kajian', 'public');
            $validated['dokumen_kajian'] = $dokumenPath;
        }

        // Handle dokumen lainnya upload
        if ($request->hasFile('dokumen_lainnya')) {
            // Hapus dokumen lama jika ada
            if ($opk->dokumen_lainnya) {
                Storage::disk('public')->delete($opk->dokumen_lainnya);
            }
            $dokumenLainnyaPath = $request->file('dokumen_lainnya')->store('wbtb/opk/dokumen-lainnya', 'public');
            $validated['dokumen_lainnya'] = $dokumenLainnyaPath;
        }

        $opk->update($validated);

        return redirect()->route('wbtb.opk.show', $opk)
            ->with('success', 'Data OPK berhasil diperbarui.');
    }

    /**
     * Remove the specified OPK resource from storage.
     *
     * @param  \App\Models\WBTB\OPK  $opk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(OPK $opk)
    {
        // Hanya superadmin yang bisa menghapus
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk menghapus data.');
        }

        // Hapus file terkait jika ada
        if ($opk->foto) {
            Storage::disk('public')->delete($opk->foto);
        }
        if ($opk->dokumen_kajian) {
            Storage::disk('public')->delete($opk->dokumen_kajian);
        }
        if ($opk->dokumen_lainnya) {
            Storage::disk('public')->delete($opk->dokumen_lainnya);
        }

        $opk->delete();

        // Jika request AJAX, berikan response JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data OPK berhasil dihapus.',
                'redirect' => route('wbtb.opk.index')
            ]);
        }

        // Jika bukan AJAX, redirect dengan flash message
        return redirect()->route('wbtb.opk.index')
            ->with('success', 'Data OPK berhasil dihapus.');
    }

    /**
     * Verify an OPK data.
     *
     * @param  \App\Models\WBTB\OPK  $opk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(OPK $opk)
    {
        // Hanya superadmin yang bisa memverifikasi
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki izin untuk memverifikasi data.');
        }

        $opk->update([
            'is_verified' => true,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return redirect()->route('wbtb.opk.show', $opk)
            ->with('success', 'Data OPK berhasil diverifikasi.');
    }
}