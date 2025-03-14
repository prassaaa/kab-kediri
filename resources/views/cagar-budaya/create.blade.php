@extends('layouts.admin-dashboard')

@section('page-title', 'Tambah Data Cagar Budaya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6">
            <a href="{{ route('cagar-budaya.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
        
        <form action="{{ route('cagar-budaya.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Umum</h3>
                        
                        <div class="mb-4">
                            <label for="objek_cagar_budaya" class="block text-sm font-medium text-gray-700 mb-1">Objek Cagar Budaya</label>
                            <input type="text" name="objek_cagar_budaya" id="objek_cagar_budaya" value="{{ old('objek_cagar_budaya') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('objek_cagar_budaya')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="predikat" class="block text-sm font-medium text-gray-700 mb-1">Predikat</label>
                            <select name="predikat" id="predikat" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Predikat</option>
                                <option value="Cagar Budaya" {{ old('predikat') == 'Cagar Budaya' ? 'selected' : '' }}>Cagar Budaya</option>
                                <option value="Objek diduga cagar budaya" {{ old('predikat') == 'Objek diduga cagar budaya' ? 'selected' : '' }}>Objek diduga cagar budaya</option>
                            </select>
                            @error('predikat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" id="kategori" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Benda" {{ old('kategori') == 'Benda' ? 'selected' : '' }}>Benda</option>
                                <option value="Bangunan" {{ old('kategori') == 'Bangunan' ? 'selected' : '' }}>Bangunan</option>
                                <option value="Struktur" {{ old('kategori') == 'Struktur' ? 'selected' : '' }}>Struktur</option>
                                <option value="Situs" {{ old('kategori') == 'Situs' ? 'selected' : '' }}>Situs</option>
                                <option value="Kawasan" {{ old('kategori') == 'Kawasan' ? 'selected' : '' }}>Kawasan</option>
                            </select>
                            @error('kategori')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="bahan" class="block text-sm font-medium text-gray-700 mb-1">Bahan</label>
                            <input type="text" name="bahan" id="bahan" value="{{ old('bahan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('bahan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Lokasi</h3>
                        
                        <div class="mb-4">
                            <label for="lokasi_jalan_dukuhan" class="block text-sm font-medium text-gray-700 mb-1">Jalan/Dukuhan</label>
                            <input type="text" name="lokasi_jalan_dukuhan" id="lokasi_jalan_dukuhan" value="{{ old('lokasi_jalan_dukuhan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('lokasi_jalan_dukuhan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="lokasi_dusun" class="block text-sm font-medium text-gray-700 mb-1">Dusun</label>
                            <input type="text" name="lokasi_dusun" id="lokasi_dusun" value="{{ old('lokasi_dusun') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('lokasi_dusun')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="lokasi_desa" class="block text-sm font-medium text-gray-700 mb-1">Desa</label>
                            <input type="text" name="lokasi_desa" id="lokasi_desa" value="{{ old('lokasi_desa') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('lokasi_desa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="lokasi_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                            <input type="text" name="lokasi_kecamatan" id="lokasi_kecamatan" value="{{ old('lokasi_kecamatan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @error('lokasi_kecamatan')
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
                            
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mt-2">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Konversi UTM ke Latitude/Longitude</h5>
                                
                                <div class="grid grid-cols-4 gap-2 mb-2">
                                    <div>
                                        <label for="utm_zone" class="block text-xs font-medium text-gray-700 mb-1">Zone UTM</label>
                                        <select id="utm_zone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm py-1">
                                            <option value="48M">48M</option>
                                            <option value="48N">48N</option>
                                            <option value="49M">49M</option>
                                            <option value="49N">49N</option>
                                            <option value="50M">50M</option>
                                            <option value="50N">50N</option>
                                            <option value="51M">51M</option>
                                            <option value="51N">51N</option>
                                            <option value="52M">52M</option>
                                            <option value="52N">52N</option>
                                            <option value="53M">53M</option>
                                            <option value="53N">53N</option>
                                            <option value="54M">54M</option>
                                            <option value="54N">54N</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="utm_easting" class="block text-xs font-medium text-gray-700 mb-1">Easting (X)</label>
                                        <input type="text" id="utm_easting" placeholder="Contoh: 123456" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm py-1">
                                    </div>
                                    <div>
                                        <label for="utm_northing" class="block text-xs font-medium text-gray-700 mb-1">Northing (Y)</label>
                                        <input type="text" id="utm_northing" placeholder="Contoh: 1234567" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm py-1">
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" id="convert_utm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Konversi
                                        </button>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Masukkan zona UTM (contoh: 49M), easting (X), dan northing (Y) lalu klik tombol Konversi.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Nomor Registrasi</h3>
                        
                        <div class="mb-4 grid grid-cols-2 gap-4">
                            <div>
                                <label for="no_reg_bpk_lama" class="block text-sm font-medium text-gray-700 mb-1">No. Reg BPK Lama</label>
                                <input type="text" name="no_reg_bpk_lama" id="no_reg_bpk_lama" value="{{ old('no_reg_bpk_lama') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('no_reg_bpk_lama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="no_reg_bpk_baru" class="block text-sm font-medium text-gray-700 mb-1">No. Reg BPK Baru</label>
                                <input type="text" name="no_reg_bpk_baru" id="no_reg_bpk_baru" value="{{ old('no_reg_bpk_baru') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
                                    <input type="text" name="no_reg_disparbud_nomor_urut" id="no_reg_disparbud_nomor_urut" value="{{ old('no_reg_disparbud_nomor_urut') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="no_reg_disparbud_kode_kecamatan" class="block text-xs text-gray-500 mb-1">Kode Kecamatan</label>
                                    <input type="text" name="no_reg_disparbud_kode_kecamatan" id="no_reg_disparbud_kode_kecamatan" value="{{ old('no_reg_disparbud_kode_kecamatan') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="no_reg_disparbud_kode_kabupaten" class="block text-xs text-gray-500 mb-1">Kode Kabupaten</label>
                                    <input type="text" name="no_reg_disparbud_kode_kabupaten" id="no_reg_disparbud_kode_kabupaten" value="{{ old('no_reg_disparbud_kode_kabupaten') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="no_reg_disparbud_tahun" class="block text-xs text-gray-500 mb-1">Tahun</label>
                                    <input type="text" name="no_reg_disparbud_tahun" id="no_reg_disparbud_tahun" value="{{ old('no_reg_disparbud_tahun') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Gambar</h3>
                        
                        <div class="mb-4">
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
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
                            <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('deskripsi_singkat') }}</textarea>
                            @error('deskripsi_singkat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Kondisi</h3>
                        
                        <div class="mb-4">
                            <label for="kondisi_saat_ini" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Saat Ini</label>
                            <textarea name="kondisi_saat_ini" id="kondisi_saat_ini" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('kondisi_saat_ini') }}</textarea>
                            @error('kondisi_saat_ini')
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
<!-- Include Proj4js for accurate conversion -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.8.0/proj4.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to convert UTM to lat/long using Proj4js
        function convertUTM() {
            const zone = document.getElementById('utm_zone').value;
            const easting = document.getElementById('utm_easting').value;
            const northing = document.getElementById('utm_northing').value;
            
            // Validate inputs
            if (!zone || !easting || !northing) {
                alert('Semua field UTM harus diisi!');
                return;
            }
            
            try {
                // Get zone number and letter
                const zoneNum = parseInt(zone);
                const zoneLetter = zone.substr(-1);
                
                // Check if we're in northern hemisphere (N) or southern (M)
                const isNorthern = zoneLetter >= 'N';
                
                // Define the UTM and WGS84 projections
                const utmProj = `+proj=utm +zone=${zoneNum} ${isNorthern ? '' : '+south'} +datum=WGS84 +units=m +no_defs`;
                const wgs84Proj = "+proj=longlat +datum=WGS84 +no_defs";
                
                // Convert UTM to Lat/Long
                const result = proj4(utmProj, wgs84Proj, [parseFloat(easting), parseFloat(northing)]);
                
                // Round to 7 decimal places
                const lng = Math.round(result[0] * 10000000) / 10000000;
                const lat = Math.round(result[1] * 10000000) / 10000000;
                
                // Update the form fields
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                
                // Show success message
                alert(`Konversi berhasil!\nLatitude: ${lat}\nLongitude: ${lng}`);
            } catch (e) {
                alert('Error saat konversi: ' + e.message);
            }
        }
        
        // If Proj4js fails for some reason, use this fallback function
        function utmToLatLongFallback(zone, easting, northing) {
            // Parse zone to get number and letter
            let zoneNum = parseInt(zone);
            let zoneLetter = zone.substr(-1);
            
            // UTM parameters
            const a = 6378137; // WGS84 ellipsoid radius in meters
            const eccSquared = 0.00669438; // eccentricity squared
            
            // Convert easting and northing to meters
            easting = parseFloat(easting);
            northing = parseFloat(northing);
            
            // False northing/easting based on zone letter
            let northernHemisphere = zoneLetter >= 'N';
            const falseNorthing = northernHemisphere ? 0 : 10000000.0;
            const falseEasting = 500000.0;
            
            // Central meridian of the zone
            const centralMeridian = (zoneNum - 1) * 6 - 180 + 3; // in degrees
            
            // Calculations
            const x = easting - falseEasting;
            const y = northing - falseNorthing;
            
            // Scale factor at central meridian
            const k0 = 0.9996;
            
            // Additional calculations for converting UTM to lat/long
            // This is a simplified implementation
            const M = y / k0;
            const mu = M / (a * (1 - eccSquared / 4 - 3 * eccSquared * eccSquared / 64 - 5 * eccSquared * eccSquared * eccSquared / 256));
            
            const phi1Rad = mu + (3 * Math.pow(Math.E, 1) / 2 - 27 * Math.pow(Math.E, 3) / 32) * Math.sin(2 * mu) +
                          (21 * Math.pow(Math.E, 2) / 16 - 55 * Math.pow(Math.E, 4) / 32) * Math.sin(4 * mu) +
                          (151 * Math.pow(Math.E, 3) / 96) * Math.sin(6 * mu);
            
            const N1 = a / Math.sqrt(1 - eccSquared * Math.sin(phi1Rad) * Math.sin(phi1Rad));
            const T1 = Math.tan(phi1Rad) * Math.tan(phi1Rad);
            const C1 = eccSquared * Math.cos(phi1Rad) * Math.cos(phi1Rad);
            const R1 = a * (1 - eccSquared) / Math.pow(1 - eccSquared * Math.sin(phi1Rad) * Math.sin(phi1Rad), 1.5);
            const D = x / (N1 * k0);
            
            const latRad = phi1Rad - (N1 * Math.tan(phi1Rad) / R1) * (D * D / 2 - (5 + 3 * T1 + 10 * C1 - 4 * C1 * C1 - 9 * eccSquared) * D * D * D * D / 24 +
                                 (61 + 90 * T1 + 298 * C1 + 45 * T1 * T1 - 252 * eccSquared - 3 * C1 * C1) * D * D * D * D * D * D / 720);
            
            const lonRad = (D - (1 + 2 * T1 + C1) * D * D * D / 6 + (5 - 2 * C1 + 28 * T1 - 3 * C1 * C1 + 8 * eccSquared + 24 * T1 * T1) * D * D * D * D * D / 120) / Math.cos(phi1Rad);
            
            const latitude = latRad * 180 / Math.PI;
            const longitude = centralMeridian + lonRad * 180 / Math.PI;
            
            return { latitude, longitude };
        }
        
        // Attach event handler for UTM conversion
        document.getElementById('convert_utm').addEventListener('click', convertUTM);

        // Element untuk form dan notifikasi
        const uploadForm = document.querySelector('form[enctype="multipart/form-data"]');
        const submitButton = uploadForm.querySelector('button[type="submit"]');
        
        // Buat elemen untuk notifikasi status koneksi
        const connectionStatusContainer = document.createElement('div');
        connectionStatusContainer.id = 'connection-status-container';
        connectionStatusContainer.className = 'fixed bottom-4 right-4 p-3 rounded-lg shadow-lg z-50 transition-all duration-300';
        connectionStatusContainer.innerHTML = `
            <div class="flex items-center gap-2">
                <span id="connection-indicator" class="inline-block w-3 h-3 rounded-full"></span>
                <span id="connection-status-text" class="text-sm font-medium"></span>
            </div>
        `;
        document.body.appendChild(connectionStatusContainer);
        
        const connectionIndicator = document.getElementById('connection-indicator');
        const connectionStatusText = document.getElementById('connection-status-text');
        
        // Container untuk notifikasi upload
        const uploadNotification = document.createElement('div');
        uploadNotification.id = 'upload-notification';
        uploadNotification.className = 'fixed top-0 left-0 w-full p-3 text-center text-white font-medium transform -translate-y-full transition-transform duration-300 z-50';
        document.body.appendChild(uploadNotification);
        
        // Variabel untuk menyimpan status koneksi terakhir yang diperiksa
        let lastConnectionStatus = {
            online: navigator.onLine,
            speed: 'unknown',
            latency: 0
        };
        
        // Fungsi untuk mengupdate tampilan status koneksi
        function updateConnectionUI() {
            // Reset terlebih dahulu
            connectionStatusContainer.classList.remove('bg-red-100', 'bg-yellow-100', 'bg-green-100');
            connectionIndicator.classList.remove('bg-red-600', 'bg-yellow-500', 'bg-green-600');
            connectionStatusText.classList.remove('text-red-600', 'text-yellow-600', 'text-green-600');
            
            if (!lastConnectionStatus.online) {
                // Offline
                connectionStatusContainer.classList.add('bg-red-100');
                connectionIndicator.classList.add('bg-red-600');
                connectionStatusText.textContent = 'Offline';
                connectionStatusText.classList.add('text-red-600');
            } else if (lastConnectionStatus.speed === 'slow') {
                // Koneksi lambat
                connectionStatusContainer.classList.add('bg-yellow-100');
                connectionIndicator.classList.add('bg-yellow-500');
                connectionStatusText.textContent = 'Koneksi Lambat';
                connectionStatusText.classList.add('text-yellow-600');
            } else {
                // Koneksi baik
                connectionStatusContainer.classList.add('bg-green-100');
                connectionIndicator.classList.add('bg-green-600');
                connectionStatusText.textContent = 'Koneksi Baik';
                connectionStatusText.classList.add('text-green-600');
            }
        }
        
        // Fungsi untuk mengukur kecepatan koneksi
        function checkConnectionSpeed() {
            const startTime = Date.now();
            const url = '{{ route("connection.test") }}?' + startTime; // tambahkan parameter untuk menghindari cache
            
            return fetch(url, { method: 'HEAD' })
                .then(response => {
                    const endTime = Date.now();
                    const latency = endTime - startTime;
                    
                    lastConnectionStatus.latency = latency;
                    lastConnectionStatus.online = true;
                    
                    // Tentukan kualitas koneksi berdasarkan latency
                    if (latency > 500) { // lebih dari 500ms dianggap lambat
                        lastConnectionStatus.speed = 'slow';
                    } else {
                        lastConnectionStatus.speed = 'good';
                    }
                    
                    updateConnectionUI();
                    return lastConnectionStatus;
                })
                .catch(error => {
                    console.error('Gagal mengecek koneksi:', error);
                    lastConnectionStatus.online = navigator.onLine;
                    lastConnectionStatus.speed = 'unknown';
                    updateConnectionUI();
                    return lastConnectionStatus;
                });
        }
        
        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type) {
            uploadNotification.textContent = message;
            uploadNotification.classList.remove('bg-red-600', 'bg-yellow-500', 'bg-green-600');
            
            if (type === 'error') {
                uploadNotification.classList.add('bg-red-600');
            } else if (type === 'warning') {
                uploadNotification.classList.add('bg-yellow-500');
            } else {
                uploadNotification.classList.add('bg-green-600');
            }
            
            uploadNotification.classList.add('translate-y-0');
            
            setTimeout(() => {
                uploadNotification.classList.remove('translate-y-0');
            }, 5000);
        }
        
        // Jalankan pengecekan awal
        checkConnectionSpeed();
        
        // Update status saat event online/offline
        window.addEventListener('online', () => {
            lastConnectionStatus.online = true;
            checkConnectionSpeed();
            showNotification('Koneksi internet telah tersambung kembali', 'success');
        });
        
        window.addEventListener('offline', () => {
            lastConnectionStatus.online = false;
            updateConnectionUI();
            showNotification('Koneksi internet terputus', 'error');
        });
        
        // Tambahkan event listener untuk file input (gambar)
        const fileInput = document.getElementById('gambar');
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // Cek ukuran file
                const fileSize = this.files[0].size / 1024 / 1024; // convert to MB
                
                // Jika file lebih dari 1 MB, periksa kecepatan koneksi
                if (fileSize > 1) {
                    checkConnectionSpeed().then(status => {
                        if (status.speed === 'slow') {
                            showNotification(`Perhatian: Koneksi internet lambat (${status.latency}ms). Upload mungkin membutuhkan waktu lebih lama.`, 'warning');
                        }
                    });
                }
            }
        });
        
        // Tambahkan event listener untuk form submission
        uploadForm.addEventListener('submit', function(e) {
            // Cek apakah ada file yang dipilih
            const fileInput = document.getElementById('gambar');
            let hasFile = fileInput.files && fileInput.files.length > 0;
            
            if (hasFile) {
                e.preventDefault(); // Tahan pengiriman form
                
                // Periksa koneksi terlebih dahulu
                checkConnectionSpeed().then(status => {
                    if (!status.online) {
                        showNotification('Tidak dapat mengirim form: Koneksi internet terputus', 'error');
                        return;
                    }
                    
                    if (status.speed === 'slow') {
                        // Tampilkan konfirmasi jika koneksi lambat
                        if (confirm(`Koneksi internet Anda lambat (${status.latency}ms). Upload mungkin membutuhkan waktu lebih lama atau gagal. Lanjutkan?`)) {
                            // Ubah tampilan tombol submit
                            const originalText = submitButton.innerHTML;
                            submitButton.innerHTML = '<span class="inline-block animate-spin mr-2">↻</span> Mengunggah...';
                            submitButton.disabled = true;
                            
                            // Timer untuk timeout
                            const uploadTimeout = setTimeout(() => {
                                submitButton.innerHTML = originalText;
                                submitButton.disabled = false;
                                showNotification('Upload gagal: Waktu habis', 'error');
                            }, 60000); // 60 detik timeout
                            
                            // Gunakan Fetch API untuk upload dengan progress
                            const formData = new FormData(uploadForm);
                            
                            fetch(uploadForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => {
                                clearTimeout(uploadTimeout);
                                
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Server error');
                                }
                            })
                            .then(data => {
                                submitButton.innerHTML = '✓ Berhasil';
                                showNotification(data.message || 'Data berhasil disimpan', 'success');
                                
                                setTimeout(() => {
                                    window.location.href = data.redirect || "{{ route('cagar-budaya.index') }}";
                                }, 1000);
                            })
                            .catch(error => {
                                clearTimeout(uploadTimeout);
                                submitButton.innerHTML = originalText;
                                submitButton.disabled = false;
                                showNotification('Upload gagal: ' + error.message, 'error');
                            });
                        }
                    } else {
                        // Jika koneksi baik, submit form seperti biasa
                        uploadForm.submit();
                    }
                });
            } else {
                // Jika tidak ada file, periksa koneksi dasar saja
                if (!navigator.onLine) {
                    e.preventDefault();
                    showNotification('Tidak dapat mengirim form: Koneksi internet terputus', 'error');
                }
            }
        });
        
        // Periksa koneksi secara berkala (setiap 30 detik)
        setInterval(checkConnectionSpeed, 30000);
    });
</script>

<style>
/* Animasi untuk indikator */
#connection-indicator {
    transition: background-color 0.3s ease;
}

/* Animasi untuk spinner upload */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Transisi untuk notifikasi */
#upload-notification {
    transition: transform 0.3s ease;
}

/* Responsiveness untuk container status koneksi */
@media (max-width: 640px) {
    #connection-status-container {
        bottom: 0;
        right: 0;
        width: 100%;
        border-radius: 0;
    }
}
</style>
@endpush