@extends('layouts.admin-dashboard')

@section('page-title', 'Lokasi Cagar Budaya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Peta Lokasi Cagar Budaya</h2>
    <div id="map" class="w-full h-[40rem] rounded-lg border border-gray-300"></div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    let map = L.map('map').setView([-7.8031, 111.9914], 10); // Koordinat Kabupaten Kediri
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Menambahkan kontrol lokasi saat ini
    let locationMarker, locationCircle;
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
            getLocation();
            return false;
        };
        
        return div;
    };
    
    locationControl.addTo(map);
    
    // Variabel untuk menyimpan referensi notifikasi inaccurate
    let inaccurateToast = null;
    
    // Fungsi untuk mendapatkan dan menampilkan lokasi pengguna saat ini dengan akurasi maksimum
    function getLocation() {
        if (navigator.geolocation) {
            // Menampilkan indikator loading
            const loadingToast = document.createElement('div');
            loadingToast.className = 'fixed top-4 right-4 bg-blue-500 text-white p-3 rounded shadow-lg z-50';
            loadingToast.innerHTML = 'Mendapatkan lokasi Anda...';
            document.body.appendChild(loadingToast);
            
            // Menggunakan getCurrentPosition untuk mendapatkan lokasi satu kali
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    // Hapus loading toast
                    if (document.body.contains(loadingToast)) {
                        document.body.removeChild(loadingToast);
                    }
                    
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const accuracy = position.coords.accuracy;
                    
                    console.log("Lokasi ditemukan:", lat, lng, "Akurasi:", accuracy, "meter");
                    
                    // Jika akurasi lebih dari 50m, tampilkan notifikasi
                    if (accuracy > 50) {
                        const inaccurateToast = document.createElement('div');
                        inaccurateToast.className = 'fixed top-4 right-4 bg-yellow-500 text-white p-3 rounded shadow-lg z-50';
                        inaccurateToast.innerHTML = `Lokasi kurang akurat (${Math.round(accuracy)}m).`;
                        document.body.appendChild(inaccurateToast);
                        
                        // Hilangkan notifikasi setelah 5 detik
                        setTimeout(function() {
                            if (document.body.contains(inaccurateToast)) {
                                document.body.removeChild(inaccurateToast);
                            }
                        }, 5000);
                    }
                    
                    // Hapus marker lokasi sebelumnya jika ada
                    if (locationMarker) {
                        map.removeLayer(locationMarker);
                    }
                    
                    if (locationCircle) {
                        map.removeLayer(locationCircle);
                    }
                    
                    // Tambahkan marker lokasi saat ini dengan ikon khusus
                    const locationIcon = L.divIcon({
                        html: `<div style="background-color: #4285F4; width: 16px; height: 16px; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.3);"></div>`,
                        className: 'location-marker',
                        iconSize: [22, 22],
                        iconAnchor: [11, 11]
                    });
                    
                    locationMarker = L.marker([lat, lng], {
                        icon: locationIcon,
                        zIndexOffset: 1000 // Pastikan marker lokasi di atas marker lainnya
                    }).addTo(map);
                    
                    // Tambahkan lingkaran yang menunjukkan akurasi
                    locationCircle = L.circle([lat, lng], {
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
                    locationMarker.bindPopup(`
                        <strong>Lokasi Anda Saat Ini</strong><br>
                        Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}<br>
                        Akurasi: ${Math.round(accuracy)} meter
                    `).openPopup();
                    
                    // Tampilkan notifikasi sukses
                    const successToast = document.createElement('div');
                    successToast.className = 'fixed top-4 right-4 bg-green-500 text-white p-3 rounded shadow-lg z-50';
                    successToast.innerHTML = 'Lokasi Anda berhasil ditampilkan!';
                    document.body.appendChild(successToast);
                    
                    // Hilangkan notifikasi sukses setelah 3 detik
                    setTimeout(function() {
                        if (document.body.contains(successToast)) {
                            document.body.removeChild(successToast);
                        }
                    }, 3000);
                },
                function(error) {
                    // Hapus loading toast
                    if (document.body.contains(loadingToast)) {
                        document.body.removeChild(loadingToast);
                    }
                    
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
                    
                    const errorToast = document.createElement('div');
                    errorToast.className = 'fixed top-4 right-4 bg-red-500 text-white p-3 rounded shadow-lg z-50';
                    errorToast.innerHTML = errorMessage;
                    document.body.appendChild(errorToast);
                    
                    // Hilangkan notifikasi error setelah 5 detik
                    setTimeout(function() {
                        if (document.body.contains(errorToast)) {
                            document.body.removeChild(errorToast);
                        }
                    }, 5000);
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
    
    // Fungsi untuk menghitung level zoom berdasarkan akurasi
    function calculateZoomLevel(accuracy) {
        if (accuracy <= 10) return 19;       // Sangat akurat (< 10m)
        else if (accuracy <= 50) return 18;  // Akurat (10-50m)
        else if (accuracy <= 100) return 17; // Cukup akurat (50-100m)
        else if (accuracy <= 500) return 16; // Kurang akurat (100-500m)
        else if (accuracy <= 1000) return 15; // Tidak akurat (500-1000m)
        else return 14;                      // Sangat tidak akurat (> 1000m)
    }
    
    // Warna berdasarkan kategori cagar budaya (sesuai dengan warna marker Leaflet yang tersedia)
    const categoryColors = {
        'Benda': 'red',          // Merah
        'Bangunan': 'blue',      // Biru
        'Struktur': 'green',     // Hijau
        'Situs': 'violet',       // Ungu
        'Kawasan': 'orange',     // Oranye
        'default': 'blue'        // Biru (warna default)
    };
    
    // Fungsi untuk mendapatkan warna berdasarkan kategori
    function getCategoryColor(category) {
        return categoryColors[category] || categoryColors.default;
    }
    
    // Menambahkan legenda kategori
    const legend = L.control({position: 'bottomright'});
    
    legend.onAdd = function(map) {
        const div = L.DomUtil.create('div', 'info legend');
        div.style.backgroundColor = 'white';
        div.style.padding = '10px';
        div.style.borderRadius = '5px';
        div.style.boxShadow = '0 0 5px rgba(0,0,0,0.2)';
        
        let labels = ['<strong>Kategori Cagar Budaya</strong>'];
        
        // Menambahkan entry untuk setiap kategori
        Object.entries(categoryColors).forEach(([category, color]) => {
            if (category !== 'default') {
                labels.push(
                    `<div class="legend-item" style="margin-top: 5px;">
                        <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png" 
                             style="width: 12px; display: inline-block; margin-right: 5px;">
                        <span>${category}</span>
                    </div>`
                );
            }
        });
        
        div.innerHTML = labels.join('<br>');
        return div;
    };
    
    legend.addTo(map);
    
    // Fungsi untuk membuat konten popup
    function createPopupContent(item) {
        const baseContent = `
            <div style="width: 220px;">
                <div id="img-container-${item.id}" class="mt-2 mb-2">
                    <div class="text-center py-2">
                        <span class="text-xs text-gray-500">Memuat gambar...</span>
                    </div>
                </div>
                <div class="text-sm">
                    <a href="/cagar-budaya/${item.id || '#'}" class="font-semibold" aria-label="Lihat detail ${item.objek_cagar_budaya || 'cagar budaya'}">
                        ${item.objek_cagar_budaya || 'Tidak ada nama'}
                    </a>
                    <div>
                        <strong>Predikat:</strong> ${item.predikat || 'Tidak tersedia'}
                    </div>
                    <div>
                        <strong>Kategori:</strong> ${item.kategori || 'Tidak tersedia'}
                    </div>
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
                    <button onclick="getDirectionsFromCurrentLocation(${item.latitude}, ${item.longitude}, '${item.objek_cagar_budaya || 'cagar budaya'}')" class="bg-green-500 hover:bg-green-600 text-white text-sm py-1 px-2 rounded inline-flex items-center justify-center" style="color: white !important;">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Dari Sini
                    </button>
                </div>
            </div>
        `;
        return baseContent;
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
    
    // Fungsi untuk load gambar dan menampilkan di popup
    function loadImage(item, popupContent) {
        fetch(`/api/cagar-budaya-image/${item.id}`)
            .then(response => response.json())
            .then(imageData => {
                const imageUrl = imageData.image_url || '/images/default-placeholder.jpg';
                const imgContainer = document.getElementById(`img-container-${item.id}`);
                
                if (imgContainer) {
                    // Tes dulu apakah gambar bisa diload
                    const testImg = new Image();
                    testImg.onload = function() {
                        // Gambar berhasil diload, tampilkan
                        imgContainer.innerHTML = `<img src="${imageUrl}" alt="${item.objek_cagar_budaya}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;">`;
                    };
                    testImg.onerror = function() {
                        // Gambar gagal diload, tampilkan placeholder
                        console.warn(`Gambar gagal diload: ${imageUrl}`);
                        imgContainer.innerHTML = `
                            <img src="/images/default-placeholder.jpg" alt="${item.objek_cagar_budaya}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;">
                        `;
                    };
                    testImg.src = imageUrl;
                }
            })
            .catch(error => {
                console.warn("Error saat memuat gambar:", error);
                const imgContainer = document.getElementById(`img-container-${item.id}`);
                if (imgContainer) {
                    imgContainer.innerHTML = `
                        <img src="/images/default-placeholder.jpg" alt="${item.objek_cagar_budaya}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;">
                    `;
                }
            });
    }
    
    // Tambahkan tombol filter berdasarkan kategori
    const filterControl = L.control({position: 'topright'});
    
    filterControl.onAdd = function(map) {
        const div = L.DomUtil.create('div', 'leaflet-control filter-control');
        div.style.backgroundColor = 'white';
        div.style.padding = '10px';
        div.style.borderRadius = '5px';
        div.style.boxShadow = '0 0 5px rgba(0,0,0,0.2)';
        div.style.marginRight = '10px';
        
        let html = '<div><strong>Filter Kategori</strong></div>';
        
        // Tambahkan opsi "Semua"
        html += `
            <div class="mt-2">
                <label class="flex items-center">
                    <input type="radio" name="category-filter" value="all" checked class="mr-2">
                    <span>Semua</span>
                </label>
            </div>
        `;
        
        // Tambahkan opsi untuk setiap kategori
        Object.entries(categoryColors).forEach(([category, color]) => {
            if (category !== 'default') {
                html += `
                    <div class="mt-1">
                        <label class="flex items-center">
                            <input type="radio" name="category-filter" value="${category}" class="mr-2">
                            <span>${category}</span>
                        </label>
                    </div>
                `;
            }
        });
        
        div.innerHTML = html;
        
        // Stop propagation of click events to prevent map interactions when clicking the control
        L.DomEvent.disableClickPropagation(div);
        
        return div;
    };
    
    filterControl.addTo(map);
    
    // Tambahkan array untuk menyimpan semua marker
    const allMarkers = [];
    
    // Fetch data dari API dan tampilkan di peta
    fetch('/api/cagar-budaya-coordinates')
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
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
                            
                            // Get the color based on the category
                            const category = item.kategori || 'default';
                            const markerColor = getCategoryColor(category);
                            
                            // Create default marker with custom color
                            const marker = L.marker([lat, lng], {
                                icon: new L.Icon({
                                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-' + markerColor + '.png',
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
                            const popupContent = createPopupContent(item);
                            const popup = marker.bindPopup(popupContent);
                            
                            // Load image when popup is opened
                            marker.on('popupopen', function() {
                                loadImage(item, popup);
                            });
                            
                            // Add category data to marker for filtering
                            marker.category = category;
                            
                            // Add to allMarkers array
                            allMarkers.push(marker);
                        } else {
                            console.warn(`Invalid coordinate range for item ${item.id}: ${lat}, ${lng}`);
                        }
                    } catch (e) {
                        console.error(`Error processing coordinates for item ${item.id}:`, e);
                    }
                } else {
                    console.warn(`Missing coordinates for item ${item.id}`);
                }
            });
            
            // Configure filter event handlers
            const filterInputs = document.querySelectorAll('input[name="category-filter"]');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const selectedCategory = this.value;
                    
                    allMarkers.forEach(marker => {
                        if (selectedCategory === 'all' || marker.category === selectedCategory) {
                            if (!map.hasLayer(marker)) {
                                map.addLayer(marker);
                            }
                        } else {
                            if (map.hasLayer(marker)) {
                                map.removeLayer(marker);
                            }
                        }
                    });
                });
            });
            
        } else {
            console.warn("No cultural heritage data received");
        }
    })
    .catch(error => {
        console.error("Error saat mengambil data cagar budaya:", error);
    });
});
</script>
@endpush