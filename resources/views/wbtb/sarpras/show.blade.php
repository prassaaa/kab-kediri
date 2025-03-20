@extends('layouts.admin-dashboard')

@section('page-title', 'Detail Sarpras Kebudayaan')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('wbtb.sarpras.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            <div class="flex space-x-2">
                @if(Auth::user()->role != 'user' && (!$sarpras->is_verified || Auth::user()->role == 'superadmin'))
                    <a href="{{ route('wbtb.sarpras.edit', $sarpras) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                @endif
                
                @if(Auth::user()->role == 'superadmin' && !$sarpras->is_verified)
                    <form action="{{ route('wbtb.sarpras.verify', $sarpras) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center" onclick="return confirm('Yakin ingin memverifikasi data ini?')">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Verifikasi
                        </button>
                    </form>
                @endif
                
                @if(Auth::user()->role == 'superadmin')
                    <form action="{{ route('wbtb.sarpras.destroy', $sarpras) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                @endif
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Kolom 1: Foto dan Media -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Papan Nama</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sarpras->papan_nama)
                            <img src="{{ Storage::url($sarpras->papan_nama) }}" alt="{{ $sarpras->nama_sarpras }}" class="max-w-full h-auto mx-auto rounded-lg">
                        @else
                            <div class="h-40 flex items-center justify-center bg-gray-200 rounded-lg">
                                <p class="text-gray-500 italic">Tidak ada foto papan nama</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Foto Bangunan Tampak Dalam</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sarpras->foto_dalam)
                            <img src="{{ Storage::url($sarpras->foto_dalam) }}" alt="Tampak Dalam {{ $sarpras->nama_sarpras }}" class="w-full h-auto rounded-lg">
                        @else
                            <div class="h-40 flex items-center justify-center bg-gray-200 rounded-lg">
                                <p class="text-gray-500 italic">Tidak ada foto tampak dalam</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Foto Bangunan Tampak Luar</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sarpras->foto_luar)
                            <img src="{{ Storage::url($sarpras->foto_luar) }}" alt="Tampak Luar {{ $sarpras->nama_sarpras }}" class="w-full h-auto rounded-lg">
                        @else
                            <div class="h-40 flex items-center justify-center bg-gray-200 rounded-lg">
                                <p class="text-gray-500 italic">Tidak ada foto tampak luar</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Status Verifikasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sarpras->is_verified)
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-green-800 font-medium">Terverifikasi</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">
                                Diverifikasi oleh: {{ $sarpras->verifier->name ?? 'Unknown' }} <br>
                                Tanggal: {{ $sarpras->verified_at->format('d F Y, H:i') }}
                            </p>
                        @else
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <span class="text-yellow-800 font-medium">Belum Diverifikasi</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if (Auth::user()->role != 'user')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Informasi Administratif</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat oleh:</span>
                                <span>{{ $sarpras->creator ? $sarpras->creator->name : 'Unknown' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat pada:</span>
                                <span>{{ $sarpras->created_at->format('d F Y, H:i') }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Terakhir diupdate:</span>
                                <span>{{ $sarpras->updated_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Kolom 2: Informasi Dasar -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Informasi Dasar</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Nama Sarpras:</span>
                            <span class="text-lg">{{ $sarpras->nama_sarpras }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Deskripsi:</span>
                            <p class="whitespace-pre-line mt-1 text-sm">{{ $sarpras->deskripsi }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Alamat:</span>
                            <p class="whitespace-pre-line mt-1">{{ $sarpras->alamat }}</p>
                        </div>
                        
                        @if($sarpras->latitude && $sarpras->longitude)
                            <div class="mb-3">
                                <span class="font-semibold">Koordinat:</span>
                                <span>{{ $sarpras->latitude }}, {{ $sarpras->longitude }}</span>
                            </div>
                            <div class="mt-2 mb-3">
                                <div id="map" class="h-64 w-full rounded-lg border border-gray-300"></div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Kepemilikan dan Kepengurusan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Status Kepemilikan:</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ $sarpras->status_kepemilikan }}
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Nama Pemilik:</span>
                            <span>{{ $sarpras->nama_pemilik }}</span>
                        </div>
                        
                        @if($sarpras->nama_pengelola)
                            <div class="mb-3">
                                <span class="font-semibold">Nama Pengelola:</span>
                                <span>{{ $sarpras->nama_pengelola }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Kolom 3: Kontak dan Fasilitas -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Kontak</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Nama:</span>
                            <span>{{ $sarpras->nama_kontak }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Nomor HP:</span>
                            <span>{{ $sarpras->no_hp }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Fasilitas Tersedia</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($sarpras->fasilitas) && count($sarpras->fasilitas) > 0)
                            <div class="space-y-3">
                                @foreach($sarpras->fasilitas as $fasilitas)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $fasilitas['nama'] ?? '' }}</p>
                                        @if(isset($fasilitas['keterangan']) && !empty($fasilitas['keterangan']))
                                            <p class="text-sm text-gray-600">{{ $fasilitas['keterangan'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data fasilitas</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($sarpras->latitude && $sarpras->longitude)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map = L.map('map').setView([{{ $sarpras->latitude }}, {{ $sarpras->longitude }}], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([{{ $sarpras->latitude }}, {{ $sarpras->longitude }}])
                .addTo(map)
                .bindPopup('{{ $sarpras->nama_sarpras }}');
        });
    </script>
    @endpush
@endif
@endsection