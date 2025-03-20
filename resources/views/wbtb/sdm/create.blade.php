@extends('layouts.admin-dashboard')

@section('page-title', 'Tambah SDM Kebudayaan')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('wbtb.sdm.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        
        <form action="{{ route('wbtb.sdm.store') }}" method="POST" enctype="multipart/form-data" id="sdm-form">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Identitas Tenaga Budaya -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Identitas Tenaga Budaya</h3>
                        
                        <div class="mb-4">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="gelar_pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Gelar Pendidikan</label>
                            <input type="text" name="gelar_pendidikan" id="gelar_pendidikan" value="{{ old('gelar_pendidikan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('gelar_pendidikan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama_alias" class="block text-sm font-medium text-gray-700 mb-1">Nama Alias</label>
                            <input type="text" name="nama_alias" id="nama_alias" value="{{ old('nama_alias') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nama_alias')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="jenis_identitas" class="block text-sm font-medium text-gray-700 mb-1">Jenis Identitas <span class="text-red-500">*</span></label>
                            <select name="jenis_identitas" id="jenis_identitas" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Jenis Identitas</option>
                                <option value="KTP" {{ old('jenis_identitas') == 'KTP' ? 'selected' : '' }}>KTP</option>
                                <option value="Paspor" {{ old('jenis_identitas') == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                                <option value="SIM" {{ old('jenis_identitas') == 'SIM' ? 'selected' : '' }}>SIM</option>
                                <option value="Kartu Pelajar" {{ old('jenis_identitas') == 'Kartu Pelajar' ? 'selected' : '' }}>Kartu Pelajar</option>
                            </select>
                            @error('jenis_identitas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nomor_identitas" class="block text-sm font-medium text-gray-700 mb-1">Nomor Identitas <span class="text-red-500">*</span></label>
                            <input type="text" name="nomor_identitas" id="nomor_identitas" value="{{ old('nomor_identitas') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nomor_identitas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('tempat_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="kewarganegaraan" class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan <span class="text-red-500">*</span></label>
                            <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('kewarganegaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('tanggal_lahir')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select name="agama" id="agama" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('agama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Media Foto -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Media Foto</h3>
                        
                        <div class="mb-4">
                            <label for="pas_foto" class="block text-sm font-medium text-gray-700 mb-1">Pas Foto</label>
                            <input type="file" name="pas_foto" id="pas_foto" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('pas_foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto_identitas" class="block text-sm font-medium text-gray-700 mb-1">Foto Identitas</label>
                            <input type="file" name="foto_identitas" id="foto_identitas" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('foto_identitas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div>
                    <!-- Alamat -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Alamat</h3>
                        
                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea name="alamat" id="alamat" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="text-md font-medium text-gray-700 mb-2">Koordinat</h4>
                            
                            <div class="grid grid-cols-2 gap-4 mb-2">
                                <div>
                                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude (DD)</label>
                                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('latitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude (DD)</label>
                                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('longitude')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kontak -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        
                        <div class="mb-4">
                            <label for="nomor_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="text" name="nomor_hp" id="nomor_hp" value="{{ old('nomor_hp') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nomor_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nama_ayah')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                            <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nama_ibu')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="media_sosial" class="block text-sm font-medium text-gray-700 mb-1">Akun Media Sosial</label>
                            <input type="text" name="media_sosial" id="media_sosial" value="{{ old('media_sosial') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Instagram: @username, Facebook: nama.akun">
                            @error('media_sosial')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Riwayat -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Riwayat</h3>
                        
                        <!-- Riwayat Pendidikan -->
                        <div class="mb-4" id="riwayat-pendidikan-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Pendidikan</label>
                            
                            <div class="riwayat-pendidikan-items space-y-2">
                                <div class="riwayat-pendidikan-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="riwayat_pendidikan[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2010-2014">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Jenjang</label>
                                            <input type="text" name="riwayat_pendidikan[0][jenjang]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="S1/SMA/dll">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-xs text-gray-500 mb-1">Institusi</label>
                                        <input type="text" name="riwayat_pendidikan[0][institusi]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama institusi pendidikan">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Jurusan/Program Studi</label>
                                        <input type="text" name="riwayat_pendidikan[0][jurusan]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama jurusan/program studi">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-pendidikan" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Riwayat Pendidikan
                            </button>
                        </div>
                        
                        <!-- Riwayat Pelatihan -->
                        <div class="mb-4" id="riwayat-pelatihan-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Pelatihan</label>
                            
                            <div class="riwayat-pelatihan-items space-y-2">
                                <div class="riwayat-pelatihan-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="riwayat_pelatihan[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2020">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Durasi</label>
                                            <input type="text" name="riwayat_pelatihan[0][durasi]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="3 bulan">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-xs text-gray-500 mb-1">Nama Pelatihan</label>
                                        <input type="text" name="riwayat_pelatihan[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama pelatihan">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Penyelenggara</label>
                                        <input type="text" name="riwayat_pelatihan[0][penyelenggara]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama penyelenggara">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-pelatihan" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Riwayat Pelatihan
                            </button>
                        </div>
                        
                        <!-- Riwayat Pekerjaan -->
                        <div class="mb-4" id="riwayat-pekerjaan-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Pekerjaan</label>
                            
                            <div class="riwayat-pekerjaan-items space-y-2">
                                <div class="riwayat-pekerjaan-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="riwayat_pekerjaan[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2015-2020">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Posisi/Jabatan</label>
                                            <input type="text" name="riwayat_pekerjaan[0][posisi]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Posisi/Jabatan">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Perusahaan/Instansi</label>
                                        <input type="text" name="riwayat_pekerjaan[0][instansi]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama perusahaan/instansi">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-pekerjaan" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Riwayat Pekerjaan
                            </button>
                        </div>
                        
                        <!-- Riwayat Aktivitas Kebudayaan -->
                        <div class="mb-4" id="riwayat-aktivitas-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Aktivitas Kebudayaan</label>
                            
                            <div class="riwayat-aktivitas-items space-y-2">
                                <div class="riwayat-aktivitas-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="riwayat_aktivitas[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2022">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Jenis Aktivitas</label>
                                            <input type="text" name="riwayat_aktivitas[0][jenis]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Pertunjukan/Workshop/dll">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-xs text-gray-500 mb-1">Nama Kegiatan</label>
                                        <input type="text" name="riwayat_aktivitas[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama kegiatan">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Penyelenggara</label>
                                        <input type="text" name="riwayat_aktivitas[0][penyelenggara]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama penyelenggara">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-aktivitas" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Riwayat Aktivitas
                            </button>
                        </div>
                        
                        <!-- Riwayat Penghargaan -->
                        <div class="mb-4" id="riwayat-penghargaan-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Riwayat Penghargaan</label>
                            
                            <div class="riwayat-penghargaan-items space-y-2">
                                <div class="riwayat-penghargaan-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="riwayat_penghargaan[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2021">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tingkat</label>
                                            <input type="text" name="riwayat_penghargaan[0][tingkat]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Lokal/Nasional/Internasional">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-xs text-gray-500 mb-1">Nama Penghargaan</label>
                                        <input type="text" name="riwayat_penghargaan[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama penghargaan">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Pemberi Penghargaan</label>
                                        <input type="text" name="riwayat_penghargaan[0][pemberi]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama lembaga/institusi pemberi">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-penghargaan" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Riwayat Penghargaan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk validasi form
        function validateForm() {
            let valid = true;
            const requiredFields = [
                'nama_lengkap', 
                'jenis_identitas', 
                'nomor_identitas', 
                'tempat_lahir', 
                'kewarganegaraan', 
                'tanggal_lahir', 
                'jenis_kelamin', 
                'alamat'
            ];
            
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    element.classList.add('border-red-500');
                    valid = false;
                } else {
                    element.classList.remove('border-red-500');
                }
            });
            
            return valid;
        }
        
        // Event listener untuk form submission
        document.getElementById('sdm-form').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
            }
        });
        
        // Fungsi untuk menambahkan riwayat pendidikan
        function setupRiwayatManager(type) {
            let count = 1;
            const addButton = document.getElementById(`add-${type}`);
            const itemsContainer = document.querySelector(`.riwayat-${type}-items`);
            const template = document.querySelector(`.riwayat-${type}-item`).outerHTML;
            
            addButton.addEventListener('click', function() {
                const newItem = template.replace(new RegExp(`${type}\\[0\\]`, 'g'), `${type}[${count}]`);
                itemsContainer.insertAdjacentHTML('beforeend', newItem);
                count++;
            });
        }
        
        // Setup untuk setiap jenis riwayat
        setupRiwayatManager('pendidikan');
        setupRiwayatManager('pelatihan');
        setupRiwayatManager('pekerjaan');
        setupRiwayatManager('aktivitas');
        setupRiwayatManager('penghargaan');
    });
</script>
@endpush