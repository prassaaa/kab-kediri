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

@if (Auth::user()->role != 'user')
    <div class="mt-8 bg-white overflow-hidden shadow-sm rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Peta Lokasi Cagar Budaya</h2>
        <div id="map" class="w-full h-96 rounded-lg border border-gray-300"></div>
    </div>
@endif
@endsection

@if (Auth::user()->role != 'user')
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map = L.map('map').setView([-7.8031, 111.9914], 10); // Koordinat Kabupaten Kediri
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
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