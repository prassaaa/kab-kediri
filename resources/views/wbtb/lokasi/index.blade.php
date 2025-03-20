@extends('layouts.admin-dashboard')

@section('page-title', 'Peta Lokasi WBTB')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-6">Peta Sebaran WBTB</h2>
    
    <div class="mb-6">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Klik tombol <strong>Lokasi Saya</strong> pada peta untuk menampilkan lokasi Anda saat ini.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Peta Lembaga Kebudayaan -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Lembaga Kebudayaan</h3>
            </div>
            <div class="p-4">
                <div id="map-lembaga" class="w-full h-[300px] md:h-[400px] rounded-lg border border-gray-300"></div>
            </div>
        </div>
        
        <!-- Peta Sarana Prasarana -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Sarana dan Prasarana Kebudayaan</h3>
            </div>
            <div class="p-4">
                <div id="map-sarpras" class="w-full h-[300px] md:h-[400px] rounded-lg border border-gray-300"></div>
            </div>
        </div>
        
        <!-- Peta SDM Kebudayaan -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">SDM Kebudayaan</h3>
            </div>
            <div class="p-4">
                <div id="map-sdm" class="w-full h-[300px] md:h-[400px] rounded-lg border border-gray-300"></div>
            </div>
        </div>
        
        <!-- Peta OPK -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Objek Pemajuan Kebudayaan</h3>
            </div>
            <div class="p-4">
                <div id="map-opk" class="w-full h-[300px] md:h-[400px] rounded-lg border border-gray-300"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Koordinat default, sesuaikan dengan lokasi Anda
        const defaultCoordinates = [-7.8031, 111.9914];
        const defaultZoom = 10;
        
        // Variabel untuk marker lokasi saat ini
        let locationMarker = null;
        let locationCircle = null;
        
        // Inisialisasi peta-peta
        const maps = {
            lembaga: L.map('map-lembaga').setView(defaultCoordinates, defaultZoom),
            sarpras: L.map('map-sarpras').setView(defaultCoordinates, defaultZoom),
            sdm: L.map('map-sdm').setView(defaultCoordinates, defaultZoom),
            opk: L.map('map-opk').setView(defaultCoordinates, defaultZoom)
        };
        
        // Konfigurasi warna marker untuk setiap jenis
        const markerColors = {
            lembaga: 'blue',
            sarpras: 'green',
            sdm: 'orange',
            opk: 'red'
        };
        
        // Tambahkan tile layer ke semua peta
        Object.values(maps).forEach(map => {
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        });
        
        // Tambahkan kontrol lokasi saat ini ke semua peta
        Object.entries(maps).forEach(([type, map]) => {
            const locationControl = L.control({position: 'topleft'});
            
            locationControl.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
                div.innerHTML = `<a href="#" title="Tampilkan lokasi saya" style="display:flex; align-items:center; justify-content:center; width:30px; height:30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>`;
                
                div.onclick = function() {
                    getLocation(type);
                    return false;
                };
                
                return div;
            };
            
            locationControl.addTo(map);
        });
        
        // Variabel untuk menyimpan referensi notifikasi
        let currentToast = null;
        
        // Fungsi untuk mendapatkan dan menampilkan lokasi pengguna saat ini
        function getLocation(mapType) {
            if (navigator.geolocation) {
                // Menampilkan indikator loading
                showToast('Mendapatkan lokasi Anda...', 'blue');
                
                // Menggunakan getCurrentPosition untuk mendapatkan lokasi satu kali
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Hapus loading toast
                        hideToast();
                        
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const accuracy = position.coords.accuracy;
                        
                        console.log("Lokasi ditemukan:", lat, lng, "Akurasi:", accuracy, "meter");
                        
                        // Jika akurasi lebih dari 50m, tampilkan notifikasi
                        if (accuracy > 50) {
                            showToast(`Lokasi kurang akurat (${Math.round(accuracy)}m).`, 'yellow', 5000);
                        }
                        
                        // Hapus marker lokasi sebelumnya jika ada di peta yang aktif
                        const map = maps[mapType];
                        
                        if (map.locationMarker) {
                            map.removeLayer(map.locationMarker);
                        }
                        
                        if (map.locationCircle) {
                            map.removeLayer(map.locationCircle);
                        }
                        
                        // Tambahkan marker lokasi saat ini dengan ikon khusus
                        const locationIcon = L.divIcon({
                            html: `<div style="background-color: #4285F4; width: 16px; height: 16px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.3);"></div>`,
                            className: 'location-marker',
                            iconSize: [22, 22],
                            iconAnchor: [11, 11]
                        });
                        
                        map.locationMarker = L.marker([lat, lng], {
                            icon: locationIcon,
                            zIndexOffset: 1000 // Pastikan marker lokasi di atas marker lainnya
                        }).addTo(map);
                        
                        // Tambahkan lingkaran yang menunjukkan akurasi
                        map.locationCircle = L.circle([lat, lng], {
                            radius: accuracy,
                            color: '#4285F4',
                            fillColor: '#4285F4',
                            fillOpacity: 0.2,
                            weight: 1
                        }).addTo(map);
                        
                        // Zoom ke lokasi dengan level zoom yang sesuai dengan akurasi
                        const zoomLevel = calculateZoomLevel(accuracy);
                        map.setView([lat, lng], zoomLevel);
                        
                        // Tambahkan popup yang menampilkan informasi lokasi
                        map.locationMarker.bindPopup(`
                            <strong>Lokasi Anda Saat Ini</strong><br>
                            Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}<br>
                            Akurasi: ${Math.round(accuracy)} meter
                        `).openPopup();
                        
                        // Tampilkan notifikasi sukses
                        showToast('Lokasi Anda berhasil ditampilkan!', 'green', 3000);
                    },
                    function(error) {
                        // Hapus loading toast
                        hideToast();
                        
                        // Tampilkan pesan error
                        let errorMessage = "Terjadi kesalahan saat mendapatkan lokasi Anda.";
                        
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage = "Akses lokasi ditolak. Harap izinkan akses lokasi di pengaturan browser Anda.";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage = "Informasi lokasi tidak tersedia.";
                                break;
                            case error.TIMEOUT:
                                errorMessage = "Waktu permintaan lokasi habis.";
                                break;
                        }
                        
                        console.error("Error lokasi:", error.code, error.message);
                        showToast(errorMessage, 'red', 5000);
                    },
                    {
                        enableHighAccuracy: true,  // Meminta akurasi tinggi (GPS)
                        timeout: 15000,            // Timeout lebih lama (15 detik)
                        maximumAge: 0              // Selalu minta posisi baru, jangan gunakan cache
                    }
                );
            } else {
                alert("Geolocation tidak didukung oleh browser Anda");
            }
        }
        
        // Fungsi untuk menampilkan toast notification
        function showToast(message, color, duration = 0) {
            // Hapus toast yang ada jika ada
            hideToast();
            
            // Buat toast baru
            currentToast = document.createElement('div');
            currentToast.className = `fixed top-4 right-4 bg-${color}-500 text-white p-3 rounded shadow-lg z-50`;
            currentToast.innerHTML = message;
            document.body.appendChild(currentToast);
            
            // Jika duration > 0, set timer untuk menghapus toast
            if (duration > 0) {
                setTimeout(hideToast, duration);
            }
        }
        
        // Fungsi untuk menghapus toast notification
        function hideToast() {
            if (currentToast && document.body.contains(currentToast)) {
                document.body.removeChild(currentToast);
                currentToast = null;
            }
        }
        
        // Fungsi untuk menghitung level zoom berdasarkan akurasi
        function calculateZoomLevel(accuracy) {
            if (accuracy <= 10) return 19;       // Sangat akurat (< 10m)
            else if (accuracy <= 50) return 18;  // Akurat (10-50m)
            else if (accuracy <= 100) return 17; // Cukup akurat (50-100m)
            else if (accuracy <= 500) return 16; // Kurang akurat (100-500m)
            else if (accuracy <= 1000) return 15; // Tidak akurat (500-1000m)
            else return 14;                      // Sangat tidak akurat (> 1000m)
        }
        
        // Fungsi untuk membuat konten popup untuk berbagai jenis data
        function createPopupContent(item, type) {
            let content = `<div style="width: 220px;"><div class="text-sm">`;
            
            switch(type) {
                case 'lembaga':
                    content += `
                        <a href="{{ route('wbtb.lembaga.show', '') }}/${item.id}" class="font-semibold">
                            ${item.nama_lembaga || 'Nama tidak tersedia'}
                        </a>
                        <div>
                            <strong>Kategori:</strong> ${item.kategori_lembaga || 'Tidak tersedia'}
                        </div>
                        <div>
                            <strong>Alamat:</strong> ${item.alamat || 'Tidak tersedia'}
                        </div>
                    `;
                    break;
                    
                case 'sarpras':
                    content += `
                        <a href="{{ route('wbtb.sarpras.show', '') }}/${item.id}" class="font-semibold">
                            ${item.nama_sarpras || 'Nama tidak tersedia'}
                        </a>
                        <div>
                            <strong>Status Kepemilikan:</strong> ${item.status_kepemilikan || 'Tidak tersedia'}
                        </div>
                        <div>
                            <strong>Alamat:</strong> ${item.alamat || 'Tidak tersedia'}
                        </div>
                    `;
                    break;
                    
                case 'sdm':
                    content += `
                        <a href="{{ route('wbtb.sdm.show', '') }}/${item.id}" class="font-semibold">
                            ${item.nama_lengkap || 'Nama tidak tersedia'}
                        </a>
                        <div>
                            <strong>Alamat:</strong> ${item.alamat || 'Tidak tersedia'}
                        </div>
                    `;
                    break;
                    
                case 'opk':
                    content += `
                        <a href="{{ route('wbtb.opk.show', '') }}/${item.id}" class="font-semibold">
                            ${item.nama_opk || 'Nama tidak tersedia'}
                        </a>
                        <div>
                            <strong>Jenis:</strong> ${item.jenis_opk || 'Tidak tersedia'}
                        </div>
                        <div>
                            <strong>Alamat:</strong> ${item.alamat || 'Tidak tersedia'}
                        </div>
                    `;
                    break;
            }
            
            content += `
                <div>
                    <strong>Koordinat:</strong> ${item.latitude.toFixed(6)}, ${item.longitude.toFixed(6)}
                </div>
            </div>
            <div class="mt-2 grid grid-cols-2 gap-2">
                <a href="https://www.google.com/maps/dir/?api=1&destination=${item.latitude},${item.longitude}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-2 rounded inline-flex items-center justify-center" style="color: white !important;">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    Rute
                </a>
                <button onclick="getDirectionsFromCurrentLocation(${item.latitude}, ${item.longitude}, '${(item.nama_lembaga || item.nama_sarpras || item.nama_lengkap || item.nama_opk || 'lokasi')}')" class="bg-green-500 hover:bg-green-600 text-white text-sm py-1 px-2 rounded inline-flex items-center justify-center" style="color: white !important;">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Dari Sini
                </button>
            </div>
            </div>`;
            
            return content;
        }
        
        // Fungsi untuk mendapatkan rute dari lokasi saat ini
        window.getDirectionsFromCurrentLocation = function(destLat, destLng, destName) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const originLat = position.coords.latitude;
                        const originLng = position.coords.longitude;
                        
                        // Buka Google Maps dengan rute dari lokasi saat ini
                        window.open(`https://www.google.com/maps/dir/${originLat},${originLng}/${destLat},${destLng}/${encodeURIComponent(destName)}`, '_blank');
                    },
                    function(error) {
                        alert("Tidak dapat mendapatkan lokasi Anda saat ini: " + error.message);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                alert("Geolocation tidak didukung oleh browser Anda");
            }
        };
        
        // Fungsi untuk memvalidasi dan menambahkan marker
        function addMarkers(data, type) {
            const map = maps[type];
            const markers = [];
            
            data.forEach(item => {
                // Validate coordinates before creating markers
                if (item.latitude && item.longitude) {
                    try {
                        // Convert to numbers if they're strings
                        const lat = parseFloat(item.latitude);
                        const lng = parseFloat(item.longitude);
                        
                        // Validate that coordinates are in reasonable range
                        if (!isNaN(lat) && !isNaN(lng) && 
                            lat >= -90 && lat <= 90 && 
                            lng >= -180 && lng <= 180) {
                            
                            // Create default marker with custom color
                            const marker = L.marker([lat, lng], {
                                icon: new L.Icon({
                                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-' + markerColors[type] + '.png',
                                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41],
                                    popupAnchor: [1, -34],
                                    shadowSize: [41, 41]
                                })
                            }).addTo(map);
                            
                            // Update the item with parsed coordinates
                            item.latitude = lat;
                            item.longitude = lng;
                            
                            // Create popup
                            const popupContent = createPopupContent(item, type);
                            marker.bindPopup(popupContent);
                            
                            // Add to markers array
                            markers.push(marker);
                        } else {
                            console.warn(`Invalid coordinate range for ${type} item ${item.id}: ${lat}, ${lng}`);
                        }
                    } catch (e) {
                        console.error(`Error processing coordinates for ${type} item ${item.id}:`, e);
                    }
                } else {
                    console.warn(`Missing coordinates for ${type} item ${item.id}`);
                }
            });
            
            // Jika ada marker, buat batas pandangan yang mencakup semua marker
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1)); // Padding 10%
            } else {
                console.warn(`No ${type} data with valid coordinates received`);
            }
            
            return markers;
        }
        
        // Load data untuk semua peta
        Promise.all([
            fetch('/api/wbtb/lembaga-coordinates').then(res => res.json()),
            fetch('/api/wbtb/sarpras-coordinates').then(res => res.json()),
            fetch('/api/wbtb/sdm-coordinates').then(res => res.json()),
            fetch('/api/wbtb/opk-coordinates').then(res => res.json())
        ]).then(([lembagaData, sarprasData, sdmData, opkData]) => {
            addMarkers(lembagaData, 'lembaga');
            addMarkers(sarprasData, 'sarpras');
            addMarkers(sdmData, 'sdm');
            addMarkers(opkData, 'opk');
        }).catch(error => {
            console.error("Error saat mengambil data:", error);
            showToast("Gagal memuat data lokasi", "red", 5000);
        });
    });
</script>
@endpush