<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg shadow">
                            <h4 class="text-lg font-medium text-blue-700 mb-2">Total Cagar Budaya</h4>
                            <p class="text-3xl font-bold">{{ $data['total_cagar_budaya'] }}</p>
                            <a href="{{ route('cagar-budaya.index') }}" class="text-blue-600 text-sm hover:underline mt-2 inline-block">
                                Lihat Semua →
                            </a>
                        </div>
                        
                        @if (Auth::user()->role != 'user')
                            <div class="bg-green-50 p-6 rounded-lg shadow">
                                <h4 class="text-lg font-medium text-green-700 mb-2">Terverifikasi</h4>
                                <p class="text-3xl font-bold">{{ $data['verified_cagar_budaya'] }}</p>
                                <a href="{{ route('cagar-budaya.index', ['status' => 'verified']) }}" class="text-green-600 text-sm hover:underline mt-2 inline-block">
                                    Lihat Data →
                                </a>
                            </div>
                            
                            <div class="bg-yellow-50 p-6 rounded-lg shadow">
                                <h4 class="text-lg font-medium text-yellow-700 mb-2">Belum Terverifikasi</h4>
                                <p class="text-3xl font-bold">{{ $data['unverified_cagar_budaya'] }}</p>
                                <a href="{{ route('cagar-budaya.index', ['status' => 'unverified']) }}" class="text-yellow-600 text-sm hover:underline mt-2 inline-block">
                                    Lihat Data →
                                </a>
                            </div>
                        @endif
                        
                        @if (Auth::user()->role == 'superadmin')
                            <div class="bg-purple-50 p-6 rounded-lg shadow">
                                <h4 class="text-lg font-medium text-purple-700 mb-2">Total Admin</h4>
                                <p class="text-3xl font-bold">{{ $data['total_admin'] }}</p>
                                <a href="{{ route('admin.index') }}" class="text-purple-600 text-sm hover:underline mt-2 inline-block">
                                    Kelola Admin →
                                </a>
                            </div>
                            
                            <div class="bg-indigo-50 p-6 rounded-lg shadow">
                                <h4 class="text-lg font-medium text-indigo-700 mb-2">Total User</h4>
                                <p class="text-3xl font-bold">{{ $data['total_user'] }}</p>
                                <a href="{{ route('user.index') }}" class="text-indigo-600 text-sm hover:underline mt-2 inline-block">
                                    Kelola User →
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    @if (!Auth::user()->role != 'user')
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Peta Lokasi Cagar Budaya</h3>
                            <div id="map" class="w-full h-96 rounded-lg border border-gray-300"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @if (!Auth::user()->role != 'user')
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the map
                let map = L.map('map').setView([-7.8031, 111.9914], 10); // Koordinat Kabupaten Kediri
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Fetch cagar budaya data with coordinates
                fetch('/api/cagar-budaya-coordinates')
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            if (item.latitude && item.longitude) {
                                L.marker([item.latitude, item.longitude])
                                    .addTo(map)
                                    .bindPopup(`<a href="/cagar-budaya/${item.id}">${item.objek_cagar_budaya}</a><br>${item.kategori}`);
                            }
                        });
                    });
            });
        </script>
        @endpush
    @endif
</x-app-layout>