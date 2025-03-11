@extends('layouts.admin-dashboard')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Total Cagar Budaya</p>
                <p class="text-gray-800 text-2xl font-semibold">{{ $data['total_cagar_budaya'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('cagar-budaya.index') }}" class="text-blue-500 hover:underline text-sm flex items-center justify-end">
                Lihat Semua <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
    
    @if (Auth::user()->role != 'user')
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Terverifikasi</p>
                    <p class="text-gray-800 text-2xl font-semibold">{{ $data['verified_cagar_budaya'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('cagar-budaya.index', ['status' => 'verified']) }}" class="text-green-500 hover:underline text-sm flex items-center justify-end">
                    Lihat Semua <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Belum Terverifikasi</p>
                    <p class="text-gray-800 text-2xl font-semibold">{{ $data['unverified_cagar_budaya'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('cagar-budaya.index', ['status' => 'unverified']) }}" class="text-yellow-500 hover:underline text-sm flex items-center justify-end">
                    Lihat Semua <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    @endif
    
    @if (Auth::user()->role == 'superadmin')
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total Admin</p>
                    <p class="text-gray-800 text-2xl font-semibold">{{ $data['total_admin'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.index') }}" class="text-purple-500 hover:underline text-sm flex items-center justify-end">
                    Kelola Admin <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-500 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total User</p>
                    <p class="text-gray-800 text-2xl font-semibold">{{ $data['total_user'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('user.index') }}" class="text-indigo-500 hover:underline text-sm flex items-center justify-end">
                    Kelola User <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Bagian chart hanya untuk non-user -->
@if (Auth::user()->role != 'user')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- Grafik predikat -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Perbandingan Predikat</h2>
            <div style="position: relative; height:300px; width:100%">
                <canvas id="predikatChart"></canvas>
            </div>
        </div>
        
        <!-- Grafik kecamatan (ganti dari verifikasi) -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Distribusi Berdasarkan Kecamatan</h2>
            <div style="position: relative; height:300px; width:100%">
                <canvas id="kecamatanChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik kategori -->
    <div class="mt-6">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Distribusi Berdasarkan Kategori</h2>
            <div style="position: relative; height:300px; width:100%">
                <canvas id="kategoriChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Peta -->
    <div class="mt-8 bg-white overflow-hidden shadow-sm rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Peta Lokasi Cagar Budaya</h2>
        <div id="map" class="w-full h-[34rem] rounded-lg border border-gray-300"></div>
    </div>
@endif
@endsection

@push('scripts')
@if (Auth::user()->role != 'user')
    <!-- Tambahkan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk grafik
            const predikatData = {
                labels: ['Cagar Budaya', 'Objek diduga cagar budaya'],
                datasets: [{
                    data: [{{ $data['cagar_budaya_count'] ?? 0 }}, {{ $data['objek_diduga_count'] ?? 0 }}],
                    backgroundColor: ['rgba(52, 152, 219, 0.7)', 'rgba(243, 156, 18, 0.7)'],
                    borderColor: ['rgba(52, 152, 219, 1)', 'rgba(243, 156, 18, 1)'],
                    borderWidth: 1
                }]
            };
            
            // Data kecamatan (ganti dari verifikasi)
            const kecamatanData = {
                labels: [
                    @foreach($data['kecamatan_distribution'] as $kecamatan => $count)
                        '{{ $kecamatan }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Cagar Budaya',
                    data: [
                        @foreach($data['kecamatan_distribution'] as $count)
                            {{ $count }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(52, 152, 219, 0.7)',
                        'rgba(155, 89, 182, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(241, 196, 15, 0.7)',
                        'rgba(231, 76, 60, 0.7)',
                        'rgba(52, 73, 94, 0.7)',
                        'rgba(26, 188, 156, 0.7)',
                        'rgba(230, 126, 34, 0.7)',
                        'rgba(149, 165, 166, 0.7)',
                        'rgba(41, 128, 185, 0.7)'
                    ],
                    borderColor: [
                        'rgba(52, 152, 219, 1)',
                        'rgba(155, 89, 182, 1)',
                        'rgba(46, 204, 113, 1)',
                        'rgba(241, 196, 15, 1)',
                        'rgba(231, 76, 60, 1)',
                        'rgba(52, 73, 94, 1)',
                        'rgba(26, 188, 156, 1)',
                        'rgba(230, 126, 34, 1)',
                        'rgba(149, 165, 166, 1)',
                        'rgba(41, 128, 185, 1)'
                    ],
                    borderWidth: 1
                }]
            };
            
            const kategoriData = {
                labels: ['Benda', 'Bangunan', 'Struktur', 'Situs', 'Kawasan'],
                datasets: [{
                    label: 'Jumlah',
                    data: [
                        {{ $data['kategori_distribution']['Benda'] ?? 0 }}, 
                        {{ $data['kategori_distribution']['Bangunan'] ?? 0 }}, 
                        {{ $data['kategori_distribution']['Struktur'] ?? 0 }}, 
                        {{ $data['kategori_distribution']['Situs'] ?? 0 }}, 
                        {{ $data['kategori_distribution']['Kawasan'] ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(52, 152, 219, 0.7)',
                        'rgba(155, 89, 182, 0.7)',
                        'rgba(46, 204, 113, 0.7)',
                        'rgba(241, 196, 15, 0.7)',
                        'rgba(231, 76, 60, 0.7)'
                    ],
                    borderWidth: 1
                }]
            };
            
            // Opsi umum untuk grafik pie/doughnut
            const pieOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            };
            
            // Opsi untuk grafik bar
            const barOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            };
            
            // Opsi untuk grafik kecamatan (horizontal bar)
            const kecamatanOptions = {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',  // Membuat bar horizontal
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            };
            
            // Buat grafik
            new Chart(document.getElementById('predikatChart'), {
                type: 'doughnut',
                data: predikatData,
                options: pieOptions
            });
            
            new Chart(document.getElementById('kecamatanChart'), {
                type: 'bar',
                data: kecamatanData,
                options: kecamatanOptions
            });
            
            new Chart(document.getElementById('kategoriChart'), {
                type: 'bar',
                data: kategoriData,
                options: barOptions
            });
        });
    </script>

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
    
    fetch('/api/cagar-budaya-coordinates')
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            // Prepare array to hold valid coordinates
            const validMarkers = [];
            
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
                                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-' + markerColor.replace('#', '') + '.png',
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
                            
                            validMarkers.push({
                                lat: lat,
                                lng: lng
                            });
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
            
        } else {
            console.warn("No cultural heritage data received");
        }
    })
    .catch(error => {
        console.error("Error saat mengambil data cagar budaya:", error);
    });
});
</script>
@endif
@endpush