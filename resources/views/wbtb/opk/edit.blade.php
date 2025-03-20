@extends('layouts.admin-dashboard')

@section('page-title', 'Edit Data OPK')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('wbtb.opk.show', $opk) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Detail
            </a>
        </div>
        
        <form action="{{ route('wbtb.opk.update', $opk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Umum</h3>
                        
                        <div class="mb-4">
                            <label for="nama_opk" class="block text-sm font-medium text-gray-700 mb-1">Nama OPK</label>
                            <input type="text" name="nama_opk" id="nama_opk" value="{{ old('nama_opk', $opk->nama_opk) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_opk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jenis_opk" class="block text-sm font-medium text-gray-700 mb-1">Jenis OPK</label>
                            <select name="jenis_opk" id="jenis_opk" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Jenis OPK</option>
                                <option value="Tradisi lisan" {{ old('jenis_opk', $opk->jenis_opk) == 'Tradisi lisan' ? 'selected' : '' }}>Tradisi lisan</option>
                                <option value="Manuskrip" {{ old('jenis_opk', $opk->jenis_opk) == 'Manuskrip' ? 'selected' : '' }}>Manuskrip</option>
                                <option value="Adat istiadat" {{ old('jenis_opk', $opk->jenis_opk) == 'Adat istiadat' ? 'selected' : '' }}>Adat istiadat</option>
                                <option value="Ritus" {{ old('jenis_opk', $opk->jenis_opk) == 'Ritus' ? 'selected' : '' }}>Ritus</option>
                                <option value="Pengetahuan tradisional" {{ old('jenis_opk', $opk->jenis_opk) == 'Pengetahuan tradisional' ? 'selected' : '' }}>Pengetahuan tradisional</option>
                                <option value="Teknologi tradisional" {{ old('jenis_opk', $opk->jenis_opk) == 'Teknologi tradisional' ? 'selected' : '' }}>Teknologi tradisional</option>
                                <option value="Seni" {{ old('jenis_opk', $opk->jenis_opk) == 'Seni' ? 'selected' : '' }}>Seni</option>
                                <option value="Bahasa" {{ old('jenis_opk', $opk->jenis_opk) == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                                <option value="Permainan rakyat" {{ old('jenis_opk', $opk->jenis_opk) == 'Permainan rakyat' ? 'selected' : '' }}>Permainan rakyat</option>
                                <option value="Olahraga tradisional" {{ old('jenis_opk', $opk->jenis_opk) == 'Olahraga tradisional' ? 'selected' : '' }}>Olahraga tradisional</option>
                            </select>
                            @error('jenis_opk')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('alamat', $opk->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="text-md font-medium text-gray-700 mb-2">Koordinat</h4>
                            
                            <div class="grid grid-cols-2 gap-4 mb-2">
                                <div>
                                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude (DD)</label>
                                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $opk->latitude) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('latitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude (DD)</label>
                                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $opk->longitude) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('longitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Media dan Dokumen</h3>
                        
                        <div class="mb-4">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto/Gambar</label>
                            
                            @if($opk->foto)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($opk->foto) }}" alt="{{ $opk->nama_opk }}" class="h-40 w-auto rounded-md shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            
                            <input type="file" name="foto" id="foto" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="dokumen_kajian" class="block text-sm font-medium text-gray-700 mb-1">Dokumen Kajian</label>
                            
                            @if($opk->dokumen_kajian)
                                <div class="mb-2 flex items-center">
                                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="{{ Storage::url($opk->dokumen_kajian) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                        Lihat dokumen kajian saat ini
                                    </a>
                                </div>
                            @endif
                            
                            <input type="file" name="dokumen_kajian" id="dokumen_kajian" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX. Maks: 10MB. Biarkan kosong jika tidak ingin mengubah dokumen.</p>
                            @error('dokumen_kajian')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tautan_video" class="block text-sm font-medium text-gray-700 mb-1">Tautan Video</label>
                            <input type="url" name="tautan_video" id="tautan_video" value="{{ old('tautan_video', $opk->tautan_video) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="https://www.youtube.com/...">
                            <p class="text-xs text-gray-500 mt-1">Masukkan tautan YouTube, Vimeo, atau platform video lainnya</p>
                            @error('tautan_video')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="dokumen_lainnya" class="block text-sm font-medium text-gray-700 mb-1">Dokumen Lainnya</label>
                            
                            @if($opk->dokumen_lainnya)
                                <div class="mb-2 flex items-center">
                                    <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="{{ Storage::url($opk->dokumen_lainnya) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                        Lihat dokumen lainnya saat ini
                                    </a>
                                </div>
                            @endif
                            
                            <input type="file" name="dokumen_lainnya" id="dokumen_lainnya" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX, XLS, XLSX. Maks: 10MB. Biarkan kosong jika tidak ingin mengubah dokumen.</p>
                            @error('dokumen_lainnya')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Deskripsi</h3>
                        
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="7" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('deskripsi', $opk->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validasi form sebelum submit
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            let valid = true;
            
            // Validasi nama OPK
            const namaOPK = document.getElementById('nama_opk').value.trim();
            if (namaOPK === '') {
                valid = false;
                document.getElementById('nama_opk').classList.add('border-red-500');
            } else {
                document.getElementById('nama_opk').classList.remove('border-red-500');
            }
            
            // Validasi jenis OPK
            const jenisOPK = document.getElementById('jenis_opk').value;
            if (jenisOPK === '') {
                valid = false;
                document.getElementById('jenis_opk').classList.add('border-red-500');
            } else {
                document.getElementById('jenis_opk').classList.remove('border-red-500');
            }
            
            // Validasi alamat
            const alamat = document.getElementById('alamat').value.trim();
            if (alamat === '') {
                valid = false;
                document.getElementById('alamat').classList.add('border-red-500');
            } else {
                document.getElementById('alamat').classList.remove('border-red-500');
            }
            
            // Validasi deskripsi
            const deskripsi = document.getElementById('deskripsi').value.trim();
            if (deskripsi === '') {
                valid = false;
                document.getElementById('deskripsi').classList.add('border-red-500');
            } else {
                document.getElementById('deskripsi').classList.remove('border-red-500');
            }
            
            if (!valid) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi.');
            }
        });
    });
</script>
@endpush