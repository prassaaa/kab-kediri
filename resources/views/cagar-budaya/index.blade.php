@extends('layouts.admin-dashboard')

@section('page-title', 'Data Cagar Budaya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-4 sm:p-6">
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div class="flex flex-col space-y-2 w-full sm:w-auto">
                @if (Auth::user()->role != 'user')
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                        <a href="{{ route('cagar-budaya.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Data
                        </a>
                        
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                        <a href="{{ route('cagar-budaya.import-form') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Import Data
                        </a>
                    @endif
                    </div>
                @endif
                
                @if (Auth::user()->role == 'superadmin')
                <form action="{{ route('cagar-budaya.export.kecamatan') }}" method="GET" class="w-full sm:w-auto">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Export PDF
                    </button>
                    <input type="hidden" name="kecamatan" value="{{ request('kecamatan') }}">
                </form>
                @endif
            </div>
            
            <div class="flex flex-col w-full sm:w-auto space-y-4">
                <!-- Form Filter -->
                <form action="{{ route('cagar-budaya.index') }}" method="GET" class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full">
                    <select name="kategori" class="rounded-md border-gray-300 shadow-sm text-sm sm:text-base">
                        <option value="">Semua Kategori</option>
                        <option value="Benda" {{ request('kategori') == 'Benda' ? 'selected' : '' }}>Benda</option>
                        <option value="Bangunan" {{ request('kategori') == 'Bangunan' ? 'selected' : '' }}>Bangunan</option>
                        <option value="Struktur" {{ request('kategori') == 'Struktur' ? 'selected' : '' }}>Struktur</option>
                        <option value="Situs" {{ request('kategori') == 'Situs' ? 'selected' : '' }}>Situs</option>
                        <option value="Kawasan" {{ request('kategori') == 'Kawasan' ? 'selected' : '' }}>Kawasan</option>
                    </select>
                    
                    @if (Auth::user()->role != 'user')
                        <select name="status" class="rounded-md border-gray-300 shadow-sm text-sm sm:text-base">
                            <option value="">Semua Status</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Belum Terverifikasi</option>
                        </select>
                    @endif
                    
                    <select name="kecamatan" class="rounded-md border-gray-300 shadow-sm text-sm sm:text-base">
                        <option value="">Semua Kecamatan</option>
                        @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan }}" {{ request('kecamatan') == $kecamatan ? 'selected' : '' }}>
                                {{ $kecamatan }}
                            </option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm sm:text-base">
                        Filter
                    </button>
                </form>

                <!-- Form Pencarian -->
                <form action="{{ route('cagar-budaya.index') }}" method="GET" class="w-full sm:w-auto">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari objek cagar budaya..." 
                               class="rounded-md border-gray-300 shadow-sm text-sm sm:text-base pl-10 pr-3 py-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                    </div>
                    <!-- Menyimpan filter lain -->
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="kecamatan" value="{{ request('kecamatan') }}">
                </form>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <!-- Desktop Table -->
            <div class="hidden sm:block">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Objek Cagar Budaya
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Predikat
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Lokasi
                            </th>
                            @if (Auth::user()->role != 'user')
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                            @endif
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cagarBudayas as $cagarBudaya)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                    {{ $cagarBudaya->objek_cagar_budaya }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if ($cagarBudaya->predikat == 'Cagar Budaya') bg-green-100 text-green-800
                                        @else bg-orange-100 text-orange-800
                                        @endif">
                                        {{ $cagarBudaya->predikat }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if ($cagarBudaya->kategori == 'Benda') bg-blue-100 text-blue-800
                                        @elseif ($cagarBudaya->kategori == 'Bangunan') bg-purple-100 text-purple-800
                                        @elseif ($cagarBudaya->kategori == 'Struktur') bg-green-100 text-green-800
                                        @elseif ($cagarBudaya->kategori == 'Situs') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $cagarBudaya->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                    {{ $cagarBudaya->lokasi_kecamatan }}
                                </td>
                                @if (Auth::user()->role != 'user')
                                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                        @if ($cagarBudaya->is_verified)
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                Belum Terverifikasi
                                            </span>
                                        @endif
                                    </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('cagar-budaya.show', $cagarBudaya->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        @if (Auth::user()->role != 'user')
                                            @if ((Auth::user()->role == 'admin' && !$cagarBudaya->is_verified) || Auth::user()->role == 'superadmin')
                                                <a href="{{ route('cagar-budaya.edit', $cagarBudaya->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if (Auth::user()->role == 'superadmin')
                                                @if (!$cagarBudaya->is_verified)
                                                    <form action="{{ route('cagar-budaya.verify', $cagarBudaya->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('cagar-budaya.destroy', $cagarBudaya->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role != 'user' ? 5 : 4 }}" class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-center">
                                    Tidak ada data cagar budaya.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block sm:hidden space-y-4">
                @forelse ($cagarBudayas as $cagarBudaya)
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                        <div class="grid grid-cols-1 gap-2">
                            <div>
                                <span class="text-xs text-gray-600 uppercase">Objek</span>
                                <p class="text-sm">{{ $cagarBudaya->objek_cagar_budaya }}</p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 uppercase">Kategori</span>
                                <p class="text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if ($cagarBudaya->kategori == 'Benda') bg-blue-100 text-blue-800
                                        @elseif ($cagarBudaya->kategori == 'Bangunan') bg-purple-100 text-purple-800
                                        @elseif ($cagarBudaya->kategori == 'Struktur') bg-green-100 text-green-800
                                        @elseif ($cagarBudaya->kategori == 'Situs') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $cagarBudaya->kategori }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600 uppercase">Lokasi</span>
                                <p class="text-sm">{{ $cagarBudaya->lokasi_kecamatan }}</p>
                            </div>
                            @if (Auth::user()->role != 'user')
                                <div>
                                    <span class="text-xs text-gray-600 uppercase">Status</span>
                                    <p class="text-sm">
                                        @if ($cagarBudaya->is_verified)
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                                Belum Terverifikasi
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            @endif
                            <div>
                                <span class="text-xs text-gray-600 uppercase">Aksi</span>
                                <div class="flex space-x-2 mt-1">
                                    <a href="{{ route('cagar-budaya.show', $cagarBudaya->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    @if (Auth::user()->role != 'user')
                                        @if ((Auth::user()->role == 'admin' && !$cagarBudaya->is_verified) || Auth::user()->role == 'superadmin')
                                            <a href="{{ route('cagar-budaya.edit', $cagarBudaya->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if (Auth::user()->role == 'superadmin')
                                            @if (!$cagarBudaya->is_verified)
                                                <form action="{{ route('cagar-budaya.verify', $cagarBudaya->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('cagar-budaya.destroy', $cagarBudaya->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Tidak ada data cagar budaya.
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="mt-4">
            {{ $cagarBudayas->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection