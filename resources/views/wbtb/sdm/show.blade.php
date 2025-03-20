@extends('layouts.admin-dashboard')

@section('page-title', 'Detail SDM Kebudayaan')

@section('content')
<div class="bg-white overflow-hidden shadow-sm rounded-lg">
    <div class="p-6">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('wbtb.sdm.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            <div class="flex space-x-2">
                @if(Auth::user()->role != 'user' && (!$sdm->is_verified || Auth::user()->role == 'superadmin'))
                    <a href="{{ route('wbtb.sdm.edit', $sdm) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                @endif
                
                @if(Auth::user()->role == 'superadmin' && !$sdm->is_verified)
                    <form action="{{ route('wbtb.sdm.verify', $sdm) }}" method="POST">
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
                    <form action="{{ route('wbtb.sdm.destroy', $sdm) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
            <!-- Kolom 1: Foto dan Informasi Dasar -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Foto</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sdm->pas_foto)
                            <img src="{{ Storage::url($sdm->pas_foto) }}" alt="{{ $sdm->nama_lengkap }}" class="w-full h-auto rounded-lg mb-4">
                        @else
                            <div class="w-full h-64 flex items-center justify-center bg-gray-200 rounded-lg mb-4">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        @if($sdm->foto_identitas)
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Foto Identitas:</h4>
                            <img src="{{ Storage::url($sdm->foto_identitas) }}" alt="Identitas {{ $sdm->nama_lengkap }}" class="w-full h-auto rounded-lg">
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Status Verifikasi</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sdm->is_verified)
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-green-800 font-medium">Terverifikasi</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">
                                Diverifikasi oleh: {{ $sdm->verifier->name ?? 'Unknown' }} <br>
                                Tanggal: {{ $sdm->verified_at->format('d F Y, H:i') }}
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
                                <span>{{ $sdm->creator ? $sdm->creator->name : 'Unknown' }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Dibuat pada:</span>
                                <span>{{ $sdm->created_at->format('d F Y, H:i') }}</span>
                            </div>
                            <div class="mb-3">
                                <span class="font-semibold">Terakhir diupdate:</span>
                                <span>{{ $sdm->updated_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Kolom 2: Informasi Identitas dan Kontak -->
            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Identitas Tenaga Budaya</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Nama Lengkap:</span>
                            <span>{{ $sdm->nama_lengkap }}{{ $sdm->gelar_pendidikan ? ', '.$sdm->gelar_pendidikan : '' }}</span>
                        </div>
                        
                        @if($sdm->nama_alias)
                            <div class="mb-3">
                                <span class="font-semibold">Nama Alias:</span>
                                <span>{{ $sdm->nama_alias }}</span>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <span class="font-semibold">Jenis Identitas:</span>
                            <span>{{ $sdm->jenis_identitas }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Nomor Identitas:</span>
                            <span>{{ $sdm->nomor_identitas }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Tempat, Tanggal Lahir:</span>
                            <span>{{ $sdm->tempat_lahir }}, {{ $sdm->tanggal_lahir->format('d F Y') }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Usia:</span>
                            <span>{{ $sdm->tanggal_lahir->age }} tahun</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Jenis Kelamin:</span>
                            <span>{{ $sdm->jenis_kelamin }}</span>
                        </div>
                        
                        <div class="mb-3">
                            <span class="font-semibold">Kewarganegaraan:</span>
                            <span>{{ $sdm->kewarganegaraan }}</span>
                        </div>
                        
                        @if($sdm->agama)
                            <div class="mb-3">
                                <span class="font-semibold">Agama:</span>
                                <span>{{ $sdm->agama }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Alamat</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="font-semibold">Alamat Lengkap:</span>
                            <p class="whitespace-pre-line">{{ $sdm->alamat }}</p>
                        </div>
                        
                        @if($sdm->latitude && $sdm->longitude)
                            <div class="mb-3">
                                <span class="font-semibold">Koordinat:</span>
                                <span>{{ $sdm->latitude }}, {{ $sdm->longitude }}</span>
                            </div>
                            <div class="mt-2">
                                <div id="map" class="h-64 w-full rounded-lg border border-gray-300"></div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Kontak</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($sdm->nomor_hp)
                            <div class="mb-3">
                                <span class="font-semibold">Nomor HP:</span>
                                <span>{{ $sdm->nomor_hp }}</span>
                            </div>
                        @endif
                        
                        @if($sdm->email)
                            <div class="mb-3">
                                <span class="font-semibold">Email:</span>
                                <span>{{ $sdm->email }}</span>
                            </div>
                        @endif
                        
                        @if($sdm->media_sosial)
                            <div class="mb-3">
                                <span class="font-semibold">Media Sosial:</span>
                                <span>{{ $sdm->media_sosial }}</span>
                            </div>
                        @endif
                        
                        @if($sdm->nama_ayah)
                            <div class="mb-3">
                                <span class="font-semibold">Nama Ayah:</span>
                                <span>{{ $sdm->nama_ayah }}</span>
                            </div>
                        @endif
                        
                        @if($sdm->nama_ibu)
                            <div class="mb-3">
                                <span class="font-semibold">Nama Ibu:</span>
                                <span>{{ $sdm->nama_ibu }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Kolom 3: Riwayat-Riwayat -->
            <div>
                <!-- Riwayat Pendidikan -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Riwayat Pendidikan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($sdm->riwayat_pendidikan) && count($sdm->riwayat_pendidikan) > 0)
                            <div class="space-y-3">
                                @foreach($sdm->riwayat_pendidikan as $pendidikan)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $pendidikan['jenjang'] ?? '' }} - {{ $pendidikan['institusi'] ?? '' }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $pendidikan['jurusan'] ?? '' }}
                                            @if(isset($pendidikan['tahun']))
                                                <span class="text-gray-500">({{ $pendidikan['tahun'] }})</span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data riwayat pendidikan</p>
                        @endif
                    </div>
                </div>
                
                <!-- Riwayat Pelatihan -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Riwayat Pelatihan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($sdm->riwayat_pelatihan) && count($sdm->riwayat_pelatihan) > 0)
                            <div class="space-y-3">
                                @foreach($sdm->riwayat_pelatihan as $pelatihan)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $pelatihan['nama'] ?? '' }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $pelatihan['penyelenggara'] ?? '' }}
                                            @if(isset($pelatihan['tahun']) || isset($pelatihan['durasi']))
                                                <span class="text-gray-500">
                                                    ({{ $pelatihan['tahun'] ?? '' }}{{ isset($pelatihan['durasi']) ? ', '.$pelatihan['durasi'] : '' }})
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data riwayat pelatihan</p>
                        @endif
                    </div>
                </div>
                
                <!-- Riwayat Pekerjaan -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Riwayat Pekerjaan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($sdm->riwayat_pekerjaan) && count($sdm->riwayat_pekerjaan) > 0)
                            <div class="space-y-3">
                                @foreach($sdm->riwayat_pekerjaan as $pekerjaan)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $pekerjaan['posisi'] ?? '' }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $pekerjaan['instansi'] ?? '' }}
                                            @if(isset($pekerjaan['tahun']))
                                                <span class="text-gray-500">({{ $pekerjaan['tahun'] }})</span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data riwayat pekerjaan</p>
                        @endif
                    </div>
                </div>
                
                <!-- Riwayat Aktivitas Kebudayaan -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Riwayat Aktivitas Kebudayaan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($sdm->riwayat_aktivitas) && count($sdm->riwayat_aktivitas) > 0)
                            <div class="space-y-3">
                                @foreach($sdm->riwayat_aktivitas as $aktivitas)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $aktivitas['nama'] ?? '' }} ({{ $aktivitas['jenis'] ?? '' }})</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $aktivitas['penyelenggara'] ?? '' }}
                                            @if(isset($aktivitas['tahun']))
                                                <span class="text-gray-500">({{ $aktivitas['tahun'] }})</span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data riwayat aktivitas kebudayaan</p>
                        @endif
                    </div>
                </div>
                
                <!-- Riwayat Penghargaan -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Riwayat Penghargaan</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if(is_array($sdm->riwayat_penghargaan) && count($sdm->riwayat_penghargaan) > 0)
                            <div class="space-y-3">
                                @foreach($sdm->riwayat_penghargaan as $penghargaan)
                                    <div class="border-b border-gray-200 pb-2 last:border-b-0">
                                        <p class="font-medium">{{ $penghargaan['nama'] ?? '' }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ $penghargaan['pemberi'] ?? '' }}
                                            @if(isset($penghargaan['tahun']) || isset($penghargaan['tingkat']))
                                                <span class="text-gray-500">
                                                    ({{ $penghargaan['tahun'] ?? '' }}{{ isset($penghargaan['tingkat']) ? ', '.$penghargaan['tingkat'] : '' }})
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Tidak ada data riwayat penghargaan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($sdm->latitude && $sdm->longitude)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map = L.map('map').setView([{{ $sdm->latitude }}, {{ $sdm->longitude }}], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([{{ $sdm->latitude }}, {{ $sdm->longitude }}])
                .addTo(map)
                .bindPopup('{{ $sdm->nama_lengkap }}');
        });
    </script>
    @endpush
@endif
@endsection