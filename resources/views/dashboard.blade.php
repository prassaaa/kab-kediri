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
        
        <!-- Grafik verifikasi -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Distribusi Berdasarkan Verifikasi</h2>
            <div style="position: relative; height:300px; width:100%">
                <canvas id="verifikasiChart"></canvas>
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
            
            const verifikasiData = {
                labels: ['Terverifikasi', 'Belum Terverifikasi'],
                datasets: [{
                    data: [{{ $data['verified_cagar_budaya'] ?? 0 }}, {{ $data['unverified_cagar_budaya'] ?? 0 }}],
                    backgroundColor: ['rgba(46, 204, 113, 0.7)', 'rgba(231, 76, 60, 0.7)'],
                    borderColor: ['rgba(46, 204, 113, 1)', 'rgba(231, 76, 60, 1)'],
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
            
            // Buat grafik
            new Chart(document.getElementById('predikatChart'), {
                type: 'doughnut',
                data: predikatData,
                options: pieOptions
            });
            
            new Chart(document.getElementById('verifikasiChart'), {
                type: 'doughnut',
                data: verifikasiData,
                options: pieOptions
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
    
    // Fungsi untuk membuat konten popup
    function createPopupContent(item) {
        const baseContent = `
            <div style="width: 220px;">
                <a href="/cagar-budaya/${item.id}" class="font-semibold">${item.objek_cagar_budaya}</a>
                <div id="img-container-${item.id}" class="mt-2 mb-2">
                    <div class="text-center py-2">
                        <span class="text-xs text-gray-500">Memuat gambar...</span>
                    </div>
                </div>
                <div class="text-sm">
                    <strong>Predikat:</strong> ${item.predikat}<br>
                    <strong>Kategori:</strong> ${item.kategori}
                </div>
                <div class="mt-2">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${item.latitude},${item.longitude}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-2 rounded inline-flex items-center" style="color: white !important;">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Rute Google Maps
                    </a>
                </div>
            </div>
        `;
        return baseContent;
    }
    
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
            data.forEach(item => {
                if (item.latitude && item.longitude) {
                    const marker = L.marker([item.latitude, item.longitude]).addTo(map);
                    
                    // Buat popup dengan konten dasar
                    const popupContent = createPopupContent(item);
                    
                    // Tambahkan popup ke marker
                    const popup = marker.bindPopup(popupContent);
                    
                    // Muat gambar saat popup dibuka
                    marker.on('popupopen', function() {
                        loadImage(item, popup);
                    });
                }
            });
        })
        .catch(error => {
            console.error("Error saat mengambil data cagar budaya:", error);
        });
});
    </script>
@endif
@endpush