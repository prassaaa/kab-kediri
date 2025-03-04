<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Cagar Budaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="mb-6 flex justify-between items-center">
                        @if (Auth::user()->role != 'user')
                            <a href="{{ route('cagar-budaya.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Tambah Data Cagar Budaya
                            </a>
                        @else
                            <div></div>
                        @endif
                        
                        <div class="flex">
                            <form action="{{ route('cagar-budaya.index') }}" method="GET" class="flex space-x-2">
                                <select name="kategori" class="rounded-md border-gray-300 shadow-sm">
                                    <option value="">Semua Kategori</option>
                                    <option value="Benda" {{ request('kategori') == 'Benda' ? 'selected' : '' }}>Benda</option>
                                    <option value="Bangunan" {{ request('kategori') == 'Bangunan' ? 'selected' : '' }}>Bangunan</option>
                                    <option value="Struktur" {{ request('kategori') == 'Struktur' ? 'selected' : '' }}>Struktur</option>
                                    <option value="Situs" {{ request('kategori') == 'Situs' ? 'selected' : '' }}>Situs</option>
                                    <option value="Kawasan" {{ request('kategori') == 'Kawasan' ? 'selected' : '' }}>Kawasan</option>
                                </select>
                                
                                @if (Auth::user()->role != 'user')
                                    <select name="status" class="rounded-md border-gray-300 shadow-sm">
                                        <option value="">Semua Status</option>
                                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                        <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Belum Terverifikasi</option>
                                    </select>
                                @endif
                                
                                <select name="kecamatan" class="rounded-md border-gray-300 shadow-sm">
                                    <option value="">Semua Kecamatan</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan }}" {{ request('kecamatan') == $kecamatan ? 'selected' : '' }}>
                                            {{ $kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Filter
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Objek Cagar Budaya
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
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                            {{ $cagarBudaya->objek_cagar_budaya }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-300">
                                            {{ $cagarBudaya->kategori }}
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
                                            <a href="{{ route('cagar-budaya.show', $cagarBudaya) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                                Detail
                                            </a>
                                            
                                            @if (Auth::user()->role != 'user')
                                                @if ((Auth::user()->role == 'admin' && !$cagarBudaya->is_verified) || Auth::user()->role == 'superadmin')
                                                    <a href="{{ route('cagar-budaya.edit', $cagarBudaya) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                                        Edit
                                                    </a>
                                                @endif
                                                
                                                @if (Auth::user()->role == 'superadmin')
                                                    @if (!$cagarBudaya->is_verified)
                                                        <form action="{{ route('cagar-budaya.verify', $cagarBudaya) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-2" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                                                                Verifikasi
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    <form action="{{ route('cagar-budaya.destroy', $cagarBudaya) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap border-b border-gray-300 text-center">
                                            Tidak ada data cagar budaya.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $cagarBudayas->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>