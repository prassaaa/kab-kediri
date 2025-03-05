@extends('layouts.admin-dashboard')

@section('page-title', 'Edit Data Cagar Budaya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-4 sm:p-6">
        <div class="mb-6">
            <a href="{{ route('cagar-budaya.show', $cagarBudaya->id) }}" 
               class="text-blue-600 hover:text-blue-900 flex items-center text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Detail
            </a>
        </div>
        
        <form action="{{ route('cagar-budaya.update', $cagarBudaya->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Informasi Umum</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="objek_cagar_budaya" class="block text-sm font-medium text-gray-700 mb-1">Objek Cagar Budaya</label>
                                <input type="text" 
                                       name="objek_cagar_budaya" 
                                       id="objek_cagar_budaya" 
                                       value="{{ old('objek_cagar_budaya', $cagarBudaya->objek_cagar_budaya) }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                       required>
                                @error('objek_cagar_budaya')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" 
                                        id="kategori" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                        required>
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
                            
                            <div>
                                <label for="bahan" class="block text-sm font-medium text-gray-700 mb-1">Bahan</label>
                                <input type="text" 
                                       name="bahan" 
                                       id="bahan" 
                                       value="{{ old('bahan', $cagarBudaya->bahan) }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                @error('bahan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Lokasi</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="lokasi_jalan_dukuhan" class="block text-sm font-medium text-gray-700 mb-1">Jalan/Dukuhan</label>
                                <input type="text" 
                                       name="lokasi_jalan_dukuhan" 
                                       id="lokasi_jalan_dukuhan" 
                                       value="{{ old('lokasi_jalan_dukuhan', $cagarBudaya->lokasi_jalan_dukuhan) }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                @error('lokasi_jalan_dukuhan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="lokasi_dusun" class="block text-sm font-medium text-gray-700 mb-1">Dusun</label>
                                <input type="text" 
                                       name="lokasi_dusun" 
                                       id="lokasi_dusun" 
                                       value="{{ old('lokasi_dusun', $cagarBudaya->lokasi_dusun) }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                @error('lokasi_dusun')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="lokasi_desa" class="block text-sm font-medium text-gray-700 mb-1">Desa</label>
                                <input type="text" 
                                       name="lokasi_desa" 
                                       id="lokasi_desa" 
                                       value="{{ old('lokasi_desa', $cagarBudaya->lokasi_desa) }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                       required>
                                @error('lokasi_desa')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="lokasi_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                <input type="text" 
                                       name="lokasi_kecamatan" 
                                       id="lokasi_kecamatan" 
                                       value="{{ old('lokasi_kecamatan', $cagarBudaya->lokasi_kecamatan) }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                       required>
                                @error('lokasi_kecamatan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                                    <input type="text" 
                                           name="latitude" 
                                           id="latitude" 
                                           value="{{ old('latitude', $cagarBudaya->latitude) }}" 
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    @error('latitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                                    <input type="text" 
                                           name="longitude" 
                                           id="longitude" 
                                           value="{{ old('longitude', $cagarBudaya->longitude) }}" 
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    @error('longitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Nomor Registrasi</h3>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="no_reg_bpk_lama" class="block text-sm font-medium text-gray-700 mb-1">No. Reg BPK Lama</label>
                                    <input type="text" 
                                           name="no_reg_bpk_lama" 
                                           id="no_reg_bpk_lama" 
                                           value="{{ old('no_reg_bpk_lama', $cagarBudaya->no_reg_bpk_lama) }}" 
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    @error('no_reg_bpk_lama')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="no_reg_bpk_baru" class="block text-sm font-medium text-gray-700 mb-1">No. Reg BPK Baru</label>
                                    <input type="text" 
                                           name="no_reg_bpk_baru" 
                                           id="no_reg_bpk_baru" 
                                           value="{{ old('no_reg_bpk_baru', $cagarBudaya->no_reg_bpk_baru) }}" 
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    @error('no_reg_bpk_baru')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <p class="block text-sm font-medium text-gray-700 mb-2">No. Reg Disparbud</p>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                    <div>
                                        <label for="no_reg_disparbud_nomor_urut" class="block text-xs text-gray-500 mb-1">Nomor Urut</label>
                                        <input type="text" 
                                               name="no_reg_disparbud_nomor_urut" 
                                               id="no_reg_disparbud_nomor_urut" 
                                               value="{{ old('no_reg_disparbud_nomor_urut', $cagarBudaya->no_reg_disparbud_nomor_urut) }}" 
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    </div>
                                    <div>
                                        <label for="no_reg_disparbud_kode_kecamatan" class="block text-xs text-gray-500 mb-1">Kode Kecamatan</label>
                                        <input type="text" 
                                               name="no_reg_disparbud_kode_kecamatan" 
                                               id="no_reg_disparbud_kode_kecamatan" 
                                               value="{{ old('no_reg_disparbud_kode_kecamatan', $cagarBudaya->no_reg_disparbud_kode_kecamatan) }}" 
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    </div>
                                    <div>
                                        <label for="no_reg_disparbud_kode_kabupaten" class="block text-xs text-gray-500 mb-1">Kode Kabupaten</label>
                                        <input type="text" 
                                               name="no_reg_disparbud_kode_kabupaten" 
                                               id="no_reg_disparbud_kode_kabupaten" 
                                               value="{{ old('no_reg_disparbud_kode_kabupaten', $cagarBudaya->no_reg_disparbud_kode_kabupaten) }}" 
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    </div>
                                    <div>
                                        <label for="no_reg_disparbud_tahun" class="block text-xs text-gray-500 mb-1">Tahun</label>
                                        <input type="text" 
                                               name="no_reg_disparbud_tahun" 
                                               id="no_reg_disparbud_tahun" 
                                               value="{{ old('no_reg_disparbud_tahun', $cagarBudaya->no_reg_disparbud_tahun) }}" 
                                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Gambar</h3>
                        
                        @if ($cagarBudaya->gambar)
                            <div class="mb-4">
                                <p class="text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini:</p>
                                <img src="{{ Storage::url($cagarBudaya->gambar) }}" 
                                     alt="{{ $cagarBudaya->objek_cagar_budaya }}" 
                                     class="max-w-full h-auto rounded-lg mb-2" 
                                     style="max-height: 200px;">
                            </div>
                        @endif
                        
                        <div class="space-y-4">
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar (opsional)</label>
                                <input type="file" 
                                       name="gambar" 
                                       id="gambar" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                                @error('gambar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Deskripsi</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="deskripsi_singkat" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                <textarea name="deskripsi_singkat" 
                                          id="deskripsi_singkat" 
                                          rows="5" 
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base" 
                                          required>{{ old('deskripsi_singkat', $cagarBudaya->deskripsi_singkat) }}</textarea>
                                @error('deskripsi_singkat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-center sm:text-left">Kondisi</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="kondisi_saat_ini" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Saat Ini</label>
                                <textarea name="kondisi_saat_ini" 
                                          id="kondisi_saat_ini" 
                                          rows="5" 
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm sm:text-base">{{ old('kondisi_saat_ini', $cagarBudaya->kondisi_saat_ini) }}</textarea>
                                @error('kondisi_saat_ini')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 sm:px-6 rounded-lg text-sm sm:text-base">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection