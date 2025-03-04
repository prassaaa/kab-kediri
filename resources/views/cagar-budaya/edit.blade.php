<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Cagar Budaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('cagar-budaya.show', $cagarBudaya) }}" class="text-blue-600 hover:text-blue-900">
                            &larr; Kembali ke Detail
                        </a>
                    </div>
                    
                    <form action="{{ route('cagar-budaya.update', $cagarBudaya) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-4">Informasi Umum</h3>
                                    
                                    <div class="mb-4">
                                        <label for="objek_cagar_budaya" class="block text-sm font-medium text-gray-700 mb-1">Objek Cagar Budaya</label>
                                        <input type="text" name="objek_cagar_budaya" id="objek_cagar_budaya" value="{{ old('objek_cagar_budaya', $cagarBudaya->objek_cagar_budaya) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        @error('objek_cagar_budaya')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                        <select name="kategori" id="kategori" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Benda" {{ old('kategori', $cagarBudaya->kategori) == 'Benda' ? 'selected' : '' }}>Benda</option>
                                            <option value="Bangunan" {{ old('kategori', $cagarBudaya->kategori) == 'Bangunan' ? 'selected' : '' }}>Bangunan</option>
                                            <option value="Struktur" {{ old('kategori', $cagarBudaya->kategori) == 'Struktur' ? 'selected' : '' }}>Struktur</option>
                                            <option value="Situs" {{ old('kategori', $cagarBudaya->kategori) == 'Situs' ? 'selected' : '' }}>Situs</option>
                                            <option value="Kawasan" {{ old('kategori', $cagarBudaya->kategori) == 'Kawasan' ? 'selected' : '' }}>Kawasan</option>
                                        </select>
                                        @error('kategori')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="bahan" class="block text-sm font-medium text-gray-700 mb-1">Bahan</label>
                                        <input type="text" name="bahan" id="bahan" value="{{ old('bahan', $cagarBudaya->bahan) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @error('bahan')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Bagian lokasi, sama seperti create tapi dengan nilai dari $cagarBudaya -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-4">Lokasi</h3>
                                    
                                    <div class="mb-4">
                                        <label for="lokasi_jalan_dukuhan" class="block text-sm font-medium text-gray-700 mb-1">Jalan/Dukuhan</label>
                                        <input type="text" name="lokasi_jalan_dukuhan" id="lokasi_jalan_dukuhan" value="{{ old('lokasi_jalan_dukuhan', $cagarBudaya->lokasi_jalan_dukuhan) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @error('lokasi_jalan_dukuhan')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="lokasi_dusun" class="block text-sm font-medium text-gray-700 mb-1">Dusun</label>
                                        <input type="text" name="lokasi_dusun" id="lokasi_dusun" value="{{ old('lokasi_dusun', $cagarBudaya->lokasi_dusun) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @error('lokasi_dusun')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="lokasi_desa" class="block text-sm font-medium text-gray-700 mb-1">Desa</label>
                                        <input type="text" name="lokasi_desa" id="lokasi_desa" value="{{ old('lokasi_desa', $cagarBudaya->lokasi_desa) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        @error('lokasi_desa')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="lokasi_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="lokasi_kecamatan" id="lokasi_kecamatan" value="{{ old('lokasi_kecamatan', $cagarBudaya->lokasi_kecamatan) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        @error('lokasi_kecamatan')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4 grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                                            <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $cagarBudaya->latitude) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('latitude')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                                            <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $cagarBudaya->longitude) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('longitude')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Bagian nomor registrasi, sama seperti create tapi dengan nilai dari $cagarBudaya -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-4">Nomor Registrasi</h3>
                                    
                                    <div class="mb-4 grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="no_reg_bpk_lama" class="block text-sm font-medium text-gray-700 mb-1">No. Reg BPK Lama</label>
                                            <input type="text" name="no_reg_bpk_lama" id="no_reg_bpk_lama" value="{{ old('no_reg_bpk_lama', $cagarBudaya->no_reg_bpk_lama) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('no_reg_bpk_lama')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="no_reg_bpk_baru" class="block text-sm font-medium text-gray-700 mb-1">No. Reg BPK Baru</label>
                                            <input type="text" name="no_reg_bpk_baru" id="no_reg_bpk_baru" value="{{ old('no_reg_bpk_baru', $cagarBudaya->no_reg_bpk_baru) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @error('no_reg_bpk_baru')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="block text-sm font-medium text-gray-700 mb-2">No. Reg Disparbud</p>
                                        <div class="grid grid-cols-4 gap-2">
                                            <div>
                                                <label for="no_reg_disparbud_nomor_urut" class="block text-xs text-gray-500 mb-1">Nomor Urut</label>
                                                <input type="text" name="no_reg_disparbud_nomor_urut" id="no_reg_disparbud_nomor_urut" value="{{ old('no_reg_disparbud_nomor_urut', $cagarBudaya->no_reg_disparbud_nomor_urut) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <div>
                                                <label for="no_reg_disparbud_kode_kecamatan" class="block text-xs text-gray-500 mb-1">Kode Kecamatan</label>
                                                <input type="text" name="no_reg_disparbud_kode_kecamatan" id="no_reg_disparbud_kode_kecamatan" value="{{ old('no_reg_disparbud_kode_kecamatan', $cagarBudaya->no_reg_disparbud_kode_kecamatan) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <div>
                                                <label for="no_reg_disparbud_kode_kabupaten" class="block text-xs text-gray-500 mb-1">Kode Kabupaten</label>
                                                <input type="text" name="no_reg_disparbud_kode_kabupaten" id="no_reg_disparbud_kode_kabupaten" value="{{ old('no_reg_disparbud_kode_kabupaten', $cagarBudaya->no_reg_disparbud_kode_kabupaten) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            <div>
                                                <label for="no_reg_disparbud_tahun" class="block text-xs text-gray-500 mb-1">Tahun</label>
                                                <input type="text" name="no_reg_disparbud_tahun" id="no_reg_disparbud_tahun" value="{{ old('no_reg_disparbud_tahun', $cagarBudaya->no_reg_disparbud_tahun) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-4">Gambar</h3>
                                    
                                    @if ($cagarBudaya->gambar)
                                        <div class="mb-4">
                                            <p class="text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini:</p>
                                            <img src="{{ Storage::url($cagarBudaya->gambar) }}" alt="{{ $cagarBudaya->objek_cagar_budaya }}" class="max-w-full h-auto rounded-lg mb-2" style="max-height: 200px;">
                                        </div>
                                    @endif
                                    
                                    <div class="mb-4">
                                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar (opsional)</label>
                                        <input type="file" name="gambar" id="gambar" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                                        @error('gambar')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-4">Deskripsi</h3>
                                    
                                    <div class="mb-4">
                                        <label for="deskripsi_singkat" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                        <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('deskripsi_singkat', $cagarBudaya->deskripsi_singkat) }}</textarea>
                                        @error('deskripsi_singkat')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-4">Kondisi</h3>
                                    
                                    <div class="mb-4">
                                        <label for="kondisi_saat_ini" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Saat Ini</label>
                                        <textarea name="kondisi_saat_ini" id="kondisi_saat_ini" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('kondisi_saat_ini', $cagarBudaya->kondisi_saat_ini) }}</textarea>
                                        @error('kondisi_saat_ini')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 text-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                                Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>