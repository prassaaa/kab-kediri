@extends('layouts.admin-dashboard')

@section('page-title', 'Detail Cagar Budaya')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-4 sm:p-6">
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <a href="{{ route('cagar-budaya.index') }}" 
               class="text-blue-600 hover:text-blue-900 flex items-center text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            @if (Auth::user()->role != 'user')
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                    @if ((Auth::user()->role == 'admin' && !$cagarBudaya->is_verified) || Auth::user()->role == 'superadmin')
                        <a href="{{ route('cagar-budaya.edit', $cagarBudaya->id) }}" 
                           class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center text-sm sm:text-base w-full sm:w-36 justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Data
                        </a>
                    @endif
                    
                    @if (Auth::user()->role == 'superadmin')
                        @if (!$cagarBudaya->is_verified)
                            <form action="{{ route('cagar-budaya.verify', $cagarBudaya->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center text-sm sm:text-base w-full sm:w-36 justify-center" 
                                        onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Verifikasi Data
                                </button>
                            </form>
                        @endif
                        
                        <form action="{{ route('cagar-budaya.destroy', $cagarBudaya->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center text-sm sm:text-base w-full sm:w-36 justify-center" 
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus Data
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Informasi Umum</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Objek Cagar Budaya:</span>
                            <span>{{ $cagarBudaya->objek_cagar_budaya }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Kategori:</span>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if ($cagarBudaya->kategori == 'Benda') bg-blue-100 text-blue-800
                                @elseif ($cagarBudaya->kategori == 'Bangunan') bg-purple-100 text-purple-800
                                @elseif ($cagarBudaya->kategori == 'Struktur') bg-green-100 text-green-800
                                @elseif ($cagarBudaya->kategori == 'Situs') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $cagarBudaya->kategori }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Bahan:</span>
                            <span>{{ $cagarBudaya->bahan ?: 'Tidak ada data' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Status:</span>
                            @if ($cagarBudaya->is_verified)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    Terverifikasi pada {{ $cagarBudaya->verified_at instanceof \DateTime ? $cagarBudaya->verified_at->format('d/m/Y H:i') : $cagarBudaya->verified_at }}
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    Belum Terverifikasi
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Lokasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Jalan/Dukuhan:</span>
                            <span>{{ $cagarBudaya->lokasi_jalan_dukuhan ?: 'Tidak ada data' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Dusun:</span>
                            <span>{{ $cagarBudaya->lokasi_dusun ?: 'Tidak ada data' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Desa:</span>
                            <span>{{ $cagarBudaya->lokasi_desa }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">Kecamatan:</span>
                            <span>{{ $cagarBudaya->lokasi_kecamatan }}</span>
                        </div>
                        @if ($cagarBudaya->longitude && $cagarBudaya->latitude)
                            <div class="mb-3">
                                <span class="font-semibold">Koordinat:</span>
                                <span>{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}</span>
                            </div>
                            <div class="mt-4">
                                <div id="map" class="h-48 sm:h-64 rounded-lg border border-gray-300"></div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Nomor Registrasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">No. Reg BPK Lama:</span>
                            <span>{{ $cagarBudaya->no_reg_bpk_lama ?: 'Tidak ada data' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">No. Reg BPK Baru:</span>
                            <span>{{ $cagarBudaya->no_reg_bpk_baru ?: 'Tidak ada data' }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="font-semibold">No. Reg Disparbud:</span>
                            <span>
                                @if ($cagarBudaya->no_reg_disparbud_nomor_urut || $cagarBudaya->no_reg_disparbud_kode_kecamatan || $cagarBudaya->no_reg_disparbud_kode_kabupaten || $cagarBudaya->no_reg_disparbud_tahun)
                                    {{ $cagarBudaya->no_reg_disparbud_nomor_urut }}/{{ $cagarBudaya->no_reg_disparbud_kode_kecamatan }}/{{ $cagarBudaya->no_reg_disparbud_kode_kabupaten }}/{{ $cagarBudaya->no_reg_disparbud_tahun }}
                                @else
                                    Tidak ada data
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Gambar</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if ($cagarBudaya->gambar)
                            <img src="{{ Storage::url($cagarBudaya->gambar) }}" 
                                 alt="{{ $cagarBudaya->objek_cagar_budaya }}" 
                                 class="w-full h-auto rounded-lg">
                        @else
                            <div class="text-center p-6 bg-gray-100 rounded-lg">
                                <p>Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Deskripsi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="whitespace-pre-line text-sm sm:text-base">{{ $cagarBudaya->deskripsi_singkat }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Kondisi Saat Ini</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="whitespace-pre-line text-sm sm:text-base">{{ $cagarBudaya->kondisi_saat_ini ?: 'Tidak ada data' }}</p>
                    </div>
                </div>
                
                @if (Auth::user()->role != 'user')
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-center sm:text-left">Informasi Tambahan</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat oleh:</span>
                                <span>{{ $cagarBudaya->creator->name }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat pada:</span>
                                <span>{{ $cagarBudaya->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if ($cagarBudaya->is_verified && $cagarBudaya->verifier)
                                <div class="mb-3">
                                    <span class="font-semibold">Diverifikasi oleh:</span>
                                    <span>{{ $cagarBudaya->verifier->name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if ($cagarBudaya->longitude && $cagarBudaya->latitude)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map = L.map('map').setView([{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([{{ $cagarBudaya->latitude }}, {{ $cagarBudaya->longitude }}])
                .addTo(map)
                .bindPopup('{{ $cagarBudaya->objek_cagar_budaya }}');
        });
    </script>
    @endpush
@endif
@endsection