@extends('layouts.admin-dashboard')

@section('page-title', 'Tambah Lembaga Kebudayaan')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('wbtb.lembaga.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        
        <form action="{{ route('wbtb.lembaga.store') }}" method="POST" enctype="multipart/form-data" id="lembaga-form">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Informasi Dasar -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Dasar</h3>
                        
                        <div class="mb-4">
                            <label for="nama_lembaga" class="block text-sm font-medium text-gray-700 mb-1">Nama Lembaga <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_lembaga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="kategori_lembaga" class="block text-sm font-medium text-gray-700 mb-1">Kategori Lembaga <span class="text-red-500">*</span></label>
                            <select name="kategori_lembaga" id="kategori_lembaga" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Sanggar" {{ old('kategori_lembaga') == 'Sanggar' ? 'selected' : '' }}>Sanggar</option>
                                <option value="Komunitas" {{ old('kategori_lembaga') == 'Komunitas' ? 'selected' : '' }}>Komunitas</option>
                                <option value="Organisasi" {{ old('kategori_lembaga') == 'Organisasi' ? 'selected' : '' }}>Organisasi</option>
                                <option value="Yayasan" {{ old('kategori_lembaga') == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                                <option value="Perkumpulan" {{ old('kategori_lembaga') == 'Perkumpulan' ? 'selected' : '' }}>Perkumpulan</option>
                                <option value="Lainnya" {{ old('kategori_lembaga') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori_lembaga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nomor_registrasi" class="block text-sm font-medium text-gray-700 mb-1">Nomor Registrasi</label>
                            <input type="text" name="nomor_registrasi" id="nomor_registrasi" value="{{ old('nomor_registrasi') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nomor_registrasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_berdiri" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berdiri</label>
                            <input type="date" name="tanggal_berdiri" id="tanggal_berdiri" value="{{ old('tanggal_berdiri') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('tanggal_berdiri')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tingkat_lembaga" class="block text-sm font-medium text-gray-700 mb-1">Tingkat Lembaga</label>
                            <select name="tingkat_lembaga" id="tingkat_lembaga" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Pilih Tingkat</option>
                                <option value="Desa" {{ old('tingkat_lembaga') == 'Desa' ? 'selected' : '' }}>Desa</option>
                                <option value="Kecamatan" {{ old('tingkat_lembaga') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                                <option value="Kabupaten" {{ old('tingkat_lembaga') == 'Kabupaten' ? 'selected' : '' }}>Kabupaten</option>
                                <option value="Provinsi" {{ old('tingkat_lembaga') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                <option value="Nasional" {{ old('tingkat_lembaga') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            </select>
                            @error('tingkat_lembaga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="status_hukum" class="block text-sm font-medium text-gray-700 mb-1">Status Hukum</label>
                            <select name="status_hukum" id="status_hukum" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Pilih Status Hukum</option>
                                <option value="Berbadan Hukum" {{ old('status_hukum') == 'Berbadan Hukum' ? 'selected' : '' }}>Berbadan Hukum</option>
                                <option value="Tidak Berbadan Hukum" {{ old('status_hukum') == 'Tidak Berbadan Hukum' ? 'selected' : '' }}>Tidak Berbadan Hukum</option>
                            </select>
                            @error('status_hukum')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="visi_misi" class="block text-sm font-medium text-gray-700 mb-1">Visi dan Misi</label>
                            <textarea name="visi_misi" id="visi_misi" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('visi_misi') }}</textarea>
                            @error('visi_misi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Kontak dan Alamat -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Kontak dan Alamat</h3>
                        
                        <div class="mb-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
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
                        
                        <div class="mb-4">
                            <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nomor_telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" name="website" id="website" value="{{ old('website') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="https://...">
                            @error('website')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="media_sosial" class="block text-sm font-medium text-gray-700 mb-1">Media Sosial</label>
                            <input type="text" name="media_sosial" id="media_sosial" value="{{ old('media_sosial') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Instagram: @username, Facebook: nama.akun">
                            @error('media_sosial')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div>
                    <!-- Struktur Organisasi -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Struktur Organisasi</h3>
                        
                        <div class="mb-4">
                            <label for="nama_pimpinan" class="block text-sm font-medium text-gray-700 mb-1">Nama Pimpinan <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_pimpinan" id="nama_pimpinan" value="{{ old('nama_pimpinan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_pimpinan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="jabatan_pimpinan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan Pimpinan</label>
                            <input type="text" name="jabatan_pimpinan" id="jabatan_pimpinan" value="{{ old('jabatan_pimpinan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ketua/Direktur/dll">
                            @error('jabatan_pimpinan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="jumlah_anggota" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Anggota</label>
                            <input type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" min="0">
                            @error('jumlah_anggota')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Pengurus -->
                        <div class="mb-4" id="pengurus-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Pengurus</label>
                            
                            <div class="pengurus-items space-y-2">
                                <div class="pengurus-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Nama</label>
                                            <input type="text" name="pengurus[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama pengurus">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Jabatan</label>
                                            <input type="text" name="pengurus[0][jabatan]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Jabatan pengurus">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Keterangan</label>
                                        <input type="text" name="pengurus[0][keterangan]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Keterangan tambahan (opsional)">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-pengurus" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Pengurus
                            </button>
                        </div>
                    </div>
                    
                    <!-- Aktivitas -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Aktivitas dan Prestasi</h3>
                        
                        <!-- Aktivitas -->
                        <div class="mb-4" id="aktivitas-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Aktivitas</label>
                            
                            <div class="aktivitas-items space-y-2">
                                <div class="aktivitas-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="aktivitas[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2023">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Jenis Kegiatan</label>
                                            <input type="text" name="aktivitas[0][jenis]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Workshop/Pertunjukan/dll">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Nama Kegiatan</label>
                                        <input type="text" name="aktivitas[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama kegiatan">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-aktivitas" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Aktivitas
                            </button>
                        </div>
                        
                        <!-- Prestasi -->
                        <div class="mb-4" id="prestasi-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Prestasi</label>
                            
                            <div class="prestasi-items space-y-2">
                                <div class="prestasi-item p-3 border border-gray-300 rounded-md">
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                                            <input type="text" name="prestasi[0][tahun]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="2023">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Tingkat</label>
                                            <input type="text" name="prestasi[0][tingkat]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Kabupaten/Provinsi/Nasional/dll">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-xs text-gray-500 mb-1">Nama Penghargaan</label>
                                        <input type="text" name="prestasi[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama penghargaan">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Pemberi Penghargaan</label>
                                        <input type="text" name="prestasi[0][pemberi]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama lembaga/institusi pemberi">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-prestasi" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Prestasi
                            </button>
                        </div>
                    </div>
                    
                    <!-- Media -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Media</h3>
                        
                        <div class="mb-4">
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo Lembaga</label>
                            <input type="file" name="logo" id="logo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('logo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto_bangunan" class="block text-sm font-medium text-gray-700 mb-1">Foto Bangunan/Sekretariat</label>
                            <input type="file" name="foto_bangunan" id="foto_bangunan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('foto_bangunan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto_kegiatan" class="block text-sm font-medium text-gray-700 mb-1">Foto Kegiatan (Multiple)</label>
                            <input type="file" name="foto_kegiatan[]" id="foto_kegiatan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB per file. Maksimal 5 foto.</p>
                            @error('foto_kegiatan.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="dokumen_legalitas" class="block text-sm font-medium text-gray-700 mb-1">Dokumen Legalitas</label>
                            <input type="file" name="dokumen_legalitas" id="dokumen_legalitas" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX. Maks: 10MB</p>
                            @error('dokumen_legalitas')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
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
                'nama_lembaga', 
                'kategori_lembaga',
                'alamat',
                'nama_pimpinan'
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
        document.getElementById('lembaga-form').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
            }
        });
        
        // Fungsi untuk menambahkan item dinamis (pengurus, aktivitas, prestasi)
        function setupItemManager(type) {
            let count = 1;
            const addButton = document.getElementById(`add-${type}`);
            const itemsContainer = document.querySelector(`.${type}-items`);
            const template = document.querySelector(`.${type}-item`).outerHTML;
            
            addButton.addEventListener('click', function() {
                const newItem = template.replace(new RegExp(`${type}\\[0\\]`, 'g'), `${type}[${count}]`);
                itemsContainer.insertAdjacentHTML('beforeend', newItem);
                count++;
            });
        }
        
        // Setup untuk setiap jenis item dinamis
        setupItemManager('pengurus');
        setupItemManager('aktivitas');
        setupItemManager('prestasi');
        
        // Limitasi jumlah file untuk foto kegiatan
        document.getElementById('foto_kegiatan').addEventListener('change', function() {
            if (this.files.length > 5) {
                alert('Anda hanya dapat memilih maksimal 5 foto kegiatan.');
                this.value = '';
            }
        });
    });
</script>
@endpush