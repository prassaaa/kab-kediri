@extends('layouts.admin-dashboard')

@section('page-title', 'Tambah Sarpras Kebudayaan')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('wbtb.sarpras.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        
        <form action="{{ route('wbtb.sarpras.store') }}" method="POST" enctype="multipart/form-data" id="sarpras-form">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Informasi Dasar -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Dasar</h3>
                        
                        <div class="mb-4">
                            <label for="nama_sarpras" class="block text-sm font-medium text-gray-700 mb-1">Nama Sarpras <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_sarpras" id="nama_sarpras" value="{{ old('nama_sarpras') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_sarpras')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
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
                    </div>
                    
                    <!-- Kontak -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        
                        <div class="mb-4">
                            <label for="nama_kontak" class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_kontak" id="nama_kontak" value="{{ old('nama_kontak') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_kontak')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No HP <span class="text-red-500">*</span></label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Kepemilikan dan Kepengurusan -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Kepemilikan dan Kepengurusan</h3>
                        
                        <div class="mb-4">
                            <label for="status_kepemilikan" class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan <span class="text-red-500">*</span></label>
                            <select name="status_kepemilikan" id="status_kepemilikan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Status Kepemilikan</option>
                                <option value="Pemerintah" {{ old('status_kepemilikan') == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                                <option value="Swasta" {{ old('status_kepemilikan') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                <option value="Komunitas" {{ old('status_kepemilikan') == 'Komunitas' ? 'selected' : '' }}>Komunitas</option>
                                <option value="Yayasan" {{ old('status_kepemilikan') == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                                <option value="Pribadi" {{ old('status_kepemilikan') == 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                                <option value="Lainnya" {{ old('status_kepemilikan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('status_kepemilikan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama_pemilik" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('nama_pemilik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nama_pengelola" class="block text-sm font-medium text-gray-700 mb-1">Nama Pengelola</label>
                            <input type="text" name="nama_pengelola" id="nama_pengelola" value="{{ old('nama_pengelola') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nama_pengelola')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div>
                    <!-- Media -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Media</h3>
                        
                        <div class="mb-4">
                            <label for="papan_nama" class="block text-sm font-medium text-gray-700 mb-1">Papan Nama</label>
                            <input type="file" name="papan_nama" id="papan_nama" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('papan_nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto_dalam" class="block text-sm font-medium text-gray-700 mb-1">Foto Bangunan Tampak Dalam</label>
                            <input type="file" name="foto_dalam" id="foto_dalam" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('foto_dalam')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="foto_luar" class="block text-sm font-medium text-gray-700 mb-1">Foto Bangunan Tampak Luar</label>
                            <input type="file" name="foto_luar" id="foto_luar" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB</p>
                            @error('foto_luar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Fasilitas Tersedia</h3>
                        
                        <div class="mb-4" id="fasilitas-container">
                            <div class="fasilitas-items space-y-2">
                                <div class="fasilitas-item p-3 border border-gray-300 rounded-md">
                                    <div class="mb-2">
                                        <label class="block text-xs text-gray-500 mb-1">Nama Fasilitas</label>
                                        <input type="text" name="fasilitas[0][nama]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Nama fasilitas">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500 mb-1">Keterangan</label>
                                        <input type="text" name="fasilitas[0][keterangan]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" placeholder="Keterangan tambahan (opsional)">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="add-fasilitas" class="mt-2 flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Fasilitas
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
                'nama_sarpras', 
                'deskripsi',
                'alamat',
                'nama_kontak',
                'no_hp',
                'status_kepemilikan',
                'nama_pemilik'
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
        document.getElementById('sarpras-form').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
            }
        });
        
        // Fungsi untuk menambahkan fasilitas
        let fasilitasCount = 1;
        const addFasilitasButton = document.getElementById('add-fasilitas');
        const fasilitasContainer = document.querySelector('.fasilitas-items');
        const fasilitasTemplate = document.querySelector('.fasilitas-item').outerHTML;
        
        addFasilitasButton.addEventListener('click', function() {
            const newFasilitas = fasilitasTemplate.replace(/fasilitas\[0\]/g, `fasilitas[${fasilitasCount}]`);
            fasilitasContainer.insertAdjacentHTML('beforeend', newFasilitas);
            fasilitasCount++;
        });
    });
</script>
@endpush