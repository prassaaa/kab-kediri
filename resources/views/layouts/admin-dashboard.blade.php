<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Sistem Cagar Budaya</title>
    <link rel="icon" href="{{ asset('assets/img/kediri1.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar pada mobile disembunyikan secara default */
        @media (max-width: 1023px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                width: 80%; /* Lebar sidebar lebih kecil di mobile */
                z-index: 50;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
                transition: margin-left 0.3s ease-in-out;
            }
            /* Overlay saat sidebar terbuka */
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            .overlay.active {
                display: block;
            }
        }
        /* Pastikan sidebar tetap terlihat di desktop */
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
            .content {
                margin-left: 16rem; /* Sesuai dengan w-64 (256px) */
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Overlay untuk mobile -->
        <div class="overlay" id="overlay"></div>

        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-gray-800 transition-transform duration-300 transform lg:translate-x-0 sidebar">
            <div class="flex items-center justify-between h-16 sm:h-20 bg-gray-900 px-4">
                <div class="text-white text-lg sm:text-xl font-bold truncate">Sistem Cagar Budaya</div>
                <button id="sidebarClose" class="lg:hidden text-white hover:text-gray-300 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="mt-4 sm:mt-5 overflow-y-auto h-[calc(100vh-4rem)] sm:h-[calc(100vh-5rem)]">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 sm:px-6 py-2 mt-2 sm:mt-4 {{ request()->routeIs('dashboard') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <span class="mx-2 sm:mx-3 text-sm sm:text-base">Dashboard</span>
                </a>
                
                <a href="{{ route('cagar-budaya.index') }}" class="flex items-center px-4 sm:px-6 py-2 mt-2 sm:mt-4 {{ request()->routeIs('cagar-budaya.*') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span class="mx-2 sm:mx-3 text-sm sm:text-base">Data Cagar Budaya</span>
                </a>
                
                @if (Auth::user()->role == 'superadmin')
                    <a href="{{ route('admin.index') }}" class="flex items-center px-4 sm:px-6 py-2 mt-2 sm:mt-4 {{ request()->routeIs('admin.*') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="mx-2 sm:mx-3 text-sm sm:text-base">Admin</span>
                    </a>
                    
                    <a href="{{ route('user.index') }}" class="flex items-center px-4 sm:px-6 py-2 mt-2 sm:mt-4 {{ request()->routeIs('user.*') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="mx-2 sm:mx-3 text-sm sm:text-base">User</span>
                    </a>
                @endif
                
                @if (Auth::user()->role != 'user')
                    <a href="{{ route('notifikasi') }}" class="flex items-center px-4 sm:px-6 py-2 mt-2 sm:mt-4 {{ request()->routeIs('notifikasi') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="mx-2 sm:mx-3 text-sm sm:text-base">Notifikasi</span>
                    </a>
                @endif
                
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 sm:px-6 py-2 mt-2 sm:mt-4 {{ request()->routeIs('profile.*') ? 'text-white bg-gray-700' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="mx-2 sm:mx-3 text-sm sm:text-base">Profil</span>
                </a>
                
                <div class="mt-6 sm:mt-8 border-t border-gray-700 pt-4 px-4 sm:px-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-gray-300 hover:bg-gray-700 hover:text-white py-2 text-sm sm:text-base">
                            <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="mx-2 sm:mx-3">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 content lg:ml-64">
            <!-- Top Navigation -->
            <div class="bg-white shadow">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-4 sm:px-6 py-4 space-y-2 sm:space-y-0">
                    <div class="text-xl sm:text-2xl font-semibold truncate w-full sm:w-auto">
                        @yield('page-title', 'Dashboard')
                    </div>
                    <div class="flex items-center w-full sm:w-auto justify-between sm:justify-end">
                        <!-- Tombol untuk menyembunyikan/menampilkan sidebar -->
                        <button id="sidebarToggle" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div class="relative sm:ml-3">
                            <div class="flex items-center">
                                <span class="text-xs sm:text-sm bg-gray-200 px-2 sm:px-3 py-1 rounded-full">
                                    @if(Auth::user()->role == 'superadmin')
                                        Super Admin
                                    @elseif(Auth::user()->role == 'admin')
                                        Admin
                                    @else
                                        User
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-4 sm:p-6">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
                    <span class="block sm:inline text-sm sm:text-base">{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded relative" role="alert">
                    <span class="block sm:inline text-sm sm:text-base">{{ session('error') }}</span>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const overlay = document.getElementById('overlay');

            // Toggle sidebar dan overlay
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
            });

            // Tutup sidebar saat tombol close diklik
            sidebarClose.addEventListener('click', function () {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            });

            // Tutup sidebar saat overlay diklik
            overlay.addEventListener('click', function () {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>